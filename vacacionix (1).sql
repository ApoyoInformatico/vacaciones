-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2024 a las 11:52:25
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
  `id` int(11) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contrasena` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `dias` varchar(50) DEFAULT NULL,
  `token` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `dni`, `nombre`, `apellidos`, `email`, `contrasena`, `telefono`, `dias`, `token`) VALUES
(2, '98765432B', 'María', 'López', 'maria@example.com', '81dc9bdb52d04dc20036dbd8313ed055', '987654321', '22', '0'),
(3, '45678912C', 'Pedro', 'Martínez', 'pedro@example.com', '81dc9bdb52d04dc20036dbd8313ed055', '456789123', '22', '0'),
(4, '78912345D', 'Ana', 'SÃ¡nchez', 'ana@example.com', '81dc9bdb52d04dc20036dbd8313ed055', '789123456', '22', '0'),
(5, '32165498E', 'Luis', 'Rodríguez', 'luis@example.com', '4d186321c1a7f0f354b297e8914ab240', '321654987', '22', '0'),
(6, '65432178F', 'Laura', 'Fernández', 'laura@example.com', '81dc9bdb52d04dc20036dbd8313ed055', '654321789', '22', '0'),
(7, '98712365G', 'Sergio', 'GÃ³mez', 'sergio@example.com', '81dc9bdb52d04dc20036dbd8313ed055', '987123655', '22', '0'),
(8, '15935785H', 'Elena', 'DÃ­az', 'elena@example.com', '81dc9bdb52d04dc20036dbd8313ed055', '159357852', '22', '0'),
(11, 'Y8018076Z', 'HUMBERTO', 'DELLA SALA', 'HDELLASALA@GMAIL.COM', '81dc9bdb52d04dc20036dbd8313ed055', '622475216', '22', '0'),
(12, '17552572F', 'Humberto', 'Delgado', 'info@apoyoinformatico.com', '81dc9bdb52d04dc20036dbd8313ed055', '677112602', '22', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `dni` varchar(10) NOT NULL,
  `FechasReservadas` varchar(255) DEFAULT NULL,
  `diasUsados` decimal(2,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `vacaciones`
--

INSERT INTO `vacaciones` (`dni`, `FechasReservadas`, `diasUsados`) VALUES
('17552572F', '1/11/2024,2/11/2024,9/11/2024,8/11/2024,15/11/2024,16/11/2024,23/11/2024,22/11/2024,29/11/2024,30/11/2024', 10),
('78912345D', '22/2/2024,21/2/2024,20/2/2024,19/2/2024,28/1/2024,27/1/2024,26/1/2024,24/1/2024,23/1/2024,22/1/2024,5/8/2024,6/8/2024,7/8/2024,8/8/2024,9/8/2024,16/8/2024,15/8/2024,14/8/2024,13/8/2024,12/8/2024,19/8/2024,20/8/2024', 22),
('Y8018076Z', '8/2/2024,7/2/2024,6/2/2024,5/2/2024', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`,`token`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
