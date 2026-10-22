import { clamp } from './dom';

/** Mueve cada pupila hacia el punto (x, y) de la pantalla, dentro de un rango corto. */
export function lookAt(pupils, x, y, { divisor = 8, max = 8 } = {}) {
    pupils.forEach((pupil) => {
        const eye = pupil.parentElement.getBoundingClientRect();
        const moveX = clamp((x - (eye.left + eye.width / 2)) / divisor, -max, max);
        const moveY = clamp((y - (eye.top + eye.height / 2)) / divisor, -max, max);

        pupil.style.transform = `translate(calc(-50% + ${moveX}px), calc(-50% + ${moveY}px))`;
    });
}

/** Devuelve las pupilas al centro (el transform base está en robot.css). */
export function resetPupils(pupils) {
    pupils.forEach((pupil) => pupil.style.removeProperty('transform'));
}
