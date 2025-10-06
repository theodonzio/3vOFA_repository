// Diccionario de traducción
const diccionario = {
  // General / Header
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

  // Login / Formularios
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

  // Adscripta.php
  "Sistema de Gestión OFA": { en: "OFA Management System", es: "Sistema de Gestión OFA" },
  "Panel exclusivo para Adscripta": { en: "Exclusive panel for Assistant", es: "Panel exclusivo para Adscripta" },
  "Docentes del Sistema": { en: "System Teachers", es: "Docentes del Sistema" },
  "Desde aquí puedes gestionar a los docentes registrados en el sistema": { en: "From here you can manage the teachers registered in the system", es: "Desde aquí puedes gestionar a los docentes registrados en el sistema" },
  "Registrar Docente": { en: "Register Teacher", es: "Registrar Docente" },
  "Ver Docentes": { en: "View Teachers", es: "Ver Docentes" },
  "Nombre": { en: "First Name", es: "Nombre" },
  "Apellido": { en: "Last Name", es: "Apellido" },
  "Cédula": { en: "ID Number", es: "Cédula" },
  "Email": { en: "Email", es: "Email" },
  "Contraseña": { en: "Password", es: "Contraseña" },
  "Guardar": { en: "Save", es: "Guardar" },
  "Gestión de Espacios": { en: "Spaces Management", es: "Gestión de Espacios" },
  "Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos": { en: "From here you can add new spaces to the system and assign resources", es: "Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos" },
  "➕ Agregar Espacio": { en: "➕ Add Space", es: "➕ Agregar Espacio" },
  "Agregar Espacio": { en: "Add Space", es: "Agregar Espacio" },
  "Tipo de Salón": { en: "Room Type", es: "Tipo de Salón" },
  "Seleccione un tipo": { en: "Select a type", es: "Seleccione un tipo" },
  "Aula": { en: "Classroom", es: "Aula" },
  "Laboratorio": { en: "Laboratory", es: "Laboratorio" },
  "Salón": { en: "Room", es: "Salón" },
  "SUM": { en: "Multipurpose Room", es: "SUM" },
  "Descripción o nombre del espacio": { en: "Description or name of the space", es: "Descripción o nombre del espacio" },
  "Selecciona los recursos que contiene:": { en: "Select the resources it contains:", es: "Selecciona los recursos que contiene:" },
  "Televisión": { en: "TV", es: "Televisión" },
  "Cable HDMI": { en: "HDMI Cable", es: "Cable HDMI" },
  "Aire Acondicionado": { en: "Air Conditioner", es: "Aire Acondicionado" },
  "Proyector": { en: "Projector", es: "Proyector" },
  "Alargue": { en: "Extension Cord", es: "Alargue" },
  "Reservas Realizadas por los Docentes": { en: "Reservations Made by Teachers", es: "Reservas Realizadas por los Docentes" },
  "Salón:": { en: "Room:", es: "Salón:" },
  "Fecha:": { en: "Date:", es: "Fecha:" },
  "Horario:": { en: "Schedule:", es: "Horario:" },
  "Estado:": { en: "Status:", es: "Estado:" },
  "Aprobar": { en: "Approve", es: "Aprobar" },
  "No aprobar": { en: "Reject", es: "No aprobar" },
  "Pendiente": { en: "Pending", es: "Pendiente" },
  "No hay reservas registradas aún.": { en: "No reservations registered yet.", es: "No hay reservas registradas aún." }
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

  document.getElementById('lenguaje-es')?.addEventListener('click', () => setIdioma('es'));
  document.getElementById('lenguaje-en')?.addEventListener('click', () => setIdioma('en'));

  document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('shown.bs.modal', () => {
      const idioma = localStorage.getItem('idioma') || 'es';
      aplicarIdioma(idioma);
    });
  });
});
