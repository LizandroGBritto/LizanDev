<nav id="secondary-nav"
    class="fixed top-0 left-0 w-full z-[9999] transition-all duration-500 transform -translate-y-full opacity-0 pointer-events-none">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div
            class="bg-slate-900/80 backdrop-blur-xl border border-white/10 rounded-full px-6 py-2 flex items-center justify-between shadow-2xl">
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

<script>
    function scrollToSection(id, event) {
        if (event) event.preventDefault();
        const element = document.getElementById(id);
        if (element) {
            const offset = 80;
            const bodyRect = document.body.getBoundingClientRect().top;
            const elementRect = element.getBoundingClientRect().top;
            const elementPosition = elementRect - bodyRect;
            const offsetPosition = elementPosition - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const secondaryNav = document.getElementById('secondary-nav');
        const sections = ['hero-section', 'projects', 'skills', 'about', 'contact'];
        const sectionElements = sections.map(id => document.getElementById(id));
        const navLinks = document.querySelectorAll('.nav-link');

        // Classes for hidden state
        const hiddenClasses = ['-translate-y-full', 'opacity-0', 'pointer-events-none'];
        // Classes for visible state
        const visibleClasses = ['translate-y-0', 'opacity-100', 'pointer-events-auto'];

        // Scroll Event for Visibility
        function updateNavVisibility() {
            if (window.scrollY > 50) {
                // Show Nav
                secondaryNav.classList.remove(...hiddenClasses);
                secondaryNav.classList.add(...visibleClasses);
            } else {
                // Hide Nav
                secondaryNav.classList.remove(...visibleClasses);
                secondaryNav.classList.add(...hiddenClasses);
            }
        }

        window.addEventListener('scroll', updateNavVisibility);
        // Initial check
        updateNavVisibility();

        // Observer for Scrollspy
        const scrollspyObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    navLinks.forEach(link => {
                        if (link.dataset.section === id) {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }
            });
        }, {
            rootMargin: '-40% 0px -40% 0px',
            threshold: 0
        });

        sectionElements.forEach(el => {
            if (el) scrollspyObserver.observe(el);
        });
    });
</script>
