@props(['project'])

<div class="project-card mb-12">
    <div
        class="bg-white border border-line rounded-xl overflow-hidden hover:border-brand-700/50 transition-colors duration-200">
        <div class="grid md:grid-cols-2 gap-0">
            <div class="p-8 md:p-12 flex flex-col justify-center md:min-h-[520px]">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                    <span class="text-brand-700 text-xs font-semibold uppercase tracking-wider">
                        {{ $project['badge'] }}
                    </span>
                </div>

                <h4 class="text-3xl md:text-4xl font-semibold text-slate-900 mb-4">
                    {{ $project['title'] }}
                </h4>

                <p class="text-slate-600 text-lg leading-relaxed mb-8 line-clamp-4">
                    {{ $project['description'] }}
                </p>

                <div class="mb-6 mt-auto">
                    <ul class="flex flex-wrap gap-2">
                        @foreach ($project['tech'] as $tech)
                            <li
                                class="px-3 py-1 rounded-md text-sm font-medium bg-emerald-50 text-emerald-900 border border-emerald-100">
                                {{ $tech }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if ($project['demo'])
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ $project['demo'] }}" target="_blank" rel="noopener"
                            class="inline-flex items-center gap-2.5 px-6 py-3 bg-brand-700 hover:bg-emerald-800 text-white font-semibold rounded-lg transition-colors">
                            <x-icon name="external-link" class="w-5 h-5" />
                            {{ __('Demo') }}
                        </a>
                    </div>
                @endif
            </div>

            @if ($project['carousel'])
                <x-portfolio.carousel :slides="$project['carousel']" :reverse="$project['reverse']"
                    id="{{ $project['id'] }}-carousel" />
            @elseif ($project['placeholder'])
                <div @class([
                    'min-h-[260px] md:min-h-[520px] bg-emerald-50 flex flex-col items-center justify-center gap-4 border-t md:border-t-0 border-line',
                    'md:order-first md:border-r' => $project['reverse'],
                    'md:border-l' => ! $project['reverse'],
                ])>
                    <x-icon :name="$project['placeholder']['icon']" stroke-width="1.25"
                        class="w-24 h-24 text-brand-700/40" />
                    <p class="text-emerald-900 font-semibold text-lg">{{ $project['placeholder']['label'] }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
