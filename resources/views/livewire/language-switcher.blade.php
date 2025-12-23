<div class="fixed top-6 right-6 z-50 transition-all duration-300" id="language-switcher"
    x-data="{ open: @entangle('isOpen') }">

    <div class="relative">
        <!-- Botón Principal -->
        <button @click="open = !open"
            class="flex items-center gap-2 px-4 py-2 bg-slate-800/90 backdrop-blur-sm border border-slate-700/50 text-white rounded-full hover:bg-slate-700/90 hover:border-purple-500/50 transition-all duration-300 shadow-lg">

            <!-- Bandera/Icono según idioma actual -->
            @if($currentLocale === 'es')
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                    <rect width="24" height="8" fill="#AA151B" />
                    <rect y="8" width="24" height="8" fill="#F1BF00" />
                    <rect y="16" width="24" height="8" fill="#AA151B" />
                </svg>
                <span class="text-sm font-medium">ES</span>
            @else
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                    <rect width="24" height="24" fill="#012169" />
                    <path d="M0 0L24 24M24 0L0 24" stroke="white" stroke-width="3" />
                    <path d="M0 0L24 24M24 0L0 24" stroke="#C8102E" stroke-width="2" />
                    <path d="M12 0V24M0 12H24" stroke="white" stroke-width="4" />
                    <path d="M12 0V24M0 12H24" stroke="#C8102E" stroke-width="2.5" />
                </svg>
                <span class="text-sm font-medium">EN</span>
            @endif

            <!-- Icono de flecha -->
            <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" @click.away="open = false"
            class="absolute top-full right-0 mt-2 w-40 bg-slate-800/95 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-xl overflow-hidden">

            <!-- Opción Español -->
            <button wire:click="switchLocale('es')"
                class="w-full flex items-center gap-3 px-4 py-3 text-white hover:bg-purple-500/20 transition-colors duration-200 {{ $currentLocale === 'es' ? 'bg-purple-500/10' : '' }}">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                    <rect width="24" height="8" fill="#AA151B" />
                    <rect y="8" width="24" height="8" fill="#F1BF00" />
                    <rect y="16" width="24" height="8" fill="#AA151B" />
                </svg>
                <span class="text-sm font-medium">Español</span>
                @if($currentLocale === 'es')
                    <svg class="w-4 h-4 ml-auto text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                @endif
            </button>

            <!-- Opción English -->
            <button wire:click="switchLocale('en')"
                class="w-full flex items-center gap-3 px-4 py-3 text-white hover:bg-purple-500/20 transition-colors duration-200 {{ $currentLocale === 'en' ? 'bg-purple-500/10' : '' }}">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                    <rect width="24" height="24" fill="#012169" />
                    <path d="M0 0L24 24M24 0L0 24" stroke="white" stroke-width="3" />
                    <path d="M0 0L24 24M24 0L0 24" stroke="#C8102E" stroke-width="2" />
                    <path d="M12 0V24M0 12H24" stroke="white" stroke-width="4" />
                    <path d="M12 0V24M0 12H24" stroke="#C8102E" stroke-width="2.5" />
                </svg>
                <span class="text-sm font-medium">English</span>
                @if($currentLocale === 'en')
                    <svg class="w-4 h-4 ml-auto text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                @endif
            </button>
        </div>
    </div>
</div>

<script>
    // Ocultar el selector al hacer scroll
    let lastScrollTop = 0;
    const languageSwitcher = document.getElementById('language-switcher');
    let hideTimeout;

    window.addEventListener('scroll', function () {
        clearTimeout(hideTimeout);

        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > 100) {
            // Después de 100px de scroll, empezar a ocultar
            languageSwitcher.style.opacity = '0';
            languageSwitcher.style.pointerEvents = 'none';
        } else {
            // Mostrar cuando está arriba
            languageSwitcher.style.opacity = '1';
            languageSwitcher.style.pointerEvents = 'auto';
        }

        lastScrollTop = scrollTop;
    }, false);

    // Mostrar temporalmente cuando el mouse se acerca a la esquina
    document.addEventListener('mousemove', function (e) {
        if (e.clientX > window.innerWidth - 200 && e.clientY < 100) {
            languageSwitcher.style.opacity = '1';
            languageSwitcher.style.pointerEvents = 'auto';

            clearTimeout(hideTimeout);
            hideTimeout = setTimeout(() => {
                if (window.pageYOffset > 100) {
                    languageSwitcher.style.opacity = '0';
                    languageSwitcher.style.pointerEvents = 'none';
                }
            }, 2000);
        }
    });

    // Recargar la página cuando cambia el idioma
    window.addEventListener('locale-changed', () => {
        window.location.reload();
    });
</script>