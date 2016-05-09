CREATE TABLE `DEPARTAMENTO` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `nombre_unique` (`NOMBRE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

CREATE TABLE `CATEGORIA` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `EDIFICIO` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `NOMBRE` (`NOMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `PLANTA` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NUMERO` int(4) NOT NULL,
  `id_edificio` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NUMERO` (`NUMERO`,`id_edificio`),
  KEY `id_edificio` (`id_edificio`),
  CONSTRAINT `rel_edificio_planta` FOREIGN KEY (`id_edificio`) REFERENCES `EDIFICIO` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `AULA` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `AULA` varchar(20) NOT NULL DEFAULT '',
  `id_planta` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `AULA` (`AULA`,`id_planta`),
  KEY `rel_aula_planta` (`id_planta`),
  CONSTRAINT `rel_aula_planta` FOREIGN KEY (`id_planta`) REFERENCES `PLANTA` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `USUARIO` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(20) NOT NULL,
  `APELLIDOS` varchar(20) NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
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
  CONSTRAINT `departamento_usuario` FOREIGN KEY (`id_departamento`) REFERENCES `DEPARTAMENTO` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `INCIDENCIA` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ESTADO` enum('ABIERTA','RESUELTA','EN CURSO') NOT NULL DEFAULT 'ABIERTA',
  `FECHA` date NOT NULL,
  `TITULO` varchar(40) NOT NULL DEFAULT '',
  `DESCRIPCION` text,
  `TIPO` enum('URGENTE','TIC','GENERAL') NOT NULL DEFAULT 'GENERAL',
  `id_Departamento` int(11) unsigned NOT NULL,
  `id_Usuario` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_Departamento` (`id_Departamento`),
  KEY `id_Usuario` (`id_Usuario`),
  CONSTRAINT `departamento_incidencias` FOREIGN KEY (`id_Departamento`) REFERENCES `DEPARTAMENTO` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `usuario_incidencia` FOREIGN KEY (`id_Usuario`) REFERENCES `USUARIO` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `REVISION` (
  `HORA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FECHA` date NOT NULL,
  `id_Usuario` int(11) unsigned NOT NULL,
  `id_Incidencia` int(11) unsigned NOT NULL,
  `OBSERVACION` text NOT NULL,
  `PRESUPUESTO` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`HORA`,`FECHA`,`id_Usuario`,`id_Incidencia`),
  KEY `id_Usuario` (`id_Usuario`),
  KEY `id_Incidencia` (`id_Incidencia`),
  CONSTRAINT `incidecia_revision` FOREIGN KEY (`id_Incidencia`) REFERENCES `INCIDENCIA` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `usuario_revision` FOREIGN KEY (`id_Usuario`) REFERENCES `USUARIO` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `REL_AULA_INCIDENCIA` (
  `id_aula` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_incidencia` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_aula`,`id_incidencia`),
  UNIQUE KEY `id_incidencia` (`id_incidencia`,`id_aula`),
  CONSTRAINT `rel_aula_incidencia` FOREIGN KEY (`id_aula`) REFERENCES `AULA` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rel_incidencia_aula` FOREIGN KEY (`id_incidencia`) REFERENCES `INCIDENCIA` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `REL_CATEGORIA_INCIDENCIA` (
  `id_incidencia` int(11) unsigned NOT NULL,
  `id_categoria` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_incidencia`,`id_categoria`),
  KEY `rel_categoria_incidencia` (`id_categoria`),
  CONSTRAINT `rel_categoria_incidencia` FOREIGN KEY (`id_categoria`) REFERENCES `CATEGORIA` (`ID`) ON DELETE CASCADE,
  CONSTRAINT `rel_incidencia_categoria` FOREIGN KEY (`id_incidencia`) REFERENCES `INCIDENCIA` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `LOG` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FECHA` date NOT NULL,
  `HORA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_Usuario` int(11) unsigned NOT NULL,
  `DESCRIPCION` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`FECHA`,`HORA`,`id_Usuario`),
  KEY `usuario` (`id_Usuario`),
  CONSTRAINT `usuario_log` FOREIGN KEY (`id_Usuario`) REFERENCES `USUARIO` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
