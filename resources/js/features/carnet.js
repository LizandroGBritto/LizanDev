/** El carnet gira con un clic, Enter o Espacio. El estado es la clase `is-flipped`. */
export function initCarnet() {
    document.querySelectorAll('[data-flip]').forEach((card) => {
        const flip = () => {
            const flipped = card.classList.toggle('is-flipped');
            card.setAttribute('aria-pressed', String(flipped));
        };

        card.addEventListener('click', flip);
        card.addEventListener('keydown', (event) => {
            if (event.key !== 'Enter' && event.key !== ' ') return;

            event.preventDefault();
            flip();
        });
    });
}
