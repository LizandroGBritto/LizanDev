<section id="about" class="overflow-x-clip px-5 py-10 lg:px-12 lg:py-[72px]">
    <div class="mx-auto grid max-w-6xl gap-10 md:grid-cols-2 md:items-center md:gap-14">
        <div class="relative mx-auto w-full max-w-md">
            <div class="relative aspect-square overflow-hidden rounded-2xl border border-line bg-mint" data-about-card>
                @if ($photo)
                    <img src="{{ $photo }}" alt="{{ config('portfolio.name') }}" width="640" height="640"
                        loading="lazy" decoding="async" class="absolute inset-0 h-full w-full object-cover">
                @else
                    <div class="flex h-full items-center justify-center p-8 text-brand-700">
                        <x-icon name="user" class="h-1/2 w-1/2" />
                    </div>
                @endif

                <div class="about-robot absolute -right-6 -bottom-8 z-10 sm:-right-10 sm:-bottom-10" data-about-robot
                    aria-hidden="true">
                    <x-portfolio.robot class="robot-container--mini" :lines="2" />
                </div>
            </div>
        </div>

        <div class="grid gap-3.5">
            <p class="eyebrow">{{ __('About') }}</p>
            <h2 class="text-[clamp(1.6rem,4vw,2.75rem)] leading-[1.04] font-bold">{{ __('About me') }}</h2>
            <p class="max-w-[60ch] text-[17px] leading-relaxed text-muted">{{ $bio }}</p>
        </div>
    </div>
</section>
