import { prefersReducedMotion } from '../lib/dom';

const INTERVAL = 4000;

class Carousel {
    constructor(root) {
        this.root = root;
        this.slides = [...root.querySelectorAll('[data-carousel-slide]')];
        this.dots = [...root.querySelectorAll('[data-carousel-go]')];
        this.index = 0;
        this.timer = null;
        this.visible = false;
        this.hovered = false;
        this.autoplay = !prefersReducedMotion();

        root.addEventListener('click', (event) => this.handleClick(event));
        root.addEventListener('mouseenter', () => this.setHovered(true));
        root.addEventListener('mouseleave', () => this.setHovered(false));

        // Solo avanza solo mientras se ve en pantalla.
        new IntersectionObserver(([entry]) => {
            this.visible = entry.isIntersecting;
            this.restart();
        }).observe(root);
    }

    handleClick(event) {
        if (event.target.closest('[data-carousel-prev]')) {
            this.show(this.index - 1);
        } else if (event.target.closest('[data-carousel-next]')) {
            this.show(this.index + 1);
        } else {
            const dot = event.target.closest('[data-carousel-go]');
            if (dot) this.show(Number(dot.dataset.carouselGo));
        }
    }

    show(index) {
        const total = this.slides.length;
        this.index = (index + total) % total;

        this.slides.forEach((slide, i) => slide.classList.toggle('active', i === this.index));
        this.dots.forEach((dot, i) => dot.classList.toggle('active', i === this.index));
        this.restart();
    }

    setHovered(hovered) {
        this.hovered = hovered;
        this.restart();
    }

    restart() {
        clearInterval(this.timer);
        this.timer = null;

        if (this.autoplay && this.visible && !this.hovered) {
            this.timer = setInterval(() => this.show(this.index + 1), INTERVAL);
        }
    }
}

export function initCarousels() {
    document.querySelectorAll('[data-carousel]').forEach((root) => new Carousel(root));
}
