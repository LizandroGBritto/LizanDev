@extends('layouts.admin')

@section('title', __('Overview'))

@section('body')
    @include('admin.partials.cabecera', ['activo' => 'resumen'])

    <main class="mx-auto grid max-w-5xl grid-cols-[minmax(0,1fr)] gap-8 px-4 py-8">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <h1 class="text-3xl font-bold">{{ __('Overview') }}</h1>
                <p class="text-muted">{{ __('Visits and interactions on the portfolio. No IP addresses are stored.') }}</p>
            </div>

            <nav class="flex gap-2 text-sm" aria-label="{{ __('Period') }}">
                @foreach ($periodos as $periodo)
                    <a href="{{ route('admin.resumen', ['dias' => $periodo]) }}" @if ($periodo === $dias) aria-current="page" @endif
                        class="rounded-full border border-line px-4 py-1.5 aria-[current=page]:border-deep aria-[current=page]:bg-deep aria-[current=page]:text-white">{{ __(':days days', ['days' => $periodo]) }}</a>
                @endforeach
            </nav>
        </div>

        <dl class="grid grid-cols-2 gap-3 md:grid-cols-4">
            @foreach ([
                [__('Visits'), $resumen['visitas']],
                [__('Visitors'), $resumen['visitantes']],
                [__('Today'), $resumen['hoy']],
                [__('Unread messages'), $resumen['sinLeer']],
            ] as [$etiqueta, $valor])
                <div class="rounded-xl border border-line bg-card p-4">
                    <dt class="text-sm text-muted">{{ $etiqueta }}</dt>
                    <dd class="mt-1 text-3xl font-bold">{{ number_format($valor) }}</dd>
                </div>
            @endforeach
        </dl>

        <section aria-labelledby="titulo-serie" class="rounded-xl border border-line bg-card p-5">
            <h2 id="titulo-serie" class="mb-4 text-lg font-bold">{{ __('Visits per day') }}</h2>
            <ol class="panel-serie" role="img"
                aria-label="{{ __('Visits per day') }}: {{ $serie->sum('total') }}">
                @foreach ($serie as $punto)
                    <li class="panel-serie__dia" title="{{ $punto['dia'] }}: {{ $punto['total'] }}">
                        <span class="panel-serie__barra" style="--h:{{ round($punto['total'] / $maximoDia * 100) }}%"></span>
                    </li>
                @endforeach
            </ol>
        </section>

        <section aria-labelledby="titulo-proyectos" class="rounded-xl border border-line bg-card p-5">
            <h2 id="titulo-proyectos" class="text-lg font-bold">{{ __('Projects viewed') }}</h2>
            <p class="mb-4 text-sm text-muted">{{ __('A project counts as viewed after it stays on screen for a moment.') }}</p>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[32rem] text-left text-sm">
                    <thead class="text-muted">
                        <tr>
                            <th scope="col" class="py-2 pr-3 font-medium">{{ __('Project') }}</th>
                            <th scope="col" class="px-3 py-2 text-right font-medium">{{ __('Views') }}</th>
                            <th scope="col" class="px-3 py-2 text-right font-medium">{{ __('Visitors') }}</th>
                            <th scope="col" class="px-3 py-2 text-right font-medium">{{ __('On phone') }}</th>
                            <th scope="col" class="py-2 pl-3 text-right font-medium">{{ __('Demo clicks') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $proyecto)
                            <tr class="border-t border-line">
                                <th scope="row" class="py-2.5 pr-3 font-semibold">{{ $proyecto['titulo'] }}</th>
                                <td class="px-3 py-2.5 text-right">{{ $proyecto['vistas'] }}</td>
                                <td class="px-3 py-2.5 text-right">{{ $proyecto['visitantes'] }}</td>
                                <td class="px-3 py-2.5 text-right">{{ $proyecto['celular'] }}</td>
                                <td class="py-2.5 pl-3 text-right">{{ $proyecto['demos'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div class="grid gap-4 md:grid-cols-2">
            @foreach ([
                [__('Top technologies'), $tecnologias, null],
                [__('Where visitors come from'), $referentes, $directas],
                [__('Devices'), $dispositivos, null],
                [__('Languages'), $idiomas, null],
            ] as [$titulo, $filas, $directo])
                <section class="rounded-xl border border-line bg-card p-5">
                    <h2 class="mb-3 text-lg font-bold">{{ $titulo }}</h2>

                    @if ($filas->isEmpty() && ! $directo)
                        <p class="text-sm text-muted">{{ __('No data yet.') }}</p>
                    @else
                        <ul class="grid gap-1.5 text-sm">
                            @if ($directo)
                                <li class="flex justify-between gap-3"><span>{{ __('Direct') }}</span><span class="font-semibold">{{ $directo }}</span></li>
                            @endif
                            @foreach ($filas as $fila)
                                <li class="flex justify-between gap-3">
                                    <span class="min-w-0 break-all">{{ $fila->nombre }}</span>
                                    <span class="font-semibold">{{ $fila->total }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </section>
            @endforeach
        </div>
    </main>
@endsection
