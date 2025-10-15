-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2025 a las 15:17:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_ofa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id_asignatura` int(11) NOT NULL,
  `nombre_asignatura` varchar(100) NOT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id_asignatura`, `nombre_asignatura`, `carga_horaria`, `id_curso`) VALUES
(1, 'Programación', 120, 1),
(2, 'Matemáticas', 80, 2),
(3, 'Contabilidad', 100, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `duracion_anos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id_curso`, `nombre_curso`, `descripcion`, `duracion_anos`) VALUES
(1, 'Informática', 'Técnico en Informática', 3),
(2, 'Bachillerato', 'Bachillerato Tecnológico', 3),
(3, 'Administración', 'Técnico en Administración', 2),
(4, 'Informatica', 'Informatica comun', 3),
(5, 'Informatica Bilingue', 'Muchas horas', 3),
(6, 'Informatica Bilingue', 'Muchas horas', 3),
(7, 'Informatica Bilingue', 'hola', 2),
(8, 'Ciberseguridad', 'Terciario', 4),
(9, 'Ciberseguridad', 'Terciario', 4),
(10, 'Ciberseguridad', 'Curso terciario', 4),
(11, 'Diseño', 'Universitaria', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_horario`
--

CREATE TABLE `curso_horario` (
  `id_curso` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `curso_horario`
--

INSERT INTO `curso_horario` (`id_curso`, `id_horario`) VALUES
(4, 6),
(5, 3),
(5, 5),
(6, 3),
(6, 5),
(8, 9),
(8, 10),
(8, 11),
(9, 9),
(9, 10),
(9, 11),
(10, 9),
(10, 10),
(10, 11),
(11, 5),
(11, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacio`
--

CREATE TABLE `espacio` (
  `id_espacio` int(11) NOT NULL,
  `nombre_espacio` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `espacio`
--

INSERT INTO `espacio` (`id_espacio`, `nombre_espacio`, `tipo`, `capacidad`, `ubicacion`, `descripcion`) VALUES
(1, 'Lab Informática', 'Laboratorio', 30, 'Planta Baja', 'Laboratorio con computadoras'),
(2, 'Aula Magna', 'Aula', 100, 'Primer Piso', 'Salón principal'),
(3, 'Biblioteca', 'Biblioteca', 50, 'Segundo Piso', 'Espacio de estudio'),
(4, 'Laboratorio General', 'Laboratorio', 30, 'Planta Baja', 'Laboratorio con equipos'),
(5, 'Aula Principal', 'Aula', 50, 'Primer Piso', 'Aula común'),
(6, 'Salón Multiuso', 'Salón', 40, 'Segundo Piso', 'Salón flexible'),
(7, 'SUM', 'SUM', 100, 'Tercer Piso', 'Salón de usos múltiples'),
(8, 'Salón', 'Salón', NULL, NULL, NULL),
(9, 'Salón', 'Salón', NULL, NULL, NULL),
(10, '4', 'Salón', NULL, NULL, NULL),
(11, '2', 'Aula', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante_grupo`
--

CREATE TABLE `estudiante_grupo` (
  `id_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `anio_academico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiante_grupo`
--

INSERT INTO `estudiante_grupo` (`id_usuario`, `id_grupo`, `anio_academico`) VALUES
(3, 1, 2024),
(3, 2, 2023),
(3, 3, 2022);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(50) NOT NULL,
  `anio_curso` int(11) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_turno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nombre_grupo`, `anio_curso`, `id_curso`, `id_turno`) VALUES
(1, '1A', 1, 1, 1),
(2, '2B', 2, 2, 2),
(3, '3C', 3, 3, 3),
(4, 'MD', 3, 1, 1),
(5, '1CB', 1, 10, 2),
(6, '4UNI', 4, 11, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_asignatura`
--

CREATE TABLE `grupo_asignatura` (
  `id_grupo` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo_asignatura`
--

INSERT INTO `grupo_asignatura` (`id_grupo`, `id_asignatura`, `id_docente`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `nombre_horario` varchar(20) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_horario`, `nombre_horario`, `hora_inicio`, `hora_fin`) VALUES
(3, '7ma', '10:42:00', '09:25:00'),
(5, '5ta', '10:20:00', '11:05:00'),
(6, '6ta', '11:10:00', '11:55:00'),
(7, '7ma', '12:00:00', '12:45:00'),
(8, '8va', '12:50:00', '13:35:00'),
(9, '9na', '13:40:00', '14:25:00'),
(10, '10ma', '14:30:00', '15:15:00'),
(11, '11va', '15:20:00', '16:05:00'),
(12, '12va', '18:27:00', '19:30:00'),
(13, '15', '20:18:00', '00:17:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_grupo_asignatura`
--

CREATE TABLE `horario_grupo_asignatura` (
  `id_grupo` int(11) DEFAULT NULL,
  `id_horario` int(11) DEFAULT NULL,
  `dia_semana` int(11) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `id_profesor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario_grupo_asignatura`
--

INSERT INTO `horario_grupo_asignatura` (`id_grupo`, `id_horario`, `dia_semana`, `id_asignatura`, `id_profesor`) VALUES
(5, 3, 1, 2, NULL),
(5, 3, 2, NULL, NULL),
(5, 3, 3, NULL, NULL),
(5, 3, 4, NULL, NULL),
(5, 3, 5, NULL, NULL),
(5, 5, 1, 3, NULL),
(5, 5, 2, NULL, NULL),
(5, 5, 3, NULL, NULL),
(5, 5, 4, NULL, NULL),
(5, 5, 5, NULL, NULL),
(5, 6, 1, 2, NULL),
(5, 6, 2, NULL, NULL),
(5, 6, 3, NULL, NULL),
(5, 6, 4, NULL, NULL),
(5, 6, 5, NULL, NULL),
(5, 7, 1, 1, NULL),
(5, 7, 2, NULL, NULL),
(5, 7, 3, NULL, NULL),
(5, 7, 4, NULL, NULL),
(5, 7, 5, NULL, NULL),
(5, 8, 1, 3, NULL),
(5, 8, 2, NULL, NULL),
(5, 8, 3, NULL, NULL),
(5, 8, 4, NULL, NULL),
(5, 8, 5, NULL, NULL),
(5, 9, 1, 1, NULL),
(5, 9, 2, NULL, NULL),
(5, 9, 3, NULL, NULL),
(5, 9, 4, NULL, NULL),
(5, 9, 5, NULL, NULL),
(5, 10, 1, 2, NULL),
(5, 10, 2, NULL, NULL),
(5, 10, 3, NULL, NULL),
(5, 10, 4, NULL, NULL),
(5, 10, 5, NULL, NULL),
(5, 11, 1, 1, NULL),
(5, 11, 2, NULL, NULL),
(5, 11, 3, NULL, NULL),
(5, 11, 4, NULL, NULL),
(5, 11, 5, NULL, NULL),
(2, 3, 1, 1, NULL),
(2, 3, 2, NULL, NULL),
(2, 3, 3, NULL, NULL),
(2, 3, 4, NULL, NULL),
(2, 3, 5, NULL, NULL),
(2, 5, 1, 2, NULL),
(2, 5, 2, NULL, NULL),
(2, 5, 3, NULL, NULL),
(2, 5, 4, NULL, NULL),
(2, 5, 5, NULL, NULL),
(2, 6, 1, 2, NULL),
(2, 6, 2, NULL, NULL),
(2, 6, 3, NULL, NULL),
(2, 6, 4, NULL, NULL),
(2, 6, 5, NULL, NULL),
(2, 7, 1, NULL, NULL),
(2, 7, 2, NULL, NULL),
(2, 7, 3, NULL, NULL),
(2, 7, 4, NULL, NULL),
(2, 7, 5, NULL, NULL),
(2, 8, 1, NULL, NULL),
(2, 8, 2, NULL, NULL),
(2, 8, 3, NULL, NULL),
(2, 8, 4, NULL, NULL),
(2, 8, 5, NULL, NULL),
(2, 9, 1, NULL, NULL),
(2, 9, 2, NULL, NULL),
(2, 9, 3, NULL, NULL),
(2, 9, 4, NULL, NULL),
(2, 9, 5, NULL, NULL),
(2, 10, 1, NULL, NULL),
(2, 10, 2, NULL, NULL),
(2, 10, 3, NULL, NULL),
(2, 10, 4, NULL, NULL),
(2, 10, 5, NULL, NULL),
(2, 11, 1, NULL, NULL),
(2, 11, 2, NULL, NULL),
(2, 11, 3, NULL, NULL),
(2, 11, 4, NULL, NULL),
(2, 11, 5, NULL, NULL),
(4, 3, 1, 3, NULL),
(4, 3, 2, NULL, NULL),
(4, 3, 3, NULL, NULL),
(4, 3, 4, NULL, NULL),
(4, 3, 5, NULL, NULL),
(4, 5, 1, NULL, NULL),
(4, 5, 2, NULL, NULL),
(4, 5, 3, NULL, NULL),
(4, 5, 4, NULL, NULL),
(4, 5, 5, NULL, NULL),
(4, 6, 1, NULL, NULL),
(4, 6, 2, NULL, NULL),
(4, 6, 3, NULL, NULL),
(4, 6, 4, NULL, NULL),
(4, 6, 5, NULL, NULL),
(4, 7, 1, NULL, NULL),
(4, 7, 2, NULL, NULL),
(4, 7, 3, NULL, NULL),
(4, 7, 4, NULL, NULL),
(4, 7, 5, NULL, NULL),
(4, 8, 1, NULL, NULL),
(4, 8, 2, NULL, NULL),
(4, 8, 3, NULL, NULL),
(4, 8, 4, NULL, NULL),
(4, 8, 5, NULL, NULL),
(4, 9, 1, NULL, NULL),
(4, 9, 2, NULL, NULL),
(4, 9, 3, NULL, NULL),
(4, 9, 4, NULL, NULL),
(4, 9, 5, NULL, NULL),
(4, 10, 1, NULL, NULL),
(4, 10, 2, NULL, NULL),
(4, 10, 3, NULL, NULL),
(4, 10, 4, NULL, NULL),
(4, 10, 5, NULL, NULL),
(4, 11, 1, NULL, NULL),
(4, 11, 2, NULL, NULL),
(4, 11, 3, NULL, NULL),
(4, 11, 4, NULL, NULL),
(4, 11, 5, NULL, NULL),
(6, 5, 1, NULL, NULL),
(6, 5, 2, NULL, NULL),
(6, 5, 3, NULL, NULL),
(6, 5, 4, NULL, NULL),
(6, 5, 5, NULL, NULL),
(6, 11, 1, NULL, NULL),
(6, 11, 2, NULL, NULL),
(6, 11, 3, 1, NULL),
(6, 11, 4, NULL, NULL),
(6, 11, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe`
--

CREATE TABLE `informe` (
  `id_informe` int(11) NOT NULL,
  `tipo_informe` varchar(50) DEFAULT NULL,
  `fecha_generacion` datetime NOT NULL,
  `datos` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `informe`
--

INSERT INTO `informe` (`id_informe`, `tipo_informe`, `fecha_generacion`, `datos`, `id_usuario`) VALUES
(1, 'Espacios', '2024-09-04 15:30:00', 'Reporte de ocupación', 1),
(2, 'Asistencia', '2024-09-03 09:15:00', 'Informe de asistencia', 2),
(3, 'Recursos', '2024-09-02 11:45:00', 'Estado de equipos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurso`
--

CREATE TABLE `recurso` (
  `id_recurso` int(11) NOT NULL,
  `nombre_recurso` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `id_espacio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recurso`
--

INSERT INTO `recurso` (`id_recurso`, `nombre_recurso`, `tipo`, `estado`, `id_espacio`) VALUES
(1, 'Proyector', 'Audiovisual', 'Disponible', 1),
(2, 'Sistema Audio', 'Audiovisual', 'Mantenimiento', 2),
(3, 'Computadora', 'Informático', 'Disponible', 3),
(4, 'Televisión', 'Audiovisual', 'Disponible', 4),
(5, 'Cable HDMI', 'Audiovisual', 'Disponible', 4),
(6, 'Aire Acondicionado', 'Climatización', 'Disponible', 4),
(7, 'Proyector', 'Audiovisual', 'Disponible', 4),
(8, 'Alargue', 'Electrico', 'Disponible', 4),
(9, 'Televisión', 'Audiovisual', 'Disponible', 5),
(10, 'Cable HDMI', 'Audiovisual', 'Disponible', 5),
(11, 'Aire Acondicionado', 'Climatización', 'Disponible', 5),
(12, 'Proyector', 'Audiovisual', 'Disponible', 5),
(13, 'Alargue', 'Electrico', 'Disponible', 5),
(14, 'Televisión', 'Audiovisual', 'Disponible', 6),
(15, 'Cable HDMI', 'Audiovisual', 'Disponible', 6),
(16, 'Aire Acondicionado', 'Climatización', 'Disponible', 6),
(17, 'Proyector', 'Audiovisual', 'Disponible', 6),
(18, 'Alargue', 'Electrico', 'Disponible', 6),
(19, 'Televisión', 'Audiovisual', 'Disponible', 7),
(20, 'Cable HDMI', 'Audiovisual', 'Disponible', 7),
(21, 'Aire Acondicionado', 'Climatización', 'Disponible', 7),
(22, 'Proyector', 'Audiovisual', 'Disponible', 7),
(23, 'Alargue', 'Electrico', 'Disponible', 7),
(24, 'Televisión', 'General', 'Disponible', 8),
(25, 'Cable HDMI', 'General', 'Disponible', 8),
(26, 'Aire Acondicionado', 'General', 'Disponible', 8),
(27, 'Proyector', 'General', 'Disponible', 8),
(28, 'Televisión', 'General', 'Disponible', 9),
(29, 'Cable HDMI', 'General', 'Disponible', 9),
(30, 'Alargue', 'General', 'Disponible', 9),
(31, 'Televisión', 'General', 'Disponible', 10),
(32, 'Cable HDMI', 'General', 'Disponible', 10),
(33, 'Aire Acondicionado', 'General', 'Disponible', 10),
(34, 'Proyector', 'General', 'Disponible', 10),
(35, 'Televisión', 'General', 'Disponible', 11),
(36, 'Cable HDMI', 'General', 'Disponible', 11),
(37, 'Proyector', 'General', 'Disponible', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

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

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `fecha_inicio`, `fecha_fin`, `tipo_reserva`, `estado`, `id_grupo_asignatura`, `id_docente`, `id_aprobador`, `id_espacio`) VALUES
(1, '2024-09-05 08:00:00', '2024-09-05 10:00:00', 'Clase', 'Aprobada', NULL, 2, 1, 1),
(2, '2024-09-06 14:00:00', '2024-09-06 16:00:00', 'Examen', 'Aprobada', NULL, 2, NULL, 2),
(3, '2024-09-07 10:00:00', '2024-09-07 12:00:00', 'Estudio', 'Aprobada', NULL, 2, 1, 3),
(4, '2025-10-06 12:00:00', '2025-10-06 12:45:00', 'Clase', 'No aprobada', NULL, 2, NULL, 10),
(5, '2025-10-06 12:50:00', '2025-10-06 13:35:00', 'Clase', 'Aprobada', NULL, 2, NULL, 10),
(6, '2025-10-07 07:50:00', '2025-10-07 08:35:00', 'Clase', 'No aprobada', NULL, 2, NULL, 10),
(7, '2025-10-07 11:10:00', '2025-10-07 11:55:00', 'Clase', 'Aprobada', NULL, 4, NULL, 7),
(8, '2025-10-13 07:00:00', '2025-10-13 07:45:00', 'Clase', 'Aprobada', NULL, 4, NULL, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_recurso`
--

CREATE TABLE `reserva_recurso` (
  `id_reserva` int(11) NOT NULL,
  `id_recurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva_recurso`
--

INSERT INTO `reserva_recurso` (`id_reserva`, `id_recurso`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'Administrador', 'Acceso total al sistema'),
(2, 'Docente', 'Profesor del instituto'),
(3, 'Estudiante', 'Alumno matriculado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `id_turno` int(11) NOT NULL,
  `nombre_turno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id_turno`, `nombre_turno`) VALUES
(1, 'Matutino'),
(2, 'Vespertino'),
(3, 'Nocturno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `cedula`, `email`, `contrasena`, `id_rol`) VALUES
(1, 'María', 'González', '12345678', 'maria@instituto.edu.uy', '$2y$10$1iij6THLthJZpCI94TuoVOutBeTWANIkMbPVi78qqAr.d7/D1xJA2', 1),
(2, 'Carlos', 'Rodríguez', '23456789', 'carlos@instituto.edu.uy', '$2y$10$dfcOEoUmv4CkgUEPGwvIVeRnrb.Li5bLNhiVYFm.EmJFEbml8AsCa', 2),
(3, 'Ana', 'Martínez', '34567890', 'ana@instituto.edu.uy', 'pass789', 3),
(4, 'Facundo', 'Rubil', '12344567', 'facundorubil@gmail.com', '$2y$10$4LUxCakyMcYLc3WLNwDfqulgz8MdG2BUuCuz6nzGFkJodRPI5cjQ6', 2),
(8, 'Valentino', 'Grampin', '12344569', 'valegrampin@gmail.com', '$2y$10$26z/4LZHPh.WgIk30pmsyu3olTemOQ5DvjUewLc4wgYZouOaRNZ2O', 2),
(10, 'vale', 'grampin', '46728396', 'valeegrampin@gmail.com', '$2y$10$1rmRgoWePpNq6XAQUrzSYeM.rXefjEO..aMhz9y6jZ8/8kDIRcz..', NULL),
(11, 'valentino', 'grampin', '46728332', 'valentinogrampin@gmail.com', '$2y$10$yl5u9m5fe7jvnCQQxf0aBOxboimS4GySFiA7TjKGW2sdM0hLivDsa', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asignatura`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `curso_horario`
--
ALTER TABLE `curso_horario`
  ADD PRIMARY KEY (`id_curso`,`id_horario`),
  ADD KEY `id_horario` (`id_horario`);

--
-- Indices de la tabla `espacio`
--
ALTER TABLE `espacio`
  ADD PRIMARY KEY (`id_espacio`);

--
-- Indices de la tabla `estudiante_grupo`
--
ALTER TABLE `estudiante_grupo`
  ADD PRIMARY KEY (`id_usuario`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_turno` (`id_turno`);

--
-- Indices de la tabla `grupo_asignatura`
--
ALTER TABLE `grupo_asignatura`
  ADD PRIMARY KEY (`id_grupo`,`id_asignatura`,`id_docente`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `id_docente` (`id_docente`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `horario_grupo_asignatura`
--
ALTER TABLE `horario_grupo_asignatura`
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `horario_grupo_asignatura_ibfk_2` (`id_horario`);

--
-- Indices de la tabla `informe`
--
ALTER TABLE `informe`
  ADD PRIMARY KEY (`id_informe`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `recurso`
--
ALTER TABLE `recurso`
  ADD PRIMARY KEY (`id_recurso`),
  ADD KEY `id_espacio` (`id_espacio`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_aprobador` (`id_aprobador`),
  ADD KEY `id_espacio` (`id_espacio`);

--
-- Indices de la tabla `reserva_recurso`
--
ALTER TABLE `reserva_recurso`
  ADD PRIMARY KEY (`id_reserva`,`id_recurso`),
  ADD KEY `id_recurso` (`id_recurso`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id_turno`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `espacio`
--
ALTER TABLE `espacio`
  MODIFY `id_espacio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `informe`
--
ALTER TABLE `informe`
  MODIFY `id_informe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recurso`
--
ALTER TABLE `recurso`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `asignatura_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Filtros para la tabla `curso_horario`
--
ALTER TABLE `curso_horario`
  ADD CONSTRAINT `curso_horario_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_horario_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `estudiante_grupo`
--
ALTER TABLE `estudiante_grupo`
  ADD CONSTRAINT `estudiante_grupo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `estudiante_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`);

--
-- Filtros para la tabla `grupo_asignatura`
--
ALTER TABLE `grupo_asignatura`
  ADD CONSTRAINT `grupo_asignatura_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `grupo_asignatura_ibfk_2` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `grupo_asignatura_ibfk_3` FOREIGN KEY (`id_docente`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `horario_grupo_asignatura`
--
ALTER TABLE `horario_grupo_asignatura`
  ADD CONSTRAINT `horario_grupo_asignatura_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `horario_grupo_asignatura_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `informe`
--
ALTER TABLE `informe`
  ADD CONSTRAINT `informe_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `recurso`
--
ALTER TABLE `recurso`
  ADD CONSTRAINT `recurso_ibfk_1` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id_espacio`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_aprobador`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id_espacio`);

--
-- Filtros para la tabla `reserva_recurso`
--
ALTER TABLE `reserva_recurso`
  ADD CONSTRAINT `reserva_recurso_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`),
  ADD CONSTRAINT `reserva_recurso_ibfk_2` FOREIGN KEY (`id_recurso`) REFERENCES `recurso` (`id_recurso`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_