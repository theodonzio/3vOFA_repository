// scroll-top.js
// Funcionalidad del botón para volver arriba

document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('scrollTopBtn');
    
    if (!btn) return;

    // Mostrar/ocultar botón según scroll
    window.addEventListener('scroll', () => {
        if (window.scrollY > 500) {
            btn.style.opacity = '1';
            btn.style.transform = 'translateY(0)';
        } else {
            btn.style.opacity = '0';
            btn.style.transform = 'translateY(20px)';
        }
    });

    // Scroll suave al hacer clic
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});