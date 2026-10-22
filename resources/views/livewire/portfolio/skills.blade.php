<section id="skills" class="py-24 bg-ink">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-16 max-w-2xl">
                <h2 class="text-4xl md:text-5xl font-semibold text-white">
                    {{ __('Skills') }} <span class="text-brand-400">&</span> {{ __('Technologies') }}
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($skills as $skillGroup)
                    <div
                        class="bg-ink-raised rounded-xl p-8 border border-line-dark hover:border-brand-600 transition-colors duration-200">
                        <div class="flex items-center gap-3 mb-6">
                            <x-portfolio.icon-badge :icon="$skillGroup['icon']" />
                            <h3 class="text-xl font-semibold text-white">{{ $skillGroup['category'] }}</h3>
                        </div>

                        <ul class="flex flex-wrap gap-2">
                            @foreach ($skillGroup['items'] as $skill)
                                <li
                                    class="px-3 py-1.5 bg-ink border border-line-dark text-slate-200 rounded-md text-sm font-medium">
                                    {{ $skill }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="mt-14">
                <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-400 mb-4">
                    {{ __('Also work with:') }}</h3>
                <ul class="flex flex-wrap gap-2">
                    @foreach ($alsoWorkWith as $tech)
                        <li class="px-3 py-1.5 border border-line-dark rounded-md text-sm text-slate-300">
                            {{ $tech }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
