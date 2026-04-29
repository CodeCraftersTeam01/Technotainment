import "./bootstrap";
import "./editor";

// Scroll Reveal Animation
document.addEventListener("DOMContentLoaded", () => {
    const observerOptions = {
        threshold: 0.05,
        rootMargin: "0px 0px 0px 0px"
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("active");
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const revealElements = document.querySelectorAll(".reveal");
    revealElements.forEach(el => {
        // Jika elemen sudah terlihat di viewport saat halaman dimuat (misal: hero section),
        // langsung aktifkan tanpa menunggu scroll
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            el.classList.add("active");
        } else {
            observer.observe(el);
        }
    });
});
