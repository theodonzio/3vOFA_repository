const diccionario = {
  "Sistema de Gestión OFA": { en: "OFA Management System", es: "Sistema de Gestión OFA" },
  "Panel exclusivo para Adscripta": { en: "Exclusive Panel for Adscripta", es: "Panel exclusivo para Adscripta" },
  "Docentes del Sistema": { en: "System Teachers", es: "Docentes del Sistema" },
  "Desde aquí puedes gestionar a los docentes registrados en el sistema": { en: "From here you can manage the teachers registered in the system", es: "Desde aquí puedes gestionar a los docentes registrados en el sistema" },
  "Registrar Docente": { en: "Register Teacher", es: "Registrar Docente" },
  "Ver Docentes": { en: "View Teachers", es: "Ver Docentes" },
  "Nombre": { en: "Name", es: "Nombre" },
  "Apellido": { en: "Last Name", es: "Apellido" },
  "Cédula": { en: "ID", es: "Cédula" },
  "Email": { en: "Email", es: "Email" },
  "Contraseña": { en: "Password", es: "Contraseña" },
  "Cancelar": { en: "Cancel", es: "Cancelar" },
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
  "SUM": { en: "SUM", es: "SUM" },
  "Descripción o nombre del espacio": { en: "Description or room name", es: "Descripción o nombre del espacio" },
  "Selecciona los recursos que contiene:": { en: "Select the resources it contains:", es: "Selecciona los recursos que contiene:" },
  "Televisión": { en: "Television", es: "Televisión" },
  "Cable HDMI": { en: "HDMI Cable", es: "Cable HDMI" },
  "Aire Acondicionado": { en: "Air Conditioning", es: "Aire Acondicionado" },
  "Proyector": { en: "Projector", es: "Proyector" },
  "Alargue": { en: "Extension Cord", es: "Alargue" },
  "Reservas Realizadas por los Docentes": { en: "Reservations Made by Teachers", es: "Reservas Realizadas por los Docentes" },
  "Salón:": { en: "Room:", es: "Salón:" },
  "Fecha:": { en: "Date:", es: "Fecha:" },
  "Horario:": { en: "Schedule:", es: "Horario:" },
  "Pendiente": { en: "Pending", es: "Pendiente" },
  "Aprobada": { en: "Approved", es: "Aprobada" },
  "No aprobada": { en: "Not Approved", es: "No aprobada" },
  "Aprobar": { en: "Approve", es: "Aprobar" },
  "No aprobar": { en: "Do not approve", es: "No aprobar" },
  "No hay reservas registradas aún.": { en: "No reservations registered yet.", es: "No hay reservas registradas aún." },
  "Tema": { en: "Theme", es: "Tema" },
  "Claro": { en: "Light", es: "Claro" },
  "Oscuro": { en: "Dark", es: "Oscuro" },
  "Lenguaje": { en: "Language", es: "Lenguaje" },
  "Español": { en: "Spanish", es: "Español" },
  "Inglés": { en: "English", es: "Inglés" },
  "Grupos": {en:"Groups", es: "Grupos"},
  "Docentes": {en:"Teachers", es: "Docentes"},
  "Espacios": {en:"Spaces", es: "Espacios"},
  "Horarios": {en:"Schedules", es: "Horarios"},
  "General": {en:"General", es:"General"},
  "Cuenta": {en:"Account", es: "Cuenta"},
  "Salir": {en:"Log out", es: "Salir"}
};

// Función para traducir todos los elementos con data-traducible
function traducir(idioma) {
  document.querySelectorAll('[data-traducible]').forEach(el => {
    const textoOriginal = el.getAttribute('data-traducible');
    if (diccionario[textoOriginal] && diccionario[textoOriginal][idioma]) {
      if(el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
        el.placeholder = diccionario[textoOriginal][idioma];
      } else {
        el.innerText = diccionario[textoOriginal][idioma];
      }
    }
  });
  localStorage.setItem('idioma', idioma);
}

// Cargar idioma guardado al iniciar
document.addEventListener("DOMContentLoaded", () => {
  const idiomaGuardado = localStorage.getItem("idioma") || "es";
  traducir(idiomaGuardado);

  // Dropdown de cambio de idioma
  document.getElementById("lenguaje-es").addEventListener("click", () => traducir("es"));
  document.getElementById("lenguaje-en").addEventListener("click", () => traducir("en"));
});
