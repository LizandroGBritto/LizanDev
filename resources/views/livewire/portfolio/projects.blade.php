<section id="projects"
    class="py-20 bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl">
        </div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl">
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-3">
                    Proyectos <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600">Destacados</span>
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-purple-500 to-pink-500 mx-auto rounded-full"></div>
                <p class="text-slate-300 text-sm mt-3 max-w-2xl mx-auto">
                    Una selección de proyectos en los que he trabajado recientemente
                </p>
            </div>

            <!-- 3D Carousel Container -->
            <div class="relative" style="perspective: 1600px; height: 480px;">
                <div id="carousel-3d" class="carousel-3d-wrapper">
                    @foreach($projects as $index => $project)
                        <div class="carousel-card" data-index="{{ $index }}" data-project="{{ json_encode($project) }}">
                            <!-- Card Front (Compacta) -->
                            <div class="card-front">
                                <div class="relative h-48 overflow-hidden bg-slate-800 rounded-t-xl">
                                    <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}"
                                        class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent"></div>
                                </div>
                                <div class="p-4 bg-slate-800/90 backdrop-blur-sm rounded-b-xl">
                                    <h3 class="text-lg font-bold text-white mb-2">
                                        {{ $project['title'] }}
                                    </h3>
                                    <p class="text-slate-300 text-xs line-clamp-2 mb-3">
                                        {{ $project['description'] }}
                                    </p>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach(array_slice($project['tags'], 0, 3) as $tag)
                                            <span
                                                class="px-2 py-0.5 bg-purple-500/20 text-purple-300 rounded-full text-xs font-medium">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Card Back (Expandida) -->
                            <div class="card-back">
                                <div
                                    class="h-full flex flex-col bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-6">
                                    <button
                                        class="close-btn self-end text-slate-400 hover:text-white transition-colors mb-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <h3 class="text-2xl font-bold text-white mb-3">
                                        {{ $project['title'] }}
                                    </h3>

                                    <!-- Mini Carrusel de Imágenes -->
                                    <div class="relative mb-4 mini-carousel-container" data-mini-carousel="{{ $index }}">
                                        <div class="overflow-hidden rounded-lg">
                                            <div
                                                class="mini-carousel-wrapper flex transition-transform duration-500 ease-in-out">
                                                <div class="mini-carousel-slide flex-shrink-0 w-full">
                                                    <img src="{{ $project['image'] }}"
                                                        alt="{{ $project['title'] }} - Vista 1"
                                                        class="w-full h-20 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity mini-carousel-img">
                                                </div>
                                                <div class="mini-carousel-slide flex-shrink-0 w-full">
                                                    <img src="{{ $project['image'] }}"
                                                        alt="{{ $project['title'] }} - Vista 2"
                                                        class="w-full h-20 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity mini-carousel-img">
                                                </div>
                                                <div class="mini-carousel-slide flex-shrink-0 w-full">
                                                    <img src="{{ $project['image'] }}"
                                                        alt="{{ $project['title'] }} - Vista 3"
                                                        class="w-full h-20 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity mini-carousel-img">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Navegación del mini carrusel -->
                                        <button
                                            class="mini-carousel-prev absolute left-1.5 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-1.5 rounded-full transition-all">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </button>
                                        <button
                                            class="mini-carousel-next absolute right-1.5 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-1.5 rounded-full transition-all">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                        <!-- Indicadores -->
                                        <div class="flex flex-col items-center gap-0.5 mt-2">
                                            <div class="flex justify-center gap-1.5">
                                                <div
                                                    class="mini-indicator w-1.5 h-1.5 rounded-full bg-white transition-all">
                                                </div>
                                                <div
                                                    class="mini-indicator w-1.5 h-1.5 rounded-full bg-white/40 transition-all">
                                                </div>
                                                <div
                                                    class="mini-indicator w-1.5 h-1.5 rounded-full bg-white/40 transition-all">
                                                </div>
                                            </div>
                                            <p class="text-slate-400" style="font-size: 0.65rem; font-style: italic;">*Toque
                                                la imagen para ampliar</p>
                                        </div>
                                    </div>

                                    <div class="flex-1 overflow-y-auto mb-4">
                                        <p class="text-slate-300 text-sm mb-4 leading-relaxed">
                                            {{ $project['description'] }}
                                        </p>
                                        <div class="flex flex-wrap gap-1.5 mb-4">
                                            @foreach($project['tags'] as $tag)
                                                <span
                                                    class="px-2.5 py-0.5 bg-purple-500/30 text-purple-200 rounded-full text-xs font-medium">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <a href="{{ $project['github'] }}" target="_blank"
                                            class="flex-1 flex items-center justify-center gap-1.5 px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-sm rounded-full transition-all">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Código
                                        </a>
                                        <a href="{{ $project['demo'] }}" target="_blank"
                                            class="flex-1 flex items-center justify-center gap-1.5 px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-600 text-white text-sm rounded-full hover:shadow-lg hover:shadow-purple-500/50 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                            Demo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Modal para ampliar imagen -->
                <div id="image-modal" class="image-modal">
                    <div class="image-modal-close" onclick="closeImageModal()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <img id="modal-image" src="" alt="Imagen ampliada">
                </div>

                <!-- Navigation Controls -->
                <button id="prev-btn" class="carousel-nav-btn left-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="next-btn" class="carousel-nav-btn right-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Indicators (Hidden) -->
            <div id="carousel-indicators" class="hidden flex justify-center gap-2 mt-8">
                @foreach($projects as $index => $project)
                    <button class="indicator-dot" data-index="{{ $index }}"></button>
                @endforeach
            </div>

            <!-- Call to Action -->
            <div class="mt-12 text-center">
                <p class="text-slate-300 text-sm mb-3">¿Quieres ver más proyectos?</p>
                <a href="https://github.com" target="_blank"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-sm text-white text-sm rounded-full hover:bg-white/20 border-2 border-white/20 transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd" />
                    </svg>
                    Ver en GitHub
                </a>
            </div>
        </div>
    </div>

    <style>
        .carousel-3d-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .carousel-card {
            position: absolute;
            width: 272px;
            height: 340px;
            left: 50%;
            top: 50%;
            margin-left: -136px;
            margin-top: -170px;
            transition: all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
            transform-style: preserve-3d;
            cursor: pointer;
        }

        .carousel-card.expanded {
            width: 336px;
            height: 384px;
            margin-left: -168px;
            margin-top: -192px;
            z-index: 100 !important;
            cursor: default;
        }

        .card-front,
        .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 0.75rem;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .card-back {
            transform: rotateY(180deg);
        }

        .carousel-card.flipped .card-front {
            transform: rotateY(180deg);
        }

        .carousel-card.flipped .card-back {
            transform: rotateY(0deg);
        }

        .carousel-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .carousel-nav-btn:hover {
            background: rgba(139, 92, 246, 0.3);
            transform: translateY(-50%) scale(1.1);
        }

        .indicator-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .indicator-dot.active {
            background: linear-gradient(135deg, #a855f7, #ec4899);
            transform: scale(1.3);
        }

        /* Mini Carousel Styles */
        .mini-carousel-container {
            position: relative;
        }

        .mini-carousel-wrapper {
            display: flex;
        }

        .mini-carousel-slide {
            min-width: 100%;
        }

        .mini-carousel-prev,
        .mini-carousel-next {
            z-index: 10;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .mini-carousel-container:hover .mini-carousel-prev,
        .mini-carousel-container:hover .mini-carousel-next {
            opacity: 1;
        }

        .mini-indicator {
            transition: all 0.3s;
            cursor: pointer;
        }

        .mini-indicator.active {
            background: white;
            width: 0.75rem;
        }

        /* Modal para ampliar imagen */
        .image-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 200;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }

        .image-modal.active {
            display: flex;
        }

        .image-modal img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 0.5rem;
        }

        .image-modal-close {
            position: absolute;
            top: 2rem;
            right: 2rem;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.5);
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .image-modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .carousel-card {
                width: 204px;
                height: 286px;
                margin-left: -102px;
                margin-top: -143px;
            }

            .carousel-card.expanded {
                width: 224px;
                height: 320px;
                margin-left: -112px;
                margin-top: -160px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('carousel-3d');
            const cards = document.querySelectorAll('.carousel-card');
            const indicators = document.querySelectorAll('.indicator-dot');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            let currentRotation = 0;
            let isAnimating = false;
            let autoPlayInterval = null;

            const totalCards = cards.length;
            const angleStep = 360 / totalCards;

            function updateCarousel() {
                if (isAnimating) return;
                isAnimating = true;

                // Calcular qué tarjeta está al frente basándose en la rotación actual
                const normalizedRotation = ((currentRotation % 360) + 360) % 360;
                const currentIndex = Math.round(normalizedRotation / angleStep) % totalCards;

                cards.forEach((card, index) => {
                    const angle = (index * angleStep) - currentRotation;
                    const distance = 480;

                    // Normalizar el ángulo para determinar si está al frente
                    const normalizedAngle = ((angle % 360) + 360) % 360;
                    const isAtFront = normalizedAngle < angleStep / 2 || normalizedAngle > 360 - angleStep / 2;

                    const scale = isAtFront ? 1 : 0.7;
                    const opacity = isAtFront ? 1 : 0.5;
                    const zIndex = isAtFront ? 10 : 1;

                    card.style.transform = `
                        rotateY(${angle}deg) 
                        translateZ(${distance}px) 
                        scale(${scale})
                    `;
                    card.style.opacity = opacity;
                    card.style.zIndex = zIndex;
                    card.style.pointerEvents = isAtFront ? 'auto' : 'none';
                });

                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === currentIndex);
                });

                setTimeout(() => {
                    isAnimating = false;
                }, 800);
            }

            function nextSlide() {
                if (isAnimating) return;
                currentRotation += angleStep;
                updateCarousel();
            }

            function prevSlide() {
                if (isAnimating) return;
                currentRotation -= angleStep;
                updateCarousel();
            }

            function goToSlide(index) {
                if (isAnimating) return;
                const targetRotation = index * angleStep;
                const normalizedCurrent = ((currentRotation % 360) + 360) % 360;
                const diff = targetRotation - normalizedCurrent;

                // Ajustar para tomar el camino más corto
                if (diff > 180) {
                    currentRotation -= (360 - diff);
                } else if (diff < -180) {
                    currentRotation += (360 + diff);
                } else {
                    currentRotation += diff;
                }

                updateCarousel();
            }

            function startAutoPlay() {
                if (!autoPlayInterval) {
                    autoPlayInterval = setInterval(nextSlide, 4000);
                }
            }

            function stopAutoPlay() {
                if (autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                    autoPlayInterval = null;
                }
            }

            // Event Listeners
            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    goToSlide(index);
                });
            });

            // Click on card to expand
            cards.forEach(card => {
                card.addEventListener('click', function (e) {
                    if (!this.classList.contains('flipped')) {
                        this.classList.add('flipped', 'expanded');
                        stopAutoPlay();
                        prevBtn.style.opacity = '0';
                        prevBtn.style.pointerEvents = 'none';
                        nextBtn.style.opacity = '0';
                        nextBtn.style.pointerEvents = 'none';
                    }
                });

                const closeBtn = card.querySelector('.close-btn');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        card.classList.remove('flipped', 'expanded');
                        startAutoPlay();
                        prevBtn.style.opacity = '';
                        prevBtn.style.pointerEvents = '';
                        nextBtn.style.opacity = '';
                        nextBtn.style.pointerEvents = '';
                    });
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') prevSlide();
                if (e.key === 'ArrowRight') nextSlide();
            });

            // Iniciar auto-play
            startAutoPlay();

            updateCarousel();

            // Mini Carousel Logic
            document.querySelectorAll('.mini-carousel-container').forEach(container => {
                const wrapper = container.querySelector('.mini-carousel-wrapper');
                const slides = container.querySelectorAll('.mini-carousel-slide');
                const prevBtn = container.querySelector('.mini-carousel-prev');
                const nextBtn = container.querySelector('.mini-carousel-next');
                const indicators = container.querySelectorAll('.mini-indicator');
                let currentSlide = 0;
                const totalSlides = slides.length;

                function updateMiniCarousel() {
                    wrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
                    indicators.forEach((indicator, idx) => {
                        indicator.classList.toggle('active', idx === currentSlide);
                    });
                }

                prevBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                    updateMiniCarousel();
                });

                nextBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    currentSlide = (currentSlide + 1) % totalSlides;
                    updateMiniCarousel();
                });

                // Indicadores clickeables
                indicators.forEach((indicator, idx) => {
                    indicator.addEventListener('click', (e) => {
                        e.stopPropagation();
                        currentSlide = idx;
                        updateMiniCarousel();
                    });
                });

                // Ampliar imagen al hacer clic
                const images = container.querySelectorAll('.mini-carousel-img');
                images.forEach(img => {
                    img.addEventListener('click', (e) => {
                        e.stopPropagation();
                        openImageModal(img.src, img.alt);
                    });
                });

                updateMiniCarousel();
            });

            // Funciones para el modal de imagen
            window.openImageModal = function (src, alt) {
                const modal = document.getElementById('image-modal');
                const modalImage = document.getElementById('modal-image');
                modalImage.src = src;
                modalImage.alt = alt;
                modal.classList.add('active');
            };

            window.closeImageModal = function () {
                const modal = document.getElementById('image-modal');
                modal.classList.remove('active');
            };

            // Cerrar modal al hacer clic fuera de la imagen
            document.getElementById('image-modal')?.addEventListener('click', function (e) {
                if (e.target === this) {
                    closeImageModal();
                }
            });

            // Cerrar modal con tecla Escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeImageModal();
                }
            });
        });
    </script>
</section>