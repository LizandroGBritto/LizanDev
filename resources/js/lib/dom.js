export const ready = (callback) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });
    } else {
        callback();
    }
};

export const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

export const prefersReducedMotion = () =>
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/** Ejecuta `callback` como máximo una vez por frame, con los últimos argumentos recibidos. */
export const rafThrottle = (callback) => {
    let queued = false;
    let lastArgs = [];

    return (...args) => {
        lastArgs = args;
        if (queued) return;

        queued = true;
        requestAnimationFrame(() => {
            queued = false;
            callback(...lastArgs);
        });
    };
};
