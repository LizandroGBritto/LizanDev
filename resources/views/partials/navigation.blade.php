<nav id="secondary-nav"
    class="fixed top-0 left-0 w-full z-[9999] transition-all duration-500 transform -translate-y-full opacity-0 pointer-events-none">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div
            class="bg-slate-900/40 backdrop-blur-xl border border-white/10 rounded-full px-6 py-2 flex items-center justify-between shadow-2xl">
            <!-- Logo/Name -->
            <a href="#" class="text-white font-bold text-xl tracking-tighter flex items-center gap-2 group"
                onclick="scrollToSection('hero-section', event)">
                <span
                    class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-slate-900 group-hover:rotate-12 transition-transform">L</span>
                <span class="hidden sm:block">LizanDev</span>
            </a>

            <!-- Navigation Links -->
            <div class="flex items-center gap-1 sm:gap-6 relative">
                @php
                    $navItems = [
                        ['id' => 'hero-section', 'label' => 'Home'],
                        ['id' => 'projects', 'label' => 'Projects'],
                        ['id' => 'skills', 'label' => 'Skills'],
                        ['id' => 'about', 'label' => 'About'],
                        ['id' => 'contact', 'label' => 'Contact'],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    <a href="#{{ $item['id'] }}" data-section="{{ $item['id'] }}"
                        onclick="scrollToSection('{{ $item['id'] }}', event)"
                        class="nav-link relative px-3 py-1.5 text-sm font-medium text-slate-300 hover:text-white transition-colors duration-300">
                        {{ __($item['label']) }}
                        <div
                            class="active-dot absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-1.5 h-1.5 bg-emerald-500 rounded-full opacity-0 scale-0 transition-all duration-300">
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Action Button -->
            <div class="hidden md:block">
                <a href="#contact" onclick="scrollToSection('contact', event)"
                    class="bg-emerald-500 hover:bg-emerald-600 text-slate-900 px-5 py-2 rounded-full text-sm font-bold transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/30">
                    {{ __('Let\'s Talk') }}
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    .nav-link.active {
        color: #fff;
    }

    .nav-link.active .active-dot {
        opacity: 1;
        scale: 1;
        animation: active-pulse 2s infinite;
    }

    @keyframes active-pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }
</style>
