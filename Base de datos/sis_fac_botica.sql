-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-11-2021 a las 21:48:06
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sis_fac_botica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id_asistencia` int(10) NOT NULL AUTO_INCREMENT,
  `unico` varchar(25) NOT NULL,
  `user_id` int(10) NOT NULL,
  `hora_entrada` time NOT NULL,
  `fecha_entrada` date NOT NULL,
  `hora_base` time NOT NULL,
  `hora_salida` time NOT NULL,
  `fecha_salida` date NOT NULL,
  `min_tardanza` time NOT NULL,
  `asistencia` int(2) NOT NULL,
  PRIMARY KEY (`id_asistencia`),
  UNIQUE KEY `unico` (`unico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `baja_sunat`
--

DROP TABLE IF EXISTS `baja_sunat`;
CREATE TABLE IF NOT EXISTS `baja_sunat` (
  `id_baja` int(10) NOT NULL AUTO_INCREMENT,
  `id_doc1` int(10) NOT NULL,
  `numero` varchar(8) NOT NULL,
  `fecha` date NOT NULL,
  `aceptado_baja` varchar(100) NOT NULL,
  `xml` varchar(30) NOT NULL,
  `ticket` varchar(20) NOT NULL,
  `has_cpe` varchar(100) NOT NULL,
  `cod_sunat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_baja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

DROP TABLE IF EXISTS `caja`;
CREATE TABLE IF NOT EXISTS `caja` (
  `id_caja` int(10) NOT NULL AUTO_INCREMENT,
  `usuario_inicio` int(3) NOT NULL,
  `fec_reg` datetime NOT NULL,
  `fecha` date NOT NULL,
  `inicio` decimal(10,2) NOT NULL,
  `cierre` decimal(10,2) NOT NULL,
  `tienda` int(2) NOT NULL,
  `usuario_cierre` int(3) NOT NULL,
  `faltante` decimal(10,2) NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `entrada` decimal(10,2) NOT NULL,
  `salida` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_caja`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `usuario_inicio`, `fec_reg`, `fecha`, `inicio`, `cierre`, `tienda`, `usuario_cierre`, `faltante`, `fecha_cierre`, `entrada`, `salida`) VALUES
(1, 1, '2021-10-24 04:00:59', '2021-10-24', '20.00', '95.40', 1, 1, '0.00', '2021-10-25 01:28:20', '75.40', '0.00'),
(2, 1, '2021-10-25 01:28:31', '2021-10-25', '30.00', '30.00', 1, 1, '0.00', '2021-10-25 13:42:43', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
  `id_carrito` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `clave` varchar(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `cantidad` double NOT NULL,
  `precio` double NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_carrito`)
) ENGINE=InnoDB AUTO_INCREMENT=604 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `clave`, `id_usuario`, `id_producto`, `cantidad`, `precio`, `fecha`) VALUES
(582, '6260d432', 0, 11408, 1, 20, '2020-08-05 12:27:39'),
(583, '3458e0e8', 0, 11424, 5, 17, '2020-08-07 19:12:32'),
(584, '3458e0e8', 0, 11423, 1, 18, '2020-08-07 19:12:22'),
(585, 'a7e4a18d', 0, 11411, 1, 17, '2020-08-13 09:04:49'),
(586, '5d788261', 0, 11402, 1, 20.8, '2020-08-30 14:45:14'),
(587, '45e1bacc', 0, 11575, 2, 14, '2020-09-07 00:03:11'),
(588, '5cb211a5', 0, 11408, 1, 20, '2020-09-09 00:17:22'),
(589, '5cb211a5', 0, 11506, 2, 14, '2020-09-09 00:19:39'),
(590, '08a0cc7c', 0, 11581, 1, 29, '2020-09-12 23:27:09'),
(591, 'e55659c4', 0, 11581, 1, 29, '2020-09-12 23:27:18'),
(592, '14d8261a', 0, 11581, 1, 29, '2020-09-12 23:27:28'),
(593, 'f8b0a31d', 0, 11581, 1, 15000, '2020-09-14 21:55:00'),
(594, '61154cd7', 0, 11408, 1, 25, '2020-09-18 10:08:27'),
(595, '197d3185', 0, 11408, 2, 25, '2020-09-18 10:09:01'),
(596, '197d3185', 0, 11418, 1, 16, '2020-09-18 10:09:07'),
(597, '197d3185', 0, 11417, 1, 18, '2020-09-18 10:09:13'),
(598, '197d3185', 0, 11424, 1, 17, '2020-09-18 10:09:42'),
(599, '8252516b', 0, 11423, 2, 18, '2020-09-22 09:09:42'),
(600, '8252516b', 0, 11422, 2, 19, '2020-09-22 09:09:47'),
(601, '8252516b', 0, 11420, 1, 6, '2020-09-22 09:09:50'),
(602, '5b5d3e37', 0, 11506, 1, 17, '2020-09-27 07:05:56'),
(603, 'df2f45ac', 0, 11506, 2, 14, '2021-04-05 22:33:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(10) NOT NULL AUTO_INCREMENT,
  `nom_cat` varchar(50) CHARACTER SET utf8 NOT NULL,
  `des_cat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `nom_cat` (`nom_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nom_cat`, `des_cat`) VALUES
(14, 'PAÃ‘ALES', 'ninguna'),
(15, 'DESODORANTE', 'Ninguno'),
(16, 'TOHALLAS HIGIENICAS', 'Ninguno'),
(17, 'CEPILLO DE DIENTES', 'Ninguno'),
(18, 'JABON', 'Ninguno'),
(19, 'SHAMPOO', 'Ninguno'),
(20, 'TALCO', 'Ninguno'),
(21, 'ACEITE PARA BEBE', 'Ninguno'),
(22, 'KIT PARA BEBE ', 'Ninguno'),
(23, 'ESPUMA PARA  AFEITAR', 'Ninguno'),
(24, 'VITAMINA', 'Ninguno'),
(26, 'PRESERVATIVO', 'Ninguno'),
(27, 'ENJUAGUE BUCAL', 'Ninguno'),
(28, 'CREMA DENTAL', 'Ninguno'),
(29, 'HOJA DE AFEITAR', 'Ninguno'),
(30, 'CREMA FACIAL', 'Ninguno'),
(32, 'AFEITADOR', 'Ninguno'),
(33, 'MEDICAMENTOS', 'Ninguno'),
(34, 'UNGUENTO TOPICO', 'Ninguno'),
(35, 'GEL PARA CABELLO ', 'Ninguno'),
(36, 'PAÃ‘ITOS HUMEDOS', 'Ninguno'),
(37, 'PAPEL HIGIENICO', 'Ninguno'),
(38, 'BLOQUEADOR SOLAR', 'Ninguno'),
(39, 'EFERVESCENTES', 'Ninguno'),
(40, 'SOLUCION TOPICA', 'Ninguno'),
(41, 'HILO DENTAL', 'Ninguno'),
(42, 'BALSAMO LABIAL', 'Ninguno'),
(43, 'CURITAS', 'Ninguno'),
(44, 'HISOPOS', 'Ninguno'),
(45, 'CORTA UÃ‘AS', 'Ninguno'),
(46, 'PINZA', 'Ninguno'),
(47, 'SUERO', 'Ninguno'),
(48, 'PAÃ‘UELOS DESCARTABLES', 'Ninguno'),
(49, 'FORMULAS NUTRICIONALES', 'Ninguno'),
(50, 'ALGODON HIDROFILO', 'Ninguno'),
(51, 'TETINA / CHUPON', 'Ninguno'),
(52, 'BIBERONES', 'Ninguno'),
(53, 'JUEGOS DIDACTICOS', 'Ninguno'),
(54, 'KIT PARA NIÃ‘O', 'Ninguno'),
(55, 'PEZONERA', 'Ninguno'),
(56, 'CHUPONES', 'Ninguno'),
(57, 'KIT DE ASEO NIÃ‘OS', 'Ninguno'),
(58, 'MORDEDORES', 'Ninguno'),
(59, 'SET MANICURE BEBE', 'Ninguno'),
(60, 'SET DE CUCHARA BEBE', 'Ninguno'),
(61, 'DISPOSITIVOS MEDICOS', 'Ninguno'),
(62, 'AMPOLLA', 'Ninguno'),
(63, 'JARABE', 'Ninguno'),
(64, 'CAPSULAS', 'Ninguno'),
(65, 'TABLETAS', 'Ninguno'),
(66, 'JARABE / BLISTER', 'Ninguno'),
(67, 'SOBRES', 'Ninguno'),
(68, 'CARAMELOS', 'Ninguno'),
(69, 'OVULOS', 'Ninguno'),
(70, 'COMPRIMIDO', 'Ninguno'),
(71, 'SET BIBERON / PLATO BEBE', 'Ninguno'),
(72, 'MASCARILLA', 'Ninguno'),
(73, 'PROTECTOR FACIAL', 'Ninguno'),
(74, 'ATOMIZADOR', 'Ninguno'),
(75, 'ALCOHOL ', 'Ninguno'),
(76, 'JABON LIQUIDO', 'Ninguno'),
(78, 'AGUA MINERAL', 'Ninguno'),
(79, 'BEBIDAS ENERGIZANTES', 'Ninguno'),
(80, 'GOTAS', 'Ninguno'),
(81, 'CREMA TOPICA', 'Ninguno'),
(82, 'CREMA ANTIFUNGICA', 'Ninguno'),
(83, 'INHALADOR', 'Ninguno'),
(84, 'POLVO PARA SUSPENSION', 'Ninguno'),
(85, 'TABLETAS MASTICABLES', 'Ninguno'),
(86, 'AMPOLLETAS VIA ORAL', 'Ninguno'),
(87, 'AGUJA PARA JERINGA', 'NINGUNO'),
(88, 'ESPARADRAPO', 'NINGUNO'),
(90, 'FRASCO COLECTOR DE ORINA', 'NINGUNO'),
(91, 'FRASCO COLECTOR DE HECES', 'NINGUNO'),
(92, 'AEROCAMARA', 'NINGUNO'),
(93, 'GUANTES', 'NINGUNO'),
(94, 'GASA', 'NINGUNO'),
(95, 'CERA DENTAL', 'NINGUNO'),
(96, 'VENDA', 'NINGUNO'),
(97, 'LLAVE TRIPLE VIA', 'NINGUNO'),
(98, 'DISPOSITIVOS PARA OXIGENO', 'NINGUNO'),
(99, 'ALITA', 'NINGUNO'),
(100, 'JERINGAS', 'NINGUNO'),
(101, 'GOTERO', 'NINGUNO'),
(102, 'PARCHES', 'NINGUNO'),
(103, 'EQUIPO DE PROTECCION PERSONAL', 'NINGUNO'),
(104, 'SUPOSITORIO', 'NINGUNO'),
(105, 'UNGUENTO OFTALMICO', 'NINGUNO'),
(106, 'POMADA', 'NINGUNO'),
(107, 'GRAGEAS', 'NINGUNO'),
(108, 'SOLUCION GINGIVAL', 'NINGUNO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_online` int(12) NOT NULL,
  `cliente` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  PRIMARY KEY (`id_online`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(255) NOT NULL,
  `telefono_cliente` char(30) NOT NULL,
  `email_cliente` varchar(64) NOT NULL,
  `direccion_cliente` varchar(255) NOT NULL,
  `status_cliente` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `doc` varchar(15) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `vendedor` varchar(100) NOT NULL,
  `pais` text NOT NULL,
  `departamento` text NOT NULL,
  `provincia` text NOT NULL,
  `distrito` text NOT NULL,
  `cuenta` text NOT NULL,
  `tipo1` int(2) NOT NULL,
  `tienda` int(10) NOT NULL,
  `users` int(5) NOT NULL,
  `deuda` decimal(8,2) NOT NULL,
  `debe` decimal(8,2) NOT NULL,
  `documento` varchar(11) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=671 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `telefono_cliente`, `email_cliente`, `direccion_cliente`, `status_cliente`, `date_added`, `doc`, `dni`, `vendedor`, `pais`, `departamento`, `provincia`, `distrito`, `cuenta`, `tipo1`, `tienda`, `users`, `deuda`, `debe`, `documento`) VALUES
(1, 'CLIENTES VARIOS', '', '', '', 1, '0000-00-00 00:00:00', '0', '11111111', '', '', 'Junin', 'Huancayo', 'Tambo', '', 1, 1, 0, '28003.00', '0.00', '11111111'),
(659, 'JHENRRY CASIMIRO SILVA', '999987790', 'compuexpertos@gmail.com', 'Jose olaya - Huancayo', 1, '2021-06-14 11:41:05', '0', '42660983', '', 'Peru', '', '', '', '', 1, 1, 0, '0.00', '0.00', '42660983'),
(660, 'MARINET SUSAN CARHUANCHO MUCHA', '', '', '', 1, '2021-06-30 10:33:29', '0', '42225921', '', 'Peru', '', '', '', '', 1, 1, 0, '0.00', '0.00', '42225921'),
(661, 'VIRGINIA HUILLCAS HUINCHO', '974331337', 'huillcask@gmail.com', 'Huancayo', 1, '2021-07-02 01:21:52', '0', '71240003', '', 'Peru', '', '', '', '', 1, 1, 0, '0.00', '0.00', '71240003'),
(662, 'HUILLCAS HUINCHO VICTORIANO', '974331337', 'huillcask@gmail.com', 'Huancayo', 1, '2021-07-02 05:04:42', '10712400264', '0', '', 'Peru', 'Junin', 'Huancayo', 'Tambo', '123456789', 1, 1, 0, '0.00', '0.00', '10712400264'),
(664, 'ANTONIO HUILLCAS APARCO', '974331337', 'huillcask@gmail.com', 'Jr. Ica huancayo', 1, '2021-07-04 04:21:49', '0', '23464740', '', 'Peru', '', '', '', '', 1, 1, 0, '0.00', '0.00', '23464740'),
(665, 'MUNICIPALIDAD PROVINCIAL CHURCAMPA', '', '', 'JR. DOS DE MAYO NRO. S/N HUANCAVELICA CHURCAMPA CHURCAMPA', 1, '2021-07-05 03:18:39', '20165762470', '0', '', 'Peru', '', '', '', '', 1, 1, 0, '0.00', '0.00', '20165762470'),
(666, 'NIKITA', '123456789', '', 'LIMA', 1, '2021-08-10 17:33:39', '0', '12345678', '', 'Peru', 'LIMA', 'LIMA', 'LIMA', '', 2, 1, 0, '0.00', '50.00', '12345678'),
(667, 'BOTIFARMA', '', '', 'LIMA', 1, '2021-08-19 22:04:25', '0', '23456789', '', 'Peru', 'LIMA', 'LIMA', 'LIMA', '', 2, 1, 0, '0.00', '0.00', '23456789'),
(668, 'BOTIFARMA', '', '', 'LIMA', 1, '2021-08-19 22:04:55', '0', '87654321', '', 'Peru', 'LIMA', 'LIMA', 'LIMA', '', 2, 1, 0, '0.00', '0.00', '87654321'),
(669, 'FONDO DE ASEGURAMIENTO EN SALUD DE LA PNP-SALUDPOL', '', '', '', 1, '2021-09-09 20:37:44', '20178922581', '0', '', 'Peru', '', '', '', '', 1, 1, 0, '0.00', '0.00', '20178922581'),
(670, 'SAUL PAQUIYAURI TICLLACONDOR', '', '', '', 1, '2021-09-20 08:47:53', '0', '71240004', '', 'Peru', '', '', '', '', 1, 1, 0, '0.00', '0.00', '71240004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id_comentario` int(10) NOT NULL AUTO_INCREMENT,
  `id_producto` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `comentario` text NOT NULL,
  `correo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_pago`
--

DROP TABLE IF EXISTS `comprobante_pago`;
CREATE TABLE IF NOT EXISTS `comprobante_pago` (
  `id_comprobante` int(2) NOT NULL,
  `cod_comprobante` varchar(3) NOT NULL,
  `des_comprobante` text NOT NULL,
  PRIMARY KEY (`id_comprobante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comprobante_pago`
--

INSERT INTO `comprobante_pago` (`id_comprobante`, `cod_comprobante`, `des_comprobante`) VALUES
(1, '01', 'Factura'),
(2, '03', 'Boleta de Venta'),
(3, '100', 'Guia'),
(4, '02', 'Recibo por Honorarios'),
(5, '00', 'Otros (especificar)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE IF NOT EXISTS `consultas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` int(2) NOT NULL,
  `a1` text NOT NULL,
  `a2` text NOT NULL,
  `a3` text NOT NULL,
  `a4` text NOT NULL,
  `a5` text NOT NULL,
  `a6` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8577 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id`, `tipo`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`) VALUES
(8576, 41, '2021-11-01', '2021-11-04', '1', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

DROP TABLE IF EXISTS `contacto`;
CREATE TABLE IF NOT EXISTS `contacto` (
  `id_contacto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_cont` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `tema` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  PRIMARY KEY (`id_contacto`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `nom_cont`, `email`, `fecha`, `tema`, `mensaje`) VALUES
(3, '', 'admin@admin.com', '2020-06-30 18:58:05', '1232131232', ''),
(4, '', 'marcoantonio_n1@hotmail.com', '2020-07-01 13:24:15', '949594645', ''),
(5, '', 'principe1814@gmail.com', '2020-07-01 13:28:53', '997934525', ''),
(7, '', 'iroditi0925@gmail.com', '2020-07-01 13:51:46', '0983388723', ''),
(9, '', 'robersvilla.1804@gmail.com', '2020-07-01 14:44:27', '998583665 ', ''),
(11, '', 'tezt2020@gmail.com', '2020-07-01 15:20:28', 'tezt2020@gmail.com', ''),
(12, '', 'accm787@outlook.com', '2020-07-01 16:58:07', '959670064', ''),
(13, '', 'demo@gmail.com', '2020-07-01 19:40:06', '973307372', ''),
(14, '', 'jusor1975@yahoo.com', '2020-07-01 21:16:47', '980606901', ''),
(15, '', 'builderdotnet@gmail.com', '2020-07-01 21:20:52', '949332944', ''),
(16, '', 'foo@yopmail.com', '2020-07-01 21:21:09', '999999999', ''),
(17, '', 'demo@gmail.com', '2020-07-01 21:48:58', '999999999', ''),
(18, '', 'demo@demo.com', '2020-07-02 08:27:23', '111111111', ''),
(19, '', 'pruebadesistema@yopmail.com', '2020-07-02 12:56:40', '9864050166', ''),
(20, 'Marco Antonio CARDOZO MONTALVO', 'cardozomarco@hotmail.com', '2020-07-02 14:05:26', '976499255', 'Estoy interesado. Cómo ser&iacute;a para registrar 18000 productos'),
(21, 'Marco Antonio CARDOZO MONTALVO', 'cardozomarco@hotmail.com', '2020-07-02 14:13:31', '976499255', 'Estoy interesado. Cómo ser&iacute;a para registrar 18000 productos'),
(22, '', 'jharin.25@hotmail.com', '2020-07-02 21:49:05', '987654321', ''),
(23, '', 'yy@hh.c', '2020-07-02 21:52:22', 'uu', ''),
(24, '', 'f.@dd.com', '2020-07-02 21:53:47', 'ddf', ''),
(25, '', 'gemaw78068@frost2d.net', '2020-07-03 06:13:42', '99999999', ''),
(26, '', 'fsd@sdf.com', '2020-07-03 22:01:54', 'sdf', ''),
(27, '', 'fsd@sdf.com', '2020-07-03 22:01:54', 'sdf', ''),
(28, '', 'Roberto.urbaez89@gmail.com', '2020-07-05 19:19:34', '5804168829693', ''),
(29, '', 'ramonrojaslopez@gmail.com', '2020-07-10 21:05:33', '8094248312', ''),
(30, '', 'ramonrojaslopez@gmail.com', '2020-07-10 21:11:34', '8094248312', ''),
(31, '', 'ramonrojaslopez@gmail.com', '2020-07-12 18:52:59', '8094248312', ''),
(32, '', 'ramonrojaslopez@gmail.com', '2020-07-12 19:04:04', '8094248312', ''),
(33, '', 'magy_jr@hotmail.com', '2020-07-14 21:22:50', '0993580036', ''),
(34, '', 'alexandercarpato@gmail.com', '2020-07-15 08:59:43', '809 467-9083', ''),
(35, '', 'jarcech00@gmail.com', '2020-07-15 17:44:12', '990009756', ''),
(36, '', 'fullpagos2017yr@hotmail.com', '2020-07-15 18:13:19', '956103164', ''),
(37, '', 'espinozafc@gmail.com', '2020-07-15 23:39:06', '987654321', ''),
(38, '', 'aylin99h_x931l@zmat.xyz', '2020-07-17 18:26:23', '987635326', ''),
(39, '', 'as@as.as', '2020-07-17 21:48:39', 'as', ''),
(40, '', 'as@as.as', '2020-07-17 21:49:15', 'as', ''),
(41, '', 'JOSESICCHA@GMAIL.COM', '2020-07-17 21:51:20', '958029891', ''),
(42, '', 'JOSESICCHA@GMAIL.COM', '2020-07-17 22:35:29', '958029891', ''),
(43, '', 'jorgedj07@gmail.com', '2020-07-21 21:00:44', '098012770', ''),
(44, '', 'jorgedj07@gmail.com', '2020-07-21 21:39:32', '098012770', ''),
(45, '', 'lokiam1910@gmail.com', '2020-07-27 11:02:31', '506 70468335', ''),
(46, '', 'ss@sfsdf.com', '2020-07-30 09:18:05', '685954645', ''),
(47, '', 'ss@sfsdf.com', '2020-07-30 09:39:45', '685954645', ''),
(48, '', 'ss@sfsdf.com', '2020-07-30 09:42:25', '685954645', ''),
(49, '', 'dgfgd@gsdgd.com', '2020-07-30 09:52:05', '34534535', ''),
(50, '', 'fjdjds@ffkd.com', '2020-07-30 09:53:21', '9653833333', ''),
(51, '', 'ok_reyraq@hotmail.com', '2020-08-01 19:05:13', '70101101', ''),
(52, '', 'pventa@gmail.com', '2020-08-03 21:21:40', '999888777', ''),
(53, '', 'cynthia.chugchilan9415@utc.edu.ec', '2020-08-06 13:32:21', '0983991074', ''),
(54, '', 'cg_velazco@hotmail.com', '2020-08-07 08:45:24', '99999999990000', ''),
(55, '', 'darrenhuaman@gmail.com', '2020-08-07 19:05:43', '997068807', ''),
(56, '', 'darrenhuaman@gmail.com', '2020-08-07 19:05:44', '997068807', ''),
(57, '', 'dsfsdf@ffsdf.com', '2020-08-08 23:24:08', '34634535', ''),
(58, '', 'aetechnova@gmail.com', '2020-08-09 19:20:48', '991334125', ''),
(59, '', 'candradesmartinez17@gmail.com', '2020-08-12 13:17:04', '3137267613', ''),
(60, '', 'PABLO11086@GMAIL.COM', '2020-08-12 21:35:49', '966999533', ''),
(61, '', 'kevin-cordonh@hotmail.com', '2020-08-17 23:56:13', '66462913', ''),
(62, '', 'p.cruz0089@gmail.com', '2020-08-21 15:50:19', '981577835', ''),
(63, '', 'ismaelmolina719@gmail.com', '2020-08-22 17:35:55', '8097798722', ''),
(64, '', 'abel.angelsc@gmail.com', '2020-08-24 17:35:07', '961104340', ''),
(65, '', 'jesuseconce17@gmail.com', '2020-08-27 06:58:48', 'jesuseconce17@gmail.com', ''),
(66, '', 'abel.angelsc@gmail.com', '2020-08-28 19:50:13', '961104340', ''),
(67, '', 'abel.angelsc@gmail.com', '2020-08-29 13:02:19', '961104340', ''),
(68, '', 'lemos@dgf.com', '2020-08-29 16:20:51', '999888666', ''),
(69, '', 'mario.rojas@gmail.com', '2020-08-31 11:42:38', '999587652', ''),
(70, '', 'issema2020@gmail.com', '2020-09-12 12:57:23', '2214000392', ''),
(71, '', 'sdsds@dd.com', '2020-09-14 20:19:04', '(59) 599410101', ''),
(72, '', 'marlonmorel301@gmail.com', '2020-09-23 06:24:46', '+50494527744', ''),
(73, '', 'marlonmorel301@gmail.com', '2020-09-23 06:25:43', '+50494527744', ''),
(74, '', 'sdad@dsd.com', '2020-09-23 19:21:19', '(59) 599410101', ''),
(75, 'SEBASTIAN BORJA', 'snborja@tecnosolucion.com.py', '2020-09-23 19:49:19', '99401010', 'hola, quisiera saber si puedes hacer la adaptacion de tu software para una ferreteria, y lo quiero usar en paraguay, por lo que no estoy necesitando la parte de facturacion electronica ni tienda online, solo seria la parte de facturacion local.'),
(76, '', 'mi@correo1.comddd', '2020-09-25 14:02:52', '954012392', ''),
(77, '782561 Kennethhaw', 'naummarkin5154@yandex.ru', '2020-09-27 04:52:14', 'Kennethhaw', '???? ?? ??????????? ???????????? ?????? (??????) \r\n??? ?????? ?????? ??????? «SEO ????????????»,?? ??? ??? ????? ?????????. \r\n? ????? ?????? ?? ????????? ?? ?????? ??????????-?????? ???. \r\nhttps://offeramazon.ru/2020/09/25/xrumer/'),
(78, '', 'sandromv96@gmail.com', '2020-10-03 13:33:50', 'san336534', ''),
(79, '', 'sandromv96@gmail.com', '2020-10-03 13:34:54', 'san336534', ''),
(80, '', 'patriciagestido@hotmail.com', '2020-10-06 08:29:35', '2236008018', ''),
(81, '', 'demo@gmail.com', '2020-10-06 22:31:42', '123456789', ''),
(82, '', 'elmer.homs@gmail.com', '2020-10-07 00:52:33', '939451526', ''),
(83, '', 'elmer.homs@gmail.com', '2020-10-07 01:37:44', '939451526', ''),
(84, '336696 Danil', 'southlife80@mail.ru', '2020-10-09 18:35:16', 'Danil', '????????? ? ?????'),
(85, '', 'admin@gmail.com', '2020-10-12 13:15:05', '2838382828', ''),
(86, '', 'jenny.chauca1979@gmail.com', '2020-10-12 14:03:17', '0991702003', ''),
(87, '', 'demo@gmail.com', '2020-10-13 23:54:44', '987654321', ''),
(88, '654842 Ramgaism', 'wysylaja@cbd-8.com', '2020-10-16 02:56:58', 'Ramgaism', 'tablets http://cialis20walmart.com - tribenzor besonderes aldactone festen'),
(89, '', 'elmer.homs@gmail.com', '2020-10-17 00:25:13', '939451526', ''),
(90, '', 'heberluis94@gmail.com', '2020-10-18 14:08:10', '+58424316139', ''),
(91, '', 'heberluis94@gmail.com', '2020-10-18 14:08:21', '+58424316139', ''),
(92, '', 'heberluis94@gmail.com', '2020-10-18 14:09:17', '+58424316139', ''),
(93, '', 'dasd@h.com', '2020-10-20 17:36:08', '3434', ''),
(94, '', 'dada@df.com', '2020-10-20 17:42:20', '32424', ''),
(95, '', 'graciela_carl@outlook.com', '2020-10-21 10:48:29', '0981812084', ''),
(96, '', 'dsd@jjd.com', '2020-10-27 15:46:41', '34424', ''),
(97, '', 'fdgd@sadas', '2020-11-13 09:55:40', 'sdf', ''),
(98, '', 'fgtg@sdas', '2020-11-16 02:40:59', 'sdfsed', ''),
(99, '', 'flakovhsa@yopmail.com', '2020-11-17 11:12:46', '9934556720', ''),
(100, '', 'ferchinao@hotmail.com', '2020-11-18 09:48:40', '0999184215', ''),
(101, '', 'demo@e.org.pe', '2020-11-19 00:08:38', '985 603 718', ''),
(102, '', 'demo@e.org.pe', '2020-11-19 00:48:00', '985 603 718', ''),
(103, 'Sebastian Aragon', 'marketing.central.caymaqp@gmail.com', '2020-11-19 21:20:29', '977713122', 'Hola estoy interesado en un sistema de Facturación Electrónica para mi empresa, es un Salón de belleza, tiene un programa para este rubro o cual se puede adaptar.'),
(104, '', 'sef@afaf.com', '2020-11-29 13:12:20', 'asdf', ''),
(105, '', 'ismaelulman8@gmail.com', '2020-11-30 19:46:11', '3492320050', ''),
(106, '', 'juykel@gmail.com', '2020-12-01 19:10:59', '3043660025', ''),
(107, '', 'aweycl@gmail.com', '2020-12-05 17:44:51', '987656565', ''),
(108, '', 'yooricoco@hotmail.com', '2020-12-07 17:43:38', '5511582061', ''),
(109, '', 'SELENART@outlook.com', '2020-12-08 10:11:51', '0983176138', ''),
(110, '', 'mq@morangesoft.com', '2020-12-10 17:20:22', '990148222', ''),
(111, '', 'mq@morangesoft.com', '2020-12-10 17:21:39', '990148222', ''),
(112, 'Angel Sosa', 'angelnewww@gmail.com', '2020-12-18 12:37:48', '+595971411066', 'hola quiero la demo de tus sitemas para hacer una prueba antes de comprar'),
(113, '', 'jorgeh@unica.cu', '2020-12-21 14:38:56', '+5354253646', ''),
(114, '', 'ojos_verdes556@hotmail.com', '2021-01-04 12:16:04', '1128816939', ''),
(115, '', 'amor_pipa@hotmail.com', '2021-01-06 05:41:02', '983184623', ''),
(116, '', 'gerencia@asesoriamurrieta.com', '2021-01-14 22:39:14', '976248185', ''),
(117, '', 'clever.humpire@gmail.com', '2021-01-15 15:35:43', 'clever.humpire@gmail.com', ''),
(118, '', 'davidballestas10@hotmail.com', '2021-01-16 08:14:03', '3112885672', ''),
(119, '', 'SAD@DJF.CO', '2021-01-19 11:25:26', '1212', ''),
(120, '', 'DSA@JD.COM', '2021-01-19 11:26:07', '1212', ''),
(121, '', 'luis13rs@hotmail.com', '2021-01-19 14:20:52', '984493506', ''),
(122, '957992 generic viagra canadian pharmacy online', 'duzeyi@vgsnake.com', '2021-01-22 08:07:09', 'generic viagra from india', 'viagra 5 mg online moderators\r\n discount viagra\r\n kamagra generic viagra\r\n - buy viagra today columbus oh\r\n https://vgsnake.com/# - cheap virgar u.s.a.\r\n viagra 10 mg effectiveness knowledge base'),
(123, '', 'rayojuncos@hotmail.com', '2021-02-03 07:49:41', '7874564455', ''),
(124, '', 'rafael76372@gmail.com', '2021-02-04 11:15:36', '04145874125', ''),
(125, '', 'gonzalo@gmail.com', '2021-02-08 14:25:05', '609853521', ''),
(126, '', 'soygoku212@outlook.com', '2021-02-11 20:57:07', '0980724680', ''),
(127, '', 'mateito26017@hotmail.com', '2021-02-15 07:30:53', '0986611674', ''),
(128, '', 'brenda@gmail.com', '2021-02-15 07:54:55', '13456733', ''),
(129, '', 'iglesiabautistacristovivegt@gmail.com', '2021-02-15 11:20:35', '40414243', ''),
(130, '', 'jhonatan.fmh@gmail.com', '2021-02-21 13:19:00', '935889381', ''),
(131, '', 'jhonatan.fmh@gmail.com', '2021-02-21 13:19:20', '935889381', ''),
(132, '', 'eumerperez@gmail.com', '2021-02-26 07:49:30', '04140219936', ''),
(133, '', 'camposwisner@gmail.com', '2021-02-26 15:34:58', '61081864', ''),
(134, '', 'aas@aas.asas', '2021-02-28 19:26:48', '999888777', ''),
(135, '', 'sad@asd-c', '2021-03-01 18:45:48', '56464465', ''),
(136, '', 'linapre59@gmail.com', '2021-03-06 14:04:08', '86947361', ''),
(137, '951497 Floydbem', 'qmlya@goposts.site', '2021-03-15 16:55:19', 'Floydbem', 'Free sex dating in your city, here https://bit.ly/2LtgS3Z'),
(138, '', 'hernandezalbertojimenez@gimail.com', '2021-03-17 09:25:51', 'hernandezalbertojimenez@gimail.com', ''),
(139, '', 'orlatrade@hotmail.com', '2021-03-22 15:51:56', '995707179', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

DROP TABLE IF EXISTS `cuentas`;
CREATE TABLE IF NOT EXISTS `cuentas` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `cod_cue` int(4) NOT NULL,
  `nom_cue` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosempresa`
--

DROP TABLE IF EXISTS `datosempresa`;
CREATE TABLE IF NOT EXISTS `datosempresa` (
  `nom_emp` varchar(200) NOT NULL,
  `id_emp` int(2) NOT NULL,
  `tienda` int(10) NOT NULL,
  `des_emp` text NOT NULL,
  `mis_emp` text NOT NULL,
  `vis_emp` text NOT NULL,
  `tel_emp` varchar(200) NOT NULL,
  `dir_emp` varchar(300) NOT NULL,
  `email_emp` text NOT NULL,
  `face_emp` varchar(200) NOT NULL,
  `tiwter_emp` text NOT NULL,
  `youtube_emp` text NOT NULL,
  `linkedin_emp` text NOT NULL,
  `wasap_emp` varchar(30) NOT NULL,
  `dolar` float NOT NULL,
  `alerta` double NOT NULL,
  `logo` varchar(20) NOT NULL,
  `fotovision` varchar(20) NOT NULL,
  `fotomision` varchar(20) NOT NULL,
  `slider1` varchar(20) NOT NULL,
  `slider2` varchar(20) NOT NULL,
  `slider3` varchar(20) NOT NULL,
  `slider4` varchar(20) NOT NULL,
  `slider5` varchar(20) NOT NULL,
  `comentario1` text NOT NULL,
  `comentario2` text NOT NULL,
  `comentario3` text NOT NULL,
  `comentario4` text NOT NULL,
  `comentario5` text NOT NULL,
  `precio2` decimal(7,2) NOT NULL,
  `precio3` decimal(7,2) NOT NULL,
  `fac_ele` int(2) NOT NULL,
  `usuariosol` varchar(30) NOT NULL,
  `clavesol` varchar(30) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `moneda` int(2) NOT NULL,
  `google_maps` text NOT NULL,
  `color` varchar(30) NOT NULL,
  PRIMARY KEY (`id_emp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datosempresa`
--

INSERT INTO `datosempresa` (`nom_emp`, `id_emp`, `tienda`, `des_emp`, `mis_emp`, `vis_emp`, `tel_emp`, `dir_emp`, `email_emp`, `face_emp`, `tiwter_emp`, `youtube_emp`, `linkedin_emp`, `wasap_emp`, `dolar`, `alerta`, `logo`, `fotovision`, `fotomision`, `slider1`, `slider2`, `slider3`, `slider4`, `slider5`, `comentario1`, `comentario2`, `comentario3`, `comentario4`, `comentario5`, `precio2`, `precio3`, `fac_ele`, `usuariosol`, `clavesol`, `clave`, `moneda`, `google_maps`, `color`) VALUES
('Botica mas vida y salud', 1, 1, 'La salud a tu alcance', 'Botica mas vida y salud', 'La salud a tu alcance', '987654321', 'Jr. Sucre 113 - El tambo - Huancayo', 'contacto@continental.com', 'https://www.facebook.com/ejemplo', 'https://twitter.com/ejemplo', 'https://www.youtube.com/channel/ejemplo', '', '938806297', 3.2, 5, 'logo.jpg', 'vision.jpg', 'mision.jpg', 'fotoPr8dJmY0.jpg', 'fotoWNO7xmCv.jpg', 'fotox1Pqoy0j.jpg', '', '', 'Bienvenido', 'Tienda Online', '', '', '', '10.00', '20.00', 3, 'MODDATOS', 'moddatos', '', 0, '', 'lite-blue-theme');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(10) NOT NULL,
  `id_vendedor` int(10) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `ot` varchar(20) NOT NULL,
  `id_producto` varchar(100) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `tienda` int(2) NOT NULL,
  `activo` int(1) NOT NULL,
  `ven_com` int(2) NOT NULL,
  `fecha` datetime NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `tipo_doc` int(2) NOT NULL,
  `inv_ini` decimal(10,2) NOT NULL,
  `moneda` decimal(4,2) NOT NULL,
  `folio` varchar(5) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `numero_cotizacion` (`numero_factura`,`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=5769 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detalle`, `id_cliente`, `id_vendedor`, `numero_factura`, `ot`, `id_producto`, `cantidad`, `precio_venta`, `tienda`, `activo`, `ven_com`, `fecha`, `precio_compra`, `tipo_doc`, `inv_ini`, `moneda`, `folio`) VALUES
(5723, 1, 1, 331, '1', '11772', '1.00', '28.00', 1, 1, 1, '2021-10-24 02:54:04', '25.00', 3, '31.00', '1.00', 'T001'),
(5724, 1, 1, 332, '1', '11751', '1.00', '1.80', 1, 1, 1, '2021-10-24 02:54:12', '1.60', 3, '228.00', '1.00', 'T001'),
(5768, 1, 1, 352, '1', '11829', '3.00', '1.67', 1, 1, 1, '2021-11-04 11:01:50', '1.00', 3, '71.00', '1.00', 'T001'),
(5767, 1, 1, 2, '1', '11819', '1.00', '4.50', 1, 0, 1, '2021-11-03 09:09:48', '1.00', 8, '40.00', '1.00', 'C001'),
(5729, 1, 8, 2, '1', '11828', '1.00', '2.00', 3, 1, 1, '2021-10-24 03:03:43', '1.00', 2, '15.00', '1.00', 'B003'),
(5730, 662, 8, 2, '1', '11828', '1.00', '2.00', 3, 1, 1, '2021-10-24 03:03:54', '1.00', 1, '14.00', '1.00', 'F003'),
(5731, 1, 1, 1, '1', '11818', '1.00', '14.80', 1, 1, 1, '2021-10-24 03:04:41', '1.00', 2, '3.00', '1.00', 'B001'),
(5732, 1, 1, 333, '1', '11823', '1.00', '2.50', 1, 1, 1, '2021-10-24 03:05:05', '1.00', 3, '312.00', '1.00', 'T001'),
(5733, 1, 1, 334, '1', '11823', '1.00', '2.50', 1, 1, 1, '2021-10-24 03:05:25', '1.00', 3, '311.00', '1.00', 'T001'),
(5734, 1, 1, 2, '1', '11823', '1.00', '2.50', 1, 1, 1, '2021-10-24 03:05:36', '1.00', 2, '310.00', '1.00', 'B001'),
(5735, 1, 1, 335, '1', '11823', '1.00', '2.50', 1, 1, 1, '2021-10-24 03:05:49', '1.00', 3, '309.00', '1.00', 'T001'),
(5736, 1, 1, 3, '1', '11823', '1.00', '2.50', 1, 1, 1, '2021-10-24 03:05:59', '1.00', 2, '308.00', '1.00', 'B001'),
(5737, 1, 1, 4, '1', '11825', '1.00', '1.50', 1, 1, 1, '2021-10-24 03:06:12', '1.00', 2, '35.00', '1.00', 'B001'),
(5738, 662, 1, 1, '1', '11818', '1.00', '14.80', 1, 1, 1, '2021-10-24 03:06:34', '1.00', 1, '2.00', '1.00', 'F001'),
(5739, 662, 1, 2, '1', '11824', '1.00', '2.00', 1, 1, 1, '2021-10-24 03:06:48', '1.00', 1, '271.00', '1.00', 'F001'),
(5740, 666, 8, 123, '2', '11775', '10.00', '3.90', 1, 1, 2, '2021-10-24 03:13:50', '0.00', 1, '76.00', '1.00', 'f001'),
(5741, 1, 8, 30, '1', '11828', '1.00', '2.00', 3, 1, 1, '2021-10-24 03:18:53', '1.00', 3, '13.00', '1.00', 'T003'),
(5744, 666, 8, 123, '2', '11829', '1.00', '1.00', 1, 1, 2, '2021-10-24 03:40:48', '0.00', 1, '10.00', '1.00', 'f001'),
(5745, 664, 8, 123, '2', '11829', '20.00', '1.00', 1, 1, 2, '2021-10-24 03:45:06', '0.00', 1, '11.00', '1.00', 'f001'),
(5746, 666, 8, 1236, '2', '11829', '10.00', '1.00', 3, 1, 2, '2021-10-24 03:55:05', '0.00', 1, '51.00', '1.00', 'bb'),
(5747, 666, 1, 12, '2', '11819', '50.00', '1.00', 1, 1, 2, '2021-10-24 05:16:59', '0.00', 1, '3.00', '1.00', '12'),
(5748, 0, 1, 1, '1', '11822', '2.00', '1.00', 1, 0, 2, '2021-10-26 11:35:30', '0.00', 10, '5.00', '1.00', 'ES'),
(5749, 1, 1, 337, '1', '11821', '1.00', '135.00', 1, 1, 1, '2021-10-27 09:08:59', '1.00', 3, '4.00', '1.00', 'T001'),
(5750, 661, 1, 5, '1', '11819', '1.00', '25.00', 1, 1, 1, '2021-10-27 09:50:08', '1.00', 2, '53.00', '1.00', 'B001'),
(5751, 662, 1, 3, '1', '11819', '2.00', '159.00', 1, 1, 1, '2021-10-27 11:00:47', '1.00', 1, '52.00', '1.00', 'F001'),
(5752, 1, 1, 338, '1', '11772', '1.00', '28.00', 1, 1, 1, '2021-10-30 03:08:04', '25.00', 3, '30.00', '1.00', 'T001'),
(5753, 1, 1, 339, '1', '11819', '1.00', '4.50', 1, 1, 1, '2021-10-30 03:08:14', '1.00', 3, '50.00', '1.00', 'T001'),
(5754, 1, 1, 340, '1', '11772', '1.00', '28.00', 1, 1, 1, '2021-10-30 03:08:43', '25.00', 3, '29.00', '1.00', 'T001'),
(5755, 1, 1, 342, '1', '11819', '1.00', '4.50', 1, 1, 1, '2021-10-30 03:24:14', '1.00', 3, '48.00', '1.00', 'T001'),
(5756, 1, 1, 343, '1', '11819', '1.00', '4.50', 1, 1, 1, '2021-10-30 03:26:03', '1.00', 3, '47.00', '1.00', 'T001'),
(5757, 1, 1, 344, '1', '11770', '1.00', '4.20', 1, 1, 1, '2021-10-30 18:05:57', '3.80', 3, '24.00', '1.00', 'T001'),
(5758, 1, 1, 344, '1', '11772', '1.00', '28.00', 1, 1, 1, '2021-10-30 18:05:57', '25.00', 3, '28.00', '1.00', 'T001'),
(5759, 1, 1, 345, '1', '11819', '1.00', '4.50', 1, 1, 1, '2021-10-30 18:06:24', '1.00', 3, '46.00', '1.00', 'T001'),
(5760, 1, 1, 346, '1', '11819', '1.00', '4.50', 1, 1, 1, '2021-10-30 18:07:24', '1.00', 3, '45.00', '1.00', 'T001'),
(5761, 1, 1, 347, '1', '11819', '1.00', '4.50', 1, 1, 1, '2021-10-30 18:07:39', '1.00', 3, '44.00', '1.00', 'T001'),
(5762, 1, 1, 348, '1', '11822', '1.00', '1.50', 1, 1, 1, '2021-10-30 18:07:51', '1.00', 3, '3.00', '1.00', 'T001'),
(5763, 1, 1, 348, '1', '11819', '1.00', '4.50', 1, 1, 1, '2021-10-30 18:07:51', '1.00', 3, '43.00', '1.00', 'T001'),
(5764, 1, 1, 349, '1', '11765', '20.00', '1.00', 1, 1, 1, '2021-10-30 18:08:52', '0.80', 3, '56.00', '1.00', 'T001'),
(5765, 1, 1, 350, '1', '11765', '20.00', '1.00', 1, 1, 1, '2021-10-30 18:09:04', '0.80', 3, '36.00', '1.00', 'T001'),
(5766, 1, 1, 351, '1', '11819', '2.00', '4.50', 1, 1, 1, '2021-11-03 07:04:46', '1.00', 3, '42.00', '1.00', 'T001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

DROP TABLE IF EXISTS `documento`;
CREATE TABLE IF NOT EXISTS `documento` (
  `id_documento` int(2) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(12) NOT NULL,
  `numero` double NOT NULL,
  `tienda1` varchar(10) NOT NULL,
  `tienda2` varchar(10) NOT NULL,
  `tienda3` varchar(10) NOT NULL,
  `tienda4` varchar(10) NOT NULL,
  `tienda5` varchar(10) NOT NULL,
  `tienda6` varchar(10) NOT NULL,
  `folio1` varchar(5) NOT NULL,
  `folio2` varchar(5) NOT NULL,
  `folio3` varchar(5) NOT NULL,
  `folio4` varchar(5) NOT NULL,
  `folio5` varchar(5) NOT NULL,
  `folio6` varchar(5) NOT NULL,
  PRIMARY KEY (`id_documento`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id_documento`, `tipo`, `numero`, `tienda1`, `tienda2`, `tienda3`, `tienda4`, `tienda5`, `tienda6`, `folio1`, `folio2`, `folio3`, `folio4`, `folio5`, `folio6`) VALUES
(1, 'factura', 0, '3', '0', '2', '0', '0', '0', 'F001', 'F002', 'F003', 'F004', 'F005', 'F006'),
(2, 'boleta', 0, '5', '0', '2', '0', '0', '0', 'B001', 'B002', 'B003', 'B004', 'B005', 'B006'),
(3, 'guia', 0, '352', '0', '31', '0', '2', '0', 'T001', 'T002', 'T003', 'T004', 'T005', 'T006'),
(4, 'remision', 0, '2', '0', '0', '0', '0', '0', 'T001', 'T002', 'T003', 'T004', 'T005', 'T006'),
(5, 'nota_debito', 0, '0', '0', '0', '0', '0', '0', 'F001', 'F002', 'F003', 'F004', 'F005', 'F006'),
(6, 'nota_credito', 0, '0', '0', '0', '0', '0', '0', 'F001', 'F002', 'F003', 'F004', 'F005', 'F006'),
(7, 'Resumen', 0, '0', '0', '0', '0', '0', '0', 'F001', 'F002', 'F003', 'F004', 'F005', 'F006'),
(8, 'cotizacion', 0, '2', '0', '0', '0', '0', '0', 'C001', 'C002', 'C003', 'C004', 'C005', 'C006'),
(9, 'nota_debito1', 0, '0', '0', '0', '0', '0', '0', 'B001', 'B002', 'B003', 'B004', 'B005', 'B006'),
(10, 'nota_credito', 0, '0', '0', '0', '0', '0', '0', 'B001', 'B002', 'B003', 'B004', 'B005', 'B006'),
(11, 'requerimient', 0, '0', '0', '0', '0', '0', '0', 'R001', 'R002', 'R003', 'R004', 'R005', 'R006');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_electronicos`
--

DROP TABLE IF EXISTS `documentos_electronicos`;
CREATE TABLE IF NOT EXISTS `documentos_electronicos` (
  `id_doc` int(10) NOT NULL AUTO_INCREMENT,
  `ruc` int(11) NOT NULL,
  `obs` text,
  `url_xml` text NOT NULL,
  `hash_cpe` text NOT NULL,
  `hash_cdr` text NOT NULL,
  `msj_sunat` text NOT NULL,
  `ruta_cdr` text NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `doc` varchar(30) NOT NULL,
  PRIMARY KEY (`id_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

DROP TABLE IF EXISTS `facturas`;
CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `numero_factura` varchar(30) NOT NULL,
  `fecha_factura` datetime NOT NULL,
  `cod_hash` varchar(40) NOT NULL,
  `doc_mod` varchar(20) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `baja` varchar(30) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `condiciones` int(1) NOT NULL,
  `total_venta` decimal(10,2) NOT NULL,
  `deuda_total` decimal(10,2) NOT NULL,
  `estado_factura` text NOT NULL,
  `tienda` int(2) NOT NULL,
  `ven_com` int(2) NOT NULL,
  `activo` int(2) NOT NULL,
  `servicio` int(2) NOT NULL,
  `moneda` double NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `obs` varchar(200) NOT NULL,
  `cuenta1` decimal(10,2) NOT NULL,
  `fec_eli` date NOT NULL,
  `dias` int(3) NOT NULL,
  `folio` varchar(5) NOT NULL,
  `des` int(2) NOT NULL,
  `aceptado` varchar(100) NOT NULL,
  `resumen` int(2) NOT NULL,
  `motivo` varchar(10) NOT NULL,
  `tipo` int(2) NOT NULL,
  `pago_efectivo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_factura`)
) ENGINE=MyISAM AUTO_INCREMENT=3303 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `numero_factura`, `fecha_factura`, `cod_hash`, `doc_mod`, `id_cliente`, `baja`, `id_vendedor`, `condiciones`, `total_venta`, `deuda_total`, `estado_factura`, `tienda`, `ven_com`, `activo`, `servicio`, `moneda`, `nombre`, `obs`, `cuenta1`, `fec_eli`, `dias`, `folio`, `des`, `aceptado`, `resumen`, `motivo`, `tipo`, `pago_efectivo`) VALUES
(3276, '2', '2021-10-24 03:03:54', 'TnZWN36hALoC9+OczXScjpT3LKs=', 'undefined', 662, '0', 8, 1, '2.00', '0.00', '1', 3, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'F003', 1, '', 0, '', 0, NULL),
(3275, '2', '2021-10-24 03:03:43', 'vJ1xibFczPdOLcEVWZV6YLLwGuI=', 'undefined', 1, '0', 8, 1, '2.00', '0.00', '2', 3, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'B003', 1, '', 0, '', 0, NULL),
(3274, '29', '2021-10-24 03:03:22', '0', 'undefined', 1, '0', 8, 1, '2.00', '0.00', '3', 3, 1, 0, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T003', 1, '', 0, '', 0, NULL),
(3273, '28', '2021-10-24 02:57:37', '0', 'undefined', 1, '0', 8, 1, '2.00', '0.00', '3', 3, 1, 0, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T003', 1, '', 0, '', 0, NULL),
(3272, '27', '2021-10-24 02:55:33', '0', 'undefined', 1, '0', 8, 1, '2.00', '0.00', '3', 3, 1, 0, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T003', 1, '', 0, '', 0, NULL),
(3271, '26', '2021-10-24 02:55:26', '0', 'undefined', 1, '0', 8, 1, '2.00', '0.00', '3', 3, 1, 0, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T003', 1, '', 0, '', 0, NULL),
(3270, '332', '2021-10-24 02:54:12', '0', 'undefined', 1, '0', 1, 1, '1.80', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, NULL),
(3269, '331', '2021-10-24 02:54:04', '0', 'undefined', 1, '0', 1, 1, '28.00', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, NULL),
(3277, '1', '2021-10-24 03:04:41', 'K4Xk34Idm/NrSV2gTb2sHHID8UY=', 'undefined', 1, '0', 1, 1, '14.80', '0.00', '2', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'B001', 1, '', 0, '', 0, NULL),
(3278, '333', '2021-10-24 03:05:05', '0', 'undefined', 1, '0', 1, 1, '2.50', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, NULL),
(3279, '334', '2021-10-24 03:05:25', '0', 'undefined', 1, '0', 1, 1, '2.50', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, NULL),
(3280, '2', '2021-10-24 03:05:36', 'krqV1jQ4YAwjDhhWl4Dqe6ac2ns=', 'undefined', 1, '0', 1, 1, '2.50', '0.00', '2', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'B001', 1, '', 0, '', 0, NULL),
(3281, '335', '2021-10-24 03:05:49', '0', 'undefined', 1, '0', 1, 1, '2.50', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, NULL),
(3282, '3', '2021-10-24 03:05:59', '+KNi0/EqslTr53pz0/a6i8ReBEw=', 'undefined', 1, '0', 1, 1, '2.50', '0.00', '2', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'B001', 1, '', 0, '', 0, NULL),
(3283, '4', '2021-10-24 03:06:12', 'KY+pb32b9bl1TwLqCeKqZdJgiaA=', 'undefined', 1, '0', 1, 1, '1.50', '0.00', '2', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'B001', 1, '', 0, '', 0, NULL),
(3284, '1', '2021-10-24 03:06:34', '703aUsympu5gQm1Zr0IUMW6r+sQ=', 'undefined', 662, '0', 1, 1, '14.80', '0.00', '1', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'F001', 1, '', 0, '', 0, NULL),
(3285, '2', '2021-10-24 03:06:48', 'TsdYO8OhOBeP7hfh+glYjzLbhKk=', 'undefined', 662, '0', 1, 1, '2.00', '0.00', '1', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'F001', 1, '', 0, '', 0, NULL),
(3286, '30', '2021-10-24 03:18:53', '0', 'undefined', 1, '0', 8, 1, '2.00', '0.00', '3', 3, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T003', 1, '', 0, '', 0, NULL),
(3287, '31', '2021-10-24 03:19:02', '0', 'undefined', 1, '0', 8, 1, '2.00', '0.00', '3', 3, 1, 0, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T003', 1, '', 0, '', 0, NULL),
(3288, '336', '2021-10-24 03:19:32', '0', 'undefined', 1, '0', 1, 1, '2.00', '0.00', '3', 1, 1, 0, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, NULL),
(3289, '1', '2021-10-26 11:35:30', '0', '', 0, '0', 1, 1, '2.00', '0.00', '10', 1, 2, 0, 0, 1, '', 'Disminuir Stock', '0.00', '2018-11-11', 0, 'ES', 2, '', 0, '', 0, NULL),
(3290, '337', '2021-10-27 09:08:59', '0', 'undefined', 1, '0', 1, 1, '135.00', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, NULL),
(3291, '5', '2021-10-27 09:50:08', '7ZY8TaBaNsWszXBOM7PvasoSpeQ=', 'undefined', 661, '0', 1, 1, '25.00', '0.00', '2', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'B001', 1, '', 0, '', 0, NULL),
(3292, '3', '2021-10-27 11:00:47', '4uJAFDJl6AAPG+0YLuC9K1ji6NY=', 'undefined', 662, '0', 1, 1, '318.00', '0.00', '1', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'F001', 1, '', 0, '', 0, NULL),
(3293, '340', '2021-10-30 03:08:43', '0', 'undefined', 1, '0', 1, 1, '28.00', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, NULL),
(3294, '341', '2021-10-30 03:10:38', '0', 'undefined', 1, '0', 1, 1, '4.50', '0.00', '3', 1, 1, 0, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, NULL),
(3295, '342', '2021-10-30 03:24:14', '0', 'undefined', 1, '0', 1, 1, '4.50', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, '0.00'),
(3296, '343', '2021-10-30 03:26:03', '0', 'undefined', 1, '0', 1, 1, '4.50', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, '10.00'),
(3297, '347', '2021-10-30 18:07:39', '0', 'undefined', 1, '0', 1, 1, '4.50', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, '10.00'),
(3298, '348', '2021-10-30 18:07:51', '0', 'undefined', 1, '0', 1, 1, '6.00', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, '20.00'),
(3299, '350', '2021-10-30 18:09:04', '0', 'undefined', 1, '0', 1, 1, '20.00', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, '50.00'),
(3300, '351', '2021-11-03 07:04:46', '0', 'undefined', 1, '0', 1, 1, '9.00', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, '0.00'),
(3301, '2', '2021-11-03 09:09:48', '0', 'undefined', 1, '0', 1, 1, '4.50', '0.00', '8', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'C001', 1, '', 0, 'undefined', 0, '0.00'),
(3302, '352', '2021-11-04 11:01:50', '0', 'undefined', 1, '0', 1, 1, '5.01', '0.00', '3', 1, 1, 1, 1, 1, '1', '', '0.00', '2018-11-11', 0, 'T001', 1, '', 0, '', 0, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_carrito`
--

DROP TABLE IF EXISTS `factura_carrito`;
CREATE TABLE IF NOT EXISTS `factura_carrito` (
  `id_factura1` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `documento` varchar(11) NOT NULL,
  `observacion` text NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `nro_guia` int(11) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `activo` int(11) NOT NULL,
  `fecha1` datetime NOT NULL,
  PRIMARY KEY (`id_factura1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

DROP TABLE IF EXISTS `fotos`;
CREATE TABLE IF NOT EXISTS `fotos` (
  `id_foto` int(10) NOT NULL AUTO_INCREMENT,
  `nom_foto` varchar(30) NOT NULL,
  `archivo` text NOT NULL,
  `largo` varchar(10) NOT NULL,
  `ancho` varchar(10) NOT NULL,
  `ubi_pag` varchar(30) NOT NULL,
  PRIMARY KEY (`id_foto`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id_foto`, `nom_foto`, `archivo`, `largo`, `ancho`, `ubi_pag`) VALUES
(38, 'slider1', 'fotoPr8dJmY0.jpg', '620', '356', 'slider1'),
(39, 'slider2', 'fotoWNO7xmCv.jpg', '1300', '866', 'slider2'),
(42, 'vision', 'vision.jpg', '340', '340', 'fotovision'),
(43, 'mision', 'mision.jpg', '800', '600', 'fotomision'),
(44, 'slider3', 'fotox1Pqoy0j.jpg', '870', '424', 'slider3'),
(45, 'sdfs', 'vision.jpg', '', '', 'fotovision'),
(46, 'vision', 'vision.jpg', '340', '340', 'fotovision');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos1`
--

DROP TABLE IF EXISTS `fotos1`;
CREATE TABLE IF NOT EXISTS `fotos1` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `nom_foto` varchar(30) NOT NULL,
  `archivo` text NOT NULL,
  `largo` varchar(10) NOT NULL,
  `ancho` varchar(10) NOT NULL,
  `ubi_pag` varchar(30) NOT NULL,
  `a1` varchar(30) NOT NULL,
  `a2` varchar(30) NOT NULL,
  `a3` varchar(30) NOT NULL,
  PRIMARY KEY (`id_foto`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fotos1`
--

INSERT INTO `fotos1` (`id_foto`, `nom_foto`, `archivo`, `largo`, `ancho`, `ubi_pag`, `a1`, `a2`, `a3`) VALUES
(10, 'mision', 'mision.jpg', '800', '600', 'Mision', '', '', ''),
(12, 'slider1', 's1.jpg', '825', '400', 'Inicio', 'Nueva Coleccion', 'Comprar Hasta un', '37% Descuento'),
(13, 'slider2', 's5.jpg', '1146', '556', 'Inicio', 'Nueva Coleccion', 'Comprar Hasta un', '37% Descuento'),
(14, 'slider3', 'si1.jpg', '187', '442', 'Inicio', '', '', ''),
(15, 'slider4', 'si5.jpg', '256', '355', 'Inicio', '', '', ''),
(16, 'banner1', 'banner1.jpg', '653', '288', 'Inicio', '', '', ''),
(17, 'banner2', 'banner2.jpg', '460', '289', 'Inicio', '', '', ''),
(20, 'banner 3', 'banner3.jpg', '1142', '196', 'Inicio', 'comentario 1', 'comentario 2', 'comentario 3'),
(21, 'vision', 'vision.jpg', '340', '340', 'Vision', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `globales`
--

DROP TABLE IF EXISTS `globales`;
CREATE TABLE IF NOT EXISTS `globales` (
  `id_global` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `med` varchar(20) NOT NULL,
  PRIMARY KEY (`id_global`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `globales`
--

INSERT INTO `globales` (`id_global`, `nombre`, `med`) VALUES
(1, 'COLOR', '#E0E6F8'),
(2, 'COLOR1', '#D8D8D8'),
(3, 'COLOR2', '#58FAAC'),
(4, 'COLOR3', '#F3F781'),
(5, 'iva', '0.18'),
(6, 'nom_iva', 'IGV'),
(7, 'doc', 'Nota de venta'),
(8, 'moneda', 'S/.'),
(9, 'videos', '1'),
(10, 'des1', 'Modelo'),
(11, 'des2', 'Color'),
(12, 'des3', 'Marca'),
(13, 'D.N.I ', '8'),
(14, 'R.U.C ', '11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia`
--

DROP TABLE IF EXISTS `guia`;
CREATE TABLE IF NOT EXISTS `guia` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_doc` int(10) NOT NULL,
  `serie` varchar(4) DEFAULT NULL,
  `guia` int(8) DEFAULT NULL,
  `dir_par` varchar(100) DEFAULT NULL,
  `dom_lleg` text,
  `cont_lleg` text,
  `tel_lleg` text,
  `fecha_lleg` date DEFAULT NULL,
  `vehiculo` text,
  `inscripcion` text,
  `lic` text,
  `fecha` date DEFAULT NULL,
  `CODMOTIVO_TRASLADO` varchar(2) DEFAULT NULL,
  `MOTIVO_TRASLADO` varchar(10) DEFAULT NULL,
  `PESO` decimal(10,3) DEFAULT NULL,
  `NUMERO_PAQUETES` int(5) DEFAULT NULL,
  `UBIGEO_DESTINO` varchar(10) DEFAULT NULL,
  `UBIGEO_PARTIDA` varchar(10) DEFAULT NULL,
  `NRO_DOCUMENTO_TRANSPORTE` varchar(11) DEFAULT NULL,
  `RAZON_SOCIAL_TRANSPORTE` varchar(150) DEFAULT NULL,
  `CODTIPO_TRANSPORTISTA` varchar(2) DEFAULT NULL,
  `hash_cpe` varchar(100) DEFAULT NULL,
  `cod_sunat` varchar(100) DEFAULT NULL,
  `aceptado_guia` varchar(100) DEFAULT NULL,
  `doc_guia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `guia`
--

INSERT INTO `guia` (`id`, `id_doc`, `serie`, `guia`, `dir_par`, `dom_lleg`, `cont_lleg`, `tel_lleg`, `fecha_lleg`, `vehiculo`, `inscripcion`, `lic`, `fecha`, `CODMOTIVO_TRASLADO`, `MOTIVO_TRASLADO`, `PESO`, `NUMERO_PAQUETES`, `UBIGEO_DESTINO`, `UBIGEO_PARTIDA`, `NRO_DOCUMENTO_TRANSPORTE`, `RAZON_SOCIAL_TRANSPORTE`, `CODTIPO_TRANSPORTISTA`, `hash_cpe`, `cod_sunat`, `aceptado_guia`, `doc_guia`) VALUES
(1, 3292, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `id_inventario` int(10) NOT NULL AUTO_INCREMENT,
  `id_producto` int(10) NOT NULL,
  `usuario` int(4) NOT NULL,
  `fecha` datetime NOT NULL,
  `inventario` decimal(12,2) NOT NULL,
  `inv_ini` decimal(12,2) NOT NULL,
  `tienda` int(2) NOT NULL,
  `motivo` text NOT NULL,
  PRIMARY KEY (`id_inventario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laborales`
--

DROP TABLE IF EXISTS `laborales`;
CREATE TABLE IF NOT EXISTS `laborales` (
  `id_laboral` int(10) NOT NULL AUTO_INCREMENT,
  `cod_var` varchar(10) NOT NULL,
  `variables` text NOT NULL,
  `des_var` text NOT NULL,
  `col_var` varchar(10) NOT NULL,
  PRIMARY KEY (`id_laboral`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `laborales`
--

INSERT INTO `laborales` (`id_laboral`, `cod_var`, `variables`, `des_var`, `col_var`) VALUES
(1, 'DF', 'DESCANSO FISICO', 'DESCANSO FISICO', '#8080ff'),
(0, 'A', 'ASISTENCIA', 'ASISTENCIA', '#2E9AFE'),
(3, 'V', 'VACACIONES', 'VACACIONES', '#ffff00'),
(4, 'LM', 'LICENCIA MATERNIDAD', 'LICENCIA MATERNIDAD', '#0080c0'),
(5, 'DM', 'DESCANSO MEDICO', 'DESCANSO MEDICO', '#ff00ff');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

DROP TABLE IF EXISTS `laboratorio`;
CREATE TABLE IF NOT EXISTS `laboratorio` (
  `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `nom_laboratorio` varchar(150) NOT NULL,
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id_laboratorio`, `nom_laboratorio`) VALUES
(4, 'niikita'),
(5, 'power'),
(6, 'otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pack`
--

DROP TABLE IF EXISTS `pack`;
CREATE TABLE IF NOT EXISTS `pack` (
  `id_pack` int(10) NOT NULL AUTO_INCREMENT,
  `id_producto` int(10) NOT NULL,
  `id_producto1` int(10) NOT NULL,
  `cantidad` decimal(8,2) NOT NULL,
  `tipo` int(2) NOT NULL,
  PRIMARY KEY (`id_pack`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_pago` int(10) NOT NULL,
  `id_factura` int(10) NOT NULL,
  `pago` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` char(20) NOT NULL,
  `nombre_producto` text,
  `status_producto` tinyint(4) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `precio_producto` decimal(10,2) DEFAULT NULL,
  `costo_producto` decimal(10,2) DEFAULT NULL,
  `mon_costo` decimal(4,2) DEFAULT NULL,
  `mon_venta` int(2) DEFAULT NULL,
  `cantidad_blister` varchar(20) DEFAULT NULL,
  `pro_contiene` varchar(50) DEFAULT NULL,
  `pro_puntos` varchar(50) DEFAULT NULL,
  `b1` int(11) DEFAULT NULL,
  `b2` int(11) DEFAULT NULL,
  `b3` int(11) DEFAULT NULL,
  `b4` int(11) DEFAULT NULL,
  `b5` int(11) DEFAULT NULL,
  `b6` int(11) DEFAULT NULL,
  `cat_pro` int(2) NOT NULL,
  `pro_ser` int(2) NOT NULL,
  `foto1` varchar(100) DEFAULT NULL,
  `foto2` varchar(100) DEFAULT NULL,
  `foto3` varchar(100) DEFAULT NULL,
  `foto4` varchar(100) DEFAULT NULL,
  `web` int(2) DEFAULT NULL,
  `pre_web` decimal(10,2) DEFAULT NULL,
  `descripcion` text,
  `descripcion1` text,
  `megusta` int(10) DEFAULT NULL,
  `nomegusta` int(10) DEFAULT NULL,
  `precio2` decimal(10,2) DEFAULT NULL,
  `precio3` decimal(10,2) DEFAULT NULL,
  `und_pro` int(3) DEFAULT NULL,
  `barras` varchar(20) DEFAULT NULL,
  `dcto` decimal(5,2) DEFAULT NULL,
  `min` decimal(10,2) DEFAULT NULL,
  `precio_blister` decimal(10,2) DEFAULT NULL,
  `fecha_caducidad` date DEFAULT NULL,
  `costo_total` decimal(10,2) DEFAULT NULL,
  `cod_laboratorio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=11831 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_producto`, `codigo_producto`, `nombre_producto`, `status_producto`, `date_added`, `precio_producto`, `costo_producto`, `mon_costo`, `mon_venta`, `cantidad_blister`, `pro_contiene`, `pro_puntos`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `cat_pro`, `pro_ser`, `foto1`, `foto2`, `foto3`, `foto4`, `web`, `pre_web`, `descripcion`, `descripcion1`, `megusta`, `nomegusta`, `precio2`, `precio3`, `und_pro`, `barras`, `dcto`, `min`, `precio_blister`, `fecha_caducidad`, `costo_total`, `cod_laboratorio`) VALUES
(11748, '7751128001952', 'GABAPENTAMINA 300MG', 1, '2021-10-17 14:41:53', '0.50', '0.30', '1.00', 1, '10', '100', '', 306, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.50', '', '', 0, 0, '0.00', '0.00', 1, '916846481602', '0.00', '50.00', '5.00', '2023-11-30', '49.00', 8),
(11749, '7753820001421', 'GLIBENCLAMIDA 5MG', 1, '2021-10-17 14:45:43', '0.20', '0.10', '1.00', 1, '10', '100', '', 165, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.20', '', '', 0, 0, '0.00', '0.00', 1, '092454204117', '0.00', '50.00', '2.00', '2023-01-31', '17.00', 7),
(11750, '7759307225496', 'GASEOVET  MS 800mg  +     40mg', 1, '2021-10-17 14:55:01', '1.50', '1.30', '1.00', 1, '5', '40', '', 53, 0, 0, 0, 0, 0, 85, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.50', '', '', 0, 0, '0.00', '0.00', 1, '937867734462', '0.30', '40.00', '6.00', '2022-12-31', '53.00', 9),
(11751, '7759307006873', 'GRAVAMIN  (Dimenhidrinato 50mg)', 1, '2021-10-17 15:23:36', '1.80', '1.60', '1.00', 1, '10', '100', '', 227, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.80', '', '', 0, 0, '0.00', '0.00', 1, '502591197990', '0.00', '50.00', '16.00', '2025-01-31', '160.00', 9),
(11752, '7759307207188', 'GASEOVET 40 (40mg)', 1, '2021-10-17 15:28:01', '1.50', '1.30', '1.00', 1, '15', '150', '', 98, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.50', '', '', 0, 0, '0.00', '0.00', 1, '778743955329', '0.00', '50.00', '15.00', '2023-03-31', '195.00', 9),
(11753, '7759307541862', 'GASEOVET  80mg/ml  (15 ml FRESA)', 1, '2021-10-17 15:33:02', '22.00', '19.00', '1.00', 1, '0', '1', '', 8, 0, 0, 0, 0, 0, 80, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '22.00', '', '', 0, 0, '0.00', '0.00', 2, '406233925513', '0.00', '5.00', '0.00', '2023-11-30', '19.00', 9),
(11754, '7759307556941', 'GASEOVET  80mg/ml  (15 ml ANIS)', 1, '2021-10-17 15:37:35', '22.00', '19.00', '1.00', 1, '0', '1', '', 2, 0, 0, 0, 0, 0, 80, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '22.00', '', '', 0, 0, '0.00', '0.00', 2, '313497391011', '0.00', '5.00', '0.00', '2024-01-31', '19.00', 9),
(11755, '7759307433396', 'GRAVOL (Dimenhidrinato) 50mg', 1, '2021-10-17 15:41:54', '3.50', '3.20', '1.00', 1, '10', '100', '', 75, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '3.50', '', '', 0, 0, '0.00', '0.00', 1, '800169745217', '0.00', '50.00', '35.00', '2024-11-30', '320.00', 9),
(11756, '7759307443678', 'GRAVOL A/P 75mg (Dimenhidrinato)', 1, '2021-10-17 15:47:35', '5.50', '5.30', '1.00', 1, '3', '12', '', 4, 0, 0, 0, 0, 0, 64, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '5.50', '', '', 0, 0, '0.00', '0.00', 1, '770011507599', '0.00', '5.00', '22.00', '2023-05-30', '63.60', 9),
(11757, '77503961', 'GRAVOL 12.5 mg/ml (Dimenhidrinato)', 1, '2021-10-17 15:50:41', '44.50', '42.00', '1.00', 1, '0', '1', '', 1, 0, 0, 0, 0, 0, 80, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '44.50', '', '', 0, 0, '0.00', '0.00', 1, '099440422388', '0.00', '5.00', '0.00', '2023-05-30', '42.00', 9),
(11758, '7750831017748', 'GINGISONA L NF 30ml', 1, '2021-10-17 15:57:57', '17.00', '16.00', '1.00', 1, '0', '1', '', 11, 0, 0, 0, 0, 0, 109, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '17.00', '', '', 0, 0, '0.00', '0.00', 2, '912406235216', '0.00', '5.00', '0.00', '2021-10-17', '16.00', 10),
(11759, '7750831017533', 'GINGISONA B 15ml', 1, '2021-10-17 16:01:24', '27.00', '24.00', '1.00', 1, '0', '1', '', 7, 0, 0, 0, 0, 0, 110, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '27.00', '', '', 0, 0, '0.00', '0.00', 2, '073922361893', '0.00', '5.00', '0.00', '2024-06-30', '24.00', 10),
(11760, '7759307005838', 'GASEOVET MS 220 mL', 1, '2021-10-17 16:03:33', '22.00', '20.00', '1.00', 1, '0', '1', '', 3, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '22.00', '', '', 0, 0, '0.00', '0.00', 2, '958402682474', '0.00', '5.00', '0.00', '2023-03-30', '20.00', 9),
(11761, '7752343000010', 'GENTAMICINA 0.3% / 5mL', 1, '2021-10-17 16:08:52', '6.00', '5.00', '1.00', 1, '0', '1', '', 19, 0, 0, 0, 0, 0, 111, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '6.00', '', '', 0, 0, '0.00', '0.00', 2, '713734604720', '0.00', '5.00', '0.00', '2023-03-30', '5.00', 11),
(11762, '7752092000088', 'GENSARNA 25%', 1, '2021-10-17 16:14:28', '12.00', '11.00', '1.00', 1, '0', '1', '', 6, 0, 0, 0, 0, 0, 112, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '12.00', '', '', 0, 0, '0.00', '0.00', 2, '426422387064', '0.00', '5.00', '0.00', '2023-08-31', '11.00', 12),
(11763, '7702605151035', 'GEMFIBROZILO 600mg', 1, '2021-10-17 16:24:19', '0.50', '0.30', '1.00', 1, '2', '20', '', 60, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.50', '', '', 0, 0, '0.00', '0.00', 1, '468165439085', '0.00', '5.00', '0.00', '2022-04-30', '18.00', 13),
(11764, '7840653000124', 'GRIFANTIL 60mL', 1, '2021-10-17 16:27:36', '24.00', '23.00', '1.00', 1, '0', '1', '', 2, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '24.00', '', '', 0, 0, '0.00', '0.00', 2, '958973504354', '0.00', '5.00', '0.00', '2024-07-30', '23.00', 14),
(11765, '7759307006385', 'GRIPA-C', 1, '2021-10-17 16:32:16', '1.00', '0.80', '1.00', 1, '10', '100', '', 16, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.00', '', '', 0, 0, '0.00', '0.00', 1, '868811198500', '0.00', '50.00', '10.00', '2023-06-30', '95.00', 9),
(11766, '7759307006392', 'GRIPA-C JHUNIOR', 1, '2021-10-17 16:35:45', '1.00', '0.80', '1.00', 1, '10', '100', '', 53, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.00', '', '', 0, 0, '0.00', '0.00', 1, '376297345839', '0.00', '50.00', '0.00', '2022-04-30', '80.00', 9),
(11767, '7757310693189', 'GEROMUCOVIT PLUS', 1, '2021-10-17 16:39:54', '1.30', '1.10', '1.00', 1, '10', '100', '', 100, 0, 0, 0, 0, 0, 64, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.30', '', '', 0, 0, '0.00', '0.00', 1, '053024164556', '0.00', '50.00', '0.00', '2023-09-09', '110.00', 15),
(11768, '7751207000654', 'GYNOVAL ', 1, '2021-10-17 16:46:11', '4.80', '4.30', '1.00', 1, '10', '50', '', 42, 0, 0, 0, 0, 0, 69, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '4.80', '', '', 0, 0, '0.00', '0.00', 1, '857806939245', '0.00', '5.00', '24.00', '2023-12-31', '215.00', 5),
(11769, '7750500001320', 'GUCAL 10%', 1, '2021-10-17 16:49:43', '3.80', '3.30', '1.00', 1, '1', '10', '', 2, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '3.80', '', '', 0, 0, '0.00', '0.00', 1, '565199213826', '0.00', '20.00', '38.00', '2023-09-30', '33.00', 16),
(11770, '7750500000941', 'N-BUTILBROMURO DE HIOSCINA 20mg/mL', 1, '2021-10-17 16:54:00', '4.20', '3.80', '1.00', 1, '0', '25', '', 23, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '4.20', '', '', 0, 0, '0.00', '0.00', 1, '174376695623', '0.00', '50.00', '0.00', '2022-03-30', '95.00', 16),
(11771, '7707236127480', 'HIDROCORTISONA 100mg', 1, '2021-10-17 16:57:52', '8.00', '7.50', '1.00', 1, '0', '10', '', 16, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '8.00', '', '', 0, 0, '0.00', '0.00', 1, '739723271750', '0.00', '50.00', '0.00', '2023-11-30', '75.00', 17),
(11772, '7753820001049', 'HEPARINA SODICA 5000 UI/mL', 1, '2021-10-17 17:05:01', '28.00', '25.00', '1.00', 1, '0', '10', '', 27, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '28.00', '', '', 0, 0, '0.00', '0.00', 1, '433781192173', '0.00', '50.00', '0.00', '2023-06-30', '250.00', 7),
(11773, '7753820000622', 'HIDROCORTISONA SUCCINATO SODICO 250 mg', 1, '2021-10-17 17:08:38', '13.00', '11.00', '1.00', 1, '0', '10', '', 10, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '13.00', '', '', 0, 0, '0.00', '0.00', 1, '193699261713', '0.00', '50.00', '0.00', '2022-02-28', '110.00', 7),
(11774, '7757310003223', 'HANALGEZE ', 1, '2021-10-17 17:11:35', '3.20', '2.90', '1.00', 1, '5', '50', '', 30, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '3.20', '', '', 0, 0, '0.00', '0.00', 1, '426462883572', '0.00', '50.00', '16.00', '2022-04-30', '290.00', 15),
(11775, '7755860000297', 'HIDROXOCOBALAMINA 1mg/mL', 1, '2021-10-17 17:17:40', '4.00', '3.90', '1.00', 1, '0', '100', '', 86, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '4.00', '', '', 0, 0, '0.00', '0.00', 1, '136193003573', '0.00', '20.00', '0.00', '2021-12-30', '390.00', 18),
(11776, '7757310002226', 'HIEDRATOS 100 mL', 1, '2021-10-17 17:21:54', '22.00', '20.00', '1.00', 1, '0', '1', '', 3, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '22.00', '', '', 0, 0, '0.00', '0.00', 2, '942646760523', '0.00', '10.00', '0.00', '2022-06-30', '20.00', 15),
(11797, '7702605151196', 'IBUPROFENO 400mg', 1, '2021-10-17 19:53:46', '0.10', '10.00', '1.00', 1, '10', '100', '', 823, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.10', '', '', 0, 0, '0.00', '0.00', 1, '849908221128', '0.00', '50.00', '0.00', '2022-04-30', '10.00', 13),
(11778, '7758112001141', 'HALOPERIDOL 10 mg', 1, '2021-10-17 17:28:47', '0.70', '0.50', '1.00', 1, '10', '100', '', 60, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.70', '', '', 0, 0, '0.00', '0.00', 1, '526403260329', '0.00', '20.00', '0.00', '2022-03-30', '50.00', 20),
(11779, '172401311075ra0241', 'HALOPERIDOL 5mg/ 1mL', 1, '2021-10-17 17:32:34', '6.50', '6.00', '1.00', 1, '0', '100', '', 75, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '6.50', '', '', 0, 0, '0.00', '0.00', 1, '349464125818', '0.00', '20.00', '0.00', '2024-01-30', '8.00', 21),
(11780, '77506375', 'HALOPERIDOL 2mg/mL', 1, '2021-10-17 17:50:35', '16.00', '13.00', '1.00', 1, '0', '1', '', 4, 0, 0, 0, 0, 0, 80, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '16.00', '', '', 0, 0, '0.00', '0.00', 1, '826833439533', '0.00', '5.00', '0.00', '2023-06-30', '13.00', 22),
(11781, '7751940000287', 'HIRUDOID 14g', 1, '2021-10-17 17:55:56', '18.50', '17.00', '1.00', 1, '0', '1', '', 7, 0, 0, 0, 0, 0, 106, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '18.50', '', '', 0, 0, '0.00', '0.00', 1, '573926658090', '0.00', '5.00', '0.00', '2026-02-28', '17.00', 23),
(11782, '7800018188652', 'HIPOGLOS 20 g', 1, '2021-10-17 17:59:35', '13.00', '11.00', '1.00', 1, '0', '1', '', 3, 0, 0, 0, 0, 0, 34, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '13.00', '', '', 0, 0, '0.00', '0.00', 1, '922106120124', '0.00', '5.00', '0.00', '2021-10-17', '11.00', 4),
(11783, '7753820001469', 'IMIPENEM + CILASTATINA 0.5g +0.5G', 1, '2021-10-17 18:03:04', '28.50', '25.00', '1.00', 1, '0', '1', '', 6, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '28.50', '', '', 0, 0, '0.00', '0.00', 1, '148714101436', '0.00', '5.00', '0.00', '2022-04-30', '25.00', 7),
(11784, '7754662000825', 'HIERRONIM 100mg / 5mL', 1, '2021-10-17 18:06:04', '20.00', '18.00', '1.00', 1, '0', '5', '', 43, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '20.00', '', '', 0, 0, '0.00', '0.00', 1, '621937930064', '0.00', '5.00', '0.00', '2021-10-17', '18.00', 24),
(11785, '7702605151158', 'HIDROCLOROTIAZIDA 50 mg', 1, '2021-10-17 18:10:58', '0.50', '14.00', '1.00', 1, '03', '30', '', 148, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.50', '', '', 0, 0, '0.00', '0.00', 1, '886703669715', '0.00', '5.00', '5.00', '2023-09-30', '14.00', 13),
(11786, '7757398183817', 'HADENSA 15g', 1, '2021-10-17 18:14:20', '38.80', '35.00', '1.00', 1, '0', '1', '', 6, 0, 0, 0, 0, 0, 106, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '38.80', '', '', 0, 0, '0.00', '0.00', 1, '897362624661', '0.00', '5.00', '0.00', '2023-04-30', '35.00', 25),
(11787, '7750778592292', 'HUMEDAD 15mL', 1, '2021-10-17 18:20:03', '16.50', '15.00', '1.00', 1, '0', '1', '', 2, 0, 0, 0, 0, 0, 113, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '16.50', '', '', 0, 0, '0.00', '0.00', 1, '981949925926', '0.00', '5.00', '0.00', '2024-03-30', '15.00', 11),
(11788, '7759604000246', 'HEPABIONTA 2mL', 1, '2021-10-17 18:25:51', '22.80', '20.00', '1.00', 1, '0', '3', '', 6, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '22.80', '', '', 0, 0, '0.00', '0.00', 1, '287795397326', '0.00', '5.00', '0.00', '2024-04-30', '20.00', 26),
(11789, '7757016000250', 'GLORANTA Caramelos', 1, '2021-10-17 18:34:53', '2.00', '1.60', '1.00', 1, '0', '', '', 25, 0, 0, 0, 0, 0, 67, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.00', '', '', 0, 0, '0.00', '0.00', 1, '017677320412', '0.00', '5.00', '0.00', '2023-04-30', '1.60', 27),
(11790, '7751207002184', 'HEPAVIT B COMPLEX', 1, '2021-10-17 18:37:06', '1.50', '20.00', '1.00', 1, '10', '100', '', 50, 0, 0, 0, 0, 0, 64, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.50', '', '', 0, 0, '0.00', '0.00', 1, '506390864326', '0.00', '5.00', '15.00', '2024-09-30', '20.00', 5),
(11791, '7702605151226', 'IBUPROFENO 120 mL', 1, '2021-10-17 18:44:18', '5.00', '4.00', '1.00', 1, '0', '1', '', 2, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '5.00', '', '', 0, 0, '0.00', '0.00', 2, '368909393243', '0.00', '5.00', '0.00', '2023-07-30', '4.00', 13),
(11792, '7840653007567', 'BANES 60mL (Ibuprofeno)', 1, '2021-10-17 18:47:59', '8.00', '7.00', '1.00', 1, '0', '1', '', 1, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '8.00', '', '', 0, 0, '0.00', '0.00', 2, '083048700297', '0.00', '5.00', '0.00', '2023-05-30', '7.00', 14),
(11793, '7750215728222', 'IBUPROFENO 100mg / 5mL', 1, '2021-10-17 18:55:35', '3.50', '3.00', '1.00', 1, '0', '1', '', 7, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '3.50', '', '', 0, 0, '0.00', '0.00', 2, '308210505150', '0.00', '5.00', '0.00', '2024-07-30', '3.00', 19),
(11794, '7759604000635', 'HEPABIONTA ', 1, '2021-10-17 18:59:04', '2.00', '1.80', '1.00', 1, '50', '200', '', 147, 0, 0, 0, 0, 0, 107, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.00', '', '', 0, 0, '0.00', '0.00', 1, '405478724473', '0.00', '20.00', '0.00', '2024-02-28', '1.80', 26),
(11795, '7755570000068', 'DOLIFEB (Ibuprofeno)', 1, '2021-10-17 19:04:46', '10.00', '8.00', '1.00', 1, '0', '1', '', 6, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '10.00', '', '', 0, 0, '0.00', '0.00', 2, '008738723035', '0.00', '5.00', '0.00', '2023-11-30', '8.00', 28),
(11796, '7705959881290', 'Editar', 1, '2021-10-17 19:28:14', '7.00', '7.00', '1.00', 1, '0', '', '', 6, 0, 0, 0, 0, 0, 15, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '7.00', '', '', 0, 0, '0.00', '0.00', 1, '348922195123', '0.00', '4.00', '0.00', '2021-10-27', '4.00', 5),
(11798, '7702605151219', 'IBUPROFENO 800mg', 1, '2021-10-17 20:38:01', '0.40', '0.20', '1.00', 1, '5', '50', '', 10, 0, 0, 0, 0, 0, 59, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.40', '', '', 0, 0, '0.00', '0.00', 1, '898574829228', '0.00', '20.00', '4.00', '2021-10-18', '0.20', 13),
(11799, '7750625000178', 'IBUPIROL 100mg / 5 mL', 1, '2021-10-17 20:45:37', '1.00', '1.00', '1.00', 1, '10', '60', '', 100, 0, 0, 0, 0, 0, 114, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.00', '', '', 0, 0, '0.00', '0.00', 1, '258641527124', '0.00', '20.00', '0.00', '2023-03-30', '1.00', 29),
(11800, '7759307002226', 'IOPAMED 370 (lopamidol 755mg/mL)', 1, '2021-10-17 20:47:56', '146.00', '1.00', '1.00', 1, '0', '1', '', 3, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '146.00', '', '', 0, 0, '0.00', '0.00', 2, '981557322785', '0.00', '10.00', '0.00', '2022-01-30', '1.00', 9),
(11801, '7751198000169', 'IRRIGOR PLUS', 1, '2021-10-17 21:08:53', '3.30', '1.00', '1.00', 1, '3', '30', '', 71, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '3.30', '', '', 0, 0, '0.00', '0.00', 1, '267224519233', '0.00', '10.00', '0.00', '2022-09-30', '1.00', 30),
(11802, '7751946003008', 'IRRICOLINA (NIMODIPINO 30mg)', 1, '2021-10-17 21:12:49', '1.00', '1.00', '1.00', 1, '3', '30', '', 30, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.00', '', '', 0, 0, '0.00', '0.00', 1, '122636480070', '0.00', '10.00', '0.00', '2022-09-30', '1.00', 31),
(11803, '7757310415835', 'ISORBIDE Sublingual (Dinitrato de Idodorbida 5mg )', 1, '2021-10-17 21:17:26', '4.50', '1.00', '1.00', 1, '1', '25', '', 16, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '4.50', '', '', 0, 0, '0.00', '0.00', 1, '632275402067', '0.00', '5.00', '0.00', '2022-06-30', '1.00', 15),
(11804, '7757310415842', 'ISORBIDE (Dinitrato de Idodorbida 10mg )', 1, '2021-10-17 21:19:24', '4.50', '1.00', '1.00', 1, '1', '20', '', 1, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '4.50', '', '', 0, 0, '0.00', '0.00', 1, '384552356556', '0.00', '10.00', '0.00', '2024-01-30', '1.00', 15),
(11805, '7757310430234', 'INFECTRIM 60mL', 1, '2021-10-17 21:22:01', '22.00', '1.00', '1.00', 1, '0', '1', '', 4, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '22.00', '', '', 0, 0, '0.00', '0.00', 2, '490779927543', '0.00', '5.00', '0.00', '2023-02-28', '1.00', 15),
(11806, '7750936002366', 'ITRACONAZAL 100mg', 1, '2021-10-17 21:26:15', '2.00', '1.00', '1.00', 1, '10', '100', '', 82, 0, 0, 0, 0, 0, 64, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.00', '', '', 0, 0, '0.00', '0.00', 1, '369350342779', '0.00', '20.00', '0.00', '2023-05-30', '1.00', 32),
(11807, '7759307002851', 'IDELLE 15g', 1, '2021-10-17 21:30:44', '39.80', '1.00', '1.00', 1, '0', '1', '', 6, 0, 0, 0, 0, 0, 115, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '39.80', '', '', 0, 0, '0.00', '0.00', 1, '904250709350', '0.00', '5.00', '0.00', '2023-01-30', '1.00', 9),
(11808, '7750215004487', 'OMEPRAZOL 20mg (ANTIULCEROSO)', 1, '2021-10-18 09:36:39', '0.20', '1.00', '1.00', 1, '10', '100', '', 45, 0, 0, 0, 0, 0, 64, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.20', '', '', 0, 0, '0.00', '0.00', 1, '890213403807', '0.00', '20.00', '0.00', '2023-05-30', '1.00', 19),
(11809, '7753820001940', 'OMEPRAZOL 20mg', 1, '2021-10-18 09:45:57', '0.20', '1.00', '1.00', 1, '10', '100', '', 200, 0, 0, 0, 0, 0, 64, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.20', '', '', 0, 0, '0.00', '0.00', 1, '769160614926', '0.00', '20.00', '0.00', '2024-01-30', '1.00', 7),
(11810, '7755860000068', 'OMEPRAZOL 40mg ', 1, '2021-10-18 09:51:54', '7.00', '1.00', '1.00', 1, '0', '50', '', 61, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '7.00', '', '', 0, 0, '0.00', '0.00', 2, '298091207501', '0.00', '20.00', '0.00', '2024-03-30', '1.00', 18),
(11811, '7753709000149', 'OEFENADRINA CITRATO 60mg/ 2mL', 1, '2021-10-18 10:00:11', '2.50', '1.00', '1.00', 1, '0', '100', '', 14, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.50', '', '', 0, 0, '0.00', '0.00', 2, '675472625359', '0.00', '20.00', '0.00', '2024-08-30', '1.00', 33),
(11812, '7758112000502', 'ORFENADRINA CITRATO ', 1, '2021-10-18 10:05:47', '0.40', '1.00', '1.00', 1, '10', '100', '', 10, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.40', '', '', 0, 0, '0.00', '0.00', 1, '335440570209', '0.00', '20.00', '4.00', '2023-06-30', '1.00', 20),
(11813, '7758967000023', 'ORFEDOL 60.00mg ', 1, '2021-10-18 10:22:55', '2.50', '1.00', '1.00', 1, '0', '25', '', 23, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.50', '', '', 0, 0, '0.00', '0.00', 2, '612737283371', '0.00', '20.00', '0.00', '2023-05-30', '1.00', 33),
(11814, '7750958000333', 'OVUDATE ', 1, '2021-10-18 10:31:11', '7.00', '1.00', '1.00', 1, '10', '60', '', 37, 0, 0, 0, 0, 0, 69, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '7.00', '', '', 0, 0, '0.00', '0.00', 1, '914495096817', '0.00', '20.00', '0.00', '2022-09-30', '1.00', 34),
(11815, '7752343000096', 'PREDNISOLONA ', 1, '2021-10-18 10:42:40', '18.80', '1.00', '1.00', 1, '0', '1', '', 1, 0, 0, 0, 0, 0, 62, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '18.80', '', '', 0, 0, '0.00', '0.00', 2, '787601048338', '0.00', '20.00', '0.00', '2023-03-30', '1.00', 11),
(11816, '7758713000352', 'PANADOL', 1, '2021-10-18 11:01:38', '1.80', '1.00', '1.00', 1, '0', '24', '', 43, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.80', '', '', 0, 0, '0.00', '0.00', 1, '550600110538', '0.00', '20.00', '0.00', '2023-07-30', '1.00', 35),
(11817, '7441026001276', 'PANADOL  160mg/5mL', 1, '2021-10-18 11:07:51', '16.00', '1.00', '1.00', 1, '0', '1', '', 3, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '16.00', '', '', 0, 0, '0.00', '0.00', 1, '846544231286', '0.00', '20.00', '0.00', '2022-08-30', '1.00', 35),
(11818, '7441026001283', 'PANADOL 100mg/mL', 1, '2021-10-18 11:10:31', '14.80', '1.00', '1.00', 1, '0', '1', '', 1, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '14.80', '', '', 0, 0, '0.00', '0.00', 1, '529047440601', '0.00', '20.00', '0.00', '2022-10-30', '1.00', 35),
(11819, '7750215575819', 'PARACETAMOL 120mg / 5mL', 1, '2021-10-18 11:15:18', '4.50', '1.00', '1.00', 1, '0', '1', '', 40, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '4.50', '', '', 0, 0, '0.00', '0.00', 1, '337760032278', '0.00', '20.00', '0.00', '2024-06-30', '1.00', 19),
(11820, '7840653001855', 'OTOMICIN 10mL', 1, '2021-10-18 11:22:20', '18.00', '1.00', '1.00', 1, '0', '1', '', 3, 0, 0, 0, 0, 0, 58, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '18.00', '', '', 0, 0, '0.00', '0.00', 1, '992958654373', '0.00', '20.00', '0.00', '2021-12-30', '1.00', 14),
(11821, '7702605151684', 'PARACETAMOL 150 mg / 5 mL', 1, '2021-10-18 11:24:27', '3.50', '1.00', '1.00', 1, '0', '1', '', 3, 0, 0, 0, 0, 0, 63, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '3.50', '', '', 0, 0, '0.00', '0.00', 1, '043548918705', '0.00', '20.00', '0.00', '2023-08-30', '1.00', 13),
(11822, '7750215074299', 'PARACETAMOL 100g / 5mL', 1, '2021-10-18 11:31:46', '1.50', '1.00', '1.00', 1, '0', '1', '', 2, 0, 0, 0, 0, 0, 80, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.50', '', '', 0, 0, '0.00', '0.00', 1, '960182751611', '0.00', '20.00', '0.00', '2022-08-30', '1.00', 19),
(11823, '7451079003424', 'PANADOL (ANTIGRIPAL NF)', 1, '2021-10-18 11:38:01', '2.50', '1.00', '1.00', 1, '0', '104', '', 307, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.50', '', '', 0, 0, '0.00', '0.00', 1, '049532730978', '0.00', '20.00', '0.00', '2022-12-30', '1.00', 35),
(11824, '7451079003387', 'PANADOL FORTE ', 1, '2021-10-18 11:41:07', '2.00', '1.00', '1.00', 1, '0', '52', '', 270, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.00', '', '', 0, 0, '0.00', '0.00', 1, '975494113337', '0.00', '20.00', '0.00', '2022-12-30', '1.00', 35),
(11825, '7758713000031', 'PANADOL 500mg', 1, '2021-10-18 11:44:19', '1.50', '1.00', '1.00', 1, '0', '100', '', 34, 0, 0, 0, 0, 0, 65, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '1.50', '', '', 0, 0, '0.00', '0.00', 1, '223369539454', '0.00', '20.00', '0.00', '2024-12-30', '1.00', 35),
(11826, 'UC64ZRW37XMV4', 'otros', 1, '2021-10-18 12:10:12', '2.00', '1.00', '1.00', 1, '5', '100', '', 568, 0, 0, 0, 0, 0, 14, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '0.00', '', '', 0, 0, '0.00', '0.00', 1, '669807419843', '0.00', '5.00', '10.00', '2021-10-18', '50.00', 4),
(11827, '4X6R8WPGDK8UM', 'otrosss', 1, '2021-10-19 21:59:33', '2.00', '1.00', '1.00', 1, '0', '10', '', 50, 0, 0, 0, 0, 0, 16, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.00', '', '', 0, 0, '0.00', '0.00', 1, '814146122453', '0.00', '2.00', '0.00', '2021-10-20', '50.00', 5),
(11828, 'K2QUZ1NKJ6YW2', 'otros abc', 1, '2021-10-19 22:00:35', '2.00', '1.00', '1.00', 1, '0', '10', '', 0, 0, 12, 0, 0, 0, 14, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.00', '', '', 0, 0, '0.00', '0.00', 1, '614198897892', '0.00', '10.00', '0.00', '2021-10-20', '100.00', 4),
(11829, 'CJK5WW25DK04Z', 'x', 1, '2021-10-24 03:12:39', '2.00', '1.00', '1.00', 1, '3', '10', '10', 68, 0, 61, 0, 0, 0, 15, 1, 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.00', '', '', 0, 0, '0.00', '0.00', 1, '834932071736', '0.00', '2.00', '5.00', '2021-10-24', '50.00', 4),
(11830, 'KP4HT9HMHBG5T', 'ax', 1, '2021-11-03 12:25:43', '2.00', '1.00', '1.00', 1, '0', '10', '30', 10, 0, 0, 0, 0, 0, 19, 1, '1producto11830.jpg', 'nuevo.jpg', 'nuevo.jpg', 'nuevo.jpg', 0, '2.00', '', '', 0, 0, '0.00', '0.00', 2, '110430965721', '0.00', '2.00', '0.00', '2021-11-03', '10.00', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_documentos`
--

DROP TABLE IF EXISTS `resumen_documentos`;
CREATE TABLE IF NOT EXISTS `resumen_documentos` (
  `id_resumen` int(10) NOT NULL AUTO_INCREMENT,
  `numero` varchar(8) NOT NULL,
  `fecha` date NOT NULL,
  `aceptado_resumen` varchar(100) NOT NULL,
  `xml` varchar(30) NOT NULL,
  `ticket` varchar(20) NOT NULL,
  `hash_cpe` varchar(100) NOT NULL,
  `cod_sunat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_resumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruc`
--

DROP TABLE IF EXISTS `ruc`;
CREATE TABLE IF NOT EXISTS `ruc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruc` text NOT NULL,
  `nombre` text NOT NULL,
  `direccion` text NOT NULL,
  `departamento` text NOT NULL,
  `provincia` text NOT NULL,
  `distrito` text NOT NULL,
  `telefono` text NOT NULL,
  `email` text NOT NULL,
  `web` text NOT NULL,
  `rubro` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12052 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE IF NOT EXISTS `servicio` (
  `id_servicio` int(10) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `doc_servicio` varchar(30) NOT NULL,
  `tienda` int(2) NOT NULL,
  `nom_ser` varchar(100) NOT NULL,
  `tipo` int(2) NOT NULL,
  `pre_ser` decimal(5,2) NOT NULL,
  `ade_ser` decimal(5,2) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `des_ser` text NOT NULL,
  `car1` varchar(200) NOT NULL,
  `car2` varchar(200) NOT NULL,
  `car3` varchar(200) NOT NULL,
  `car4` varchar(200) NOT NULL,
  `car5` varchar(200) NOT NULL,
  `car6` varchar(200) NOT NULL,
  `com_ser` text NOT NULL,
  `ter_ser` int(2) NOT NULL,
  `cancelado` int(2) NOT NULL,
  `telefono1` varchar(100) NOT NULL,
  `guia` varchar(100) NOT NULL,
  `tip_doc` int(2) NOT NULL,
  `activo` int(2) NOT NULL,
  `detalle` int(10) NOT NULL,
  `fecha_emision` datetime NOT NULL,
  `fecha_reparado` datetime NOT NULL,
  `saliente` datetime NOT NULL,
  `desechado` datetime NOT NULL,
  `aceptar_guia` int(2) NOT NULL,
  `reparado` int(2) NOT NULL,
  `entregado` int(10) NOT NULL,
  `id_reparado` int(10) NOT NULL,
  `id_entregado` int(10) NOT NULL,
  PRIMARY KEY (`id_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

DROP TABLE IF EXISTS `servicios`;
CREATE TABLE IF NOT EXISTS `servicios` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `nom_servicio` text NOT NULL,
  `cod_servicio` varchar(10) NOT NULL,
  `pre_servicio` decimal(10,2) NOT NULL,
  `tipo` int(2) NOT NULL,
  PRIMARY KEY (`id_servicio`),
  UNIQUE KEY `cod` (`cod_servicio`),
  UNIQUE KEY `nom` (`nom_servicio`(10))
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nom_servicio`, `cod_servicio`, `pre_servicio`, `tipo`) VALUES
(9, 'Consulta ', '001', '80.00', 0),
(11, 'RevisiÃ³n 1', '1234', '45.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_tipo`
--

DROP TABLE IF EXISTS `sub_tipo`;
CREATE TABLE IF NOT EXISTS `sub_tipo` (
  `id_sub_tipo` int(2) NOT NULL AUTO_INCREMENT,
  `id_tipo` int(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `sub_tipo` text NOT NULL,
  PRIMARY KEY (`id_sub_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sub_tipo`
--

INSERT INTO `sub_tipo` (`id_sub_tipo`, `id_tipo`, `nombre`, `sub_tipo`) VALUES
(1, 1, 'Laptop', 'Marca'),
(2, 1, 'Laptop', 'Modelo'),
(3, 1, 'Laptop', 'Nro Serie'),
(4, 1, 'Laptop', 'Procesador'),
(5, 1, 'Laptop', 'Memoria Ram'),
(7, 2, 'Computadora', 'Marca'),
(8, 2, 'Computadora', 'Modelo'),
(9, 2, 'Computadora', 'Placa'),
(10, 2, 'Computadora', 'Procesador'),
(11, 2, 'Computadora', 'Memoria Ram'),
(13, 3, 'Impresora', 'Tipo'),
(14, 3, 'Impresora', 'Marca'),
(15, 3, 'Impresora', 'Modelo'),
(16, 3, 'Impresora', 'Nro Serie');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE IF NOT EXISTS `sucursal` (
  `id_sucursal` int(10) NOT NULL AUTO_INCREMENT,
  `tienda` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `ubigeo` varchar(10) NOT NULL,
  `caja` int(2) NOT NULL,
  `dep_suc` varchar(100) NOT NULL,
  `pro_suc` varchar(100) NOT NULL,
  `dis_suc` varchar(100) NOT NULL,
  `descripcion_sucursal` text,
  PRIMARY KEY (`id_sucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id_sucursal`, `tienda`, `nombre`, `ruc`, `direccion`, `correo`, `telefono`, `foto`, `ubigeo`, `caja`, `dep_suc`, `pro_suc`, `dis_suc`, `descripcion_sucursal`) VALUES
(1, 1, 'Botica mas vida y salud', '20604850453', 'Jr. Sucre 113 - A , El tambo - huancayo', 'contacto@gmail.com', 'CEL: 938806297', 'sucursal1.jpg', '12001', 1, 'Junin', 'Huancayo', 'huancayo', 'Mas vida y salud a tu alcance ...!'),
(2, 2, 'La botica', '20604850453', 'Huancayo', '', '974331337', 'sucursal2.jpg', '', 0, 'Junin', 'Huancayo', 'Tambo', ''),
(3, 3, 'abc', '20604850453', 'Huancayo', '', '974331337', 'logo.jpg', '', 0, 'Junin', 'Huancayo', 'Tambo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `id_tipo` int(2) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `tipo`) VALUES
(1, 'Laptops'),
(2, 'Computadoras'),
(3, 'Impresoras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

DROP TABLE IF EXISTS `tmp`;
CREATE TABLE IF NOT EXISTS `tmp` (
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad_tmp` decimal(10,2) NOT NULL,
  `precio_tmp` decimal(10,2) DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tienda` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=MyISAM AUTO_INCREMENT=11976 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `und`
--

DROP TABLE IF EXISTS `und`;
CREATE TABLE IF NOT EXISTS `und` (
  `id_und` int(2) NOT NULL AUTO_INCREMENT,
  `nom_und` varchar(100) NOT NULL,
  `cod_und` varchar(4) NOT NULL,
  `xml_und` varchar(4) NOT NULL,
  `etiqueta` varchar(10) NOT NULL,
  PRIMARY KEY (`id_und`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `und`
--

INSERT INTO `und` (`id_und`, `nom_und`, `cod_und`, `xml_und`, `etiqueta`) VALUES
(1, 'UNIDAD                           ', '1', 'NIU', 'UND'),
(2, 'CAJA                                                  ', '2', 'NIU', 'CAJA'),
(3, 'BLISTER', '3', 'NIU', 'BLISTER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `nombres` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `hora` time NOT NULL,
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL,
  `accesos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `domicilio` text COLLATE utf8_unicode_ci NOT NULL,
  `telefono` text COLLATE utf8_unicode_ci NOT NULL,
  `sucursal` int(2) NOT NULL,
  `foto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `nombres`, `clave`, `user_name`, `hora`, `user_email`, `date_added`, `accesos`, `dni`, `domicilio`, `telefono`, `sucursal`, `foto`) VALUES
(1, 'admin', '123', 'admin', '00:00:00', 'contacto@gmail.com', '2016-05-21 15:06:00', '1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1', '87654321', 'lima', '987654321', 1, 'usuario1.jpg'),
(7, 'Victoriano huillcas huincho', '123456', 'adler', '00:00:00', 'huillcask@gmail.com', '2021-10-19 20:11:26', '0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.1.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0.0', '', '', '974331337', 2, 'user.png'),
(8, 'katty', '123456', 'katty', '00:00:00', 'huillcask@gmail.com', '2021-10-19 20:12:19', '1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1.1....1.1', '', '', '974331337', 3, 'user.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `documento` int(11) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id_video` int(12) NOT NULL AUTO_INCREMENT,
  `menu` text NOT NULL,
  `submenu` text NOT NULL,
  `descripcion` text NOT NULL,
  `video` text NOT NULL,
  PRIMARY KEY (`id_video`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `video`
--

INSERT INTO `video` (`id_video`, `menu`, `submenu`, `descripcion`, `video`) VALUES
(2, 'Empresa', 'Empresa', 'Empresa', 'https://www.youtube.com/watch?v=Oocazta9OmM'),
(3, 'Empresa', 'Resumen', 'Resumen', 'https://www.youtube.com/watch?v=PVT_41NYqY4'),
(4, 'Empresa', 'Sucursal', 'Sucursal', 'https://www.youtube.com/watch?v=i5aC_FEf8v8'),
(5, 'Empresa', 'Caja', 'Caja', 'https://www.youtube.com/watch?v=rpA5jGMpyBM'),
(6, 'Usuarios', 'Usuarios', 'Usuarios', 'https://www.youtube.com/watch?v=mrYM6gGwRLw'),
(7, 'Usuarios', 'Accesos', 'Accesos', 'https://www.youtube.com/watch?v=iM1_aZalvFs'),
(8, 'Productos y Servicios', 'Categorias', 'Categorias', 'https://www.youtube.com/watch?v=buLSuOs4cgw'),
(9, 'Productos y Servicios', 'Ingreso productos', 'Ingreso productos', 'https://www.youtube.com/watch?v=kClo-YxD6R4'),
(10, 'Productos y Servicios', 'Lista de productos', 'Lista de productos', 'https://www.youtube.com/watch?v=nveP-cCKCtc'),
(11, 'Productos y Servicios', 'Lista de Servicios', 'Lista de Servicios', 'https://www.youtube.com/watch?v=FeewPH5AN1g'),
(12, 'Productos y Servicios', 'Kardex de productos', 'Kardex de productos', 'https://www.youtube.com/watch?v=0Tndqld98c0'),
(13, 'Productos y Servicios', 'Entradas y salidas de productos', 'Entradas y salidas de productos', 'https://www.youtube.com/watch?v=q4O3a6drZ8Q'),
(14, 'Productos y Servicios', 'Transferencia de productos', 'Transferencia de productos', 'https://www.youtube.com/watch?v=4fcF9mgdqoA'),
(15, 'Productos y Servicios', 'Lista de Transferencia de productos', 'Lista de Transferencia de productos', 'https://www.youtube.com/watch?v=krWNC9ULZO0'),
(16, 'Productos y Servicios', 'Consulta de productos', 'Consulta de productos', 'https://www.youtube.com/watch?v=-WR8peSfkqM'),
(17, 'Productos y Servicios', 'Productos mas vendidos', 'Productos mas vendidos', 'https://www.youtube.com/watch?v=Y3D5YiWtaM8'),
(18, 'Productos y Servicios', 'Consulta de precios', 'Consulta de precios', 'https://www.youtube.com/watch?v=ui5PSEjx6Ek'),
(19, 'Proveedores', 'Proveedores', 'Agregar,editar,eliminar proveedores', 'https://www.youtube.com/watch?v=udFw7qsraLE'),
(20, 'Clientes', 'Clientes', 'Agregar,editar,eliminar clientes', 'https://www.youtube.com/watch?v=CXId2GCi7uk'),
(21, 'Ventas de productos', 'ConfiguraciÃ³n de documentos', 'ConfiguraciÃ³n de documentos', 'https://www.youtube.com/watch?v=GNdg-Br1HFc'),
(23, 'Ventas de productos', 'Ingreso factura/Boleta/Nota de venta', 'Ingreso factura/Boleta/Nota de venta', 'https://www.youtube.com/watch?v=7eghFzpiy9I'),
(24, 'Ventas de productos', 'Ingreso CotizaciÃ³n', 'Documento que tiene el mismo procedimiento de una venta pero que no descuenta el stock, ni se considera venta', ''),
(25, 'Ventas de productos', 'Ingreso nota de debito/credito', 'Ingreso nota de debito/credito', 'https://www.youtube.com/watch?v=V49tchOMI4U'),
(26, 'Ventas de productos', 'Lista de ventas', 'Lista de ventas', 'https://www.youtube.com/watch?v=3_MxjggA4YQ'),
(27, 'Ventas de productos', 'Lista de cotizaciÃ³n', 'Lista de cotizaciÃ³n', 'https://www.youtube.com/watch?v=9L9Isub4i6k'),
(28, 'Ventas de productos', 'Lista de notas de credito/debito', 'Lista de notas de credito/debito', 'https://www.youtube.com/watch?v=FWxo_z4vJMg'),
(29, 'Ventas de productos', 'Ventas por cobrar', 'Ventas por cobrar', 'https://www.youtube.com/watch?v=E5uJYKRv55A'),
(30, 'Ventas de productos', 'Lista de cobros', 'Lista de cobros', 'https://www.youtube.com/watch?v=E5uJYKRv55A'),
(31, 'FacturaciÃ³n ElectrÃ³nica', 'ConfiguraciÃ³n de documentos electrÃ³nicos', 'Ingresar usuario  y clave sol secundarios asÃ­ como el certificado digital en formato .pfx', ''),
(32, 'FacturaciÃ³n ElectrÃ³nica', 'EnvÃ­o de documentos electrÃ³nicos', 'EnvÃ­o de documentos electrÃ³nicos factura, boletas y notas de crÃ©dito/dÃ©bito', 'https://www.youtube.com/watch?v=CSrb6nzgnag'),
(33, 'FacturaciÃ³n ElectrÃ³nica', 'Resumen diario de boletas', 'Resumen diario de boletas', 'https://www.youtube.com/watch?v=eeNZLkpPSqE'),
(34, 'FacturaciÃ³n ElectrÃ³nica', 'ComunicaciÃ³n de baja', 'ComunicaciÃ³n de baja', 'https://www.youtube.com/watch?v=hYKytHY6KbU'),
(35, 'FacturaciÃ³n ElectrÃ³nica', 'GuÃ­a de remisiÃ³n', 'GuÃ­a de remisiÃ³n', 'https://www.youtube.com/watch?v=hyP-i5Wro2E'),
(36, 'Compras', 'Compras factura/boleta/Nota de venta', 'Compras factura/boleta/Nota de venta', 'https://www.youtube.com/watch?v=P4-FpmvWs6c'),
(37, 'Compras', 'Requerimiento', 'Documento que tiene el mismo procedimiento de una compra pero que no aumenta el stock, ni se considera una compra', ''),
(38, 'Compras', 'Consulta de compras', 'Contiene toda la lista de compras', 'https://www.youtube.com/watch?v=Exh5Q2Bm2uY'),
(39, 'Compras', 'Compras por pagar', 'Compras por pagar', 'https://www.youtube.com/watch?v=W0DyBLPoge4'),
(40, 'Compras', 'Lista de pagos', 'Lista de pagos', 'https://www.youtube.com/watch?v=W0DyBLPoge4'),
(41, 'Ent/Sal Mercaderia', 'GuÃ­a entrada y salida de mercaderÃ­as', 'GuÃ­a entrada y salida de mercaderÃ­as', 'https://www.youtube.com/watch?v=coL9_rJf2cY'),
(42, 'Ent/Sal Mercaderia', 'Lista de guias', 'Lista de guias', 'https://www.youtube.com/watch?v=l7sjwDJA3yA'),
(43, 'Pagos/Cobros-Reportes', 'Reporte de entrada y salida', 'Reporte de entrada y salida', 'https://www.youtube.com/watch?v=lK3k6CUoPmY'),
(44, 'Pagos/Cobros-Reportes', 'Otros pagos/cobros', 'Otros pagos/cobros', 'https://www.youtube.com/watch?v=3oK0g6r6e2s'),
(45, 'Pagos/Cobros-Reportes', 'Reporte de ventas/compras', 'Reporte de ventas/compras', ''),
(46, 'Reporte de Ventas', 'Ventas por vendedor mensual/anual', 'Ventas por vendedor mensual/anual', 'https://www.youtube.com/watch?v=v5j2ZVuNBK4'),
(47, 'Reporte de Ventas', 'Ventas por vendedor diario', 'Ventas por vendedor diario', 'https://www.youtube.com/watch?v=LqdEOFszNR4'),
(48, 'Reporte de Ventas', 'Ventas por cliente mensual/anual', 'Ventas por cliente mensual/anual', 'https://www.youtube.com/watch?v=1qHP-Qqqk7k'),
(49, 'Reporte de Ventas', 'Ventas por cliente diario', 'Ventas por cliente diario', 'https://www.youtube.com/watch?v=pPQvQmkY0f0'),
(51, 'Reporte de Ventas', 'Ventas por producto mensual/anual', 'Ventas por producto mensual/anual', 'https://www.youtube.com/watch?v=BLlFHGbHxFc'),
(52, 'Reporte de Ventas', 'Ventas por producto diario', 'Ventas por producto diario', 'https://www.youtube.com/watch?v=2WNUMBhunAI'),
(53, 'Reporte de Compras', 'Compras por vendedor mensual/anual', 'Compras por vendedor mensual/anual', 'https://www.youtube.com/watch?v=ZSUD7PgSX64'),
(54, 'Reporte de Compras', 'Compras por vendedor diario', 'Compras por vendedor diario', 'https://www.youtube.com/watch?v=xjknmEBvflE'),
(55, 'Reporte de Compras', 'Compras por proveedor mensual/anual', 'Compras por proveedor mensual/anual', 'https://www.youtube.com/watch?v=bW2n0p9ruhs'),
(56, 'Reporte de Compras', 'Compras por proveedor diario', 'Compras por proveedor diario', 'https://www.youtube.com/watch?v=gL7Jo60yO30'),
(57, 'Reporte de Compras', 'Compras por producto mensual/anual', 'Compras por producto mensual/anual', 'https://www.youtube.com/watch?v=PeRUzOQgfHw'),
(58, 'Reporte de Compras', 'Compras por producto diario', 'Compras por producto diario', 'https://www.youtube.com/watch?v=2LDZUjYegpU'),
(59, 'Contabilidad', 'Calculo de IGV', 'Calculo de IGV', 'https://www.youtube.com/watch?v=97IFMrYNeY0'),
(60, 'Contabilidad', 'Kardex valorizado', 'Kardex valorizado', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
