import { prefersReducedMotion, rafThrottle } from '../lib/dom';

const SCROLL_OFFSET = 80;
const SHOW_AFTER = 50;

/** Barra flotante: aparece al hacer scroll, resalta la sección activa y desplaza suavemente. */
export function initNavigation() {
    const nav = document.querySelector('[data-site-nav]');
    if (!nav) return;

    let modalOpen = false;

    const updateVisibility = () => {
        nav.classList.toggle('is-visible', window.scrollY > SHOW_AFTER && !modalOpen);
    };

    window.addEventListener('scroll', rafThrottle(updateVisibility), { passive: true });
    document.addEventListener('image-modal:change', (event) => {
        modalOpen = event.detail.open;
        updateVisibility();
    });
    updateVisibility();

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

    const links = [...nav.querySelectorAll('[data-section]')];
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
