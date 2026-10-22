<nav class="site-nav fixed top-0 left-0 w-full z-[9999] bg-ink border-b border-line-dark" data-site-nav>
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-2 sm:gap-3">
        <a href="#hero-section" data-scroll-to="hero-section" class="flex-none flex items-center gap-2.5 text-white">
            <span
                class="w-8 h-8 bg-brand-500 rounded-md flex items-center justify-center text-ink font-display font-bold">L</span>
            <span class="hidden sm:block font-display font-semibold tracking-tight">LizanDev</span>
        </a>

        <div class="flex items-center sm:gap-2 min-w-0 overflow-x-auto [scrollbar-width:none] h-full">
            @foreach ($items as $item)
                <a href="#{{ $item['id'] }}" data-section="{{ $item['id'] }}" data-scroll-to="{{ $item['id'] }}"
                    class="nav-link h-full inline-flex items-center px-1.5 sm:px-3 text-[12.5px] sm:text-sm font-medium whitespace-nowrap text-slate-400 hover:text-white">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        <a href="#contact" data-scroll-to="contact"
            class="hidden md:inline-block flex-none bg-brand-500 hover:bg-brand-400 text-ink px-4 py-2 rounded-md text-sm font-semibold transition-colors">
            {{ __('Let\'s Talk') }}
        </a>
    </div>
</nav>
