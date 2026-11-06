/**
 * Robot de «Tecnologías»: al tocar una del anillo, el robot la sostiene y el
 * panel cuenta dónde se usó. Tocar la misma, el recuadro que sostiene el robot,
 * «Soltar» o Escape la devuelve.
 * Los datos viajan en atributos data-* de cada botón (los arma TechCatalog).
 */
export function initTechRobot() {
    document.querySelectorAll('[data-tech]').forEach((root) => {
        const chips = [...root.querySelectorAll('[data-tech-chip]')];
        const buttons = chips.map((chip) => chip.querySelector('[data-tech-pick]'));
        const held = root.querySelector('[data-tech-held]');
        const category = root.querySelector('[data-tech-category]');
        const name = root.querySelector('[data-tech-name]');
        const usesLabel = root.querySelector('[data-tech-uses-label]');
        const usesList = root.querySelector('[data-tech-uses]');
        const release = root.querySelector('[data-tech-release]');
        const { labelUses, labelNone } = root.dataset;

        let current = -1;

        const sync = () => {
            chips.forEach((chip, index) => {
                chip.classList.toggle('is-taken', index === current);
                buttons[index].setAttribute('aria-pressed', String(index === current));
            });
            root.classList.toggle('is-holding', current >= 0);
        };

        const drop = () => {
            const previous = current;
            current = -1;
            sync();
            if (previous >= 0) buttons[previous].focus({ preventScroll: true });
        };

        const pick = (index) => {
            if (index === current) return drop();

            current = index;
            const { techPick, category: group, uses } = buttons[index].dataset;
            const projects = uses ? uses.split('|') : [];

            held.textContent = techPick;
            held.classList.remove('pop');
            void held.offsetWidth; // reinicia la animación
            held.classList.add('pop');

            category.textContent = group;
            name.textContent = techPick;
            usesLabel.textContent = projects.length ? labelUses : labelNone;
            usesList.replaceChildren(...projects.map((project) => {
                const item = document.createElement('li');
                item.textContent = project;
                return item;
            }));

            sync();
            release.focus({ preventScroll: true });
        };

        buttons.forEach((button, index) => button.addEventListener('click', () => pick(index)));
        release.addEventListener('click', drop);
        // El recuadro que sostiene el robot también se toca para soltarlo.
        held.addEventListener('click', drop);
        root.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && current >= 0) drop();
        });
    });
}
