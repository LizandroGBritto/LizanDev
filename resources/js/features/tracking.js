/**
 * Registra qué mira el visitante, sin cookies ni datos personales: proyecto
 * visto (la card del frente, visible, durante un momento), cambio de
 * notebook/celular, apertura del modal de detalles, clic en «Ver Proyecto» y
 * tecnología tocada. El servidor
 * valida cada evento contra la lista de proyectos y tecnologías.
 *
 * Se envía con sendBeacon (no frena la página ni se pierde al salir) y, si
 * el navegador no lo tiene, con fetch keepalive. Los fallos se ignoran.
 */
const DWELL_MS = 1500;

const send = (type, subject, detail) => {
    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!token || !subject) return;

    const body = new FormData();
    body.append('_token', token);
    body.append('tipo', type);
    body.append('sujeto', subject);
    if (detail) body.append('detalle', detail);

    try {
        if (!navigator.sendBeacon?.('/seguimiento', body)) {
            fetch('/seguimiento', { method: 'POST', body, keepalive: true }).catch(() => {});
        }
    } catch {
        // El seguimiento nunca debe romper la página.
    }
};

export function initTracking() {
    // Proyecto visto: una vez por carga de página y por proyecto.
    const seen = new Set();
    const deck = document.querySelector('[data-deck]');
    let visible = false;
    let current = null;
    let timer = null;

    const consider = () => {
        clearTimeout(timer);
        if (!visible || !current || seen.has(current)) return;

        const project = current;
        timer = setTimeout(() => {
            if (visible && current === project && !seen.has(project)) {
                seen.add(project);
                send('proyecto_visto', project);
            }
        }, DWELL_MS);
    };

    if (deck) {
        new IntersectionObserver(([entry]) => {
            visible = entry.isIntersecting;
            consider();
        }, { threshold: 0.4 }).observe(deck);

        document.addEventListener('deck:active', (event) => {
            current = event.detail.project;
            consider();
        });
    }

    document.addEventListener('project:detail', (event) => send('detalle_abierto', event.detail.project));

    document.addEventListener('click', (event) => {
        const slide = event.target.closest('[data-project]');

        const view = event.target.closest('[data-device-view]');
        if (view && slide) return send('vista_dispositivo', slide.dataset.project, view.dataset.deviceView);

        const demo = event.target.closest('[data-demo]');
        if (demo && slide) return send('demo_clic', slide.dataset.project);

        const tech = event.target.closest('[data-tech-pick]');
        if (tech) send('tecnologia', tech.dataset.techPick);
    });
}
