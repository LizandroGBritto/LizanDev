/**
 * Modal de detalles de un proyecto. Se abre al tocar la card del frente o su
 * botón «Detalles»; el <dialog> nativo se encarga del foco, de Esc y de
 * devolver el foco a quien lo abrió. Acá solo se abre/cierra, se bloquea el
 * scroll del fondo y se maneja la galería (vista activa y notebook/celular).
 *
 * Un clic que termina un arrastre de la baraja no llega hasta acá: deck.js lo
 * frena antes en la fase de captura.
 */
export function initProjectDetail() {
    const root = document.documentElement;
    const dialogs = new Map([...document.querySelectorAll('dialog[data-detail]')].map((dialog) => [dialog.dataset.detail, dialog]));

    const setupGallery = (dialog) => {
        const gallery = dialog.querySelector('[data-gallery]');
        const views = [...gallery.querySelectorAll('[data-gallery-view]')];
        const thumbs = [...gallery.querySelectorAll('[data-gallery-thumb]')];
        const devices = [...gallery.querySelectorAll('[data-gallery-device]')];

        const showView = (index) => {
            views.forEach((view, i) => view.classList.toggle('is-active', i === index));
            thumbs.forEach((thumb, i) => {
                thumb.classList.toggle('is-active', i === index);
                thumb.setAttribute('aria-pressed', String(i === index));
            });
        };

        const showDevice = (phone) => {
            gallery.classList.toggle('is-phone', phone);
            devices.forEach((button) => button.setAttribute('aria-pressed', String((button.dataset.galleryDevice === 'phone') === phone)));
        };

        thumbs.forEach((thumb, index) => thumb.addEventListener('click', () => showView(index)));
        devices.forEach((button) => button.addEventListener('click', () => showDevice(button.dataset.galleryDevice === 'phone')));

        // Con foco en una miniatura, las flechas recorren las vistas.
        gallery.addEventListener('keydown', (event) => {
            const at = thumbs.indexOf(document.activeElement);
            if (at < 0 || !['ArrowLeft', 'ArrowRight'].includes(event.key)) return;

            const next = (at + (event.key === 'ArrowRight' ? 1 : -1) + thumbs.length) % thumbs.length;
            showView(next);
            thumbs[next].focus();
            event.preventDefault();
        });

        return { showView, showDevice };
    };

    const galleries = new Map([...dialogs].map(([slug, dialog]) => [slug, setupGallery(dialog)]));

    const open = (slug, phone) => {
        const dialog = dialogs.get(slug);
        if (!dialog || dialog.open) return;

        // Se abre en la primera vista y con el dispositivo que la card tenía elegido.
        galleries.get(slug).showView(0);
        galleries.get(slug).showDevice(phone);

        root.classList.add('detalle-abierto');
        dialog.showModal();
        dialog.querySelector('.detalle__cuerpo')?.scrollTo(0, 0);

        // Lo escucha features/tracking.js.
        document.dispatchEvent(new CustomEvent('project:detail', { detail: { project: slug } }));
    };

    dialogs.forEach((dialog) => {
        dialog.addEventListener('close', () => root.classList.remove('detalle-abierto'));
        dialog.querySelector('[data-detail-close]').addEventListener('click', () => dialog.close());

        // El telón es el propio <dialog>: un clic directo sobre él, fuera del panel, cierra.
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) dialog.close();
        });
    });

    document.querySelectorAll('[data-deck]').forEach((deck) => deck.addEventListener('click', (event) => {
        const slide = event.target.closest('.deck__slide');
        if (!slide || slide.inert) return;

        // Los enlaces y el selector notebook/celular conservan su función; solo «Detalles» abre.
        if (event.target.closest('a, button:not([data-detail-open])')) return;

        open(slide.dataset.project, slide.classList.contains('is-phone'));
    }));
}
