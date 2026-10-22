import { rafThrottle } from '../lib/dom';
import { lookAt } from '../lib/pupils';

/** El robot mini asoma desde la esquina de la foto al verla y mira hacia el mouse. */
export function initAboutRobot() {
    const card = document.querySelector('[data-about-card]');
    const robot = card?.querySelector('[data-about-robot]');
    if (!robot) return;

    const pupils = [...robot.querySelectorAll('.pupil')];
    let inView = false;

    new IntersectionObserver(
        ([entry]) => {
            inView = entry.isIntersecting;
            robot.classList.toggle('is-visible', inView);
        },
        { threshold: 0.4 },
    ).observe(card);

    document.addEventListener(
        'mousemove',
        rafThrottle((event) => {
            if (inView) lookAt(pupils, event.clientX, event.clientY, { divisor: 15, max: 4 });
        }),
        { passive: true },
    );
}
