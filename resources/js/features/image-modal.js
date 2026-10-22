/** Visor de imágenes a pantalla completa. Se abre desde cualquier [data-modal-src]. */
export function initImageModal() {
    const modal = document.querySelector('[data-image-modal]');
    if (!modal) return;

    const image = modal.querySelector('[data-image-modal-img]');
    const caption = modal.querySelector('[data-image-modal-caption]');
    const closeButton = modal.querySelector('button[data-modal-close]');
    let opener = null;

    const setOpen = (open) => {
        modal.hidden = !open;
        document.body.classList.toggle('overflow-hidden', open);
        document.dispatchEvent(new CustomEvent('image-modal:change', { detail: { open } }));
    };

    const open = (trigger) => {
        opener = trigger;
        image.src = trigger.dataset.modalSrc;
        image.alt = trigger.dataset.modalCaption ?? '';
        caption.textContent = trigger.dataset.modalCaption ?? '';
        setOpen(true);
        closeButton?.focus();
    };

    const close = () => {
        setOpen(false);
        opener?.focus?.();
        opener = null;
    };

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-modal-src]');
        if (trigger) {
            open(trigger);
            return;
        }

        const clickedBackdrop = event.target === modal;
        if (!modal.hidden && (clickedBackdrop || event.target.closest('button[data-modal-close]'))) {
            close();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modal.hidden) close();
    });
}
