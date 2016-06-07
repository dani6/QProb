drop database if exists qprob;
create database qprob 
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
use qprob;

CREATE TABLE `departamento` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `nombre_unique` (`NOMBRE`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `categoria` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `edificio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `planta` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NUMERO` int(4) NOT NULL,
  `id_edificio` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NUMERO` (`NUMERO`,`id_edificio`),
  KEY `id_edificio` (`id_edificio`),
  CONSTRAINT `rel_edificio_planta` FOREIGN KEY (`id_edificio`) REFERENCES `edificio` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `aula` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aula` varchar(50) NOT NULL DEFAULT '',
  `id_planta` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aula` (`aula`,`id_planta`),
  KEY `rel_aula_planta` (`id_planta`),
  CONSTRAINT `rel_aula_planta` FOREIGN KEY (`id_planta`) REFERENCES `planta` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `usuario` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) NOT NULL,
  `APELLIDOS` varchar(20) NOT NULL,
  `EMAIL` varchar(60) NOT NULL DEFAULT '',
  `TLF` int(9) NOT NULL,
  `USER` varchar(50) NOT NULL,
  `PASS` varchar(50) NOT NULL,
  `VALIDO` tinyint(1) NOT NULL DEFAULT '0',
  `TIPO` enum('NORMAL','TECHNICAL','SPECIAL','ADMIN') NOT NULL DEFAULT 'NORMAL',
  `id_departamento` int(11) unsigned NOT NULL,
  `IDIOMA` enum('ES','EN') NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Email` (`EMAIL`),
  UNIQUE KEY `user_unique` (`USER`),
  UNIQUE KEY `email_unique` (`EMAIL`),
  KEY `departamento_usuario` (`id_departamento`),
  CONSTRAINT `departamento_usuario` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `incidencia` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ESTADO` enum('ABIERTA','RESUELTA','EN CURSO') NOT NULL DEFAULT 'ABIERTA',
  `FECHA` date NOT NULL,
  `TITULO` varchar(40) NOT NULL DEFAULT '',
  `DESCRIPCION` text,
  `TIPO` enum('URGENTE','TIC','GENERAL') NOT NULL DEFAULT 'GENERAL',
  `id_departamento` int(11) unsigned NOT NULL,
  `id_usuario` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_departamento` (`id_departamento`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `departamento_incidencias` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `usuario_incidencia` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `revision` (
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario` int(11) unsigned NOT NULL,
  `id_incidencia` int(11) unsigned NOT NULL,
  `OBSERVACION` text NOT NULL,
  `PRESUPUESTO` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`FECHA`,`id_usuario`,`id_incidencia`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_incidencia` (`id_incidencia`),
  CONSTRAINT `incidecia_revision` FOREIGN KEY (`id_incidencia`) REFERENCES `incidencia` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `usuario_revision` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `rel_aula_incidencia` (
  `id_aula` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_incidencia` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_aula`,`id_incidencia`),
  UNIQUE KEY `id_incidencia` (`id_incidencia`,`id_aula`),
  CONSTRAINT `rel_aula_incidencia` FOREIGN KEY (`id_aula`) REFERENCES `aula` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rel_incidencia_aula` FOREIGN KEY (`id_incidencia`) REFERENCES `incidencia` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `rel_categoria_incidencia` (
  `id_incidencia` int(11) unsigned NOT NULL,
  `id_categoria` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_incidencia`,`id_categoria`),
  KEY `rel_categoria_incidencia` (`id_categoria`),
  CONSTRAINT `rel_categoria_incidencia` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `rel_incidencia_categoria` FOREIGN KEY (`id_incidencia`) REFERENCES `incidencia` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `edificio` (`id`, `NOMBRE`) VALUES
(2, 'BACH'),
(1, 'ESO');

INSERT INTO `planta` (`id`, `NUMERO`, `id_edificio`) VALUES
(1, 0, 1),
(5, 0, 2),
(2, 1, 1),
(6, 1, 2),
(3, 2, 1),
(7, 2, 2),
(4, 3, 1);

INSERT INTO `departamento` (`ID`, `NOMBRE`) VALUES
(34, 'Biología y Geología'),
(37, 'Dibujo'),
(23, 'Educación Física'),
(22, 'Educación Social'),
(29, 'Filosofía'),
(28, 'Física y Química'),
(32, 'FOL'),
(30, 'Francés'),
(33, 'Historia'),
(31, 'Hostelería y Turismo'),
(36, 'Informática'),
(24, 'Inglés'),
(26, 'Lengua'),
(25, 'Matemáticas'),
(21, 'Orientación'),
(27, 'Peluquería'),
(20, 'Tecnología');

INSERT INTO `categoria` (`ID`, `NOMBRE`) VALUES
(3, 'Hardware'),
(2, 'Software');

INSERT INTO `aula` (`id`, `aula`, `id_planta`) VALUES
(32, '1ºA', 2),
(110, '1ºA', 5),
(30, '1ºB', 2),
(109, '1ºB', 5),
(31, '1ºC', 2),
(132, '1ºC', 6),
(34, '1ºD', 2),
(107, '1ºD', 5),
(27, '1ºE', 2),
(133, '1ºE', 6),
(131, '1ºF', 6),
(130, '1ºG', 6),
(126, '1ºH', 6),
(28, '2ºA', 2),
(39, '2ºA', 7),
(29, '2ºB', 2),
(41, '2ºB', 7),
(49, '2ºC', 3),
(40, '2ºC', 7),
(51, '2ºD', 3),
(38, '2ºD', 7),
(124, '2ºE', 6),
(35, '2ºF', 7),
(48, '3ºA', 3),
(47, '3ºB', 3),
(44, '3ºC', 3),
(43, '3ºD', 3),
(46, '3ºE', 3),
(62, '4ºA', 4),
(57, '4ºB', 4),
(59, '4ºC', 4),
(60, '4ºD', 4),
(6, 'Almacén Teconología', 1),
(113, 'Alojamiento, hostelería y turismo', 6),
(98, 'Archivo de secretaría', 5),
(1, 'Aula de cocina', 1),
(12, 'Aula de estudios', 1),
(13, 'Aula de intercambio', 1),
(53, 'Aula de proyección 1', 4),
(55, 'Aula de proyección 2', 4),
(108, 'Aula teoría ciclos formativos', 5),
(105, 'Biblioteca', 5),
(3, 'Cafetería', 1),
(5, 'Cocina', 1),
(14, 'Consejería', 1),
(101, 'Consejería', 5),
(26, 'Desdoble 1', 2),
(45, 'Desdoble 2', 3),
(52, 'Desdoble 3', 3),
(54, 'Desdoble 4', 4),
(58, 'Desdoble 5', 4),
(56, 'Desdoble 6', 4),
(36, 'Desdoble 7', 7),
(99, 'Despacho secretario', 5),
(18, 'Dirección', 1),
(129, 'DTO Biología y Geología', 6),
(4, 'DTO cocina PCPI', 1),
(37, 'DTO Dibujo', 7),
(19, 'DTO Educación física', 1),
(15, 'DTO Educación social', 1),
(118, 'DTO Filosofía', 6),
(117, 'DTO Física y Química', 6),
(123, 'DTO FOL', 6),
(120, 'DTO Francés', 6),
(125, 'DTO Historia', 6),
(122, 'DTO Hostelería y turismo', 6),
(116, 'DTO Informática 1', 6),
(121, 'DTO Informática 2', 6),
(25, 'DTO Inglés', 2),
(115, 'DTO Latín', 6),
(50, 'DTO Lengua', 3),
(33, 'DTO Matemáticas', 2),
(23, 'DTO orientación', 1),
(97, 'DTO Peluquería', 5),
(7, 'DTO Tecnología', 1),
(10, 'Educación especial', 1),
(11, 'Educador social', 1),
(21, 'Gimnasio', 1),
(111, 'Informática 1', 6),
(112, 'Informática 2', 6),
(128, 'Informática 3', 6),
(16, 'Jefe de estudios', 1),
(127, 'Laboratorio de ciencias', 6),
(119, 'Laboratorio de física', 6),
(8, 'Música', 1),
(103, 'Nuevo taller estética', 5),
(20, 'Sala de profesores', 1),
(24, 'Salón de actos', 2),
(104, 'Sauna', 5),
(100, 'Secretaría y administración', 5),
(96, 'Taller de estética 1', 5),
(106, 'Taller de estética 2', 5),
(95, 'Taller peluquería 1', 5),
(102, 'Taller peluquería 2', 5),
(22, 'Taller tecnología', 1),
(61, 'Teoría FPB', 4),
(17, 'TIC 1', 1),
(114, 'TIC 2', 6);