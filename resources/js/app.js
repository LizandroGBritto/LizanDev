import { ready } from './lib/dom';
import { initNavigation } from './features/navigation';
import { initLanguageSwitcher } from './features/language-switcher';

/*
 * Entrada única. Lo liviano y necesario desde el primer frame se importa
 * directo; lo que depende de marcado puntual se carga con import() solo si
 * ese marcado existe, y Vite lo separa en su propio chunk.
 */
const lazy = [
    ['[data-tilt]', () => import('./features/tilt').then((m) => m.initTilt())],
    ['[data-flip]', () => import('./features/carnet').then((m) => m.initCarnet())],
    ['[data-deck-root]', () => import('./features/deck').then((m) => m.initDeck())],
    ['[data-tech]', () => import('./features/tech-robot').then((m) => m.initTechRobot())],
    ['[data-about-robot]', () => import('./features/about-robot').then((m) => m.initAboutRobot())],
    ['[data-confirm]', () => import('./features/confirm').then((m) => m.initConfirm())],
    ['[data-recaptcha-site-key]', () => import('./features/recaptcha').then((m) => m.initRecaptcha())],
];

ready(() => {
    initNavigation();
    initLanguageSwitcher();

    lazy.forEach(([selector, load]) => {
        if (document.querySelector(selector)) load();
    });
});
