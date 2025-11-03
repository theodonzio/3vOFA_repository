SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

-- Base de datos: `db_ofa`

-- Estructura de tabla para la tabla asignatura

CREATE TABLE `asignatura` (
  `id_asignatura` int(11) NOT NULL,
  `nombre_asignatura` varchar(100) NOT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Estructura de tabla para la tabla curso

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `duracion_anos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Estructura de tabla para la tabla curso_horario

CREATE TABLE `curso_horario` (
  `id_curso` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla espacio

CREATE TABLE `espacio` (
  `id_espacio` int(11) NOT NULL,
  `nombre_espacio` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla estudiante_grupo

CREATE TABLE `estudiante_grupo` (
  `id_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `anio_academico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla grupo

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(50) NOT NULL,
  `anio_curso` int(11) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_turno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla grupo_asignatura

CREATE TABLE `grupo_asignatura` (
  `id_grupo` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla horario

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `nombre_horario` varchar(20) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla horario_grupo_asignatura

CREATE TABLE `horario_grupo_asignatura` (
  `id_grupo` int(11) DEFAULT NULL,
  `id_horario` int(11) DEFAULT NULL,
  `dia_semana` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `id_profesor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla informe

CREATE TABLE `informe` (
  `id_informe` int(11) NOT NULL,
  `tipo_informe` varchar(50) DEFAULT NULL,
  `fecha_generacion` datetime NOT NULL,
  `datos` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla recurso

CREATE TABLE `recurso` (
  `id_recurso` int(11) NOT NULL,
  `nombre_recurso` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `id_espacio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla reserva

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `tipo_reserva` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `id_grupo_asignatura` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_aprobador` int(11) DEFAULT NULL,
  `id_espacio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla reserva_recurso

CREATE TABLE `reserva_recurso` (
  `id_reserva` int(11) NOT NULL,
  `id_recurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- Estructura de tabla para la tabla rol

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla rol

INSERT INTO `rol` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'Administrador', 'Acceso total al sistema'),
(2, 'Docente', 'Profesor del instituto'),
(3, 'Estudiante', 'Alumno matriculado');



-- Estructura de tabla para la tabla turno

CREATE TABLE `turno` (
  `id_turno` int(11) NOT NULL,
  `nombre_turno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla turno

INSERT INTO `turno` (`id_turno`, `nombre_turno`) VALUES
(1, 'Matutino'),
(2, 'Vespertino'),
(3, 'Nocturno');



-- Estructura de tabla para la tabla usuario

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla usuario

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `cedula`, `email`, `contrasena`, `id_rol`) VALUES
(1, 'María', 'González', '12345678', 'maria@instituto.edu.uy', 'pass123', 1);

-- Índices de tablas

-- Índices: asignatura
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asignatura`),
  ADD KEY `id_curso` (`id_curso`);

-- Índices: curso
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

-- Índices: curso_horario
ALTER TABLE `curso_horario`
  ADD PRIMARY KEY (`id_curso`,`id_horario`),
  ADD KEY `id_horario` (`id_horario`);

-- Índices: espacio
ALTER TABLE `espacio`
  ADD PRIMARY KEY (`id_espacio`);

-- Índices: estudiante_grupo
ALTER TABLE `estudiante_grupo`
  ADD PRIMARY KEY (`id_usuario`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

-- Índices: grupo
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_turno` (`id_turno`);

-- Índices: grupo_asignatura
ALTER TABLE `grupo_asignatura`
  ADD PRIMARY KEY (`id_grupo`,`id_asignatura`,`id_docente`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `id_docente` (`id_docente`);

-- Índices: horario
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`);

-- Índices: horario_grupo_asignatura
ALTER TABLE `horario_grupo_asignatura`
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `horario_grupo_asignatura_ibfk_2` (`id_horario`);

-- Índices: informe
ALTER TABLE `informe`
  ADD PRIMARY KEY (`id_informe`),
  ADD KEY `id_usuario` (`id_usuario`);

-- Índices: recurso
ALTER TABLE `recurso`
  ADD PRIMARY KEY (`id_recurso`),
  ADD KEY `id_espacio` (`id_espacio`);

-- Índices: reserva
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_aprobador` (`id_aprobador`),
  ADD KEY `id_espacio` (`id_espacio`);

-- Índices: reserva_recurso
ALTER TABLE `reserva_recurso`
  ADD PRIMARY KEY (`id_reserva`,`id_recurso`),
  ADD KEY `id_recurso` (`id_recurso`);

-- Índices: rol
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

-- Índices: turno
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id_turno`);

-- Índices: usuario
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`);

-- AUTO_INCREMENT

-- AUTO_INCREMENT: asignatura
ALTER TABLE `asignatura`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- AUTO_INCREMENT: curso
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- AUTO_INCREMENT: espacio
ALTER TABLE `espacio`
  MODIFY `id_espacio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- AUTO_INCREMENT: grupo
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- AUTO_INCREMENT: horario
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- AUTO_INCREMENT: informe
ALTER TABLE `informe`
  MODIFY `id_informe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- AUTO_INCREMENT: recurso
ALTER TABLE `recurso`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- AUTO_INCREMENT: reserva
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- AUTO_INCREMENT: rol
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- AUTO_INCREMENT: turno
ALTER TABLE `turno`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- AUTO_INCREMENT: usuario
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- Relaciones entre tablas (Foreign Keys)

-- Relaciones: asignatura
ALTER TABLE `asignatura`
  ADD CONSTRAINT `asignatura_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE;

-- Relaciones: curso_horario
ALTER TABLE `curso_horario`
  ADD CONSTRAINT `curso_horario_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_horario_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`) ON DELETE CASCADE;

-- Relaciones: estudiante_grupo
ALTER TABLE `estudiante_grupo`
  ADD CONSTRAINT `estudiante_grupo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `estudiante_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE CASCADE;

-- Relaciones: grupo
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`);

-- Relaciones: horario_grupo_asignatura
ALTER TABLE `horario_grupo_asignatura`
  ADD CONSTRAINT `horario_grupo_asignatura_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE CASCADE,
  ADD CONSTRAINT `horario_grupo_asignatura_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`) ON DELETE CASCADE;
COMMIT;