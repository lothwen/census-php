-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-11-2013 a las 13:59:35
-- Versión del servidor: 5.1.72
-- Versión de PHP: 5.3.3-7+squeeze17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `census_euskai`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadChaval`
--

CREATE TABLE IF NOT EXISTS `actividadChaval` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COD_ACTIVIDAD` int(11) NOT NULL,
  `COD_CHAVAL` int(11) NOT NULL,
  `NUM_ACOM` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `COD_ACTIVIDAD` (`COD_ACTIVIDAD`),
  KEY `COD_CHAVAL` (`COD_CHAVAL`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(255) NOT NULL,
  `FECHA` date DEFAULT NULL,
  `ACONPANANTES` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `censo`
--

CREATE TABLE IF NOT EXISTS `censo` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(255) NOT NULL DEFAULT '',
  `APELLIDOS` varchar(255) NOT NULL DEFAULT '',
  `RAMA` smallint(5) unsigned NOT NULL DEFAULT '0',
  `DIRECCION` varchar(255) NOT NULL DEFAULT '',
  `MUNICIPIO` varchar(20) NOT NULL DEFAULT 'Sestao',
  `CODIGO_POSTAL` int(5) NOT NULL,
  `PROVINCIA` varchar(100) NOT NULL,
  `DNI` varchar(255) DEFAULT NULL,
  `FECHA_NACIMIENTO` date DEFAULT NULL,
  `AMA` varchar(255) DEFAULT NULL,
  `DNI_AMA` varchar(10) DEFAULT NULL,
  `AITA` varchar(255) DEFAULT NULL,
  `DNI_AITA` varchar(10) DEFAULT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `TELEFONO1` varchar(10) NOT NULL DEFAULT '',
  `TELEFONO2` varchar(10) DEFAULT NULL,
  `OBSERVACIONES` text NOT NULL,
  `ULT_FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FECHA_ALTA` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `economia_IngresosGastos`
--

CREATE TABLE IF NOT EXISTS `economia_IngresosGastos` (
  `COD_LINEA` int(11) NOT NULL AUTO_INCREMENT,
  `COD_PRESUPUESTO` int(11) NOT NULL,
  `COD_PARTIDA` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `CONCEPTO` varchar(200) NOT NULL,
  `IMPORTE` float(10,2) NOT NULL,
  `TIPO` tinyint(1) NOT NULL,
  `PENDIENTE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`COD_LINEA`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Lineas de ingresos y gastos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `economia_Partidas`
--

CREATE TABLE IF NOT EXISTS `economia_Partidas` (
  `COD_PARTIDA` int(11) NOT NULL AUTO_INCREMENT,
  `COD_PRESUPUESTO` int(11) NOT NULL,
  `NOMBRE` varchar(200) NOT NULL,
  `IMPORTE` float(10,2) NOT NULL,
  `TIPO` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`COD_PARTIDA`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `economia_Presupuestos`
--

CREATE TABLE IF NOT EXISTS `economia_Presupuestos` (
  `COD_PRESUPUESTO` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(200) NOT NULL,
  `FECHA_INICIO` date NOT NULL,
  `FECHA_FINAL` date NOT NULL,
  `FECHA_ALTA` datetime NOT NULL,
  PRIMARY KEY (`COD_PRESUPUESTO`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE IF NOT EXISTS `notas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(255) NOT NULL,
  `CONTENIDO` text NOT NULL,
  `CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfilGrupo`
--

CREATE TABLE IF NOT EXISTS `perfilGrupo` (
  `COD_GRUPO` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `DIRECCION` varchar(255) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `WEB` varchar(50) NOT NULL,
  `THEME` varchar(50) NOT NULL DEFAULT 'default',
  `MAX_FILAS` int(11) NOT NULL DEFAULT '10'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Ficha de grupo y configuracion';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ramas`
--

CREATE TABLE IF NOT EXISTS `ramas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `ramas`
-- 

INSERT INTO `ramas` (`ID`, `NOMBRE`) VALUES 
(1, 'Koskorrak'),
(2, 'Kaskondoak'),
(3, 'Oinarinak'),
(4, 'Azkarrak'),
(5, 'Trebeak'),
(6, 'Arduradunak'),
(7, 'Antiguos'),
(8, 'Asabak');

