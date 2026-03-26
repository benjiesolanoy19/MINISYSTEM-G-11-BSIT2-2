import './bootstrap';
import Alpine from 'alpine';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

// Expose GSAP and Alpine to window
window.gsap = gsap;
window.Alpine = Alpine;

// Initialize Alpine
Alpine.start();

// Global animation utilities
window.animateElement = (element, animation) => {
    gsap.to(element, animation);
};

window.animateElementFrom = (element, animation, delay = 0) => {
    gsap.fromTo(element, { opacity: 0, y: 20 }, { 
        ...animation,
        opacity: 1,
        y: 0,
        delay,
        duration: 0.6,
        ease: 'power2.out'
    });
};

// Scroll animations for elements with data-scroll attribute
document.addEventListener('DOMContentLoaded', () => {
    gsap.utils.toArray('[data-scroll]').forEach((element) => {
        gsap.to(element, {
            scrollTrigger: {
                trigger: element,
                start: 'top 80%',
                toggleActions: 'play none none none',
            },
            opacity: 1,
            y: 0,
            duration: 0.8,
        });
    });
});

export default Alpine;
