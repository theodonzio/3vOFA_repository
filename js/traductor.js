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
"Ingresar": { en: "Login", es: "Ingresar" },
"Selecciona una opción": { en: "Select an option", es: "Selecciona una opción" },
"Elige una opción": { en: "Choose an option", es: "Elige una opción" },
"Continuar": { en: "Continue", es: "Continuar" },
"Personal": { en: "Staff", es: "Personal" },
"C.I - Email": { en: "ID - Email", es: "C.I - Email" },
"-- Seleccionar grupo --": { en: "-- Select group --", es: "-- Seleccionar grupo --" },
"No hay grupos disponibles": { en: "No groups available", es: "No hay grupos disponibles" },
"Selecciona tu grupo": { en: "Select your group", es: "Selecciona tu grupo" },
"Elige tu grupo": { en: "Choose your group", es: "Elige tu grupo" },
"Cancelar": { en: "Cancel", es: "Cancelar" },

// Adscripta.php y Docentes.php
"Sistema de Gestión OFA": { en: "OFA Management System", es: "Sistema de Gestión OFA" },
"Panel exclusivo para Adscripta": { en: "Exclusive Panel for Adscripta", es: "Panel exclusivo para Adscripta" },
"Docentes del Sistema": { en: "System Teachers", es: "Docentes del Sistema" },
"Desde aquí puedes gestionar a los docentes registrados en el sistema": { en: "From here you can manage the teachers registered in the system", es: "Desde aquí puedes gestionar a los docentes registrados en el sistema" },
"Registrar Docente": { en: "Register Teacher", es: "Registrar Docente" },
"Ver Docentes": { en: "View Teachers", es: "Ver Docentes" },
"Nombre": { en: "Name", es: "Nombre" },
"Apellido": { en: "Last Name", es: "Apellido" },
"Cédula": { en: "ID/C.I", es: "Cédula" },
"Email": { en: "Email", es: "Email" },
"Gestión de Espacios": { en: "Space Management", es: "Gestión de Espacios" },
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
"Recursos solicitados:": { en: "Resources requested:", es: "Recursos solicitados:" },
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
"Agregar Grupo": { en:"Add Group", es: "Agregar Grupo" },
"Agregar Asignatura": {en:"Add Subject", es: "Agregar Asignatura"},
"Agregar Curso":{en: "Add Course", es:"Agregar Curso"},
"Ver Cursos":{en: "See Courses", es:"Ver Cursos"},
"Desde aquí puedes agregar nuevos cursos al sistema":{en:"From here you can add new courses to the system", es:"Desde aquí puedes agregar nuevos cursos al sistema"},
"Gestión de Grupos": {en:"Group Management", es:"Gestión de Grupos"},
"Desde aquí puedes agregar nuevos grupos al sistema": {en:"From here you can add new groups to the system", es:"Desde aquí puedes agregar nuevos grupos al sistema"},
"Ver Grupos":{en:"See Groups", es:"Ver Grupos"},
"Asignaturas":{en:"Subjects", es:"Asignaturas"},
"Desde aquí puedes gestionar las asignaturas registradas en el sistema":{en:"From here you can manage the subjects registered in the system", es:"Desde aquí puedes gestionar las asignaturas registradas en el sistema"},
"Seleccioná un grupo para asignarle horarios y materias":{en:"Select a group to assign schedules and subjects", es:"Seleccioná un grupo para asignarle horarios y materias"},
"Seleccioná un grupo para comenzar":{en:"Select a group to start", es:"Seleccioná un grupo para comenzar"},
"8 dígitos sin puntos ni guiones":{en:"8 digits without periods or hyphens", es:"8 dígitos sin puntos ni guiones"},
"Mínimo 6 caracteres, al menos una letra y un número":{en:"Minimum 6 characters, at least one letter and one number", es:"Mínimo 6 caracteres, al menos una letra y un número"},
"Guardar cambios":{en:"Save Changes", es:"Guardar Cambios"},
"Editar Docente #":{en:"Edit Teacher", es:"Editar Docente"},
"Desde aquí puedes agregar, visualizar y administrar los horarios del sistema":{en: "From here you can add, view, and manage the system schedules.", es:"Desde aquí puedes agregar, visualizar y administrar los horarios del sistema"},
"Agregar Horario":{en: "Add Schedule",es: "Agregar Horario"},

// Gestión de Horarios 
"Horarios disponibles":{en:"Available times", es:"Horarios disponibles"},
"Gestión de Horarios por Grupo": { en: "Schedule Management by Group", es: "Gestión de Horarios por Grupo" },
"Seleccionar grupo:": { en: "Select group:", es: "Seleccionar grupo:" },
"Hora": { en: "Time", es: "Hora" },
"Lunes": { en: "Monday", es: "Lunes" },
"Martes": { en: "Tuesday", es: "Martes" },
"Miércoles": { en: "Wednesday", es: "Miércoles" },
"Jueves": { en: "Thursday", es: "Jueves" },
"Viernes": { en: "Friday", es: "Viernes" },
"Guardar Cambios": { en: "Save Changes", es: "Guardar Cambios" },

// Modal Agregar Espacio
"Nº de Espacio": { en: "Room Number", es: "Nº de Espacio" },
"Ej: 2": { en: "Ex: 2", es: "Ej: 2" },

// Sección Reservas
"Reservas de los Docentes": { en: "Teacher's Reservations", es: "Reservas de los Docentes" },
"ID Reserva:": { en: "Reservation ID:", es: "ID Reserva:" },
"Rechazar": { en: "Reject", es: "Rechazar" },
"PENDIENTE": { en: "PENDING", es: "PENDIENTE" },
"APROBADA": { en: "APPROVED", es: "APROBADA" },
"NO APROBADA": { en: "NOT APPROVED", es: "NO APROBADA" },

// Modal agregar cursos
"Nombre del Curso": { en: "Course Name", es: "Nombre del Curso" },
"Descripción": { en: "Description", es: "Descripción" },
"Duración en años": { en: "Duration in years", es: "Duración en años" },
"Ej: Técnico en Informática": { en: "Ex: Computer Technician", es: "Ej: Técnico en Informática" },
"Descripción del curso": { en: "Course description", es: "Descripción del curso" },
"Ej: 3": { en: "Ex: 3", es: "Ej: 3" },

// Modal agregar grupos
"Nombre del Grupo": { en: "Group Name", es: "Nombre del Grupo" },
"Año del Curso": { en: "Course Year", es: "Año del Curso" },
"Curso": { en: "Course", es: "Curso" },
"Turno": { en: "Shift", es: "Turno" },
"Seleccionar curso...": { en: "Select course...", es: "Seleccionar curso..." },
"Seleccionar turno...": { en: "Select shift...", es: "Seleccionar turno..." },
"Ej: 1A": { en: "Ex: 1A", es: "Ej: 1A" },
"Ej: 1": { en: "Ex: 1", es: "Ej: 1" },
"Matutino": { en: "Morning", es: "Matutino" },
"Vespertino": { en: "Afternoon", es: "Vespertino" },
"Nocturno": { en: "Night", es: "Nocturno" },

// Modal agregar asignaturas y asignatuas.php
"Nombre de la Asignatura": { en: "Subject Name", es: "Nombre de la Asignatura" },
"Seleccionar docente...": { en: "Select teacher...", es: "Seleccionar docente..." },
"Grupo": { en: "Group", es: "Grupo" },
"Seleccionar grupo...": { en: "Select group...", es: "Seleccionar grupo..." },
"Ej: Matemática": { en: "Ex: Math", es: "Ej: Matemática" },
"Guardar": { en: "Save", es: "Guardar" },
"Visualiza todas las asignaturas registradas en el sistema": {en: "View all subjects registered in the system", es:"Visualiza todas las asignaturas registradas en el sistema"},

// docente.php
"Sistema de Gestión": { en: "Management System", es: "Sistema de Gestión" },
"Panel exclusivo para Docentes": { en: "Exclusive Panel for Teachers", es: "Panel exclusivo para Docentes" },
"Sistema de Reservas": { en: "Reservation System", es: "Sistema de Reservas" },
"Desde aquí podés solicitar espacios": { en: "From here you can request spaces", es: "Desde aquí podés solicitar espacios" },
"Realizar Reserva": { en: "Make Reservation", es: "Realizar Reserva" },
"Seleccione un salón": { en: "Select a room", es: "Seleccione un salón" },
"Fecha": { en: "Date", es: "Fecha" },
"Horario": { en: "Schedule", es: "Horario" },
"Mis Reservas": { en: "My Reservations", es: "Mis Reservas" },
"Tipo": { en: "Type", es: "Tipo" },
"Estado": { en: "Status", es: "Estado" },

// Modal Realizar Reserva
"Selecciona un Espacio": { en: "Select a Space", es: "Selecciona un Espacio" },
"Seleccione un horario": { en: "Select a schedule", es: "Seleccione un horario" },
"Reservar": { en: "Reserve", es: "Reservar" },

// CURSOS.PHP
"Lista de Cursos Registrados": { en: "List of Registered Courses", es: "Lista de Cursos Registrados" },
"Aquí puedes ver los cursos del sistema": { en: "Here you can see the system courses", es: "Aquí puedes ver los cursos del sistema" },
"Volver al Panel": { en: "Return to Panel", es: "Volver al Panel" },
"ID": { en: "ID", es: "ID" },
"Duración (Años)": { en: "Duration (Years)", es: "Duración (Años)" },
"No hay cursos registrados": { en: "No courses registered", es: "No hay cursos registrados"},

// DOCENTES.PHP
"No hay docentes registrados": { en: "There are no registered teachers", es: "No hay docentes registrados"},
"Lista de Docentes Registrados": { en: "List of Registered Teachers", es: "Lista de Docentes Registrados" },
"Aquí puedes ver y gestionar a los docentes registrados en el sistema": { en: "Here you can view and manage the teachers registered in the system", es: "Aquí puedes ver y gestionar a los docentes registrados en el sistema" },

// GRUPOS.PHP
"Lista de Grupos Registrados": { en: "Registered Groups List", es: "Lista de Grupos Registrados" },
"Aquí puedes ver y gestionar los grupos del sistema": { en: "Here you can view and manage the system groups", es: "Aquí puedes ver y gestionar los grupos del sistema" },

// Headers
"Lenguaje": { en: "Language", es: "Lenguaje" },
"Español": { en: "Spanish", es: "Español" },
"Inglés": { en: "English", es: "Inglés" },

// Estudiante - Docentes
"Mis Docentes": { en: "My Teachers", es: "Mis Docentes" },
"Conoce a los profesores de tu grupo": { en: "Meet your group's teachers", es: "Conoce a los profesores de tu grupo" },
"Materias que imparte": { en: "Subjects taught", es: "Materias que imparte" },
"No hay docentes asignados": { en: "No teachers assigned", es: "No hay docentes asignados" },
"Aún no se han asignado docentes a tu grupo.": { en: "No teachers have been assigned to your group yet.", es: "Aún no se han asignado docentes a tu grupo." },
"Volver a mi horario": { en: "Back to my schedule", es: "Volver a mi horario" },

// Footer
"2025 OneForAll. Todos los derechos reservados.":{en: "© 2025 OneForAll. All rights reserved.", es: "© 2025 OneForAll. Todos los derechos reservados."},

//estudiantes.php
"Cargando...": { en: "Loading...", es: "Cargando..." },
"Aquí verás tu horario académico": { en: "Here you will see your academic schedule", es: "Aquí verás tu horario académico" },
"Reloj": { en: "Clock", es: "Reloj" },
"Selecciona un grupo para ver tu horario": { en: "Select a group to see your schedule", es: "Selecciona un grupo para ver tu horario" },
"Evento del calendario": { en: "Calendar Event", es: "Evento del calendario" },

// Recursos
"Recursos": { en: "Resources", es: "Recursos" },
"Desde aquí puedes agregar nuevos Recursos al sistema": { en: "From here you can add new resources to the system", es: "Desde aquí puedes agregar nuevos Recursos al sistema" },
"Agregar Recurso": { en: "Add Resource", es: "Agregar Recurso" },
"Ver Recursos": { en: "View Resources", es: "Ver Recursos" },
"Agregar Nuevo Recurso": { en: "Add New Resource", es: "Agregar Nuevo Recurso" },
"Los recursos se asignarán a espacios al crear o editar un espacio": { en: "Resources will be assigned to spaces when creating or editing a space", es: "Los recursos se asignarán a espacios al crear o editar un espacio" },
"Nombre del Recurso": { en: "Resource Name", es: "Nombre del Recurso" },
"Ej: Proyector": { en: "Ex: Projector", es: "Ej: Proyector" },
"Tipo": { en: "Type", es: "Tipo" },
"Ej: Audiovisual": { en: "Ex: Audiovisual", es: "Ej: Audiovisual" },
"Nombre descriptivo del recurso": { en: "Descriptive name of the resource", es: "Nombre descriptivo del recurso" },
"Categoría del recurso (Audiovisual, Informático, Climatización, etc.)": { en: "Resource category (Audiovisual, Computer, Air Conditioning, etc.)", es: "Categoría del recurso (Audiovisual, Informático, Climatización, etc.)" },

"Ver Asignaturas": { en: "View Subjects", es: "Ver Asignaturas" },

// Reservas Docente
"Recursos disponibles": { en: "Available resources", es: "Recursos disponibles" },
"Confirmar Reserva": { en: "Confirm Reservation", es: "Confirmar Reserva" },

"Gestión de Horarios": { en: "Schedule Management", es: "Gestión de Horarios" },
"Limpiar Todo": { en: "Clean all", es: "Limpiar Todo" },

// Modal Agregar Curso 
"Seleccionar Horarios del Curso": { en: "Select Course Schedules", es: "Seleccionar Horarios del Curso" },
"Seleccionar todos": { en: "Select all", es: "Seleccionar todos" },
"Deseleccionar todos": { en: "Deselect all", es: "Deseleccionar todos" },
"Eliminar seleccionados": { en: "Delete selected", es: "Eliminar seleccionados" },
"Marcá los horarios en los que se dictará este curso": { en: "Check the schedules in which this course will be taught", es: "Marcá los horarios en los que se dictará este curso" },
"No hay horarios disponibles. Por favor, crea horarios primero.": { en: "No schedules available. Please create schedules first.", es: "No hay horarios disponibles. Por favor, crea horarios primero." },
"Guardar Curso": { en: "Save Course", es: "Guardar Curso" },

// Modal Agregar Grupo 
"Ejemplo: 1A, 2B, 3MD": { en: "Example: 1A, 2B, 3MD", es: "Ejemplo: 1A, 2B, 3MD" },

// Modal Agregar Espacio 
"No hay recursos disponibles. Por favor, agregue recursos primero.": { en: "No resources available. Please add resources first.", es: "No hay recursos disponibles. Por favor, agregue recursos primero." },

// Modal Horarios
"Nombre del horario": { en: "Schedule name", es: "Nombre del horario" },
"Hora de inicio": { en: "Start time", es: "Hora de inicio" },
"Hora de fin": { en: "End time", es: "Hora de fin" },
"Editar Horario": { en: "Edit Schedule", es: "Editar Horario" },
"Actualizar": { en: "Update", es: "Actualizar" },

"Acciones": { en: "Actions", es: "Acciones" },
"Año": { en: "Year", es: "Año" },
"ID Espacio": { en: "ID Space", es: "ID Espacio" },

// Editar Asignatura
"Editar Asignatura": { en: "Edit Subject", es: "Editar Asignatura" },
"Modifica los datos de la asignatura seleccionada": { en: "Modify the data of the selected subject", es: "Modifica los datos de la asignatura seleccionada" },
"Seleccione un docente": { en: "Select a teacher", es: "Seleccione un docente" },
"Seleccione un grupo": { en: "Select a group", es: "Seleccione un grupo" },

// Modales de Edición
"Editar Curso": { en: "Edit Course", es: "Editar Curso" },
"Editar Grupo": { en: "Edit Group", es: "Editar Grupo" },
"Editar Docente": { en: "Edit Teacher", es: "Editar Docente" },
"Editar Recurso": { en: "Edit Resource", es: "Editar Recurso" },
"Guardar cambios": { en: "Save changes", es: "Guardar cambios" },
"-- Seleccionar curso --": { en: "-- Select course --", es: "-- Seleccionar curso --" },
"-- Seleccionar turno --": { en: "-- Select shift --", es: "-- Seleccionar turno --" },

// Textos de asignaturas.php adicionales
"No hay asignaturas registradas": { en: "No subjects registered", es: "No hay asignaturas registradas" },

// Textos de recursos.php adicionales
"Lista de Recursos Registrados": { en: "List of Registered Resources", es: "Lista de Recursos Registrados" },
"Aquí puedes ver los recursos del sistema": { en: "Here you can see the system resources", es: "Aquí puedes ver los recursos del sistema" },
"No hay recursos registrados": { en: "No resources registered", es: "No hay recursos registrados" },

// docentesestudiantes.php - Textos faltantes
"Grupo:": { en: "Group:", es: "Grupo:" },
"Curso:": { en: "Course:", es: "Curso:" },
"Turno:": { en: "Shift:", es: "Turno:" },

// Horarios Docente
"Mis Horarios": { en: "My Schedule", es: "Mis Horarios" },
"Selecciona un grupo para ver tu horario de clases": { en: "Select a group to view your class schedule", es: "Selecciona un grupo para ver tu horario de clases" },
"No estás asignado a ningún grupo": { en: "You are not assigned to any group", es: "No estás asignado a ningún grupo" },
"Tus asignaturas en este grupo:": { en: "Your subjects in this group:", es: "Tus asignaturas en este grupo:" },
"Cargando horarios...": { en: "Loading schedules...", es: "Cargando horarios..." },
"Solo se muestran tus clases asignadas": { en: "Only your assigned classes are shown", es: "Solo se muestran tus clases asignadas" },
"Selecciona un grupo para ver tus horarios": { en: "Select a group to view your schedules", es: "Selecciona un grupo para ver tus horarios" },

// Notificaciones - Cursos
"¡Curso agregado!": { en: "Course added!", es: "¡Curso agregado!" },
"El nuevo curso ha sido registrado exitosamente en el sistema.": { en: "The new course has been successfully registered in the system.", es: "El nuevo curso ha sido registrado exitosamente en el sistema." },
"Error al registrar": { en: "Registration Error", es: "Error al registrar" },
"No se pudo agregar el curso. Por favor, intenta nuevamente.": { en: "Could not add the course. Please try again.", es: "No se pudo agregar el curso. Por favor, intenta nuevamente." },

// Notificaciones - Docentes
"¡Docente registrado!": { en: "Teacher registered!", es: "¡Docente registrado!" },
"El docente ha sido agregado correctamente al sistema.": { en: "The teacher has been successfully added to the system.", es: "El docente ha sido agregado correctamente al sistema." },
"Cédula inválida": { en: "Invalid ID", es: "Cédula inválida" },
"La cédula debe tener exactamente 8 números sin puntos ni guiones.": { en: "The ID must have exactly 8 numbers without periods or hyphens.", es: "La cédula debe tener exactamente 8 números sin puntos ni guiones." },
"Contraseña inválida": { en: "Invalid Password", es: "Contraseña inválida" },
"La contraseña debe tener al menos 6 caracteres, incluyendo letras y números.": { en: "Password must be at least 6 characters, including letters and numbers.", es: "La contraseña debe tener al menos 6 caracteres, incluyendo letras y números." },
"Ocurrió un error al registrar el docente. Por favor, intenta nuevamente.": { en: "An error occurred while registering the teacher. Please try again.", es: "Ocurrió un error al registrar el docente. Por favor, intenta nuevamente." },
"El nuevo docente fue agregado exitosamente.": { en: "The new teacher was successfully added.", es: "El nuevo docente fue agregado exitosamente." },
"Datos duplicados": { en: "Duplicate Data", es: "Datos duplicados" },
"Ya existe un usuario con esa cédula o correo electrónico.": { en: "A user with that ID or email already exists.", es: "Ya existe un usuario con esa cédula o correo electrónico." },
"La cédula debe tener exactamente 8 dígitos numéricos.": { en: "The ID must have exactly 8 numeric digits.", es: "La cédula debe tener exactamente 8 dígitos numéricos." },
"Debe tener al menos 6 caracteres, incluyendo letras y números.": { en: "Must be at least 6 characters, including letters and numbers.", es: "Debe tener al menos 6 caracteres, incluyendo letras y números." },
"La cédula ingresada no es válida": { en: "The entered ID is not valid", es: "La cédula ingresada no es válida" },
"Ocurrió un problema al intentar guardar el docente.": { en: "A problem occurred while trying to save the teacher.", es: "Ocurrió un problema al intentar guardar el docente." },

// Notificaciones - Espacios
"¡Espacio agregado!": { en: "Space added!", es: "¡Espacio agregado!" },
"El nuevo espacio ha sido registrado correctamente en el sistema.": { en: "The new space has been successfully registered in the system.", es: "El nuevo espacio ha sido registrado correctamente en el sistema." },
"No se pudo agregar el espacio. Por favor, intenta nuevamente.": { en: "Could not add the space. Please try again.", es: "No se pudo agregar el espacio. Por favor, intenta nuevamente." },
"Espacio duplicado": { en: "Duplicate Space", es: "Espacio duplicado" },
"Ya existe un espacio con esas características en el sistema.": { en: "A space with those characteristics already exists in the system.", es: "Ya existe un espacio con esas características en el sistema." },

// Notificaciones - Grupos
"¡Grupo agregado!": { en: "Group added!", es: "¡Grupo agregado!" },
"El nuevo grupo ha sido creado exitosamente.": { en: "The new group has been successfully created.", es: "El nuevo grupo ha sido creado exitosamente." },
"Error al crear grupo": { en: "Error creating group", es: "Error al crear grupo" },
"No se pudo agregar el grupo. Verifica los datos e intenta nuevamente.": { en: "Could not add the group. Check the data and try again.", es: "No se pudo agregar el grupo. Verifica los datos e intenta nuevamente." },

// Notificaciones - Asignaturas
"¡Asignatura agregada!": { en: "Subject added!", es: "¡Asignatura agregada!" },
"La asignatura ha sido registrada correctamente.": { en: "The subject has been successfully registered.", es: "La asignatura ha sido registrada correctamente." },
"Asignatura duplicada": { en: "Duplicate Subject", es: "Asignatura duplicada" },
"Esta asignatura ya está asignada a este grupo con este docente.": { en: "This subject is already assigned to this group with this teacher.", es: "Esta asignatura ya está asignada a este grupo con este docente." },
"Error al agregar asignatura": { en: "Error adding subject", es: "Error al agregar asignatura" },
"No se pudo registrar la asignatura. Intenta nuevamente.": { en: "Could not register the subject. Try again.", es: "No se pudo registrar la asignatura. Intenta nuevamente." },

// Notificaciones - Horarios
"¡Horario guardado!": { en: "Schedule saved!", es: "¡Horario guardado!" },
"El horario ha sido actualizado correctamente.": { en: "The schedule has been successfully updated.", es: "El horario ha sido actualizado correctamente." },
"¡Horario eliminado!": { en: "Schedule deleted!", es: "¡Horario eliminado!" },
"El horario ha sido eliminado del sistema.": { en: "The schedule has been removed from the system.", es: "El horario ha sido eliminado del sistema." },
"Error con el horario": { en: "Error with schedule", es: "Error con el horario" },
"No se pudo procesar la operación. Intenta nuevamente.": { en: "Could not process the operation. Try again.", es: "No se pudo procesar la operación. Intenta nuevamente." },
"¡Horario agregado!": { en: "Schedule added!", es: "¡Horario agregado!" },
"El nuevo horario fue guardado exitosamente.": { en: "The new schedule was successfully saved.", es: "El nuevo horario fue guardado exitosamente." },
"No se pudo agregar el horario. Intenta nuevamente.": { en: "Could not add the schedule. Try again.", es: "No se pudo agregar el horario. Intenta nuevamente." },

// Notificaciones - Reservas
"¡Éxito!": { en: "Success!", es: "¡Éxito!" },
"Acción completada": { en: "Action completed", es: "Acción completada" },
"Si el problema persiste, contacta al administrador.": { en: "If the problem persists, contact the administrator.", es: "Si el problema persiste, contacta al administrador." },
"Operación completada exitosamente": { en: "Operation completed successfully", es: "Operación completada exitosamente" },
"Ocurrió un error al procesar la operación": { en: "An error occurred while processing the operation", es: "Ocurrió un error al procesar la operación" },
"¡Reserva realizada!": { en: "Reservation made!", es: "¡Reserva realizada!" },
"Tu reserva fue registrada correctamente.": { en: "Your reservation was successfully registered.", es: "Tu reserva fue registrada correctamente." },
"Fecha u hora inválida": { en: "Invalid date or time", es: "Fecha u hora inválida" },
"No puedes reservar en una fecha u hora pasada.": { en: "You cannot book on a past date or time.", es: "No puedes reservar en una fecha u hora pasada." },
"Error al reservar": { en: "Error making reservation", es: "Error al reservar" },
"Ocurrió un error al registrar tu reserva. Intenta nuevamente.": { en: "An error occurred while registering your reservation. Try again.", es: "Ocurrió un error al registrar tu reserva. Intenta nuevamente." },

// Notificaciones - Recursos
"¡Recurso agregado!": { en: "Resource added!", es: "¡Recurso agregado!" },
"El recurso se registró correctamente en el sistema.": { en: "The resource was successfully registered in the system.", es: "El recurso se registró correctamente en el sistema." },
"Aceptar": { en: "Accept", es: "Aceptar" },
"Cerrar": { en: "Close", es: "Cerrar" },
"Hubo un problema al registrar el recurso. Intenta nuevamente.": { en: "There was a problem registering the resource. Try again.", es: "Hubo un problema al registrar el recurso. Intenta nuevamente." },

// Notificaciones - Login
"Inicio de sesión correcto": { en: "Successful login", es: "Inicio de sesión correcto" },
"Bienvenido/a al sistema.": { en: "Welcome to the system.", es: "Bienvenido/a al sistema." },
"Contraseña incorrecta": { en: "Incorrect password", es: "Contraseña incorrecta" },
"Verifica tu contraseña e inténtalo de nuevo.": { en: "Check your password and try again.", es: "Verifica tu contraseña e inténtalo de nuevo." },
"Intentar de nuevo": { en: "Try again", es: "Intentar de nuevo" },
"Usuario no encontrado": { en: "User not found", es: "Usuario no encontrado" },
"No existe una cuenta con ese correo o cédula.": { en: "There is no account with that email or ID.", es: "No existe una cuenta con ese correo o cédula." },
"OK": { en: "OK", es: "OK" },
"Inicia sesión primero": { en: "Login first", es: "Inicia sesión primero" },
"Debes iniciar sesión para acceder al sistema.": { en: "You must login to access the system.", es: "Debes iniciar sesión para acceder al sistema." },
"Entendido": { en: "Understood", es: "Entendido" },
"Acceso no autorizado": { en: "Unauthorized access", es: "Acceso no autorizado" },
"No tienes permisos para acceder a esa página.": { en: "You do not have permission to access that page.", es: "No tienes permisos para acceder a esa página." },

// SweetAlert - Confirmaciones de eliminación
"¿Eliminar asignatura?": { en: "Delete subject?", es: "¿Eliminar asignatura?" },
"Se eliminará del sistema.": { en: "It will be deleted from the system.", es: "Se eliminará del sistema." },
"Sí, eliminar": { en: "Yes, delete", es: "Sí, eliminar" },
"¿Eliminar curso?": { en: "Delete course?", es: "¿Eliminar curso?" },
"Se eliminará el curso del sistema.": { en: "The course will be deleted from the system.", es: "Se eliminará el curso del sistema." },
"¿Eliminar grupo?": { en: "Delete group?", es: "¿Eliminar grupo?" },
"Se eliminará el grupo del sistema.": { en: "The group will be deleted from the system.", es: "Se eliminará el grupo del sistema." },
"¿Eliminar recurso?": { en: "Delete resource?", es: "¿Eliminar recurso?" },
"Se eliminará el recurso del sistema.": { en: "The resource will be deleted from the system.", es: "Se eliminará el recurso del sistema." },
"¿Eliminar docente?": { en: "Delete teacher?", es: "¿Eliminar docente?" },
"Se eliminará a del sistema.": { en: "Will be deleted from the system.", es: "Se eliminará a del sistema." },

// SweetAlert - Mensajes de éxito
"Asignatura eliminada correctamente": { en: "Subject deleted successfully", es: "Asignatura eliminada correctamente" },
"Asignatura actualizada correctamente": { en: "Subject updated successfully", es: "Asignatura actualizada correctamente" },
"Asignatura agregada correctamente": { en: "Subject added successfully", es: "Asignatura agregada correctamente" },
"Curso eliminado correctamente": { en: "Course deleted successfully", es: "Curso eliminado correctamente" },
"Curso actualizado correctamente": { en: "Course updated successfully", es: "Curso actualizado correctamente" },
"¡Docente actualizado!": { en: "Teacher updated!", es: "¡Docente actualizado!" },
"Los datos del docente se actualizaron correctamente.": { en: "Teacher data was updated successfully.", es: "Los datos del docente se actualizaron correctamente." },
"¡Docente eliminado!": { en: "Teacher deleted!", es: "¡Docente eliminado!" },
"El docente fue eliminado del sistema correctamente.": { en: "The teacher was successfully removed from the system.", es: "El docente fue eliminado del sistema correctamente." },
"La cédula debe tener exactamente 8 dígitos numéricos sin puntos ni guiones.": { en: "The ID must have exactly 8 numeric digits without periods or hyphens.", es: "La cédula debe tener exactamente 8 dígitos numéricos sin puntos ni guiones." },
"La cédula ingresada no es válida. El dígito verificador no coincide.": { en: "The entered ID is not valid. The verification digit does not match.", es: "La cédula ingresada no es válida. El dígito verificador no coincide." },
"Ya existe otro docente con esa cédula o correo electrónico.": { en: "Another teacher with that ID or email already exists.", es: "Ya existe otro docente con esa cédula o correo electrónico." },
"Error": { en: "Error", es: "Error" },
"Ocurrió un error al procesar la operación. Intenta nuevamente.": { en: "An error occurred while processing the operation. Try again.", es: "Ocurrió un error al procesar la operación. Intenta nuevamente." },
"Grupo eliminado correctamente": { en: "Group deleted successfully", es: "Grupo eliminado correctamente" },
"Grupo actualizado correctamente": { en: "Group updated successfully", es: "Grupo actualizado correctamente" },
"Recurso eliminado correctamente": { en: "Resource deleted successfully", es: "Recurso eliminado correctamente" },
"Recurso actualizado correctamente": { en: "Resource updated successfully", es: "Recurso actualizado correctamente" },
"Ya existe un recurso con ese nombre": { en: "A resource with that name already exists", es: "Ya existe un recurso con ese nombre" },
"Recurso agregado correctamente": { en: "Resource added successfully", es: "Recurso agregado correctamente" },

//Mas sweets alerts
"del sistema": { en: "from the system", es: "del sistema" },
"Se eliminará": { en: "Will be deleted", es: "Se eliminará" },
"Se eliminará el curso": { en: "The course will be deleted", es: "Se eliminará el curso" },
"Se eliminará el grupo": { en: "The group will be deleted", es: "Se eliminará el grupo" },
"Se eliminará el recurso": { en: "The resource will be deleted", es: "Se eliminará el recurso" },
"Se eliminará a": { en: "Will remove", es: "Se eliminará a" },

// Sección Reservas - SweetAlerts
"¿Aprobar esta reserva?": { en: "Approve this reservation?", es: "¿Aprobar esta reserva?" },
"¿Rechazar esta reserva?": { en: "Reject this reservation?", es: "¿Rechazar esta reserva?" },
"Docente:": { en: "Teacher:", es: "Docente:" },
"Recursos:": { en: "Resources:", es: "Recursos:" },
"Sí, aprobar": { en: "Yes, approve", es: "Sí, aprobar" },
"Sí, rechazar": { en: "Yes, reject", es: "Sí, rechazar" },
"Esta acción no se puede deshacer.": { en: "This action cannot be undone.", es: "Esta acción no se puede deshacer." },


// Timeout/Inactividad
"Advertencia de Inactividad": { en: "⏰ Inactivity Warning", es: "⏰ Advertencia de Inactividad" },
"Tu sesión expirará en": { en: "Your session will expire in", es: "Tu sesión expirará en" },
"minuto": { en: "minute", es: "minuto" },
"minutos": { en: "minutes", es: "minutos" },
"por inactividad": { en: "due to inactivity", es: "por inactividad" },
"Realiza cualquier acción para continuar en el sistema": { en: "Perform any action to continue in the system", es: "Realiza cualquier acción para continuar en el sistema" },
"Continuar": { en: "Continue", es: "Continuar" },
"Sesión Expirada": { en: "Session Expired", es: "Sesión Expirada" },
"Tu sesión ha finalizado por": { en: "Your session has ended due to", es: "Tu sesión ha finalizado por" },
"inactividad": { en: "inactivity", es: "inactividad" },
"Por tu seguridad, debes iniciar sesión nuevamente": { en: "For your security, you must log in again", es: "Por tu seguridad, debes iniciar sesión nuevamente" },
"Ir a Login": { en: "Go to Login", es: "Ir a Login" },

// Modal Agregar Curso - SweetAlerts
"Todos seleccionados": { en: "All selected", es: "Todos seleccionados" },
"Todos deseleccionados": { en: "All deselected", es: "Todos deseleccionados" },
"No hay horarios seleccionados": { en: "No schedules selected", es: "No hay horarios seleccionados" },
"Selecciona al menos un horario para eliminar": { en: "Select at least one schedule to delete", es: "Selecciona al menos un horario para eliminar" },
"¿Eliminar horarios?": { en: "Delete schedules?", es: "¿Eliminar horarios?" },
"Se eliminarán": { en: "Will be deleted", es: "Se eliminarán" },
"horario(s) seleccionado(s)": { en: "selected schedule(s)", es: "horario(s) seleccionado(s)" },
"ADVERTENCIA: Esto afectará a todos los cursos que usen estos horarios.": { en: "WARNING: This will affect all courses that use these schedules.", es: "ADVERTENCIA: Esto afectará a todos los cursos que usen estos horarios." },
"Eliminando...": { en: "Deleting...", es: "Eliminando..." },
"Eliminado": { en: "Deleted", es: "Eliminado" },
"Horarios eliminados correctamente": { en: "Schedules deleted successfully", es: "Horarios eliminados correctamente" },
"No se pudieron eliminar los horarios": { en: "Could not delete schedules", es: "No se pudieron eliminar los horarios" },
"Editar Horario": { en: "Edit Schedule", es: "Editar Horario" },
"Nombre del horario": { en: "Schedule name", es: "Nombre del horario" },
"Hora de inicio": { en: "Start time", es: "Hora de inicio" },
"Hora de fin": { en: "End time", es: "Hora de fin" },
"Guardar": { en: "Save", es: "Guardar" },
"Guardando...": { en: "Saving...", es: "Guardando..." },
"Guardado": { en: "Saved", es: "Guardado" },
"Horario actualizado correctamente": { en: "Schedule updated successfully", es: "Horario actualizado correctamente" },
"No se pudo actualizar el horario": { en: "Could not update schedule", es: "No se pudo actualizar el horario" },
"El nombre del horario es obligatorio": { en: "Schedule name is required", es: "El nombre del horario es obligatorio" },
"Las horas de inicio y fin son obligatorias": { en: "Start and end times are required", es: "Las horas de inicio y fin son obligatorias" }
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

// Función para obtener traducción 
function obtenerTraduccion(texto) {
  const idioma = localStorage.getItem('idioma') || 'es';
  return diccionario[texto] && diccionario[texto][idioma] 
    ? diccionario[texto][idioma] 
    : texto;
}

// Carga idioma guardado al iniciar
document.addEventListener("DOMContentLoaded", () => {
  const idiomaGuardado = localStorage.getItem("idioma") || "es";
  traducir(idiomaGuardado);

  // Dropdown de cambio de idioma
  document.getElementById("lenguaje-es").addEventListener("click", () => traducir("es"));
  document.getElementById("lenguaje-en").addEventListener("click", () => traducir("en"));
});