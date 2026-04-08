import './bootstrap';

// Global state for modal
let isModalOpen = false;

// --- Navigation Logic ---
window.scrollToSection = function(id, event) {
    if (event) event.preventDefault();
    const element = document.getElementById(id);
    if (element) {
        const offset = 80;
        const bodyRect = document.body.getBoundingClientRect().top;
        const elementRect = element.getBoundingClientRect().top;
        const elementPosition = elementRect - bodyRect;
        const offsetPosition = elementPosition - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
};

function updateNavVisibility() {
    const secondaryNav = document.getElementById('secondary-nav');
    if (!secondaryNav) return;

    const hiddenClasses = ['-translate-y-full', 'opacity-0', 'pointer-events-none'];
    const visibleClasses = ['translate-y-0', 'opacity-100', 'pointer-events-auto'];

    if (window.scrollY > 50 && !isModalOpen) {
        secondaryNav.classList.remove(...hiddenClasses);
        secondaryNav.classList.add(...visibleClasses);
    } else {
        secondaryNav.classList.remove(...visibleClasses);
        secondaryNav.classList.add(...hiddenClasses);
    }
}

// --- Modal Logic ---
window.openImageModal = function(src, caption) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const modalCaption = document.getElementById('modalCaption');

    if (!modal) return;

    isModalOpen = true;
    updateNavVisibility(); // Hide nav immediately

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    modalImg.src = src;
    modalImg.alt = caption;
    modalCaption.textContent = caption;

    document.body.style.overflow = 'hidden';
};

window.closeImageModal = function() {
    const modal = document.getElementById('imageModal');
    if (!modal) return;

    isModalOpen = false;
    updateNavVisibility(); // Re-evaluate nav visibility

    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
};

// --- Carousel Logic ---
const carousels = {};

window.initCarousel = function(id) {
    if (!carousels[id]) {
        const element = document.getElementById(id);
        if (element) {
            carousels[id] = {
                currentSlide: 0,
                interval: null,
                element: element
            };
            showSlide(id, 0);
            startAutoSlide(id);
            element.addEventListener('mouseenter', () => stopAutoSlide(id));
            element.addEventListener('mouseleave', () => startAutoSlide(id));
        }
    }
};

function showSlide(id, index) {
    const carousel = carousels[id];
    if (!carousel || !carousel.element) return;

    const slides = carousel.element.querySelectorAll('.carousel-slide');
    const indicators = carousel.element.querySelectorAll('.carousel-indicator');

    if (index >= slides.length) {
        carousel.currentSlide = 0;
    } else if (index < 0) {
        carousel.currentSlide = slides.length - 1;
    } else {
        carousel.currentSlide = index;
    }

    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === carousel.currentSlide);
    });

    indicators.forEach((indicator, i) => {
        indicator.classList.toggle('active', i === carousel.currentSlide);
    });
}

window.changeSlide = function(id, direction, event) {
    if (event) event.stopPropagation();
    stopAutoSlide(id);
    if (carousels[id]) {
        showSlide(id, carousels[id].currentSlide + direction);
    }
    startAutoSlide(id);
};

window.goToSlide = function(id, index, event) {
    if (event) event.stopPropagation();
    stopAutoSlide(id);
    showSlide(id, index);
    startAutoSlide(id);
};

function startAutoSlide(id) {
    if (carousels[id]) {
        stopAutoSlide(id);
        carousels[id].interval = setInterval(() => {
            showSlide(id, carousels[id].currentSlide + 1);
        }, 4000);
    }
}

function stopAutoSlide(id) {
    if (carousels[id] && carousels[id].interval) {
        clearInterval(carousels[id].interval);
        carousels[id].interval = null;
    }
}

// --- Initializations ---
document.addEventListener('DOMContentLoaded', () => {
    // Nav Scroll initialization
    window.addEventListener('scroll', updateNavVisibility);
    updateNavVisibility();

    // Scrollspy initialization
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = ['hero-section', 'projects', 'skills', 'about', 'contact'];
    const sectionElements = sections.map(id => document.getElementById(id));

    const scrollspyObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.id;
                navLinks.forEach(link => {
                    link.classList.toggle('active', link.dataset.section === id);
                });
            }
        });
    }, {
        rootMargin: '-40% 0px -40% 0px',
        threshold: 0
    });

    sectionElements.forEach(el => {
        if (el) scrollspyObserver.observe(el);
    });

    // Carousels initialization
    const carouselIds = ['sis-carousel', 'cloud-sis-carousel', 'barber-carousel'];
    carouselIds.forEach(id => window.initCarousel(id));

    // Modal Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isModalOpen) {
            window.closeImageModal();
        }
    });
});
