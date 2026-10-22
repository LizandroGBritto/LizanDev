import { rafThrottle } from '../lib/dom';

const HIDE_AFTER = 100;
const REVEAL_ZONE = { x: 200, y: 100 };
const REVEAL_DURATION = 2000;

/** El selector se oculta al hacer scroll, reaparece cerca de su esquina y recarga al cambiar de idioma. */
export function initLanguageSwitcher() {
    // Livewire dispara este evento desde LanguageSwitcher::switchLocale().
    window.addEventListener('locale-changed', () => window.location.reload());

    const switcher = document.querySelector('[data-language-switcher]');
    if (!switcher) return;

    let hideTimer;
    const setHidden = (hidden) => switcher.classList.toggle('is-hidden', hidden);

    window.addEventListener('scroll', rafThrottle(() => setHidden(window.scrollY > HIDE_AFTER)), { passive: true });

    document.addEventListener(
        'mousemove',
        rafThrottle((event) => {
            if (event.clientX < window.innerWidth - REVEAL_ZONE.x || event.clientY > REVEAL_ZONE.y) return;

            setHidden(false);
            clearTimeout(hideTimer);
            hideTimer = setTimeout(() => {
                if (window.scrollY > HIDE_AFTER) setHidden(true);
            }, REVEAL_DURATION);
        }),
        { passive: true },
    );
}
