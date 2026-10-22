import { ready } from './lib/dom';
import { initNavigation } from './features/navigation';
import { initImageModal } from './features/image-modal';
import { initLanguageSwitcher } from './features/language-switcher';

/*
 * Entrada única. Lo liviano y necesario desde el primer frame se importa
 * directo; lo que depende de marcado puntual se carga con import() solo si
 * ese marcado existe, y Vite lo separa en su propio chunk.
 */
ready(() => {
    initNavigation();
    initImageModal();
    initLanguageSwitcher();

    if (document.querySelector('[data-robot]')) {
        import('./features/hero-robot').then(({ initHeroRobot }) => initHeroRobot());
    }

    if (document.querySelector('[data-about-robot]')) {
        import('./features/about-robot').then(({ initAboutRobot }) => initAboutRobot());
    }

    if (document.querySelector('[data-carousel]')) {
        import('./features/carousel').then(({ initCarousels }) => initCarousels());
    }
});
