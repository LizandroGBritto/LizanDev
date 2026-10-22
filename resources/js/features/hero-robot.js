import { clamp, rafThrottle } from '../lib/dom';
import { lookAt, resetPupils } from '../lib/pupils';

const WAVE_DURATION = 2000;
const INITIAL_WAVE_DELAY = 1000;

/** El robot del hero sigue el mouse con los ojos y un brazo, y saluda al hacer clic. */
export function initHeroRobot() {
    const section = document.getElementById('hero-section');
    const robot = document.querySelector('[data-robot]');
    if (!section || !robot) return;

    const pupils = [...robot.querySelectorAll('.pupil')];
    const armLeft = robot.querySelector('.robot-arm-left');
    const armRight = robot.querySelector('.robot-arm-right');
    let waving = false;

    const armAngle = (mouseX, mouseY, arm, isRight) => {
        const rect = arm.getBoundingClientRect();
        const shoulderX = rect.left + rect.width / 2;
        const shoulderY = rect.top + 10;

        let angle = (Math.atan2(mouseY - shoulderY, mouseX - shoulderX) * 180) / Math.PI - 90;
        if (angle < -180) angle += 360;

        return isRight ? clamp(angle, -160, -10) : clamp(angle, 10, 160);
    };

    const updateArms = (mouseX, mouseY) => {
        const rect = robot.getBoundingClientRect();
        const mouseOnRight = mouseX > rect.left + rect.width / 2;

        armRight.style.transform = mouseOnRight ? `rotate(${armAngle(mouseX, mouseY, armRight, true)}deg)` : 'rotate(0deg)';
        armLeft.style.transform = mouseOnRight ? 'rotate(0deg)' : `rotate(${armAngle(mouseX, mouseY, armLeft, false)}deg)`;
    };

    const resetPose = () => {
        armLeft.style.transform = 'rotate(0deg)';
        armRight.style.transform = 'rotate(0deg)';
        resetPupils(pupils);
    };

    const wave = () => {
        if (waving) return;
        waving = true;
        robot.classList.add('waving', 'happy-mouth');

        setTimeout(() => {
            robot.classList.remove('waving', 'happy-mouth');
            armRight.style.transform = 'rotate(0deg)';
            waving = false;
        }, WAVE_DURATION);
    };

    section.addEventListener(
        'mousemove',
        rafThrottle((event) => {
            lookAt(pupils, event.clientX, event.clientY);
            if (!waving) updateArms(event.clientX, event.clientY);
        }),
    );
    section.addEventListener('mouseleave', () => {
        if (!waving) resetPose();
    });
    robot.addEventListener('click', wave);
    setTimeout(wave, INITIAL_WAVE_DELAY);
}
