import { prefersReducedMotion } from '../lib/dom';

/**
 * Baraja de proyectos. La línea de la card activa se rellena con una animación
 * CSS y, cuando termina (`animationend`), se pasa a la siguiente: la duración
 * vive solo en deck.css. El avance se congela con el cursor encima, con el foco
 * por teclado dentro y fuera de pantalla; tocar o arrastrar una card lo detiene
 * del todo. Arrastrar (mouse o dedo) hacia la izquierda pasa a la siguiente y
 * hacia la derecha a la anterior. Con «reducir movimiento» no avanza sola.
 */
export function initDeck() {
    document.querySelectorAll('[data-deck-root]').forEach((root) => {
        const deck = root.querySelector('[data-deck]');
        const slides = [...deck.querySelectorAll('.deck__slide')];
        const descriptions = [...root.querySelectorAll('[data-deck-desc]')];
        const steps = [...root.querySelectorAll('[data-deck-step]')];

        let active = 0;
        let stopped = prefersReducedMotion();
        let hovering = false;
        let focused = false;
        let visible = false;

        const syncState = () => {
            root.classList.toggle('is-stopped', stopped);
            root.classList.toggle('is-held', !visible || hovering || focused);
        };

        const draw = () => {
            slides.forEach((slide, index) => {
                const offset = (index - active + slides.length) % slides.length;
                slide.style.setProperty('--o', offset);
                // Solo la tarjeta del frente es alcanzable con teclado y lector de pantalla.
                slide.inert = offset !== 0;
            });

            descriptions.forEach((text, index) => text.classList.toggle('is-active', index === active));

            steps.forEach((step, index) => {
                step.classList.toggle('is-done', index < active);
                step.classList.toggle('is-current', index === active);
                if (index === active) step.setAttribute('aria-current', 'true');
                else step.removeAttribute('aria-current');
            });
        };

        const select = (index) => {
            if (index === active) return;

            active = index;
            draw();
        };

        steps.forEach((step, index) => step.addEventListener('click', () => select(index)));

        root.addEventListener('animationend', (event) => {
            if (event.target.classList.contains('deck__relleno')) select((active + 1) % slides.length);
        });

        let dragged = false;

        // Un clic que termina un arrastre no cuenta como toque.
        deck.addEventListener('click', (event) => {
            if (dragged) {
                event.stopPropagation();
                event.preventDefault();
                dragged = false;
                return;
            }

            stopped = true;
            syncState();
        }, true);

        const THRESHOLD = 8;
        const SWIPE = 60;
        let startX = 0;
        let dx = 0;
        let pointer = null;

        deck.addEventListener('pointerdown', (event) => {
            if (event.button > 0 || event.target.closest('button, a')) return;

            pointer = event.pointerId;
            startX = event.clientX;
            dx = 0;
            dragged = false;
        });

        deck.addEventListener('pointermove', (event) => {
            if (event.pointerId !== pointer) return;

            dx = event.clientX - startX;

            if (!dragged && Math.abs(dx) > THRESHOLD) {
                dragged = true;
                deck.setPointerCapture(pointer);
                deck.classList.add('is-dragging');
            }

            if (dragged) slides[active].style.setProperty('--dx', dx + 'px');
        });

        const release = (event) => {
            if (event.pointerId !== pointer) return;

            pointer = null;
            deck.classList.remove('is-dragging');
            slides[active].style.removeProperty('--dx');

            if (!dragged) return;

            stopped = true;
            syncState();

            if (dx <= -SWIPE) select((active + 1) % slides.length);
            else if (dx >= SWIPE) select((active - 1 + slides.length) % slides.length);

            // El clic de cierre llega justo después; si no llega, se limpia solo.
            setTimeout(() => { dragged = false; }, 0);
        };

        deck.addEventListener('pointerup', release);
        deck.addEventListener('pointercancel', release);
        deck.addEventListener('dragstart', (event) => event.preventDefault());

        deck.addEventListener('mouseenter', () => { hovering = true; syncState(); });
        deck.addEventListener('mouseleave', () => { hovering = false; syncState(); });

        // Solo el foco por teclado congela la línea; un clic con el mouse no.
        root.addEventListener('focusin', (event) => {
            focused = event.target.matches(':focus-visible');
            syncState();
        });
        root.addEventListener('focusout', () => { focused = false; syncState(); });

        new IntersectionObserver(([entry]) => {
            visible = entry.isIntersecting;
            syncState();
        }, { threshold: 0.4 }).observe(deck);

        draw();
        syncState();
    });
}
