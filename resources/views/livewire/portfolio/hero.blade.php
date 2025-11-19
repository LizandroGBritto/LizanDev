<div>
    <section id="hero-section"
        class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 overflow-hidden">
        <!-- Animated background -->
        <div class="absolute inset-0 w-full h-full">
            <div
                class="absolute top-0 -left-4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute top-0 -right-4 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:grid lg:grid-cols-2 gap-12 items-center">

                <!-- Columna Izquierda: Contenido -->
                <div class="text-center lg:text-left space-y-8 order-1 lg:order-1">
                    <!-- Contenido principal -->
                    <div class="space-y-4">
                        <h1 class="text-5xl md:text-7xl font-bold text-white leading-tight">
                            Hola, soy <span
                                class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600">{{ $name }}</span>
                        </h1>

                        <div
                            class="text-2xl md:text-3xl text-purple-200 font-light flex items-center justify-center lg:justify-start gap-3">
                            <span>Desarrollador</span>
                            <div class="role-carousel">
                                <div class="role-carousel-inner">
                                    <span class="role-item">Front End</span>
                                    <span class="role-item">Back End</span>
                                    <span class="role-item">Full Stack</span>
                                </div>
                            </div>
                        </div>

                        <p class="text-lg md:text-xl text-slate-300 max-w-2xl">
                            {{ $description }}
                        </p>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start items-center pt-8">
                        <a href="#projects"
                            class="px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-full font-semibold hover:shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-1 transition-all duration-300">
                            Ver Proyectos
                        </a>
                        <a href="#contact"
                            class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-full font-semibold border-2 border-white/20 hover:bg-white/20 transform hover:-translate-y-1 transition-all duration-300">
                            Contáctame
                        </a>
                    </div>

                    <!-- Social Links -->
                    <div class="flex gap-6 justify-center lg:justify-start pt-8">
                        <a href="https://github.com" target="_blank"
                            class="text-white/60 hover:text-white transform hover:scale-110 transition-all">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://linkedin.com" target="_blank"
                            class="text-white/60 hover:text-white transform hover:scale-110 transition-all">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                        <a href="mailto:tu@email.com"
                            class="text-white/60 hover:text-white transform hover:scale-110 transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Columna Derecha: Robot CSS Animado -->
                <div class="relative h-[300px] lg:h-[600px] order-2 lg:order-2 flex items-center justify-center scale-[0.5] lg:scale-100"
                    id="robot-area">
                    <div class="robot-container" id="robot">
                        <!-- Cabeza del Robot -->
                        <div class="robot-head">
                            <!-- Antenas -->
                            <div class="antenna antenna-left">
                                <div class="antenna-ball"></div>
                            </div>
                            <div class="antenna antenna-right">
                                <div class="antenna-ball"></div>
                            </div>

                            <!-- Ojos -->
                            <div class="robot-eyes">
                                <div class="eye eye-left">
                                    <div class="pupil"></div>
                                </div>
                                <div class="eye eye-right">
                                    <div class="pupil"></div>
                                </div>
                            </div>

                            <!-- Boca -->
                            <div class="robot-mouth"></div>
                        </div>

                        <!-- Cuerpo del Robot -->
                        <div class="robot-body">
                            <!-- Panel de Control -->
                            <div class="control-panel">
                                <div class="indicator"></div>
                                <div class="indicator indicator-delay-1"></div>
                                <div class="indicator indicator-delay-2"></div>
                            </div>

                            <!-- Líneas de código simuladas -->
                            <div class="code-lines">
                                <div class="code-line"></div>
                                <div class="code-line"></div>
                                <div class="code-line"></div>
                            </div>
                        </div>

                        <!-- Brazos -->
                        <div class="robot-arm robot-arm-left">
                            <div class="arm-upper"></div>
                            <div class="arm-lower"></div>
                            <div class="hand">
                                <div class="finger"></div>
                                <div class="finger"></div>
                                <div class="finger"></div>
                            </div>
                        </div>
                        <div class="robot-arm robot-arm-right">
                            <div class="arm-upper"></div>
                            <div class="arm-lower"></div>
                            <div class="hand">
                                <div class="finger"></div>
                                <div class="finger"></div>
                                <div class="finger"></div>
                            </div>
                        </div>

                        <!-- Piernas -->
                        <div class="robot-legs">
                            <div class="leg leg-left">
                                <div class="leg-upper"></div>
                                <div class="leg-lower"></div>
                                <div class="foot"></div>
                            </div>
                            <div class="leg leg-right">
                                <div class="leg-upper"></div>
                                <div class="leg-lower"></div>
                                <div class="foot"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <a href="#about" class="text-white/60 hover:text-white transition-colors animate-bounce">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </section>

    <style>
        /* Animaciones de fondo */
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Role Carousel 3D - MODIFICADO */
        /* Role Carousel 3D - VERTICAL (CORREGIDO) */
        .role-carousel {
            perspective: 1000px;
            /* CAMBIO 1: 1000px suaviza la distorsión 3D */
            display: inline-block;
            width: 220px;
            /* CAMBIO 2: Más ancho para que "Front End" respire */
            height: 1.5em;
            /* CAMBIO 3: Un poco más de altura para evitar cortes */
            position: relative;
            vertical-align: bottom;
            overflow: hidden;
            margin-bottom: -5px;
            /* Ajuste fino de alineación vertical */
        }

        .role-carousel-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            animation: rotateCarouselVertical 9s infinite cubic-bezier(0.25, 1, 0.5, 1);
        }

        .role-item {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            backface-visibility: hidden;
            font-weight: 700;
            font-size: 1.1em;
            white-space: nowrap;
            /* CAMBIO 4: Obliga al texto a no comprimirse ni saltar línea */

            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* CONFIGURACIÓN DEL PRISMA VERTICAL
           Aumentamos ligeramente translateZ a 30px porque aumentamos la altura del contenedor (height: 1.5em).
           Esto mantiene la proporción del triángulo.
        */
        .role-item:nth-child(1) {
            transform: rotateX(0deg) translateZ(30px);
        }

        .role-item:nth-child(2) {
            transform: rotateX(120deg) translateZ(30px);
        }

        .role-item:nth-child(3) {
            transform: rotateX(240deg) translateZ(30px);
        }

        /* Animación Vertical (Eje X) */
        @keyframes rotateCarouselVertical {

            /* Cara 1 */
            0%,
            30% {
                transform: translateZ(-30px) rotateX(0deg);
            }

            /* Giro a Cara 2 */
            33.33%,
            63.33% {
                transform: translateZ(-30px) rotateX(-120deg);
            }

            /* Giro a Cara 3 */
            66.66%,
            96.66% {
                transform: translateZ(-30px) rotateX(-240deg);
            }

            /* Vuelta al inicio */
            100% {
                transform: translateZ(-30px) rotateX(-360deg);
            }
        }

        /* Robot Styles */
        .robot-container {
            position: relative;
            transform: scale(0.9);
            animation: robotFloat 3s ease-in-out infinite;
        }

        @keyframes robotFloat {

            0%,
            100% {
                transform: scale(0.9) translateY(0px);
            }

            50% {
                transform: scale(0.9) translateY(-20px);
            }
        }

        /* Cabeza */
        .robot-head {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            border-radius: 20px;
            margin: 0 auto;
            position: relative;
            box-shadow: 0 10px 30px rgba(168, 85, 247, 0.4);
            animation: headTilt 4s ease-in-out infinite;
        }

        @keyframes headTilt {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-5deg);
            }

            75% {
                transform: rotate(5deg);
            }
        }

        /* Antenas */
        .antenna {
            position: absolute;
            width: 3px;
            height: 25px;
            background: linear-gradient(180deg, #a855f7, #ec4899);
            top: -25px;
        }

        .antenna-left {
            left: 30%;
        }

        .antenna-right {
            right: 30%;
        }

        .antenna-ball {
            width: 10px;
            height: 10px;
            background: #fbbf24;
            border-radius: 50%;
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            animation: antennaBlink 1.5s ease-in-out infinite;
            box-shadow: 0 0 10px #fbbf24;
        }

        @keyframes antennaBlink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        /* Ojos */
        .robot-eyes {
            display: flex;
            justify-content: space-around;
            padding: 25px 20px 0;
        }

        .eye {
            width: 30px;
            height: 30px;
            background: white;
            border-radius: 50%;
            position: relative;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .pupil {
            width: 15px;
            height: 15px;
            background: #1e293b;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: transform 0.1s ease-out;
        }

        /* Boca */
        .robot-mouth {
            width: 60px;
            height: 8px;
            background: #1e293b;
            border-radius: 0 0 30px 30px;
            /* Sonrisa normal */
            margin: 15px auto 0;
            transition: all 0.3s ease;
        }

        .happy-mouth .robot-mouth {
            height: 15px;
            /* Boca más abierta */
            width: 50px;
            border-radius: 0 0 50px 50px;
            /* Curva más pronunciada */
            background: #000;
        }

        @keyframes smile {

            0%,
            100% {
                width: 60px;
                border-radius: 0 0 30px 30px;
            }

            50% {
                width: 70px;
                border-radius: 0 0 40px 40px;
            }
        }

        /* Cuerpo */
        .robot-body {
            width: 150px;
            height: 180px;
            background: linear-gradient(135deg, #7c3aed 0%, #db2777 100%);
            border-radius: 15px;
            margin: 15px auto;
            position: relative;
            box-shadow: 0 15px 35px rgba(124, 58, 237, 0.4);
        }

        /* Panel de Control */
        .control-panel {
            display: flex;
            justify-content: space-around;
            padding: 20px 15px;
        }

        .indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #fbbf24;
            box-shadow: 0 0 15px #fbbf24;
            animation: indicatorPulse 1.5s ease-in-out infinite;
        }

        .indicator-delay-1 {
            animation-delay: 0.3s;
            background: #10b981;
            box-shadow: 0 0 15px #10b981;
        }

        .indicator-delay-2 {
            animation-delay: 0.6s;
            background: #3b82f6;
            box-shadow: 0 0 15px #3b82f6;
        }

        @keyframes indicatorPulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(0.8);
            }
        }

        /* Líneas de código */
        .code-lines {
            padding: 0 20px;
            margin-top: 10px;
        }

        .code-line {
            height: 8px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            margin-bottom: 8px;
            animation: codeType 2s ease-in-out infinite;
        }

        .code-line:nth-child(1) {
            width: 80%;
        }

        .code-line:nth-child(2) {
            width: 60%;
            animation-delay: 0.3s;
        }

        .code-line:nth-child(3) {
            width: 70%;
            animation-delay: 0.6s;
        }

        @keyframes codeType {
            0% {
                width: 0%;
            }

            50% {
                width: var(--original-width, 80%);
            }

            100% {
                width: var(--original-width, 80%);
            }
        }

        @keyframes waveHand {
            0% {
                transform: rotate(-150deg);
            }

            20% {
                transform: rotate(-100deg);
            }

            40% {
                transform: rotate(-150deg);
            }

            60% {
                transform: rotate(-100deg);
            }

            80% {
                transform: rotate(-150deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        .waving .robot-arm-right {
            /* Sobrescribimos la rotación manual mientras saluda */
            animation: waveHand 2s ease-in-out forwards;
            transition: none;
            /* Importante para que no pelee con el JS */
        }

        /* Brazos */
        .robot-arm {
            position: absolute;
            top: 220px;
            transform-origin: 12.5px 10px;
            /* Ajuste leve del pivote */
            /* Cambiamos 0.3s a 0.1s. Esto elimina la sensación de lentitud */
            transition: transform 0.1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
            /* Optimización de rendimiento */
        }

        .robot-arm-left {
            left: -30px;
        }

        .robot-arm-right {
            right: -30px;
        }

        .arm-upper {
            width: 25px;
            height: 60px;
            background: linear-gradient(135deg, #a855f7, #ec4899);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(168, 85, 247, 0.4);
            transform-origin: center top;
        }

        .arm-lower {
            width: 20px;
            height: 50px;
            background: linear-gradient(135deg, #7c3aed, #db2777);
            border-radius: 10px;
            margin: 5px 2.5px 0;
            transform-origin: center top;
            transition: transform 0.2s ease-out;
        }

        .hand {
            width: 25px;
            height: 20px;
            background: linear-gradient(135deg, #a855f7, #ec4899);
            border-radius: 8px;
            margin: 5px 0 0 -2.5px;
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            padding: 3px;
            transform-origin: center top;
            transition: transform 0.2s ease-out;
        }

        .finger {
            width: 4px;
            height: 10px;
            background: #ec4899;
            border-radius: 2px;
        }

        /* Piernas */
        .robot-legs {
            display: flex;
            justify-content: space-around;
            margin: 0 auto;
            width: 150px;
        }

        .leg {
            animation: legWalk 1s ease-in-out infinite;
        }

        .leg-left {
            animation-delay: 0.5s;
        }

        @keyframes legWalk {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .leg-upper {
            width: 30px;
            height: 60px;
            background: linear-gradient(135deg, #7c3aed, #db2777);
            border-radius: 10px;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.3);
        }

        .leg-lower {
            width: 25px;
            height: 50px;
            background: linear-gradient(135deg, #a855f7, #ec4899);
            border-radius: 8px;
            margin: 5px auto 0;
        }

        .foot {
            width: 40px;
            height: 15px;
            background: linear-gradient(135deg, #ec4899, #f43f5e);
            border-radius: 8px 8px 4px 4px;
            margin: 5px auto 0;
            box-shadow: 0 5px 10px rgba(236, 72, 153, 0.3);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const heroSection = document.getElementById('hero-section');
            const pupils = document.querySelectorAll('.pupil');
            const armLeft = document.querySelector('.robot-arm-left');
            const armRight = document.querySelector('.robot-arm-right');
            const robot = document.getElementById('robot');
            const robotContainer = document.querySelector('.robot-container');

            let isWaving = false;

            const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

            function calculateArmRotation(mouseX, mouseY, armElement, isRightArm) {
                const rect = armElement.getBoundingClientRect();
                const shoulderX = rect.left + rect.width / 2;
                const shoulderY = rect.top + 10;

                const deltaX = mouseX - shoulderX;
                const deltaY = mouseY - shoulderY;

                let angle = Math.atan2(deltaY, deltaX) * (180 / Math.PI);

                // Ajuste de offset inicial
                angle = angle - 90;

                // --- CORRECCIÓN AQUÍ ---
                // Cambiamos -270 por -180. Esto asegura que cuando el mouse
                // va hacia arriba a la izquierda, el ángulo se convierta en positivo
                // (ej: de -225 pasa a 135) para que el brazo pueda subir.
                if (angle < -180) angle += 360;

                if (isRightArm) {
                    // Brazo derecho: Rango negativo (sentido antihorario)
                    return clamp(angle, -160, -10);
                } else {
                    // Brazo izquierdo: Rango positivo (sentido horario)
                    return clamp(angle, 10, 160);
                }
            }

            function updateArms(mouseX, mouseY) {
                if (isWaving) return;

                const robotRect = robot.getBoundingClientRect();
                const robotCenterX = robotRect.left + robotRect.width / 2;

                // Umbral de histeresis para evitar parpadeo justo en el centro
                const threshold = 20;
                const isMouseOnRight = mouseX > (robotCenterX - threshold);

                const angleLeft = calculateArmRotation(mouseX, mouseY, armLeft, false);
                const angleRight = calculateArmRotation(mouseX, mouseY, armRight, true);

                if (mouseX > robotCenterX) {
                    // Mouse a la derecha
                    armRight.style.transform = `rotate(${angleRight}deg)`;
                    armLeft.style.transform = `rotate(0deg)`;
                } else {
                    // Mouse a la izquierda
                    armLeft.style.transform = `rotate(${angleLeft}deg)`;
                    armRight.style.transform = `rotate(0deg)`;
                }
            }

            function movePupils(mouseX, mouseY) {
                pupils.forEach(pupil => {
                    const eye = pupil.parentElement;
                    const eyeRect = eye.getBoundingClientRect();
                    const eyeCenterX = eyeRect.left + eyeRect.width / 2;
                    const eyeCenterY = eyeRect.top + eyeRect.height / 2;

                    const maxMove = 8;
                    const moveX = clamp((mouseX - eyeCenterX) / 8, -maxMove, maxMove);
                    const moveY = clamp((mouseY - eyeCenterY) / 8, -maxMove, maxMove);

                    pupil.style.transform = `translate(calc(-50% + ${moveX}px), calc(-50% + ${moveY}px))`;
                });
            }

            function triggerWave() {
                if (isWaving) return;
                isWaving = true;

                robotContainer.classList.add('waving');
                robot.classList.add('happy-mouth');

                setTimeout(() => {
                    robotContainer.classList.remove('waving');
                    robot.classList.remove('happy-mouth');
                    isWaving = false;
                    armRight.style.transform = 'rotate(0deg)';
                }, 2000);
            }

            heroSection.addEventListener('mousemove', function (e) {
                movePupils(e.clientX, e.clientY);
                updateArms(e.clientX, e.clientY);
            });

            heroSection.addEventListener('mouseleave', function () {
                if (!isWaving) {
                    armLeft.style.transform = 'rotate(0deg)';
                    armRight.style.transform = 'rotate(0deg)';
                    pupils.forEach(p => p.style.transform = 'translate(-50%, -50%)');
                }
            });

            robot.addEventListener('click', triggerWave);
            setTimeout(triggerWave, 1000);
        });
    </script>
</div>