-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-10-2024 a las 00:18:13
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
-- Base de datos: `uptask_mvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `proyecto` varchar(60) DEFAULT NULL,
  `url` varchar(32) DEFAULT NULL,
  `propietarioId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `proyecto`, `url`, `propietarioId`) VALUES
(1, ' Tienda virtual de Ropa', 'e4e287ec47213dbc45f3ff9226d4b55a', 10),
(2, ' Tienda virtual de autos', '5029225eb980847492c665b74bbe8625', 10),
(3, ' Tienda de telefonos', 'db0a483a6518c6068afd8c9b8335788c', 10),
(4, ' Tienda de tv', '451f1edbaffaa14f053a4557c722326b', 10),
(5, ' Terminar web personal', '9ed93f9e8ceb2bf50b527d66ad907550', 10),
(6, ' Crear portafolio de proyectos', '993b52566f83ee8cfd604921e3617ee1', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `proyectoId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `nombre`, `estado`, `proyectoId`) VALUES
(4, 'Buscar socios mayoritarios', 1, 1),
(6, ' Mandar 3 paquetes de hoddies a la misma direccion', 1, 1),
(7, ' Comprar otra maquina de sublimacion', 1, 1),
(14, ' Mejorar el Fronted', 1, 1),
(15, ' Trabajar con la ropa que salio defectuosa', 1, 1),
(16, ' Mejorar el VirtualDOM', 1, 1),
(17, ' Comprar otra maquina de sublimacion para gorras', 1, 1),
(18, 'Comprar otra maquina de sublimacion', 1, 1),
(19, ' Comprar otra maquina de sublimacion para gatos', 1, 1),
(20, ' Buscar socios1', 1, 1),
(21, 'Mandar 3 paquetes de hoddies a la misma direccion', 1, 1),
(29, ' Conseguir mas tela verde', 1, 1),
(30, ' meter estilos css', 0, 5),
(31, ' publicar el portafolios', 0, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `token` varchar(15) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `token`, `confirmado`) VALUES
(10, ' Miguel Angel', 'correo@gmail.com', '$2y$10$joq.3kbdNQu.Rp3e3c0SHe8Q330OIf9j6NG1MopXWKNBxBennKxXO', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propietarioId_FK` (`propietarioId`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyectoId_FK` (`proyectoId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `propietarioId_FK` FOREIGN KEY (`propietarioId`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `proyectoId_FK` FOREIGN KEY (`proyectoId`) REFERENCES `proyectos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
