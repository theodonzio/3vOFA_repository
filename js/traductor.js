// ===========================
// traductor.js
// ===========================

function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'es',
    includedLanguages: 'en,es',
    autoDisplay: false
  }, 'google_translate_element');
}

// Crear div oculto para el traductor
const div = document.createElement('div');
div.id = 'google_translate_element';
div.style.display = 'none';
document.body.appendChild(div);

// Insertar el script de Google Translate
const script = document.createElement('script');
script.src = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
document.body.appendChild(script);

// ===========================
// Función para aplicar idioma
// ===========================
function aplicarIdioma(lang) {
  const interval = setInterval(() => {
    const iframe = document.querySelector('iframe.goog-te-menu-frame');
    if (!iframe) return; // Esperar a que exista

    const doc = iframe.contentDocument || iframe.contentWindow.document;
    const botones = doc.querySelectorAll('.goog-te-menu2-item span.text');

    botones.forEach(boton => {
      if (lang === 'es' && boton.innerText.toLowerCase().includes('español')) boton.click();
      if (lang === 'en' && boton.innerText.toLowerCase().includes('english')) boton.click();
    });

    clearInterval(interval); // Terminar el ciclo cuando se aplica
  }, 500);
}

// ===========================
// Listeners de botones y aplicar idioma guardado
// ===========================
document.addEventListener('DOMContentLoaded', () => {
  // Aplicar idioma guardado
  const idiomaGuardado = localStorage.getItem('idioma');
  if (idiomaGuardado) aplicarIdioma(idiomaGuardado);

  // Click en botones del dropdown
  document.getElementById('lenguaje-es').addEventListener('click', () => {
    localStorage.setItem('idioma', 'es');
    aplicarIdioma('es');
  });

  document.getElementById('lenguaje-en').addEventListener('click', () => {
    localStorage.setItem('idioma', 'en');
    aplicarIdioma('en');
  });
});
