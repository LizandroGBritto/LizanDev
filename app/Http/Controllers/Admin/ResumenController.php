<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interaccion;
use App\Models\MensajeContacto;
use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ResumenController extends Controller
{
    private const PERIODOS = [7, 30, 90];

    private const DISPOSITIVOS = ['escritorio' => 'Desktop', 'movil' => 'Mobile', 'tablet' => 'Tablet'];

    public function __invoke(Request $request): View
    {
        // Un valor fuera de la lista (o no numérico) cae en 30 días: nunca llega a la consulta.
        $dias = (int) $request->query('dias');
        $dias = in_array($dias, self::PERIODOS, true) ? $dias : 30;
        $desde = now()->subDays($dias - 1)->startOfDay();

        $visitas = Visita::where('created_at', '>=', $desde);

        $resumen = [
            'visitas' => (clone $visitas)->count(),
            'visitantes' => (clone $visitas)->distinct()->count('visitante'),
            'hoy' => Visita::where('created_at', '>=', now()->startOfDay())->count(),
            'sinLeer' => MensajeContacto::sinLeer()->count(),
        ];

        $porDia = (clone $visitas)
            ->selectRaw('date(created_at) as dia, count(*) as total')
            ->groupBy('dia')
            ->pluck('total', 'dia');

        $serie = collect(range($dias - 1, 0))->map(function (int $atras) use ($porDia) {
            $dia = now()->subDays($atras)->toDateString();

            return ['dia' => $dia, 'total' => (int) ($porDia[$dia] ?? 0)];
        });

        return view('admin.resumen', [
            'dias' => $dias,
            'periodos' => self::PERIODOS,
            'resumen' => $resumen,
            'serie' => $serie,
            'maximoDia' => max(1, $serie->max('total')),
            'proyectos' => $this->proyectos($desde),
            'tecnologias' => $this->conteo(Interaccion::TECNOLOGIA, $desde)->take(5),
            'referentes' => (clone $visitas)->whereNotNull('referente')
                ->selectRaw('referente as nombre, count(*) as total')->groupBy('referente')
                ->orderByDesc('total')->limit(5)->get(),
            'directas' => (clone $visitas)->whereNull('referente')->count(),
            'dispositivos' => $this->agrupar($visitas, 'dispositivo', fn (string $valor) => __(self::DISPOSITIVOS[$valor] ?? 'Other')),
            'idiomas' => $this->agrupar($visitas, 'idioma', fn (string $valor) => strtoupper($valor)),
        ]);
    }

    /** Todos los proyectos del portafolio, también los que todavía no tienen interacciones. */
    private function proyectos($desde)
    {
        $base = fn (string $tipo) => Interaccion::where('tipo', $tipo)->where('created_at', '>=', $desde);

        $vistos = $base(Interaccion::PROYECTO_VISTO)
            ->selectRaw('sujeto, count(*) as vistas, count(distinct visitante) as visitantes')
            ->groupBy('sujeto')->get()->keyBy('sujeto');
        $celular = $base(Interaccion::VISTA_DISPOSITIVO)->where('detalle', 'phone')
            ->select('sujeto', DB::raw('count(*) as total'))->groupBy('sujeto')->pluck('total', 'sujeto');
        $demos = $base(Interaccion::DEMO_CLIC)
            ->select('sujeto', DB::raw('count(*) as total'))->groupBy('sujeto')->pluck('total', 'sujeto');

        return collect(config('portfolio.projects'))->map(fn (array $proyecto) => [
            'titulo' => __($proyecto['title']),
            'vistas' => (int) ($vistos[$proyecto['slug']]->vistas ?? 0),
            'visitantes' => (int) ($vistos[$proyecto['slug']]->visitantes ?? 0),
            'celular' => (int) ($celular[$proyecto['slug']] ?? 0),
            'demos' => (int) ($demos[$proyecto['slug']] ?? 0),
        ])->sortByDesc('vistas')->values();
    }

    private function conteo(string $tipo, $desde)
    {
        return Interaccion::where('tipo', $tipo)->where('created_at', '>=', $desde)
            ->selectRaw('sujeto as nombre, count(*) as total')->groupBy('sujeto')
            ->orderByDesc('total')->get();
    }

    private function agrupar($consulta, string $columna, callable $etiqueta)
    {
        return (clone $consulta)->whereNotNull($columna)
            ->selectRaw("{$columna} as nombre, count(*) as total")->groupBy($columna)
            ->orderByDesc('total')->get()
            ->map(fn ($fila) => (object) ['nombre' => $etiqueta($fila->nombre), 'total' => $fila->total]);
    }
}
