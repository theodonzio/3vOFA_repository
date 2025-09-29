-- ============================================
-- TABLAS PRINCIPALES
-- ============================================

CREATE TABLE Rol (
    id_rol INT PRIMARY KEY AUTO_INCREMENT,
    nombre_rol VARCHAR(50) NOT NULL,
    descripcion TEXT
);

CREATE TABLE Usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    cedula VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    id_rol INT,
    FOREIGN KEY (id_rol) REFERENCES Rol(id_rol)
);

CREATE TABLE Curso (
    id_curso INT PRIMARY KEY AUTO_INCREMENT,
    nombre_curso VARCHAR(100) NOT NULL,
    descripcion TEXT,
    duracion_anos INT
);

CREATE TABLE Turno (
    id_turno INT PRIMARY KEY AUTO_INCREMENT,
    nombre_turno VARCHAR(50) NOT NULL
);

CREATE TABLE Grupo (
    id_grupo INT PRIMARY KEY AUTO_INCREMENT,
    nombre_grupo VARCHAR(50) NOT NULL,
    anio_curso INT NOT NULL,
    id_curso INT,
    id_turno INT,
    FOREIGN KEY (id_curso) REFERENCES Curso(id_curso),
    FOREIGN KEY (id_turno) REFERENCES Turno(id_turno)
);

CREATE TABLE Asignatura (
    id_asignatura INT PRIMARY KEY AUTO_INCREMENT,
    nombre_asignatura VARCHAR(100) NOT NULL,
    carga_horaria INT,
    id_curso INT,
    FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE Espacio (
    id_espacio INT PRIMARY KEY AUTO_INCREMENT,
    nombre_espacio VARCHAR(100) NOT NULL,
    tipo VARCHAR(50),
    capacidad INT,
    ubicacion VARCHAR(100),
    descripcion TEXT
);

CREATE TABLE Recurso (
    id_recurso INT PRIMARY KEY AUTO_INCREMENT,
    nombre_recurso VARCHAR(100) NOT NULL,
    tipo VARCHAR(50),
    estado VARCHAR(50),
    id_espacio INT,
    FOREIGN KEY (id_espacio) REFERENCES Espacio(id_espacio)
);

-- ============================================
-- TABLAS RELACIONALES
-- ============================================

CREATE TABLE Grupo_Asignatura (
    id_grupo INT,
    id_asignatura INT,
    id_docente INT,
    PRIMARY KEY (id_grupo, id_asignatura, id_docente),
    FOREIGN KEY (id_grupo) REFERENCES Grupo(id_grupo),
    FOREIGN KEY (id_asignatura) REFERENCES Asignatura(id_asignatura),
    FOREIGN KEY (id_docente) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Estudiante_Grupo (
    id_usuario INT,
    id_grupo INT,
    anio_academico INT NOT NULL,
    PRIMARY KEY (id_usuario, id_grupo),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_grupo) REFERENCES Grupo(id_grupo)
);

CREATE TABLE Reserva (
    id_reserva INT PRIMARY KEY AUTO_INCREMENT,
    fecha_inicio DATETIME NOT NULL,
    fecha_fin DATETIME NOT NULL,
    tipo_reserva VARCHAR(50),
    estado VARCHAR(50),
    id_grupo_asignatura INT,
    id_docente INT,
    id_aprobador INT,
    id_espacio INT,
    FOREIGN KEY (id_docente) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_aprobador) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_espacio) REFERENCES Espacio(id_espacio)
);

CREATE TABLE Reserva_Recurso (
    id_reserva INT,
    id_recurso INT,
    PRIMARY KEY (id_reserva, id_recurso),
    FOREIGN KEY (id_reserva) REFERENCES Reserva(id_reserva),
    FOREIGN KEY (id_recurso) REFERENCES Recurso(id_recurso)
);

CREATE TABLE Informe (
    id_informe INT PRIMARY KEY AUTO_INCREMENT,
    tipo_informe VARCHAR(50),
    fecha_generacion DATETIME NOT NULL,
    datos TEXT,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);