<div>
    <section id="hero-section" class="px-5 pt-8 pb-5 lg:px-12 lg:pt-14 lg:pb-6">
        <div class="mx-auto grid max-w-7xl items-center gap-4 lg:grid-cols-[1.15fr_.85fr] lg:gap-8">
            <div>
                <h1 class="text-[clamp(2.6rem,12vw,5.25rem)] leading-[.98] font-bold">
                    {{ __("Hello, I'm") }}
                    <mark class="hero-mark">{{ $firstName }}</mark> {{ $lastName }}.
                </h1>

                <p class="mt-3.5 max-w-[42ch] text-[17px] text-muted">{{ $description }}</p>

                <div class="mt-[22px] flex flex-wrap gap-2.5">
                    <a href="#projects" data-scroll-to="projects"
                        class="rounded-full bg-deep px-5 py-[11px] text-sm font-semibold text-white transition-colors hover:bg-brand-800">
                        {{ __('View Projects') }}
                    </a>
                    <a href="#contact" data-scroll-to="contact"
                        class="rounded-full border-[1.5px] border-ink px-5 py-[11px] text-sm font-semibold text-ink transition-colors hover:bg-ink hover:text-white">
                        {{ __('Contact Me') }}
                    </a>
                </div>

                <span
                    class="mt-5 inline-flex items-center gap-2 rounded-full bg-mint px-3.5 py-1.5 text-[13px] font-semibold text-deep">
                    <span class="h-2 w-2 rounded-full bg-brand-600" aria-hidden="true"></span>
                    {{ $status }}
                </span>
            </div>

            <x-three.carnet :photo="$photo" :name="$firstName . ' ' . $lastName" :role="$role" :skills="$skills" />
        </div>
    </section>
</div>
