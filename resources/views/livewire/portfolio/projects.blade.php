<div>
    <section id="projects" class="py-20 bg-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-10 w-96 h-96 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl"></div>
        </div>
        
        <!-- Olas decorativas -->
        <div class="absolute inset-0 pointer-events-none">
            <!-- Ola superior -->
            <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-b from-emerald-50/70 to-transparent"></div>
            <svg class="absolute top-0 left-0 w-full" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z" 
                      fill="#10b981" fill-opacity="0.12"/>
            </svg>
            
            <!-- Ola media -->
            <svg class="absolute top-1/3 left-0 w-full" viewBox="0 0 1440 100" preserveAspectRatio="none">
                <path d="M0,32L60,37.3C120,43,240,53,360,58.7C480,64,600,64,720,58.7C840,53,960,43,1080,42.7C1200,43,1320,53,1380,58.7L1440,64L1440,100L1380,100C1320,100,1200,100,1080,100C960,100,840,100,720,100C600,100,480,100,360,100C240,100,120,100,60,100L0,100Z" 
                      fill="#059669" fill-opacity="0.08"/>
            </svg>
            
            <!-- Ola inferior -->
            <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,64L48,58.7C96,53,192,43,288,48C384,53,480,75,576,80C672,85,768,75,864,69.3C960,64,1056,64,1152,69.3C1248,75,1344,85,1392,90.7L1440,96L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" 
                      fill="#10b981" fill-opacity="0.12"/>
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
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900">{{ __('For the Community') }}</h3>
                    </div>

                    <!-- Proyecto SIS/HIS -->
                    <div class="bg-gradient-to-br from-emerald-50 to-green-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-emerald-200">
                        <div class="grid md:grid-cols-2 gap-0">
                            <!-- Contenido -->
                            <div class="p-8 md:p-10 flex flex-col justify-center">
                                <div class="inline-block px-4 py-1 bg-emerald-500/20 text-emerald-700 rounded-full text-sm font-semibold mb-4 w-fit">
                                    {{ __('Community Project') }}
                                </div>
                                <h4 class="text-3xl font-bold text-gray-900 mb-4">
                                    {{ __('SIS System') }}
                                </h4>
                                <p class="text-gray-700 text-base leading-relaxed mb-6">
                                    {{ __('Patient and appointment management system developed in collaboration with the Autonomous University of Encarnación and the European HEIComp Project, created for use at the Lazos del Sur oncology hospital') }}
                                </p>

                                <!-- Tecnologías -->
                                <div class="mb-6">
                                    <p class="text-sm font-semibold text-gray-700 mb-3">{{ __('Technologies Used') }}</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-sm font-medium border border-red-200">
                                            Laravel
                                        </span>
                                        <span class="px-3 py-1.5 bg-yellow-50 text-yellow-700 rounded-lg text-sm font-medium border border-yellow-200">
                                            JavaScript
                                        </span>
                                        <span class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium border border-blue-200">
                                            PHP
                                        </span>
                                        <span class="px-3 py-1.5 bg-orange-50 text-orange-700 rounded-lg text-sm font-medium border border-orange-200">
                                            HTML/CSS
                                        </span>
                                        <span class="px-3 py-1.5 bg-purple-50 text-purple-700 rounded-lg text-sm font-medium border border-purple-200">
                                            Bootstrap
                                        </span>
                                        <span class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-lg text-sm font-medium border border-gray-200">
                                            Git/GitHub
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Carrusel de Imágenes -->
                            <div class="relative h-full min-h-[400px] bg-white p-6 flex items-center justify-center">
                                <div class="relative w-full h-full overflow-hidden rounded-xl" id="sis-carousel">
                                    <!-- Slides -->
                                    <div class="carousel-slide active cursor-pointer" onclick="openImageModal('/assets/project_img/image.png', 'Reporte de citas')">
                                        <img src="/assets/project_img/image.png" alt="Reporte de citas" class="w-full h-full object-cover">
                                        <div class="absolute bottom-4 left-4 right-4 bg-black/70 backdrop-blur-sm text-white px-4 py-2 rounded-lg">
                                            <p class="text-sm font-medium">Reporte de citas</p>
                                        </div>
                                    </div>
                                    <div class="carousel-slide cursor-pointer" onclick="openImageModal('/assets/project_img/image1.jpg', 'Gestión de usuarios')">
                                        <img src="/assets/project_img/image1.jpg" alt="Gestión de usuarios" class="w-full h-full object-cover">
                                        <div class="absolute bottom-4 left-4 right-4 bg-black/70 backdrop-blur-sm text-white px-4 py-2 rounded-lg">
                                            <p class="text-sm font-medium">Gestión de usuarios</p>
                                        </div>
                                    </div>
                                    <div class="carousel-slide cursor-pointer" onclick="openImageModal('/assets/project_img/image2.jpg', 'Sistema de citas')">
                                        <img src="/assets/project_img/image2.jpg" alt="Sistema de citas" class="w-full h-full object-cover">
                                        <div class="absolute bottom-4 left-4 right-4 bg-black/70 backdrop-blur-sm text-white px-4 py-2 rounded-lg">
                                            <p class="text-sm font-medium">Sistema de citas</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Controles -->
                                    <button class="carousel-btn carousel-prev" onclick="changeSlide(-1, event)">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button class="carousel-btn carousel-next" onclick="changeSlide(1, event)">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                    
                                    <!-- Indicadores -->
                                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                                        <button class="carousel-indicator active" onclick="goToSlide(0, event)"></button>
                                        <button class="carousel-indicator" onclick="goToSlide(1, event)"></button>
                                        <button class="carousel-indicator" onclick="goToSlide(2, event)"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trabajando en Porta Agencia WEB -->
                <div class="mb-20">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900">{{ __('Working at Porta Web Agency') }}</h3>
                    </div>

                    <!-- Aquí irán los proyectos de Porta -->
                    <div class="text-center py-12 bg-white rounded-2xl shadow-lg border border-gray-200 relative overflow-hidden">
                        <!-- Decoración sutil -->
                        <div class="absolute inset-0 opacity-100">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500 rounded-full blur-2xl"></div>
                            <div class="absolute bottom-0 left-0 w-32 h-32 bg-green-500 rounded-full blur-2xl"></div>
                        </div>
                        <p class="text-gray-500 text-lg relative z-10">Próximamente...</p>
                    </div>
                </div>

                <!-- Otros Proyectos -->
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900">{{ __('Other Projects') }}</h3>
                    </div>

                    <!-- Aquí irán otros proyectos -->
                    <div class="text-center py-12 bg-gradient-to-br from-emerald-50 to-green-100 rounded-2xl shadow-lg border border-emerald-200">
                        <p class="text-gray-700 text-lg">Próximamente...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal para ampliar imágenes -->
    <div id="imageModal" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4" onclick="closeImageModal()">
        <button class="absolute top-6 right-6 text-white hover:text-emerald-400 transition-colors z-10" onclick="closeImageModal()">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="max-w-7xl max-h-full flex flex-col items-center" onclick="event.stopPropagation()">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
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
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s;
        z-index: 10;
    }
    
    .carousel-btn:hover {
        background: rgba(16, 185, 129, 0.7);
        transform: translateY(-50%) scale(1.1);
    }
    
    .carousel-prev {
        left: 16px;
    }
    
    .carousel-next {
        right: 16px;
    }
    
    .carousel-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        z-index: 10;
    }
    
    .carousel-indicator.active {
        background: white;
        width: 24px;
        border-radius: 5px;
    }
</style>

<script>
    let currentSlide = 0;
    let autoSlideInterval;
    
    function showSlide(index) {
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');
        
        if (index >= slides.length) currentSlide = 0;
        if (index < 0) currentSlide = slides.length - 1;
        else currentSlide = index;
        
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            if (i === currentSlide) {
                slide.classList.add('active');
            }
        });
        
        indicators.forEach((indicator, i) => {
            indicator.classList.remove('active');
            if (i === currentSlide) {
                indicator.classList.add('active');
            }
        });
    }
    
    function changeSlide(direction, event) {
        if (event) event.stopPropagation();
        stopAutoSlide();
        showSlide(currentSlide + direction);
        startAutoSlide();
    }
    
    function goToSlide(index, event) {
        if (event) event.stopPropagation();
        stopAutoSlide();
        showSlide(index);
        startAutoSlide();
    }
    
    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            showSlide(currentSlide + 1);
        }, 4000);
    }
    
    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }
    
    // Iniciar carrusel automático al cargar
    document.addEventListener('DOMContentLoaded', function() {
        showSlide(0);
        startAutoSlide();
        
        // Pausar en hover
        const carousel = document.getElementById('sis-carousel');
        if (carousel) {
            carousel.addEventListener('mouseenter', stopAutoSlide);
            carousel.addEventListener('mouseleave', startAutoSlide);
        }
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
