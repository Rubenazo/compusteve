-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2018 a las 04:42:00
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemaexperto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(10) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `solucion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`, `solucion`) VALUES
(1, 'tiene patas', 0),
(2, 'tiene alas', 0),
(3, 'vive en el mar', 0),
(4, 'gallina', 1),
(5, 'perro', 1),
(6, 'delfin', 1),
(7, 'serpiente', 1),
(8, 'es un mamifero', 0),
(9, 'murcielago', 1),
(10, 'tiene bigotes', 0),
(11, 'gato', 1),
(12, 'tiene tentaculos', 0),
(13, 'pulpo', 1),
(14, 'es salvaje', 0),
(15, 'oso', 1),
(16, 'es carnivoro', 0),
(17, 'leon', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(10) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `pregunta` int(10) NOT NULL,
  `siguiente` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `respuesta`, `pregunta`, `siguiente`) VALUES
(1, 'si', 1, 2),
(2, 'no', 1, 3),
(3, 'si', 2, 8),
(4, 'no', 2, 10),
(5, 'si', 3, 12),
(6, 'no', 3, 7),
(7, 'si', 8, 9),
(8, 'no', 8, 4),
(9, 'si', 10, 16),
(10, 'no', 10, 14),
(11, 'si', 12, 13),
(12, 'no', 12, 6),
(13, 'si', 14, 15),
(14, 'no', 14, 5),
(15, 'si', 16, 17),
(16, 'no', 16, 11);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pregunta` (`pregunta`),
  ADD KEY `siguiente` (`siguiente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`pregunta`) REFERENCES `preguntas` (`id`),
  ADD CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`siguiente`) REFERENCES `preguntas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
