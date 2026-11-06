<?php

namespace App\Http\Controllers;

use App\Models\Interaccion;
use App\Support\Seguimiento\Visitante;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SeguimientoController extends Controller
{
    public function store(Request $request): Response
    {
        $proyectos = array_column(config('portfolio.projects'), 'slug');
        $tecnologias = array_column(config('portfolio.technologies'), 'name');

        $validador = Validator::make($request->all(), [
            'tipo' => ['required', Rule::in(Interaccion::TIPOS)],
            'sujeto' => ['required', 'string', 'max:80'],
            'detalle' => ['nullable', Rule::in(['laptop', 'phone'])],
        ]);

        // 422 seco, sin redirección: quien llama es un sendBeacon, no un formulario.
        abort_if($validador->fails(), 422);

        $datos = $validador->validated();

        $validos = $datos['tipo'] === Interaccion::TECNOLOGIA ? $tecnologias : $proyectos;

        abort_unless(in_array($datos['sujeto'], $validos, true), 422);
        abort_if($datos['tipo'] === Interaccion::VISTA_DISPOSITIVO && empty($datos['detalle']), 422);

        // Siempre 204: quien pidió no ser rastreado no recibe una señal distinta.
        if (! Visitante::ignorar($request)) {
            Interaccion::create([
                'visitante' => Visitante::hash($request),
                'tipo' => $datos['tipo'],
                'sujeto' => $datos['sujeto'],
                'detalle' => $datos['tipo'] === Interaccion::VISTA_DISPOSITIVO ? $datos['detalle'] : null,
            ]);
        }

        return response()->noContent();
    }
}
