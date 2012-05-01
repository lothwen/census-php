-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-13
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generació17-11-2009 a las 14:27:56
-- Versióel servidor: 5.0.32
-- Versióe PHP: 5.2.0-8+etch15
-- 
-- Base de datos: `census_euskai`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `actividadChaval`
-- 

CREATE TABLE `actividadChaval` (
  `ID` int(11) NOT NULL auto_increment,
  `COD_ACTIVIDAD` int(11) NOT NULL,
  `COD_CHAVAL` int(11) NOT NULL,
  `NUM_ACOM` int(11) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `COD_ACTIVIDAD` (`COD_ACTIVIDAD`),
  KEY `COD_CHAVAL` (`COD_CHAVAL`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `actividades`
-- 

CREATE TABLE `actividades` (
  `ID` int(11) NOT NULL auto_increment,
  `NOMBRE` varchar(255) NOT NULL,
  `FECHA` date default NULL,
  `ACONPANANTES` tinyint(1) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `censo`
-- 

CREATE TABLE `censo` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `NOMBRE` varchar(255) NOT NULL default '',
  `APELLIDOS` varchar(255) NOT NULL default '',
  `RAMA` smallint(5) unsigned NOT NULL default '0',
  `DIRECCION` varchar(255) NOT NULL default '',
  `PUEBLO` varchar(20) NOT NULL default 'Sestao',
  `DNI` varchar(255) default NULL,
  `AMA` varchar(255) default NULL,
  `DNI_AMA` varchar(10) default NULL,
  `AITA` varchar(255) default NULL,
  `DNI_AITA` varchar(10) default NULL,
  `EMAIL` varchar(50) NOT NULL,
  `TELEFONO` varchar(10) NOT NULL default '',
  `MOVIL` varchar(10) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=145 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `economia_IngresosGastos`
-- 

CREATE TABLE `economia_IngresosGastos` (
  `COD_LINEA` int(11) NOT NULL auto_increment,
  `COD_PRESUPUESTO` int(11) NOT NULL,
  `COD_PARTIDA` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `CONCEPTO` varchar(200) NOT NULL,
  `IMPORTE` float(10,2) NOT NULL,
  `TIPO` tinyint(1) NOT NULL,
  `PENDIENTE` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`COD_LINEA`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Lineas de ingresos y gastos' AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `economia_Partidas`
-- 

CREATE TABLE `economia_Partidas` (
  `COD_PARTIDA` int(11) NOT NULL auto_increment,
  `COD_PRESUPUESTO` int(11) NOT NULL,
  `NOMBRE` varchar(200) NOT NULL,
  `IMPORTE` float(10,2) NOT NULL,
  `TIPO` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`COD_PARTIDA`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `economia_Presupuestos`
-- 

CREATE TABLE `economia_Presupuestos` (
  `COD_PRESUPUESTO` int(11) NOT NULL auto_increment,
  `NOMBRE` varchar(200) NOT NULL,
  `FECHA_INICIO` date NOT NULL,
  `FECHA_FINAL` date NOT NULL,
  `FECHA_ALTA` datetime NOT NULL,
  PRIMARY KEY  (`COD_PRESUPUESTO`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `perfilGrupo`
-- 

CREATE TABLE `perfilGrupo` (
  `COD_GRUPO` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `DIRECCION` varchar(255) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `WEB` varchar(50) NOT NULL,
  `THEME` varchar(50) NOT NULL default 'default',
  `MAX_FILAS` int(11) NOT NULL default '10'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Ficha de grupo y configuracion';

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ramas`
-- 

CREATE TABLE `ramas` (
  `ID` int(11) NOT NULL auto_increment,
  `NOMBRE` varchar(255) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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

