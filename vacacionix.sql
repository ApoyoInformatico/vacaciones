-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2023 a las 07:26:43
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vacacionix`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(6) UNSIGNED NOT NULL,
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contrasena` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `dias` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `dni`, `email`, `contrasena`, `telefono`, `reg_date`) VALUES
(1, 'María', 'López', NULL, 'maria@example.com', 'abcdef', '555-5678', '2023-06-25 20:25:00'),
(2, 'Pedro', 'García', NULL, 'pedro@example.com', 'qwerty', '555-9012', '2023-06-25 20:25:00'),
(3, 'Laura', 'Rodríguez', NULL, 'laura@example.com', 'zxcvbn', '555-3456', '2023-06-25 20:25:00'),
(4, 'Carlos', 'Martínez', NULL, 'carlos@example.com', 'poiuyt', '555-7890', '2023-06-25 20:25:00'),
(5, 'Ana', 'Hernández', NULL, 'ana@example.com', 'mnbvcx', '555-2345', '2023-06-25 20:25:00'),
(6, 'Luis', 'González', NULL, 'luis@example.com', 'asdfgh', '555-6789', '2023-06-25 20:25:00'),
(7, 'Sofía', 'Sánchez', NULL, 'sofia@example.com', 'lkjhgf', '555-0123', '2023-06-25 20:25:00'),
(8, 'Daniel', 'Ramírez', NULL, 'daniel@example.com', 'yuiop', '555-4567', '2023-06-25 20:25:00'),
(9, 'Patricia', 'Torres', NULL, 'patricia@example.com', 'xcvbnm', '555-8901', '2023-06-25 20:25:00'),
(10, 'Humberto', 'Della Sala Delgado', NULL, 'hdellasala@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '677112602', '2023-06-25 20:47:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unico` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
