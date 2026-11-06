<nav class="site-nav sticky top-0 z-50" data-site-nav aria-label="{{ __('Main') }}">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-3 px-4 sm:px-6 lg:px-12">
        <a href="#hero-section" data-scroll-to="hero-section" class="flex flex-none items-center gap-2.5 font-display text-lg font-bold">
            <span class="grid h-[30px] w-[30px] place-items-center rounded-full bg-deep text-mint" aria-hidden="true">L</span>
            <span class="hidden lg:inline">LizanDev</span>
        </a>

        <div class="hidden h-full items-center gap-6 lg:flex">
            @foreach ($items as $item)
                <a href="#{{ $item['id'] }}" data-section="{{ $item['id'] }}" data-scroll-to="{{ $item['id'] }}"
                    class="nav-link inline-flex h-full items-center text-sm whitespace-nowrap">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        <div class="flex items-center gap-2.5">
            <livewire:language-switcher />

            <a href="#contact" data-scroll-to="contact"
                class="flex-none rounded-full bg-deep px-5 py-[11px] text-sm font-semibold text-white transition-colors hover:bg-brand-800">
                {{ __("Let's Talk") }}
            </a>
        </div>
    </div>
</nav>
