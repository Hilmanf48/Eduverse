import './bootstrap';


import './custom-cursor.js';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

window.tippy = tippy;







document.addEventListener('DOMContentLoaded', function() {
    
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

    
    tippy('[data-tippy-content]', {
        placement: 'top',
        animation: 'shift-away',
        theme: 'light'
    });
});