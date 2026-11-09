<div>
    <section id="projects" class="overflow-x-clip border-t border-line px-5 py-10 lg:px-12 lg:py-[72px]">
        <div class="mx-auto grid max-w-7xl gap-[22px]">
            <div>
                <p class="eyebrow">{{ __('Projects') }}</p>
                <h2 class="mt-2 max-w-[20ch] text-[clamp(1.6rem,4vw,2.75rem)] leading-[1.04] font-bold">
                    {{ __('A selection of what I have built') }}
                </h2>
            </div>

            <div class="grid gap-[18px] lg:grid-cols-[300px_1fr] lg:items-center lg:gap-10" data-deck-root>
                <div class="deck__texto grid content-start gap-4">
                    {{-- Todas las descripciones comparten la misma celda: la más larga fija el alto y los controles no se mueven --}}
                    <div class="deck__descs">
                        @foreach ($projects as $project)
                            <p @class(['deck__desc text-muted', 'is-active' => $loop->first]) data-deck-desc>
                                {{ $project['description'] }}</p>
                        @endforeach
                    </div>

                    <div class="deck__pasos" role="group" aria-label="{{ __('Projects') }}">
                        @foreach ($projects as $project)
                            <button type="button" @class(['deck__paso', 'is-current' => $loop->first]) data-deck-step
                                aria-label="{{ __('Show :project', ['project' => $project['title']]) }}"
                                @if ($loop->first) aria-current="true" @endif>
                                <span class="deck__linea"><span class="deck__relleno"></span></span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="deck" data-deck>
                    @foreach ($projects as $project)
                        <article class="deck__slide" style="--o:{{ $loop->index }}" data-project="{{ $project['slug'] }}"
                            data-description="{{ $project['description'] }}" @if ($project['mobile']) data-device @endif>
                            @if ($project['image'])
                                <div class="deck__captura deck__captura--dispositivo">
                                    <div class="dispositivo">
                                        <div class="dispositivo__cara">
                                            <div class="laptop">
                                                <div class="laptop__pantalla">
                                                    <img src="{{ $project['image'] }}"
                                                        alt="{{ __('Screenshot of :project', ['project' => $project['title']]) }}"
                                                        width="960" height="600" @unless ($loop->first) loading="lazy" @endunless
                                                        decoding="async">
                                                </div>
                                                <div class="laptop__base"></div>
                                            </div>
                                        </div>
                                        @if ($project['mobile'])
                                            <div class="dispositivo__cara dispositivo__cara--atras" aria-hidden="true">
                                                <div class="phone">
                                                    <img src="{{ $project['mobile'] }}" alt="" width="390" height="844"
                                                        loading="lazy" decoding="async">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($project['image'])
                                <div class="deck__captura">
                                    <img src="{{ $project['image'] }}" alt="{{ __('Screenshot of :project', ['project' => $project['title']]) }}"
                                        width="960" height="540" @unless ($loop->first) loading="lazy" @endunless
                                        decoding="async">
                                </div>
                            @else
                                <div class="deck__captura deck__captura--vacia" aria-hidden="true">
                                    {{ $project['placeholder'] }}</div>
                            @endif

                            <div class="grid gap-1.5 px-[18px] pt-3.5 pb-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="grid gap-1.5">
                                        <h3 class="text-xl font-bold">{{ $project['title'] }}</h3>
                                        <p class="text-[13.5px] text-muted">{{ $project['badge'] }}</p>
                                    </div>

                                    @if ($project['mobile'])
                                        <div class="deck__vista" role="group" aria-label="{{ __('Device') }}"
                                            data-device-toggle>
                                            <button type="button" data-device-view="laptop" aria-pressed="true"
                                                aria-label="{{ __('View on laptop') }}">
                                                <x-icon name="laptop" class="h-4 w-4" />
                                            </button>
                                            <button type="button" data-device-view="phone" aria-pressed="false"
                                                aria-label="{{ __('View on phone') }}">
                                                <x-icon name="phone" class="h-4 w-4" />
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                <ul class="mt-0.5 flex flex-wrap gap-1.5">
                                    @foreach (array_slice($project['tech'], 0, 4) as $tech)
                                        <li class="rounded-md bg-mint px-2.5 py-0.5 text-[11.5px] font-semibold text-deep">
                                            {{ $tech }}</li>
                                    @endforeach
                                </ul>

                                <div class="mt-1.5 flex flex-wrap items-center gap-x-5 gap-y-1">
                                    <button type="button" data-detail-open aria-haspopup="dialog"
                                        class="inline-flex cursor-pointer items-center gap-1.5 text-sm font-semibold text-brand-700 underline underline-offset-4 hover:text-deep">
                                        <x-icon name="collection" class="h-4 w-4" />
                                        {{ __('Details') }}
                                    </button>

                                    @if ($project['demo'])
                                        <a href="{{ $project['demo'] }}" target="_blank" rel="noopener" data-demo
                                            class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-700 underline underline-offset-4 hover:text-deep">
                                            <x-icon name="external-link" class="h-4 w-4" />
                                            {{ __('Demo') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Un modal por proyecto: se abre al tocar la card (features/project-detail.js) --}}
        @foreach ($projects as $project)
            <dialog class="detalle" data-detail="{{ $project['slug'] }}" data-project="{{ $project['slug'] }}" aria-labelledby="detalle-{{ $project['slug'] }}">
                <div class="detalle__panel">
                    <header class="detalle__cabecera">
                        <div class="grid gap-1">
                            <p class="eyebrow">{{ $project['badge'] }}</p>
                            <h3 id="detalle-{{ $project['slug'] }}" class="text-2xl leading-tight font-bold">
                                {{ $project['title'] }}</h3>
                        </div>
                        <button type="button" class="detalle__cerrar" data-detail-close aria-label="{{ __('Close') }}">
                            <x-icon name="close" class="h-5 w-5" />
                        </button>
                    </header>

                    <div class="detalle__cuerpo">
                        <div class="detalle__galeria" data-gallery>
                            <div class="detalle__escenario">
                                @foreach ($project['views'] as $view)
                                    <figure @class(['detalle__vista', 'is-active' => $loop->first]) data-gallery-view>
                                        <div class="detalle__laptop">
                                            <img src="{{ $view['image'] }}" width="960" height="600" loading="lazy"
                                                decoding="async"
                                                alt="{{ __(':view of :project', ['view' => $view['label'], 'project' => $project['title']]) }}">
                                        </div>
                                        @if ($view['mobile'])
                                            <div class="detalle__celular">
                                                <img src="{{ $view['mobile'] }}" width="390" height="844" loading="lazy"
                                                    decoding="async"
                                                    alt="{{ __(':view of :project', ['view' => $view['label'], 'project' => $project['title']]) }}">
                                            </div>
                                        @endif
                                    </figure>
                                @endforeach
                            </div>

                            <div class="detalle__controles">
                                @if (count($project['views']) > 1)
                                    <ul class="detalle__miniaturas" aria-label="{{ __('Views') }}">
                                        @foreach ($project['views'] as $view)
                                            <li>
                                                <button type="button" data-gallery-thumb @class(['is-active' => $loop->first])
                                                    aria-pressed="{{ $loop->first ? 'true' : 'false' }}">
                                                    <img src="{{ $view['image'] }}" alt="" width="96" height="60"
                                                        loading="lazy" decoding="async">
                                                    <span>{{ $view['label'] }}</span>
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($project['mobile'])
                                    <div class="deck__vista" role="group" aria-label="{{ __('Device') }}">
                                        <button type="button" data-gallery-device="laptop" aria-pressed="true"
                                            aria-label="{{ __('View on laptop') }}">
                                            <x-icon name="laptop" class="h-4 w-4" />
                                        </button>
                                        <button type="button" data-gallery-device="phone" aria-pressed="false"
                                            aria-label="{{ __('View on phone') }}">
                                            <x-icon name="phone" class="h-4 w-4" />
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="detalle__texto">
                            <p class="text-muted">{{ $project['description'] }}</p>

                            @if ($project['highlights'])
                                <div class="grid gap-2">
                                    <h4 class="eyebrow">{{ __('Highlights') }}</h4>
                                    <ul class="detalle__puntos">
                                        @foreach ($project['highlights'] as $punto)
                                            <li>
                                                <x-icon name="check" class="mt-0.5 h-4 w-4 shrink-0 text-brand-700" />
                                                <span>{{ $punto }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="grid gap-2">
                                <h4 class="eyebrow">{{ __('Technologies') }}</h4>
                                <ul class="flex flex-wrap gap-1.5">
                                    @foreach ($project['tech'] as $tech)
                                        <li class="rounded-md bg-mint px-2.5 py-0.5 text-[12px] font-semibold text-deep">
                                            {{ $tech }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            @if ($project['demo'])
                                <a href="{{ $project['demo'] }}" target="_blank" rel="noopener" data-demo
                                    class="inline-flex w-fit items-center gap-1.5 rounded-lg bg-deep px-4 py-2.5 text-sm font-semibold text-paper hover:bg-deep-raised">
                                    <x-icon name="external-link" class="h-4 w-4" />
                                    {{ __('Demo') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </dialog>
        @endforeach
    </section>
</div>
