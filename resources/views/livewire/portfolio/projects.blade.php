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

                                @if ($project['demo'])
                                    <a href="{{ $project['demo'] }}" target="_blank" rel="noopener" data-demo
                                        class="mt-1.5 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-700 underline underline-offset-4 hover:text-deep">
                                        <x-icon name="external-link" class="h-4 w-4" />
                                        {{ __('Demo') }}
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
