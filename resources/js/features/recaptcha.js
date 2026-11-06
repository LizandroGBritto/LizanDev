const SCRIPT = 'https://www.google.com/recaptcha/api.js';
const ACTION = 'contacto';

let loading = null;

/** Carga api.js de reCAPTCHA v3 una sola vez, recién cuando el visitante toca el formulario. */
function load(siteKey) {
    loading ??= new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = `${SCRIPT}?render=${encodeURIComponent(siteKey)}`;
        script.async = true;
        script.onload = () => window.grecaptcha.ready(resolve);
        script.onerror = reject;
        document.head.append(script);
    });

    return loading;
}

/**
 * reCAPTCHA v3 en el formulario de contacto. Intercepta el envío, pide el
 * token y lo deja en `recaptchaToken` del componente Livewire antes de dejar
 * pasar el submit. Si Google no carga, el envío sigue sin token y el servidor
 * lo rechaza con un mensaje.
 */
export function initRecaptcha() {
    const form = document.querySelector('[data-contact-form][data-recaptcha-site-key]');
    if (!form) return;

    const siteKey = form.dataset.recaptchaSiteKey;
    let ready = false;

    form.addEventListener('focusin', () => load(siteKey).catch(() => {}), { once: true });

    // En captura, para correr antes que el listener de wire:submit.
    form.addEventListener('submit', async (event) => {
        if (ready) {
            ready = false;
            return;
        }

        event.preventDefault();
        event.stopImmediatePropagation();

        const wire = window.Livewire.find(form.closest('[wire\\:id]').getAttribute('wire:id'));

        try {
            await load(siteKey);
            wire.recaptchaToken = await window.grecaptcha.execute(siteKey, { action: ACTION });
        } catch {
            wire.recaptchaToken = '';
        }

        ready = true;
        form.requestSubmit();
    }, true);
}
