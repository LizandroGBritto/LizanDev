/**
 * Alterna la captura de un proyecto entre notebook y celular. El marcado trae
 * los dos dispositivos; acá solo se cambia la clase `is-phone` (CSS gira el 3D)
 * y el estado de los botones.
 */
export function initDevice() {
    document.querySelectorAll('[data-device-toggle]').forEach((toggle) => {
        const stage = toggle.closest('[data-device]');
        const buttons = [...toggle.querySelectorAll('[data-device-view]')];

        buttons.forEach((button) => button.addEventListener('click', () => {
            const phone = button.dataset.deviceView === 'phone';

            stage.classList.toggle('is-phone', phone);
            buttons.forEach((other) => other.setAttribute('aria-pressed', String(other === button)));
        }));
    });
}
