<div>
    <section id="hero-section"
        class="relative min-h-screen flex items-center justify-center bg-ink overflow-hidden pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:grid lg:grid-cols-2 gap-12 items-center">

                <div class="text-center lg:text-left space-y-8">
                    <div class="space-y-4">
                        <h1 class="text-5xl md:text-7xl font-semibold text-white leading-[1.02]">
                            {{ __("Hello, I'm") }} <span class="text-brand-400">{{ $name }}</span>
                        </h1>

                        <div
                            class="text-2xl md:text-3xl text-slate-300 font-light flex items-center justify-center lg:justify-start gap-3">
                            <div class="role-carousel" aria-label="{{ implode(', ', $roles) }}">
                                <div class="role-carousel-inner" aria-hidden="true">
                                    @foreach ($roles as $role)
                                        <span class="role-item">{{ $role }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <span @class(['order-first' => ! $roleFirst])>{{ __('Developer') }}</span>
                        </div>

                        <p class="text-lg md:text-xl text-slate-400 max-w-xl mx-auto lg:mx-0">
                            {{ $description }}
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start items-center pt-4">
                        <a href="#projects"
                            class="px-7 py-3.5 bg-brand-500 hover:bg-brand-400 text-ink rounded-lg font-semibold transition-colors">
                            {{ __('View Projects') }}
                        </a>
                        <a href="#contact"
                            class="px-7 py-3.5 border border-slate-600 hover:border-slate-300 text-white rounded-lg font-semibold transition-colors">
                            {{ __('Contact Me') }}
                        </a>
                    </div>

                    <div class="flex gap-5 justify-center lg:justify-start pt-4">
                        <a href="{{ $socials['github'] }}" target="_blank" rel="noopener" aria-label="GitHub"
                            class="text-slate-400 hover:text-white transition-colors">
                            <x-icon name="github" class="w-7 h-7" />
                        </a>
                        <a href="{{ $socials['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn"
                            class="text-slate-400 hover:text-white transition-colors">
                            <x-icon name="linkedin" class="w-7 h-7" />
                        </a>
                        <a href="mailto:{{ $socials['email'] }}" aria-label="Email"
                            class="text-slate-400 hover:text-white transition-colors">
                            <x-icon name="mail" class="w-7 h-7" />
                        </a>
                    </div>
                </div>

                <div class="relative h-[300px] lg:h-[600px] flex items-center justify-center scale-[0.5] lg:scale-100"
                    id="robot-area">
                    <x-portfolio.robot id="robot" data-robot :lines="3" />
                </div>

            </div>
        </div>

        <a href="#projects" aria-label="{{ __('Projects') }}"
            class="absolute bottom-8 left-1/2 -translate-x-1/2 text-slate-500 hover:text-white transition-colors">
            <x-icon name="arrow-down" class="w-6 h-6" />
        </a>
    </section>
</div>
