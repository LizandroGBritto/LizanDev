<section id="about" class="py-20 bg-white relative">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                    Sobre <span class="text-purple-600">Mí</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-pink-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="relative group">
                    <div class="aspect-square rounded-2xl bg-gradient-to-br from-purple-100 to-pink-100 p-8 relative overflow-hidden" id="about-card-container">
                        
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-pink-500/10 z-0"></div>

                        <div class="relative z-20 flex items-center justify-center h-full opacity-50">
                            <svg class="w-full h-full text-purple-600/20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                            </svg>
                        </div>

                        <div class="absolute -right-10 -bottom-10 z-10 transition-all duration-1000 cubic-bezier(0.34, 1.56, 0.64, 1) translate-y-full translate-x-full rotate-[-30deg] origin-bottom-right" 
                             id="mini-robot-wrapper"
                             style="scale: 0.55;"> 
                            
                            <div class="robot-container">
                                <div class="robot-head">
                                    <div class="antenna antenna-left"><div class="antenna-ball"></div></div>
                                    <div class="antenna antenna-right"><div class="antenna-ball"></div></div>
                                    <div class="robot-eyes">
                                        <div class="eye eye-left"><div class="pupil pupil-about"></div></div>
                                        <div class="eye eye-right"><div class="pupil pupil-about"></div></div>
                                    </div>
                                    <div class="robot-mouth"></div>
                                </div>
                                <div class="robot-body">
                                    <div class="control-panel">
                                        <div class="indicator"></div>
                                        <div class="indicator indicator-delay-1"></div>
                                        <div class="indicator indicator-delay-2"></div>
                                    </div>
                                    <div class="code-lines">
                                        <div class="code-line"></div><div class="code-line"></div>
                                    </div>
                                </div>
                                
                                <div class="robot-arm robot-arm-left" style="top: 107px; left: -35px; transform: rotate(130deg);">
                                    <div class="arm-upper"></div><div class="arm-lower"></div>
                                    <div class="hand"><div class="finger"></div><div class="finger"></div><div class="finger"></div></div>
                                </div>
                                <div class="robot-arm robot-arm-right" style="top: 138px; right: -35px; transform: rotate(-30deg);">
                                    <div class="arm-upper"></div><div class="arm-lower"></div>
                                    <div class="hand"><div class="finger"></div><div class="finger"></div><div class="finger"></div></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <p class="text-lg text-slate-600 leading-relaxed">
                        {{ $bio }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- 1. ANIMACIÓN DE ENTRADA (DIAGONAL) ---
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.4
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const robotWrapper = document.getElementById('mini-robot-wrapper');
                if (entry.isIntersecting) {
                    // ENTRA: Removemos el desplazamiento para que vaya a su posición original (0,0)
                    // Esto hará que salga de la esquina hacia el centro.
                    robotWrapper.classList.remove('translate-y-full', 'translate-x-full');
                    
                    // Opcional: Un pequeño ajuste para que no salga DEMASIADO
                    // robotWrapper.style.transform = "translate(20px, 20px) rotate(-45deg)"; 
                } else {
                    // SALE: Lo volvemos a esconder en la esquina inferior derecha
                    robotWrapper.classList.add('translate-y-full', 'translate-x-full');
                }
            });
        }, observerOptions);

        const target = document.getElementById('about-card-container');
        if(target) observer.observe(target);


        // --- 2. SEGUIMIENTO DE OJOS ---
        const aboutPupils = document.querySelectorAll('.pupil-about'); // Seleccionamos solo los de About
        
        const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

        function moveAboutPupils(mouseX, mouseY) {
            aboutPupils.forEach(pupil => {
                const eye = pupil.parentElement;
                const eyeRect = eye.getBoundingClientRect();
                const eyeCenterX = eyeRect.left + eyeRect.width / 2;
                const eyeCenterY = eyeRect.top + eyeRect.height / 2;

                // Como el robot está rotado -45deg, el movimiento de los ojos
                // debe compensarse o se sentirá extraño.
                // Simplificación: Reducimos el rango de movimiento para que sea sutil.
                const maxMove = 4; 
                const moveX = clamp((mouseX - eyeCenterX) / 15, -maxMove, maxMove);
                const moveY = clamp((mouseY - eyeCenterY) / 15, -maxMove, maxMove);

                pupil.style.transform = `translate(calc(-50% + ${moveX}px), calc(-50% + ${moveY}px))`;
            });
        }

        document.addEventListener('mousemove', function (e) {
            if(target && target.getBoundingClientRect().top < window.innerHeight && target.getBoundingClientRect().bottom > 0) {
                moveAboutPupils(e.clientX, e.clientY);
            }
        });
    });
</script>