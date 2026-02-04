<div>
    <section id="projects" class="py-20 bg-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 opacity-20">
            <div
                class="absolute top-20 left-10 w-96 h-96 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl">
            </div>
            <div
                class="absolute bottom-20 right-10 w-96 h-96 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl">
            </div>
        </div>

        <!-- Olas decorativas -->
        <div class="absolute inset-0 pointer-events-none">
            <!-- Ola superior -->
            <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-b from-emerald-50/70 to-transparent"></div>
            <svg class="absolute top-0 left-0 w-full" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path
                    d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"
                    fill="#10b981" fill-opacity="0.12" />
            </svg>

            <!-- Ola media -->
            <svg class="absolute top-1/3 left-0 w-full" viewBox="0 0 1440 100" preserveAspectRatio="none">
                <path
                    d="M0,32L60,37.3C120,43,240,53,360,58.7C480,64,600,64,720,58.7C840,53,960,43,1080,42.7C1200,43,1320,53,1380,58.7L1440,64L1440,100L1380,100C1320,100,1200,100,1080,100C960,100,840,100,720,100C600,100,480,100,360,100C240,100,120,100,60,100L0,100Z"
                    fill="#059669" fill-opacity="0.08" />
            </svg>

            <!-- Ola inferior -->
            <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path
                    d="M0,64L48,58.7C96,53,192,43,288,48C384,53,480,75,576,80C672,85,768,75,864,69.3C960,64,1056,64,1152,69.3C1248,75,1344,85,1392,90.7L1440,96L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"
                    fill="#10b981" fill-opacity="0.12" />
            </svg>

            <!-- Elementos flotantes circulares -->
            <div class="absolute top-1/4 right-1/4 w-64 h-64 bg-emerald-400/12 rounded-full blur-2xl"></div>
            <div class="absolute bottom-1/3 left-1/4 w-80 h-80 bg-green-500/12 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        {{ __('Projects') }}
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-green-600 mx-auto rounded-full"></div>
                    <p class="text-gray-700 text-lg mt-4 max-w-2xl mx-auto">
                        {{ __("A selection of projects I've recently worked on") }}
                    </p>
                </div>

                <!-- Para la Comunidad -->
                <div class="mb-20">
                    <div class="flex items-center gap-3 mb-8">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900">{{ __('For the Community') }}</h3>
                    </div>

                    <!-- Proyecto SIS/HIS -->
                    <div class="project-card mb-16 group">
                        <div
                            class="relative bg-white/60 backdrop-blur-xl rounded-3xl overflow-hidden border border-white/40 shadow-xl hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-700 hover:-translate-y-2">
                            <div class="grid md:grid-cols-2 gap-0">
                                <!-- Contenido -->
                                <div class="p-8 md:p-12 flex flex-col justify-center relative z-10">
                                    <div class="flex items-center gap-2 mb-4">
                                        <span class="relative flex h-2 w-2">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                            <span
                                                class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                        </span>
                                        <span class="text-emerald-700 text-xs font-bold uppercase tracking-wider">
                                            {{ __('Community Project') }}
                                        </span>
                                    </div>

                                    <h4
                                        class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors duration-500">
                                        {{ __('SIS System') }}
                                        <div
                                            class="h-1 w-0 group-hover:w-20 bg-emerald-500 transition-all duration-500 rounded-full mt-1">
                                        </div>
                                    </h4>

                                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                                        {{ __('Patient and appointment management system developed in collaboration with the Autonomous University of Encarnación and the European HEIComp Project, created for use at the Lazos del Sur oncology hospital') }}
                                    </p>

                                    <!-- Tecnologías -->
                                    <div class="mb-2">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach (['Laravel', 'JavaScript', 'PHP', 'HTML/CSS', 'Bootstrap', 'Git/GitHub'] as $tech)
                                                <span
                                                    class="px-4 py-1.5 bg-emerald-500/5 text-emerald-700 border border-emerald-500/10 rounded-full text-sm font-medium hover:bg-emerald-500 hover:text-white hover:shadow-lg hover:shadow-emerald-500/20 transition-all duration-300 transform hover:-translate-y-0.5 cursor-default">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Carrusel de Imágenes -->
                                <div class="relative h-full min-h-[450px] overflow-hidden">
                                    <div class="absolute inset-0 bg-gray-100 animate-pulse active-loader"></div>
                                    <div class="relative w-full h-full" id="sis-carousel">
                                        <!-- Slides -->
                                        @php
                                            $sisSlides = [
                                                ['path' => 'image.png', 'cap' => 'Reporte de citas'],
                                                ['path' => 'image1.jpg', 'cap' => 'Gestión de usuarios'],
                                                ['path' => 'image2.jpg', 'cap' => 'Sistema de citas'],
                                            ];
                                        @endphp
                                        @foreach ($sisSlides as $index => $slide)
                                            <div class="carousel-slide {{ $index === 0 ? 'active' : '' }} cursor-pointer group/img"
                                                onclick="openImageModal('/assets/project_img/{{ $slide['path'] }}', '{{ $slide['cap'] }}')">
                                                <img src="/assets/project_img/{{ $slide['path'] }}"
                                                    alt="{{ $slide['cap'] }}"
                                                    class="w-full h-full object-cover transition-transform duration-1000 group-hover/img:scale-110">
                                                <div
                                                    class="absolute bottom-4 left-6 right-6 bg-black/40 backdrop-blur-md text-white px-5 py-3 rounded-2xl border border-white/10 opacity-0 group-hover/img:opacity-100 transition-all duration-500 transform translate-y-4 group-hover/img:translate-y-0">
                                                    <p class="text-sm font-semibold tracking-wide uppercase">
                                                        {{ $slide['cap'] }}</p>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Controles -->
                                        <button class="carousel-btn carousel-prev"
                                            onclick="changeSlide('sis-carousel', -1, event)">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </button>
                                        <button class="carousel-btn carousel-next"
                                            onclick="changeSlide('sis-carousel', 1, event)">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>

                                        <!-- Indicadores -->
                                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                                            <button class="carousel-indicator active"
                                                onclick="goToSlide('sis-carousel', 0, event)"></button>
                                            <button class="carousel-indicator"
                                                onclick="goToSlide('sis-carousel', 1, event)"></button>
                                            <button class="carousel-indicator"
                                                onclick="goToSlide('sis-carousel', 2, event)"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Proyecto Cloud SIS -->
                        <div class="project-card mb-16 group">
                            <div
                                class="relative bg-white/60 backdrop-blur-xl rounded-3xl overflow-hidden border border-white/40 shadow-xl hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-700 hover:-translate-y-2">
                                <div class="grid md:grid-cols-2 gap-0">
                                    <!-- Carrusel de Imágenes -->
                                    <div class="relative h-full min-h-[450px] overflow-hidden order-2 md:order-1">
                                        <div class="absolute inset-0 bg-gray-100 animate-pulse active-loader"></div>
                                        <div class="relative w-full h-full" id="cloud-sis-carousel">
                                            <!-- Slides -->
                                            @php
                                                $cloudSlides = [
                                                    ['path' => 'image.png', 'cap' => 'Vista Principal'],
                                                    ['path' => 'image1.png', 'cap' => 'Panel de Control'],
                                                    ['path' => 'image2.png', 'cap' => 'Gestión de Citas'],
                                                    ['path' => 'image3.png', 'cap' => 'Gestión de Usuarios'],
                                                    ['path' => 'image4.png', 'cap' => 'Vista de Detalles'],
                                                    ['path' => 'image5.png', 'cap' => 'Reportes'],
                                                    ['path' => 'image6.png', 'cap' => 'Configuración'],
                                                    ['path' => 'image7.png', 'cap' => 'Perfil'],
                                                    ['path' => 'image8.png', 'cap' => 'Vista General'],
                                                ];
                                            @endphp
                                            @foreach ($cloudSlides as $index => $slide)
                                                <div class="carousel-slide {{ $index === 0 ? 'active' : '' }} cursor-pointer group/img"
                                                    onclick="openImageModal('/assets/project2_img/{{ $slide['path'] }}', '{{ $slide['cap'] }}')">
                                                    <img src="/assets/project2_img/{{ $slide['path'] }}"
                                                        alt="{{ $slide['cap'] }}"
                                                        class="w-full h-full object-cover transition-transform duration-1000 group-hover/img:scale-110">
                                                    <div
                                                        class="absolute bottom-4 left-6 right-6 bg-black/40 backdrop-blur-md text-white px-5 py-3 rounded-2xl border border-white/10 opacity-0 group-hover/img:opacity-100 transition-all duration-500 transform translate-y-4 group-hover/img:translate-y-0">
                                                        <p class="text-sm font-semibold tracking-wide uppercase">
                                                            {{ $slide['cap'] }}</p>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <!-- Controles -->
                                            <button class="carousel-btn carousel-prev"
                                                onclick="changeSlide('cloud-sis-carousel', -1, event)">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </button>
                                            <button class="carousel-btn carousel-next"
                                                onclick="changeSlide('cloud-sis-carousel', 1, event)">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>

                                            <!-- Indicadores -->
                                            <div
                                                class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex gap-2">
                                                @foreach ($cloudSlides as $index => $slide)
                                                    <button
                                                        class="carousel-indicator {{ $index === 0 ? 'active' : '' }}"
                                                        onclick="goToSlide('cloud-sis-carousel', {{ $index }}, event)"></button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contenido -->
                                    <div
                                        class="p-8 md:p-12 flex flex-col justify-center relative z-10 order-1 md:order-2">
                                        <div class="flex items-center gap-2 mb-4">
                                            <span class="relative flex h-2 w-2">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                <span
                                                    class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                            </span>
                                            <span class="text-emerald-700 text-xs font-bold uppercase tracking-wider">
                                                {{ __('Community Project') }}
                                            </span>
                                        </div>

                                        <h4
                                            class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors duration-500">
                                            {{ __('Cloud SIS System') }}
                                            <div
                                                class="h-1 w-0 group-hover:w-20 bg-emerald-500 transition-all duration-500 rounded-full mt-1">
                                            </div>
                                        </h4>

                                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                                            {{ __('Hospital management system developed for use in a Family Health Unit in the city of Encarnación. It features modules for appointments, doctors, room management, specialties, users, reports, role-based access control with dashboards adapted to each role, as well as support for real-time operations with protection against multiple modifications to the same value.') }}
                                        </p>

                                        <!-- Tecnologías -->
                                        <div class="mb-2">
                                            <div class="flex flex-wrap gap-2">
                                                @foreach (['React JS', 'Flowbite', 'Express JS', 'Node.js', 'AWS EC2', 'Tailwind', 'Git/GitHub', 'Socket.io'] as $tech)
                                                    <span
                                                        class="px-4 py-1.5 bg-emerald-500/5 text-emerald-700 border border-emerald-500/10 rounded-full text-sm font-medium hover:bg-emerald-500 hover:text-white hover:shadow-lg hover:shadow-emerald-500/20 transition-all duration-300 transform hover:-translate-y-0.5 cursor-default">
                                                        {{ $tech }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Freelance -->
                    <div class="mb-20">
                        <div class="flex items-center gap-3 mb-8">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ __('Working at Porta Web Agency') }}</h3>
                        </div>

                        <!-- Proyecto Alonzo Style -->
                        <div class="project-card mb-16 group">
                            <div
                                class="relative bg-white/60 backdrop-blur-xl rounded-3xl overflow-hidden border border-white/40 shadow-xl hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-700 hover:-translate-y-2">
                                <div class="grid md:grid-cols-2 gap-0">
                                    <!-- Contenido -->
                                    <div class="p-8 md:p-12 flex flex-col justify-center relative z-10">
                                        <div class="flex items-center gap-2 mb-4">
                                            <span class="relative flex h-2 w-2">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                <span
                                                    class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                            </span>
                                            <span class="text-emerald-700 text-xs font-bold uppercase tracking-wider">
                                                {{ __('Freelance Project') }}
                                            </span>
                                        </div>

                                        <h4
                                            class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors duration-500">
                                            Alonzo Style
                                            <div
                                                class="h-1 w-0 group-hover:w-20 bg-emerald-500 transition-all duration-500 rounded-full mt-1">
                                            </div>
                                        </h4>

                                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                                            {{ __('Customer, appointment, service, and barber management system with a scheduling agenda for clients. It sends push notifications to barbers and enables automated WhatsApp contact for appointment confirmation, rescheduling, or cancellation, automating virtually all management tasks.') }}
                                        </p>

                                        <!-- Tecnologías -->
                                        <div class="mb-8">
                                            <div class="flex flex-wrap gap-2">
                                                @foreach (['MongoDB', 'Express', 'React.js', 'Node.js', 'Flowbite', 'Tailwind', 'JWT', 'Git/GitHub'] as $tech)
                                                    <span
                                                        class="px-4 py-1.5 bg-emerald-500/5 text-emerald-700 border border-emerald-500/10 rounded-full text-sm font-medium hover:bg-emerald-500 hover:text-white hover:shadow-lg hover:shadow-emerald-500/20 transition-all duration-300 transform hover:-translate-y-0.5 cursor-default">
                                                        {{ $tech }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Acciones -->
                                        <div class="flex flex-wrap gap-4">
                                            <a href="http://alonzostyle.com/" target="_blank"
                                                class="inline-flex items-center gap-3 px-8 py-4 bg-emerald-600 text-white font-bold rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20 active:scale-95 group/btn">
                                                <svg class="w-5 h-5 transition-transform group-hover/btn:translate-x-1"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 00-2 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                                {{ __('Demo') }}
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Carrusel de Imágenes -->
                                    <div class="relative h-full min-h-[450px] overflow-hidden">
                                        <div class="absolute inset-0 bg-gray-100 animate-pulse active-loader"></div>
                                        <div class="relative w-full h-full" id="barber-carousel">
                                            <!-- Slides -->
                                            @php
                                                $barberSlides = [
                                                    ['path' => 'alonzo1.png', 'cap' => 'Panel de Control'],
                                                    ['path' => 'alonzo2.png', 'cap' => 'Gestión de Turnos'],
                                                    ['path' => 'alonzo3.png', 'cap' => 'Agenda de Clientes'],
                                                    ['path' => 'alonzo4.png', 'cap' => 'Notificaciones'],
                                                    ['path' => 'alonzo5.png', 'cap' => 'Configuración de Barberos'],
                                                ];
                                            @endphp
                                            @foreach ($barberSlides as $index => $slide)
                                                <div class="carousel-slide {{ $index === 0 ? 'active' : '' }} cursor-pointer group/img"
                                                    onclick="openImageModal('/assets/freelance_img/{{ $slide['path'] }}', '{{ $slide['cap'] }}')">
                                                    <img src="/assets/freelance_img/{{ $slide['path'] }}"
                                                        alt="{{ $slide['cap'] }}"
                                                        class="w-full h-full object-cover transition-transform duration-1000 group-hover/img:scale-110">
                                                    <div
                                                        class="absolute bottom-4 left-6 right-6 bg-black/40 backdrop-blur-md text-white px-5 py-3 rounded-2xl border border-white/10 opacity-0 group-hover/img:opacity-100 transition-all duration-500 transform translate-y-4 group-hover/img:translate-y-0">
                                                        <p class="text-sm font-semibold tracking-wide uppercase">
                                                            {{ $slide['cap'] }}</p>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <!-- Controles -->
                                            <button class="carousel-btn carousel-prev"
                                                onclick="changeSlide('barber-carousel', -1, event)">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </button>
                                            <button class="carousel-btn carousel-next"
                                                onclick="changeSlide('barber-carousel', 1, event)">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>

                                            <!-- Indicadores -->
                                            <div
                                                class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex gap-2">
                                                @foreach ($barberSlides as $index => $slide)
                                                    <button
                                                        class="carousel-indicator {{ $index === 0 ? 'active' : '' }}"
                                                        onclick="goToSlide('barber-carousel', {{ $index }}, event)"></button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Otros Proyectos -->
                    <div class="mb-12">
                        <div class="flex items-center gap-3 mb-8">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ __('Other Projects') }}</h3>
                        </div>

                        <!-- Aquí irán otros proyectos -->
                        <div
                            class="text-center py-12 bg-gradient-to-br from-emerald-50 to-green-100 rounded-2xl shadow-lg border border-emerald-200">
                            <p class="text-gray-700 text-lg">Próximamente...</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Modal para ampliar imágenes -->
    <div id="imageModal" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4"
        onclick="closeImageModal()">
        <button class="absolute top-6 right-6 text-white hover:text-emerald-400 transition-colors z-10"
            onclick="closeImageModal()">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="max-w-7xl max-h-full flex flex-col items-center" onclick="event.stopPropagation()">
            <img id="modalImage" src="" alt=""
                class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
            <p id="modalCaption" class="text-white text-lg mt-4 text-center"></p>
        </div>
    </div>

    <style>
        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            pointer-events: none;
        }

        .carousel-slide.active {
            opacity: 1;
            pointer-events: auto;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 20;
            opacity: 0;
            visibility: hidden;
        }

        [id$="-carousel"]:hover .carousel-btn {
            opacity: 1;
            visibility: visible;
        }

        .carousel-btn:hover {
            background: rgba(16, 185, 129, 0.9);
            border-color: rgba(16, 185, 129, 0.2);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-prev {
            left: 20px;
        }

        .carousel-next {
            right: 20px;
        }

        .carousel-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            cursor: pointer;
            transition: all 0.4s;
            z-index: 10;
        }

        .carousel-indicator.active {
            background: #10b981;
            width: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
        }

        .project-card:hover .active-loader {
            opacity: 0;
        }
    </style>

    <script>
        const carousels = {};

        function initCarousel(id) {
            if (!carousels[id]) {
                const element = document.getElementById(id);
                if (element) {
                    carousels[id] = {
                        currentSlide: 0,
                        interval: null,
                        element: element
                    };
                    // Auto slide
                    showSlide(id, 0); // Show initial slide
                    startAutoSlide(id);
                    // Hover events
                    element.addEventListener('mouseenter', () => stopAutoSlide(id));
                    element.addEventListener('mouseleave', () => startAutoSlide(id));
                }
            }
        }

        function showSlide(id, index) {
            const carousel = carousels[id];
            if (!carousel || !carousel.element) return;

            const slides = carousel.element.querySelectorAll('.carousel-slide');
            const indicators = carousel.element.querySelectorAll('.carousel-indicator');

            if (index >= slides.length) {
                carousel.currentSlide = 0;
            } else if (index < 0) {
                carousel.currentSlide = slides.length - 1;
            } else {
                carousel.currentSlide = index;
            }

            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === carousel.currentSlide) {
                    slide.classList.add('active');
                }
            });

            indicators.forEach((indicator, i) => {
                indicator.classList.remove('active');
                if (i === carousel.currentSlide) {
                    indicator.classList.add('active');
                }
            });
        }

        function changeSlide(id, direction, event) {
            if (event) event.stopPropagation();
            stopAutoSlide(id);
            if (carousels[id]) {
                showSlide(id, carousels[id].currentSlide + direction);
            }
            startAutoSlide(id);
        }

        function goToSlide(id, index, event) {
            if (event) event.stopPropagation();
            stopAutoSlide(id);
            showSlide(id, index);
            startAutoSlide(id);
        }

        function startAutoSlide(id) {
            if (carousels[id]) {
                stopAutoSlide(id);
                carousels[id].interval = setInterval(() => {
                    showSlide(id, carousels[id].currentSlide + 1);
                }, 4000);
            }
        }

        function stopAutoSlide(id) {
            if (carousels[id] && carousels[id].interval) {
                clearInterval(carousels[id].interval);
                carousels[id].interval = null;
            }
        }

        // Iniciar carruseles al cargar
        document.addEventListener('DOMContentLoaded', function() {
            initCarousel('sis-carousel');
            initCarousel('cloud-sis-carousel');
            initCarousel('barber-carousel');
        });

        function openImageModal(src, caption) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modalImg.src = src;
            modalImg.alt = caption;
            modalCaption.textContent = caption;

            // Prevenir scroll del body
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');

            // Restaurar scroll del body
            document.body.style.overflow = 'auto';
        }

        // Cerrar modal con tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</div>
