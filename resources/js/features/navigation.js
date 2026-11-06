import { prefersReducedMotion } from '../lib/dom';

const SCROLL_OFFSET = 72;

/** Desplazamiento suave a las secciones y resaltado del enlace de la sección visible. */
export function initNavigation() {
    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-scroll-to]');
        const target = trigger && document.getElementById(trigger.dataset.scrollTo);
        if (!target) return;

        event.preventDefault();
        window.scrollTo({
            top: target.getBoundingClientRect().top + window.scrollY - SCROLL_OFFSET,
            behavior: prefersReducedMotion() ? 'auto' : 'smooth',
        });
    });

    const links = [...document.querySelectorAll('[data-site-nav] [data-section]')];
    const spy = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                links.forEach((link) => {
                    link.classList.toggle('active', link.dataset.section === entry.target.id);
                });
            });
        },
        { rootMargin: '-40% 0px -40% 0px', threshold: 0 },
    );

    links.forEach((link) => {
        const section = document.getElementById(link.dataset.section);
        if (section) spy.observe(section);
    });
}
