-- -------------------------------------------------------------
-- -------------------------------------------------------------
-- TablePlus 1.2.0
--
-- https://tableplus.com/
--
-- Database: mysql
-- Generation Time: 2024-10-10 23:52:51.848882
-- -------------------------------------------------------------

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto` varchar(60) DEFAULT NULL,
  `url` varchar(32) DEFAULT NULL,
  `propietarioId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `propietarioId_FK` (`propietarioId`),
  CONSTRAINT `propietarioId_FK` FOREIGN KEY (`propietarioId`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `proyectoId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proyectoId_FK` (`proyectoId`),
  CONSTRAINT `proyectoId_FK` FOREIGN KEY (`proyectoId`) REFERENCES `proyectos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `token` varchar(15) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `uptask_mvc`.`proyectos` (`id`, `proyecto`, `url`, `propietarioId`) VALUES 
(1, ' Tienda virtual de Ropa', 'e4e287ec47213dbc45f3ff9226d4b55a', NULL),
(2, ' Tienda virtual de autos', '5029225eb980847492c665b74bbe8625', NULL),
(3, ' Tienda de telefonos', 'db0a483a6518c6068afd8c9b8335788c', NULL),
(4, ' Tienda de tv', '451f1edbaffaa14f053a4557c722326b', NULL),
(5, ' Terminar web personal', '9ed93f9e8ceb2bf50b527d66ad907550', 10),
(6, ' Crear portafolio de proyectos', '993b52566f83ee8cfd604921e3617ee1', 10);

INSERT INTO `uptask_mvc`.`tareas` (`id`, `nombre`, `estado`, `proyectoId`) VALUES 
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

INSERT INTO `uptask_mvc`.`usuarios` (`id`, `nombre`, `email`, `password`, `token`, `confirmado`) VALUES (10, ' Miguel Angel', 'correo@gmail.com', '$2y$10$joq.3kbdNQu.Rp3e3c0SHe8Q330OIf9j6NG1MopXWKNBxBennKxXO', '', 1);

