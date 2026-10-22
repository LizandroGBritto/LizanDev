<section id="about" class="py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-16">
                <h2 class="text-4xl md:text-5xl font-semibold text-slate-900">
                    Sobre <span class="text-brand-700">Mí</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="aspect-square rounded-xl bg-emerald-50 border border-line relative overflow-hidden"
                        data-about-card>
                        @if ($photo)
                            <img src="{{ $photo }}" alt="{{ config('portfolio.name') }}" width="400" height="400"
                                loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full p-8">
                                <x-icon name="user" class="w-full h-full text-brand-700/20" />
                            </div>
                        @endif

                        <div class="about-robot absolute -right-10 -bottom-10 z-10" data-about-robot>
                            <x-portfolio.robot class="robot-container--mini" :lines="2" />
                        </div>
                    </div>
                </div>

                <div>
                    <p class="text-lg md:text-xl text-slate-600 leading-relaxed max-w-prose">
                        {{ $bio }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
