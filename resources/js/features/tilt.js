import { prefersReducedMotion } from '../lib/dom';

/**
 * Inclina un elemento con el puntero. `data-tilt="ax,ay"` son los grados
 * máximos en cada eje; escribe --rx/--ry, que el CSS usa en su transform.
 * Con «reducir movimiento» y en táctil no hace nada.
 */
export function initTilt() {
    if (prefersReducedMotion()) return;

    document.querySelectorAll('[data-tilt]').forEach((el) => {
        const [maxX, maxY] = el.dataset.tilt.split(',').map(Number);

        el.addEventListener('pointermove', (event) => {
            if (event.pointerType === 'touch') return;

            const box = el.getBoundingClientRect();
            const x = (event.clientX - box.left) / box.width - 0.5;
            const y = (event.clientY - box.top) / box.height - 0.5;

            el.style.setProperty('--rx', `${(-y * maxX).toFixed(1)}deg`);
            el.style.setProperty('--ry', `${(x * maxY).toFixed(1)}deg`);
        });

        el.addEventListener('pointerleave', () => {
            el.style.removeProperty('--rx');
            el.style.removeProperty('--ry');
        });
    });
}
