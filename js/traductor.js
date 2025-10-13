const diccionario = {
// General / Header
"¿Quién eres?": { en: "Who are you?", es: "¿Quién eres?" },
"Ingresa a tu perfil": { en: "Enter your profile", es: "Ingresa a tu perfil" },
"Tema": { en: "Theme", es: "Tema" },
"Claro": { en: "Light", es: "Claro" },
"Oscuro": { en: "Dark", es: "Oscuro" },
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

// Adscripta.php y Docentes.php
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
"Grupos": { en:"Groups", es: "Grupos" },
"Docentes": { en:"Teachers", es: "Docentes" },
"Espacios": { en:"Spaces", es: "Espacios" },
"Horarios": { en:"Schedules", es: "Horarios" },
"General": { en:"General", es:"General" },
"Cuenta": { en:"Account", es: "Cuenta" },
"Salir": { en:"Log out", es: "Salir" },
"Reservas": { en:"Reservations", es: "Reservas" },
"Cursos": { en:"Courses", es: "Cursos" },
"Agregar Grupo": { en:"Add Groups", es: "Agregar Grupo" },
"Agregar Asignatura": {en:"Add Subject", es: "Agregar Asignatura"},
"Agregar Curso":{en: "Add Courses", es:"Agregar Cursos"},
"Ver Cursos":{en: "See Courses", es:"Ver Cursos"},
"Ver Cursos":{en: "See Courses", es:"Ver Cursos"},
"Desde aquí puedes agregar nuevos cursos al sistema":{en:"From here you can add new courses to the system", es:"Desde aquí puedes agregar nuevos cursos al sistema"},
"Gestión de Grupos": {en:"Group Management", es:"Gestión de Grupos"},
"Desde aquí puedes agregar nuevos grupos al sistema": {en:"From here you can add new groups to the system", es:"Desde aquí puedes agregar nuevos grupos al sistema"},
"Ver Grupos":{en:"See Groups", es:"Ver Grupos"},
"Asignaturas":{en:"Subjects", es:"Asignaturas"},
"Desde aquí puedes gestionar las asignaturas registradas en el sistema":{en:"From here you can manage the subjects registered in the system", es:"Desde aquí puedes gestionar las asignaturas registradas en el sistema"},

// Gestión de Horarios 
"Gestión de Horarios por Grupo": { en: "Schedule Management by Group", es: "Gestión de Horarios por Grupo" },
"Seleccionar grupo:": { en: "Select group:", es: "Seleccionar grupo:" },
"-- Seleccionar grupo --": { en: "-- Select group --", es: "-- Seleccionar grupo --" },
"Hora": { en: "Time", es: "Hora" },
"Lunes": { en: "Monday", es: "Lunes" },
"Martes": { en: "Tuesday", es: "Martes" },
"Miércoles": { en: "Wednesday", es: "Miércoles" },
"Jueves": { en: "Thursday", es: "Jueves" },
"Viernes": { en: "Friday", es: "Viernes" },
"-- Vacío --": { en: "-- Empty --", es: "-- Vacío --" },
"Guardar Cambios": { en: "Save Changes", es: "Guardar Cambios" },

// --- Nombres de Horarios 
"1era": { en: "1st Hour", es: "1era" },
"2da": { en: "2nd Hour", es: "2da" },
"3era": { en: "3rd Hour", es: "3era" },
"4ta": { en: "4th Hour", es: "4ta" },
"5ta": { en: "5th Hour", es: "5ta" },
"6ta": { en: "6th Hour", es: "6ta" },
"7ma": { en: "7th Hour", es: "7ma" },
"8va": { en: "8th Hour", es: "8va" },
"9na": { en: "9th Hour", es: "9na" },
"10ma": { en: "10th Hour", es: "10ma" },
"11va": { en: "11th Hour", es: "11va" },


// Sección Hero - Gestión de Espacios
"Gestión de Espacios": { en: "Space Management", es: "Gestión de Espacios" },
"Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos": { en: "From here you can add new spaces to the system and assign them resources", es: "Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos" },
"Agregar Espacio": { en: "Add Space", es: "Agregar Espacio" },

// Modal Agregar Espacio
"Tipo de Salón": { en: "Room Type", es: "Tipo de Salón" },
"Seleccione un tipo": { en: "Select a type", es: "Seleccione un tipo" },
"Aula": { en: "Classroom", es: "Aula" },
"Laboratorio": { en: "Laboratory", es: "Laboratorio" },
"Salón": { en: "Hall", es: "Salón" },
"SUM": { en: "Multipurpose Room", es: "SUM" },
"Nº de Espacio": { en: "Room Number", es: "Nº de Espacio" },
"Ej: 2": { en: "Ex: 2", es: "Ej: 2" },
"Selecciona los recursos que contiene:": { en: "Select the resources it contains:", es: "Selecciona los recursos que contiene:" },
"Televisión": { en: "Television", es: "Televisión" },
"Cable HDMI": { en: "HDMI Cable", es: "Cable HDMI" },
"Aire Acondicionado": { en: "Air Conditioner", es: "Aire Acondicionado" },
"Proyector": { en: "Projector", es: "Proyector" },
"Alargue": { en: "Extension Cord", es: "Alargue" },
"Cancelar": { en: "Cancel", es: "Cancelar" },
"Guardar": { en: "Save", es: "Guardar" },

// Sección Reservas
"Reservas Realizadas por los Docentes": { en: "Reservations Made by Teachers", es: "Reservas Realizadas por los Docentes" },
"Reservas de los Docentes": { en: "Teachers' Reservations", es: "Reservas de los Docentes" },
"Pendiente": { en: "Pending", es: "Pendiente" },
"Aprobada": { en: "Approved", es: "Aprobada" },
"No aprobada": { en: "Not Approved", es: "No aprobada" },
"Salón:": { en: "Room:", es: "Salón:" },
"Fecha:": { en: "Date:", es: "Fecha:" },
"Horario:": { en: "Schedule:", es: "Horario:" },
"Aprobar": { en: "Approve", es: "Aprobar" },
"No aprobar": { en: "Reject", es: "No aprobar" },
"ID Reserva:": { en: "Reservation ID:", es: "ID Reserva:" },
"No hay reservas registradas aún.": { en: "No reservations registered yet.", es: "No hay reservas registradas aún." },


//Modal agregar cursos
"Agregar Curso": { en: "Add Course", es: "Agregar Curso" },
"Nombre del Curso": { en: "Course Name", es: "Nombre del Curso" },
"Descripción": { en: "Description", es: "Descripción" },
"Duración en años": { en: "Duration in years", es: "Duración en años" },
"Ej: Técnico en Informática": { en: "Ex: Computer Technician", es: "Ej: Técnico en Informática" },
"Descripción del curso": { en: "Course description", es: "Descripción del curso" },
"Ej: 3": { en: "Ex: 3", es: "Ej: 3" },
"Cancelar": { en: "Cancel", es: "Cancelar" },
"Guardar": { en: "Save", es: "Guardar" },

//Modal agregar grupos

"Agregar Grupo": { en: "Add Group", es: "Agregar Grupo" },
"Nombre del Grupo": { en: "Group Name", es: "Nombre del Grupo" },
"Año del Curso": { en: "Course Year", es: "Año del Curso" },
"Curso": { en: "Course", es: "Curso" },
"Turno": { en: "Shift", es: "Turno" },
"Seleccionar curso...": { en: "Select course...", es: "Seleccionar curso..." },
"Seleccionar turno...": { en: "Select shift...", es: "Seleccionar turno..." },
"Ej: 1A": { en: "Ex: 1A", es: "Ej: 1A" },
"Ej: 1": { en: "Ex: 1", es: "Ej: 1" },
"Cancelar": { en: "Cancel", es: "Cancelar" },
"Guardar": { en: "Save", es: "Guardar" },
"Matutino": { en: "Morning", es: "Matutino" },
"Vespertino": { en: "Afternoon", es: "Vespertino" },
"Nocturno": { en: "Night", es: "Nocturno" },


//Modal agregar adignaturas
"Agregar Asignatura": { en: "Add Subject", es: "Agregar Asignatura" },
"Nombre de la Asignatura": { en: "Subject Name", es: "Nombre de la Asignatura" },
"Docente": { en: "Teacher", es: "Docente" },
"Seleccionar docente...": { en: "Select teacher...", es: "Seleccionar docente..." },
"Grupo": { en: "Group", es: "Grupo" },
"Seleccionar grupo...": { en: "Select group...", es: "Seleccionar grupo..." },
"Ej: Matemática": { en: "Ex: Math", es: "Ej: Matemática" },
"Cancelar": { en: "Cancel", es: "Cancelar" },
"Guardar": { en: "Save", es: "Guardar" },


//docente.php
"Sistema de Gestión": { en: "Management System", es: "Sistema de Gestión" },
"Panel exclusivo para Docentes": { en: "Exclusive Panel for Teachers", es: "Panel exclusivo para Docentes" },
"Sistema de Reservas": { en: "Reservation System", es: "Sistema de Reservas" },
"Desde aquí podés solicitar espacios": { en: "From here you can request spaces", es: "Desde aquí podés solicitar espacios" },
"Realizar Reserva": { en: "Make Reservation", es: "Realizar Reserva" },
"Seleccione un salón": { en: "Select a room", es: "Seleccione un salón" },
"Fecha": { en: "Date", es: "Fecha" },
"Horario": { en: "Schedule", es: "Horario" },
"Cancelar": { en: "Cancel", es: "Cancelar" },
"Reservar": { en: "Reserve", es: "Reservar" },
"Mis Reservas": { en: "My Reservations", es: "Mis Reservas" },
"Salón": { en: "Room", es: "Salón" },
"Tipo": { en: "Type", es: "Tipo" },
"Docente": { en: "Teacher", es: "Docente" },
"Estado": { en: "Status", es: "Estado" },


// Modal Realizar Reserva
"Realizar Reserva": { en: "Make Reservation", es: "Realizar Reserva" },
"Selecciona un Espacio": { en: "Select a Space", es: "Selecciona un Espacio" },
"Seleccione un salón": { en: "Select a room", es: "Seleccione un salón" },
"Fecha": { en: "Date", es: "Fecha" },
"Horario": { en: "Schedule", es: "Horario" },
"Seleccione un horario": { en: "Select a schedule", es: "Seleccione un horario" },
"Cancelar": { en: "Cancel", es: "Cancelar" },
"Reservar": { en: "Reserve", es: "Reservar" },

//Headers
"Lenguaje": { en: "Language", es: "Lenguaje" },
"Español": { en: "Spanish", es: "Español" },
"Inglés": { en: "English", es: "Inglés" },

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
