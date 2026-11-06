/** Pide confirmación antes de enviar un formulario con `data-confirm="mensaje"`. */
export function initConfirm() {
    document.addEventListener('submit', (event) => {
        const message = event.target.dataset?.confirm;

        if (message && !window.confirm(message)) event.preventDefault();
    });
}
