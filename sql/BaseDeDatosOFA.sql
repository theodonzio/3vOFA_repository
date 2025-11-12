SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- Estructura de tabla para la tabla `asignatura`

CREATE TABLE `asignatura` (
  `id_asignatura` int(11) NOT NULL,
  `nombre_asignatura` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `curso`

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `duracion_anos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Estructura de tabla para la tabla `curso_horario`

CREATE TABLE `curso_horario` (
  `id_curso` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `espacio`

CREATE TABLE `espacio` (
  `id_espacio` int(11) NOT NULL,
  `nombre_espacio` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `grupo`

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(50) NOT NULL,
  `anio_curso` int(11) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_turno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Estructura de tabla para la tabla `grupo_asignatura`

CREATE TABLE `grupo_asignatura` (
  `id_grupo` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Estructura de tabla para la tabla `horario`


CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `nombre_horario` varchar(20) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `horario_grupo_asignatura`

CREATE TABLE `horario_grupo_asignatura` (
  `id_grupo` int(11) DEFAULT NULL,
  `id_horario` int(11) DEFAULT NULL,
  `dia_semana` int(11) DEFAULT NULL COMMENT '1=Lunes, 2=Martes, 3=Miércoles, 4=Jueves, 5=Viernes',
  `id_asignatura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Estructura de tabla para la tabla `recurso`

CREATE TABLE `recurso` (
  `id_recurso` int(11) NOT NULL,
  `nombre_recurso` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'Disponible',
  `id_espacio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `reserva`

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `tipo_reserva` varchar(50) DEFAULT 'Clase',
  `estado` varchar(50) DEFAULT 'Pendiente',
  `id_docente` int(11) DEFAULT NULL,
  `id_espacio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `reserva_recurso`

CREATE TABLE `reserva_recurso` (
  `id_reserva` int(11) NOT NULL,
  `id_recurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `rol`

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `rol`

INSERT INTO `rol` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'Adscripta', 'Administrador del sistema con acceso total'),
(2, 'Docente', 'Profesor del instituto que puede hacer reservas'),

-- Estructura de tabla para la tabla `turno`

CREATE TABLE `turno` (
  `id_turno` int(11) NOT NULL,
  `nombre_turno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `turno`

INSERT INTO `turno` (`id_turno`, `nombre_turno`) VALUES
(1, 'Matutino'),
(2, 'Vespertino'),
(3, 'Nocturno');

-- Estructura de tabla para la tabla `usuario`

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `usuario`
-- Contraseña por defecto: "admin123" (cambiar en producción)

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `cedula`, `email`, `contrasena`, `id_rol`) VALUES
(1, 'María', 'González', '12345678', 'maria@instituto.edu.uy', '$2y$10$1iij6THLthJZpCI94TuoVOutBeTWANIkMbPVi78qqAr.d7/D1xJA2', 1);

-- ÍNDICES DE TABLAS

-- Índices para la tabla `asignatura`
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asignatura`);

-- Índices para la tabla `curso`
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

-- Índices para la tabla `curso_horario`
ALTER TABLE `curso_horario`
  ADD PRIMARY KEY (`id_curso`,`id_horario`),
  ADD KEY `id_horario` (`id_horario`);

-- Índices para la tabla `espacio`
ALTER TABLE `espacio`
  ADD PRIMARY KEY (`id_espacio`);

-- Índices para la tabla `grupo`
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_turno` (`id_turno`);

-- Índices para la tabla `grupo_asignatura`
ALTER TABLE `grupo_asignatura`
  ADD PRIMARY KEY (`id_grupo`,`id_asignatura`,`id_docente`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `id_docente` (`id_docente`);

-- Índices para la tabla `horario`
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`);

-- Índices para la tabla `horario_grupo_asignatura`
ALTER TABLE `horario_grupo_asignatura`
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_horario` (`id_horario`),
  ADD KEY `id_asignatura` (`id_asignatura`);

-- Índices para la tabla `recurso`
ALTER TABLE `recurso`
  ADD PRIMARY KEY (`id_recurso`),
  ADD KEY `id_espacio` (`id_espacio`);

-- Índices para la tabla `reserva`
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_espacio` (`id_espacio`);

-- Índices para la tabla `reserva_recurso`
ALTER TABLE `reserva_recurso`
  ADD PRIMARY KEY (`id_reserva`,`id_recurso`),
  ADD KEY `id_recurso` (`id_recurso`);

-- Índices para la tabla `rol`
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

-- Índices para la tabla `turno`
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id_turno`);

-- Índices para la tabla `usuario`
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`);

-- AUTO_INCREMENT

ALTER TABLE `asignatura`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `espacio`
  MODIFY `id_espacio` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `recurso`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `turno`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- RESTRICCIONES (FOREIGN KEYS)

-- Restricciones para la tabla `curso_horario`
ALTER TABLE `curso_horario`
  ADD CONSTRAINT `curso_horario_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_horario_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`) ON DELETE CASCADE;

-- Restricciones para la tabla `grupo`
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`) ON DELETE SET NULL;

-- Restricciones para la tabla `grupo_asignatura`
ALTER TABLE `grupo_asignatura`
  ADD CONSTRAINT `grupo_asignatura_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE CASCADE,
  ADD CONSTRAINT `grupo_asignatura_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE CASCADE,
  ADD CONSTRAINT `grupo_asignatura_ibfk_3` FOREIGN KEY (`id_docente`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

-- Restricciones para la tabla `horario_grupo_asignatura`
ALTER TABLE `horario_grupo_asignatura`
  ADD CONSTRAINT `horario_grupo_asignatura_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE CASCADE,
  ADD CONSTRAINT `horario_grupo_asignatura_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`) ON DELETE CASCADE,
  ADD CONSTRAINT `horario_grupo_asignatura_ibfk_3` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE SET NULL;

-- Restricciones para la tabla `recurso`
ALTER TABLE `recurso`
  ADD CONSTRAINT `recurso_ibfk_1` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id_espacio`) ON DELETE SET NULL;

-- Restricciones para la tabla `reserva`
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id_espacio`) ON DELETE CASCADE;

-- Restricciones para la tabla `reserva_recurso`
ALTER TABLE `reserva_recurso`
  ADD CONSTRAINT `reserva_recurso_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE CASCADE,
  ADD CONSTRAINT `reserva_recurso_ibfk_2` FOREIGN KEY (`id_recurso`) REFERENCES `recurso` (`id_recurso`) ON DELETE CASCADE;

-- Restricciones para la tabla `usuario`
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE SET NULL;

COMMIT;
