import { prefersReducedMotion } from '../lib/dom';

/**
 * Baraja de proyectos. La línea de la card activa se rellena con una animación
 * CSS y, cuando termina (`animationend`), se pasa a la siguiente: la duración
 * vive solo en deck.css. El avance se congela con el cursor encima, con el foco
 * por teclado dentro y fuera de pantalla; tocar una card lo detiene del todo.
 * Con «reducir movimiento» no avanza sola.
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

        deck.addEventListener('click', () => {
            stopped = true;
            syncState();
        });

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
