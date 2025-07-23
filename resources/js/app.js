import './bootstrap';

import Alpine from 'alpinejs';
import './custom-cursor.js';

window.Alpine = Alpine;

Alpine.start();

// Tambahkan ini ke app.js Anda
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer untuk animasi scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.scroll-animate').forEach(el => {
        observer.observe(el);
    });

    // Tooltip untuk instructor avatars
    tippy('[data-tippy-content]', {
        placement: 'top',
        animation: 'shift-away',
        theme: 'light'
    });
});