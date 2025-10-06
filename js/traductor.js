// Diccionario de traducción
const diccionario = {

  //INDEX.PHP
  "¿Quién eres?": { en: "Who are you?", es: "¿Quién eres?" },
  "Ingresa a tu perfil": { en: "Enter your profile", es: "Ingresa a tu perfil" },
  "Tema": { en: "Theme", es: "Tema" },
  "Claro": { en: "Light", es: "Claro" },
  "Oscuro": { en: "Dark", es: "Oscuro" },
  "Lenguaje": { en: "Language", es: "Lenguaje" },
  "Español": { en: "Spanish", es: "Español" },
  "Inglés": { en: "English", es: "Inglés" },
  "Adscripto": { en: "Assistant", es: "Adscripto" },
  "Estudiante": { en: "Student", es: "Estudiante" },
  "Docente": { en: "Teacher", es: "Docente" },
  "Acceso de Usuarios": { en: "User Access", es: "Acceso de Usuarios" },
  "C.I | Email": { en: "ID | Email", es: "C.I | Email" },
  "Contraseña": { en: "Password", es: "Contraseña" },
  "Cancelar": { en: "Cancel", es: "Cancelar" },
  "Ingresar": { en: "Login", es: "Ingresar" },
  "Selecciona una opción": { en: "Select an option", es: "Selecciona una opción" },
  "Elige una opción": { en: "Choose an option", es: "Elige una opción" },
  "Continuar": { en: "Continue", es: "Continuar" },
  // Opciones de select
  "1ºMC (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)": { en: "1st MC (INFORMATION TECHNOLOGIES - BIL)", es: "1ºMC (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)" },
  "1ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)": { en: "1st MD (INFORMATION TECHNOLOGIES - BIL)", es: "1ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)" },
  "2ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)": { en: "2nd MA (INFORMATION TECHNOLOGIES)", es: "2ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)" },
  "2ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)": { en: "2nd MB (INFORMATION TECHNOLOGIES)", es: "2ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)" },
  "2ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)": { en: "2nd MD (INFORMATION TECHNOLOGIES - BIL)", es: "2ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)" },
  "3ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)": { en: "3rd MA (INFORMATION TECHNOLOGIES)", es: "3ºMA (TECNOLOGÍAS DE LA INFORMACIÓN)" },
  "3ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)": { en: "3rd MB (INFORMATION TECHNOLOGIES)", es: "3ºMB (TECNOLOGÍAS DE LA INFORMACIÓN)" },
  "3ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)": { en: "3rd MD (INFORMATION TECHNOLOGIES - BIL)", es: "3ºMD (TECNOLOGÍAS DE LA INFORMACIÓN - BIL)" },
  "3ºBA (ROBOTICA Y TELECOMUNICACIONES)": { en: "3rd BA (ROBOTICS AND TELECOMMUNICATIONS)", es: "3ºBA (ROBOTICA Y TELECOMUNICACIONES)" },

  //ADCRIPTA.PHP

  "Sistema de Gestión OFA": "OFA Management System",
  "Panel exclusivo para Adscripta": "Exclusive Panel for Adscripta",
  "Docentes del Sistema": "System Teachers",
  "Desde aquí puedes gestionar a los docentes registrados en el sistema": "From here you can manage the registered teachers",
  "Registrar Docente": "Register Teacher",
  "Ver Docentes": "View Teachers",
  "Cancelar": "Cancel",
  "Guardar": "Save",
  "Gestión de Espacios": "Spaces Management",
  "Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos": "From here you can add new spaces to the system and assign resources",
  "➕ Agregar Espacio": "➕ Add Space",
  "Agregar Espacio": "Add Space",
  "Cerrar": "Close",
  "Tipo de Salón": "Room Type",
  "Seleccione un tipo": "Select a type",
  "Aula": "Classroom",
  "Laboratorio": "Laboratory",
  "Salón": "Room",
  "SUM": "Multipurpose Room",
  "Descripción o nombre del espacio": "Description or name of the space",
  "Selecciona los recursos que contiene:": "Select the resources it contains:",
  "Televisión": "TV",
  "Cable HDMI": "HDMI Cable",
  "Aire Acondicionado": "Air Conditioning",
  "Proyector": "Projector",
  "Alargue": "Extension Cord"
};

// Función para aplicar idioma
function aplicarIdioma(lang) {
  document.querySelectorAll('[data-traducible]').forEach(elem => {
    const textoOriginal = elem.dataset.traducible;
    if (diccionario[textoOriginal]) {
      if (elem.tagName === 'SELECT') {
        for (let i = 0; i < elem.options.length; i++) {
          const option = elem.options[i];
          const key = option.dataset.traducible;
          if (diccionario[key]) option.text = diccionario[key][lang];
        }
      } else {
        elem.innerText = diccionario[textoOriginal][lang];
      }
    }
  });
}

// Guardar idioma
function setIdioma(lang) {
  localStorage.setItem('idioma', lang);
  aplicarIdioma(lang);
}

// Inicialización
document.addEventListener('DOMContentLoaded', () => {
  const idiomaGuardado = localStorage.getItem('idioma') || 'es';
  aplicarIdioma(idiomaGuardado);

  document.getElementById('lenguaje-es').addEventListener('click', () => setIdioma('es'));
  document.getElementById('lenguaje-en').addEventListener('click', () => setIdioma('en'));

  // Traducir modales al abrir
  document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('shown.bs.modal', () => {
      const idioma = localStorage.getItem('idioma') || 'es';
      aplicarIdioma(idioma);
    });
  });
});
