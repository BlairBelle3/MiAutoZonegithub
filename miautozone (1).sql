-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2024 a las 01:29:52
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
-- Base de datos: `miautozone`
--
CREATE DATABASE IF NOT EXISTS `miautozone` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `miautozone`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `buscarCategoria`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarCategoria` (IN `consulta` VARCHAR(100))   BEGIN
	declare exit handler for sqlexception
	begin
		rollback;
	end;
	start transaction;
		set autocommit = 0;
		SELECT idCategoria, nombreCategoria, imgCategoria, desActivo FROM categoria
		INNER JOIN activo 
		ON categoria.activoCategoria = activo.idActivo
		WHERE nombreCategoria LIKE concat(consulta, '%')  or
		idCategoria LIKE  concat(consulta, '%')  or
		desActivo LIKE  concat(consulta, '%');
    commit;
END$$

DROP PROCEDURE IF EXISTS `listarMarca`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarMarca` (IN `consulta` VARCHAR(100))   BEGIN

	declare exit handler for sqlexception
	begin
		rollback;
	end;
	start transaction;
		set autocommit = 0;
		SELECT idMarca, nombreMarca, imgMarca, desActivo FROM marca
		INNER JOIN activo ON marca.activoMarca = activo.idActivo WHERE idMarca LIKE concat(consulta, '%')  or
		nombreMarca LIKE concat(consulta, '%')  or desActivo LIKE concat(consulta, '%') ;
    commit;

END$$

DROP PROCEDURE IF EXISTS `listarUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarUser` (IN `tipo` INT)   BEGIN
	SELECT idUsuario, nombreUsuario, apellidoUsuario, correo, tipo FROM usuario
	INNER JOIN tipousuario ON usuario.tipoUsuario = tipousuario.tipoUsuario WHERE usuario.tipoUsuario = tipo;
END$$

DROP PROCEDURE IF EXISTS `venta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `venta` (IN `idProducto` INT, `cantidad` INT, `idCajero` INT, `idCliente` INT)   BEGIN
	
    #se llama venta
    
	DECLARE EXIT HANDLER FOR sqlexception
    BEGIN
		ROLLBACK;
    END;
    
    START TRANSACTION;
		SET AUTOCOMMIT = 0;
        
        INSERT INTO venta (idProducto, cantidad, idCajero)
        VALUES (idProducto, cantidad, idCajero);
        
        SET @ultimo_id = last_insert_id();
        
        INSERT INTO detalleventa (idVenta, Fecha, idCliente)
        VALUES (@ultimo_id, NOW(), idCliente);
		
        COMMIT;	
        
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo`
--

DROP TABLE IF EXISTS `activo`;
CREATE TABLE IF NOT EXISTS `activo` (
  `idActivo` int(10) NOT NULL AUTO_INCREMENT,
  `desActivo` varchar(20) NOT NULL,
  PRIMARY KEY (`idActivo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `activo`
--

TRUNCATE TABLE `activo`;
--
-- Volcado de datos para la tabla `activo`
--

INSERT INTO `activo` (`idActivo`, `desActivo`) VALUES
(1, 'Disponible'),
(2, 'No Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auto`
--

DROP TABLE IF EXISTS `auto`;
CREATE TABLE IF NOT EXISTS `auto` (
  `idAuto` int(10) NOT NULL,
  `anio` int(10) NOT NULL,
  `idModelo` int(10) NOT NULL,
  `idMotor` int(10) NOT NULL,
  `NIV` int(10) NOT NULL,
  PRIMARY KEY (`idAuto`),
  KEY `idModelo` (`idModelo`,`idMotor`),
  KEY `idMotor` (`idMotor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `auto`
--

TRUNCATE TABLE `auto`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(10) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(100) NOT NULL,
  `imgCategoria` varchar(50) NOT NULL,
  `activoCategoria` int(2) NOT NULL COMMENT '1. Activo, 2. Desactivo',
  PRIMARY KEY (`idCategoria`),
  KEY `activoCategoria` (`activoCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `categoria`
--

TRUNCATE TABLE `categoria`;
--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombreCategoria`, `imgCategoria`, `activoCategoria`) VALUES
(1, 'Aceites', '1.jpg', 2),
(2, 'Baterías', '2.jpg', 1),
(3, 'Balatas', '3.jpg', 1),
(4, 'Bujías', '4.jpg', 1),
(5, 'Amortiguadores', '5.jpg', 1),
(6, 'Limpieza', '6.jpg', 1),
(7, 'Estéreos', '7.jpg', 1),
(8, 'Filtros', '8.jpg', 1),
(9, 'Llantas', '9.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

DROP TABLE IF EXISTS `detalleventa`;
CREATE TABLE IF NOT EXISTS `detalleventa` (
  `idDetalle` int(10) NOT NULL,
  `idVenta` int(10) NOT NULL,
  `Fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `idCliente` int(10) NOT NULL,
  PRIMARY KEY (`idDetalle`),
  KEY `idVenta` (`idVenta`),
  KEY `idCliente` (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `detalleventa`
--

TRUNCATE TABLE `detalleventa`;
--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`idDetalle`, `idVenta`, `Fecha`, `idCliente`) VALUES
(0, 0, '2024-11-29 18:16:33', 5),
(1, 1, '2023-11-12 11:07:42', 8),
(2, 2, '2023-11-12 11:09:49', 10),
(3, 3, '2023-11-12 11:22:46', 10),
(4, 4, '2023-11-12 11:31:17', 9),
(5, 5, '2023-11-12 11:34:08', 9),
(6, 6, '2023-11-12 11:34:08', 11),
(7, 7, '2023-11-12 11:36:08', 9),
(8, 8, '2023-11-12 11:36:08', 9),
(9, 9, '2023-11-12 11:36:08', 9),
(10, 10, '2023-11-12 11:37:18', 8),
(11, 11, '2023-11-12 11:37:18', 8),
(12, 12, '2023-11-12 11:38:32', 9),
(13, 13, '2023-11-12 11:38:32', 9),
(14, 14, '2023-11-12 11:42:37', 9),
(15, 15, '2023-11-12 11:42:37', 9),
(16, 16, '2023-11-12 11:42:37', 9),
(17, 17, '2023-11-12 12:01:03', 11),
(18, 18, '2023-11-12 12:13:39', 9),
(19, 19, '2023-11-12 12:13:39', 9),
(20, 20, '2023-11-12 14:31:31', 9),
(21, 21, '2023-11-12 14:37:42', 9),
(22, 22, '2023-11-12 14:42:28', 9),
(23, 23, '2023-11-12 14:43:57', 11),
(24, 24, '2023-11-12 14:43:57', 11),
(25, 25, '2023-11-12 16:19:01', 11),
(26, 26, '2023-11-12 17:34:46', 9),
(27, 27, '2023-11-12 17:34:46', 9),
(28, 28, '2023-11-12 19:14:16', 9),
(29, 29, '2023-11-12 19:18:30', 5),
(30, 30, '2023-11-13 14:58:54', 9),
(31, 31, '2023-11-13 14:58:54', 9),
(32, 32, '2023-11-14 14:38:17', 11),
(33, 33, '2023-11-14 20:00:29', 10),
(34, 34, '2023-11-14 20:00:29', 10),
(35, 35, '2023-11-14 20:30:58', 8),
(36, 36, '2023-11-14 20:30:58', 8),
(37, 37, '2023-11-14 21:17:53', 11),
(38, 38, '2023-11-14 21:17:53', 11),
(39, 39, '2023-11-14 21:27:42', 8),
(40, 40, '2023-11-14 21:46:19', 8),
(41, 41, '2023-11-15 07:03:25', 8),
(42, 42, '2023-11-15 18:11:16', 8),
(43, 43, '2023-11-15 18:13:22', 8),
(44, 44, '2023-11-15 18:13:22', 8),
(45, 45, '2023-11-15 18:13:22', 8),
(46, 46, '2023-11-15 18:13:22', 8),
(47, 47, '2023-11-15 19:53:00', 8),
(48, 48, '2023-11-15 19:53:00', 8),
(49, 49, '2023-11-15 19:53:00', 8),
(50, 50, '2023-11-15 19:53:15', 8),
(51, 51, '2023-11-15 19:53:15', 8),
(52, 52, '2023-11-15 19:53:15', 8),
(53, 53, '2023-11-15 19:59:02', 8),
(54, 54, '2023-11-15 20:07:21', 8),
(55, 55, '2023-11-15 20:07:21', 8),
(56, 56, '2023-11-15 20:10:00', 8),
(57, 57, '2023-11-15 20:10:21', 8),
(58, 58, '2023-11-15 20:10:52', 8),
(59, 59, '2023-11-15 20:26:51', 8),
(60, 60, '2023-11-15 20:28:03', 8),
(61, 61, '2023-11-15 20:52:17', 8),
(62, 62, '2023-11-15 20:52:17', 8),
(63, 63, '2023-11-15 20:59:26', 8),
(64, 64, '2023-11-15 20:59:26', 8),
(65, 65, '2023-11-15 21:04:07', 8),
(66, 66, '2023-11-15 21:04:07', 8),
(67, 67, '2023-11-15 21:07:03', 8),
(68, 68, '2023-11-15 21:07:03', 8),
(69, 69, '2023-11-15 21:08:19', 8),
(70, 70, '2023-11-15 21:08:19', 8),
(71, 71, '2023-11-15 21:08:19', 8),
(72, 72, '2023-11-15 21:13:23', 11),
(73, 73, '2023-11-15 21:13:23', 11),
(74, 74, '2023-11-16 09:27:56', 8),
(75, 75, '2023-11-16 09:27:56', 8),
(76, 76, '2023-11-16 10:02:06', 9),
(77, 77, '2023-11-16 10:03:46', 8),
(78, 78, '2023-11-17 19:16:54', 10),
(79, 79, '2023-11-18 19:08:49', 14),
(80, 80, '2023-11-18 19:08:49', 14),
(81, 81, '2023-11-18 19:09:03', 5),
(82, 82, '2023-11-18 19:09:43', 12),
(83, 83, '2023-11-18 19:09:57', 10),
(84, 84, '2023-11-18 19:10:10', 8),
(85, 85, '2023-11-21 10:41:14', 8),
(86, 86, '2023-11-27 08:17:51', 4),
(87, 87, '2023-11-27 08:17:51', 4),
(88, 88, '2023-11-27 08:17:51', 4),
(89, 89, '2023-11-27 08:19:43', 4),
(90, 90, '2023-11-27 08:19:43', 4),
(91, 91, '2023-11-27 08:19:43', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `idMarca` int(10) NOT NULL AUTO_INCREMENT,
  `nombreMarca` varchar(100) NOT NULL,
  `imgMarca` varchar(50) NOT NULL,
  `activoMarca` int(2) NOT NULL,
  PRIMARY KEY (`idMarca`),
  KEY `activoMarca` (`activoMarca`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `marca`
--

TRUNCATE TABLE `marca`;
--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idMarca`, `nombreMarca`, `imgMarca`, `activoMarca`) VALUES
(6, 'Ford', '6.jpg', 1),
(7, 'BMW', '7.png', 1),
(8, 'Chevrolet', '8.jpg', 1),
(9, 'Nissan', '9.jpg', 1),
(10, 'Mercedes Benz', '10.jpg', 1),
(11, 'Mobil', '11.jpg', 1),
(12, 'LTH', '12.png', 1),
(13, 'Meguiars ', '13.jpg', 1),
(14, 'Sony', '14.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

DROP TABLE IF EXISTS `modelo`;
CREATE TABLE IF NOT EXISTS `modelo` (
  `idModelo` int(10) NOT NULL,
  `nombreModelo` varchar(100) NOT NULL,
  `idMarca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `modelo`
--

TRUNCATE TABLE `modelo`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motor`
--

DROP TABLE IF EXISTS `motor`;
CREATE TABLE IF NOT EXISTS `motor` (
  `idMotor` int(10) NOT NULL,
  `nombreMotor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `motor`
--

TRUNCATE TABLE `motor`;
--
-- Volcado de datos para la tabla `motor`
--

INSERT INTO `motor` (`idMotor`, `nombreMotor`) VALUES
(1, 'Combustion interna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProducto` varchar(100) NOT NULL,
  `precio` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idMarcaProducto` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `idCategoria` (`idCategoria`,`idMarcaProducto`),
  KEY `idMarca` (`idMarcaProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `producto`
--

TRUNCATE TABLE `producto`;
--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombreProducto`, `precio`, `idCategoria`, `idMarcaProducto`) VALUES
(1, 'Aceite Mobil 1 5W-30 de 946 ml', 419, 1, 11),
(2, 'Aceite Mobil 1 5W-50 de 3.785 L', 1499, 1, 11),
(3, 'Aceite Alto Kilometraje Mobil 25W-60 de 946 ml', 155, 1, 11),
(4, 'Aceite 5w30 sintético mobil garrafa 5 litros Mobil Sintético', 799, 1, 11),
(5, 'Aceite Mobil Súper 5W-20 de 946 ml', 209, 1, 11),
(6, 'Aceite Mobil Super 15W-40 de 5 L', 855, 1, 11),
(7, 'Aceite de motor 5w20 946 ml mobil super extengine', 263, 1, 11),
(8, 'Aceite de motor 946 ml mobil sintetico 5w30', 430, 1, 11),
(9, 'Aceite Mobil Súper 20W-50 de 946 ml', 179, 1, 11),
(11, 'Amortiguadores dos pares gas x-Trail 2001 a 2007 nissan sachs', 8744, 5, 9),
(12, 'Amortiguadores dos pares gas f-250 2001 a 2003 ford sachs ', 3608, 5, 6),
(13, 'Amortiguadores gas f-150 1999 a 2003 ford delanteros sachs', 1778, 5, 6),
(14, 'Amortiguadores dos pares gas mondeo 2001 a 2007 ford trw', 6536, 5, 6),
(15, 'Amortiguadores gas 535i 2010 a 2016 bmw traseros sachs', 4880, 5, 7),
(16, 'Amortiguadores gas 535i 2005 a 2010 bmw traseros sachs', 5751, 5, 7),
(17, 'Amortiguadores dos pares de gas x5 2000 a 2006 bmw l6 3.0l sachs', 13881, 5, 7),
(18, 'Amortiguadores gas serie 5 2005 al 2010 bmw traseros sachs', 6840, 5, 7),
(19, 'Amortiguadores dos pares de gas c2500 1988 a 2000 chevrolet syd', 3300, 5, 8),
(20, 'Amortiguadores dos pares de monro-Matic plus gas c20 pickup 1973 a 1974 chevrolet monroe', 3062, 5, 8),
(21, 'Amortiguadores gas cruze 2010 a 2015 chevrolet traseros trw', 2382, 5, 8),
(22, 'Amortiguadores gas aveo 2008 a 2018 chevrolet 4 L 1.6 L delanteros sachs', 3410, 5, 8),
(23, 'Amortiguadores dos pares de gas almera 2001 a 2005 nissan syd', 3114, 5, 9),
(24, 'Amortiguadores dos pares de gas urvan 2002 a 2013 nissan sachs ', 3335, 5, 9),
(25, 'Amortiguadores hidráulicos np300 2009 a 2015 nissan traseros trw', 954, 5, 9),
(26, 'Amortiguadores gas ml250 2015 mercedes-Benz traseros trw', 3074, 5, 10),
(27, 'Amortiguadores gas c250 2010 mercedes-Benz delanteros sachs', 5878, 5, 10),
(28, 'Amortiguadores dos pares de gas c230 1996 a 2000 mercedes-Benz sachs', 6469, 5, 10),
(29, 'Amortiguadores de cofre c280 2006 a 2008 mercedes-Benz spart', 1281, 5, 10),
(30, 'Balatas ceramicas f-150 2004 a 2012 ford traseras trw', 717, 3, 6),
(31, 'Set balatas bajos metales mondeo 2001 a 2007 ford trw', 1374, 3, 6),
(34, 'Balatas cerámicas ecosport 2004 a 2012 ford front brembo', 1015, 3, 6),
(35, 'Balatas ceramicas f-150 2010 a 2015 ford delanteras trw', 827, 3, 6),
(36, 'Balatas rs sport 330ci 2001 a 2006 bmw l6 3.0l front dynamik', 1064, 3, 7),
(37, 'Balatas cerámicas x5 2007 a 2018 bmw front brembo', 2286, 3, 7),
(38, 'Balatas ceramicas silverado 1500 hd 2001 al 2003 chevrolet v8 6.0l traseras wagner', 643, 3, 8),
(39, 'Balatas semimetalicas corvette 2008 al 2012 chevrolet v8 6.2l traseras wagner', 446, 3, 8),
(40, 'Set balatas cerámicas 350z 2006 a 2009 nissan trw', 1161, 3, 9),
(41, 'Balatas semimetalicas x-Trail 2001 a 2010 nissan front generica', 528, 3, 9),
(42, 'Balatas ceramicas cl600 2007 al 2009 mercedes-Benz 5.5l v12 traseras brembo', 1286, 3, 10),
(43, 'Set balatas bajos metales ml450 2010 a 2011 mercedes-Benz trw', 1316, 3, 10),
(44, 'Bujías juego 8 bujías de encendido f-150 1997 a 2008 ford v8 4.6l iridio champion', 1498, 4, 6),
(45, 'Bujías Juego 6 bujías de encendido f-150 2011 a 2014 ford v6 3.7l platino champion', 580, 4, 6),
(46, 'Bujías Juego 4 bujías de encendido z3 1996 a 1999 bmw L4 1.9L cobre champion', 452, 4, 7),
(47, 'Bujías Juego 4 bujías de encendido 2002 1975 a 1976 bmw l4 2.0l cobre champion', 452, 4, 7),
(48, 'Batería para Auto LTH BCI 47', 2569, 2, 12),
(49, 'Batería para Auto LTH BCI 24R', 2589, 2, 12),
(50, 'Batería para Auto LTH BCI 65', 2899, 2, 12),
(51, 'Batería para Auto LTH BCI 58', 2529, 2, 12),
(52, 'Limpiador para rines de aluminio meguiar\'s spray 710ml meguiars', 438, 6, 13),
(53, 'Limpiador de motor g17316 engine dressing 450ml meguiars', 445, 6, 13),
(54, 'Limpiador de piel gold class 414ml meguiar\'s fórmula 3 en 1 meguiars', 444, 6, 13),
(55, 'Limpiador de vidrios meguiar’s 710ml perfect clarity meguiars', 310, 6, 13),
(56, 'Cera en pasta meguiar’s cleaner wax lata 311g meguiars', 475, 6, 13),
(57, 'Esponja x3070 aplicadora de producto p-2 meguiars', 259, 6, 13),
(58, 'Autoestereo sony dsx-A110u sony dsxa/10u', 3176, 7, 14),
(59, 'Autoestereo bluetooth sony dsx-A410bt sony dsxa4/0bt', 2866, 7, 14),
(60, 'Filtro para aceite f-350 1999 a 2003 ford v8 7.3l diesel sakura', 399, 8, 6),
(61, 'Filtro para aceite sintético fiesta 2003 a 2007 ford l4 1.6l sakura', 299, 8, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `tipoUsuario` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`tipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `tipousuario`
--

TRUNCATE TABLE `tipousuario`;
--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`tipoUsuario`, `tipo`) VALUES
(1, 'Mayor. Admin'),
(2, 'Administrador'),
(3, 'Empleado'),
(4, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(10) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(50) NOT NULL,
  `apellidoUsuario` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contra` varchar(100) NOT NULL,
  `tipoUsuario` int(10) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `tipoUsuario` (`tipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `apellidoUsuario`, `correo`, `contra`, `tipoUsuario`) VALUES
(2, 'Brandon', 'Hernandez', 'brandon@example.com', '$2y$10$kveVn7QLGaMo26tmJpBiK.ZhzHsdLyXyZmMJfTz.RzpTPw4okqNnW', 1),
(3, 'prueba', '1', 'prueba@example.com', '$2y$10$6kG.bvVacCiksYfXEd3Sm.jjrbbR8bSNjZ3sXzpHKCkTmVzhT4nru', 2),
(4, 'Daniel', 'Hernandez', 'daniel@example.com', '$2y$10$4xoz/720NTMT77O2CMVCdOs3zg0eehTcXbTx92Vb2mqjeIjkMNP2m', 3),
(5, 'cliente', 'prueba', 'cliente@example.com', '$2y$10$FJwCWHypU5m1orsvBjs6neONj3be1fFd4JNV7apdzLQqmOvI/bDR.', 4),
(6, 'Carlos', 'Hernandez', 'carlos@example.com', '$2y$10$9LZUR6iK8mSe0wzauIYxHOhOtZybedEea4ojlOhA0T1xvaozQWz3C', 3),
(7, 'jorge', 'Vonilla', 'jorge@example.com', '$2y$10$.jbBrFGBeSRc8/cb/ugVd.U5F9ZDxeuNskkVYYN.KQgVtoU4HH/nm', 3),
(8, 'kevin', 'Guevara', 'kevin@example.com', '$2y$10$JUOMAPhMzv0801RxuusUpOc8AR2623ybccqpd4P158yoiB7O10CEm', 4),
(9, 'Alan', 'Guevara', 'alan@example.com', '$2y$10$LY0c19YDaXGwhLuY3Ru23.skSQB.Ua8xDXxtkG3zmannizi0mR6PK', 4),
(10, 'Marcos', 'Juarez', 'mj@example.com', '$2y$10$0Ld3rSsj17eJqa4dYpHLoOB.ljaGZbgxaEG/bWNKzeTmD1IZ2RlhG', 4),
(11, 'Carlos', 'Ballarta', 'carlosB@example.com', '$2y$10$y8kp2dk/36uUmnj2knIsEuUCRKtwHULZvSENsbfo32VzmxbZyvg4i', 4),
(12, 'Franco', 'Escamilla', 'FrancoE@example.com', '$2y$10$row6jRtrYJrmIh7Hp8IB0O5ZIcGet7m0smGpFRIXDOGlmqmG.w86G', 4),
(13, 'Cajero', 'En Linea', 'cajeroLinea@example.com', '$2y$10$QIE3Sjnd13ReRoiTjc.tLuYMeHRw1kh90U68jbb9ym5btQNY0jShC', 3),
(14, 'Ana', 'Rodriguez', 'ana@example.com', '$2y$10$YRaN/sXI.mxogEwo/E1JpO2vGuWwasgWb6l5R58Orp4PYcjgcxq5G', 4),
(15, 'Citlali', 'Lozano', 'citla@example.com', '$2y$10$/gPRSvifBpj.SgmFitNzk.7YmOuJIPrJTScKkifKvA5rhU26NNgMa', 4),
(16, 'Brandon', 'Hernandez', 'bran17052003@gmail.com', '$2y$10$bpy22F1ytiTOYgrJDv0DQe7N05zpvrU46L5WPcJrqKqP7131TP/w.', 1),
(17, 'Administrador', 'Programador', 'programador@example.com', '$2y$10$zF7ZdTxbpsYnUy6rLQ9FO.lEQgJz4gGnErobuozLnvhUNUHWimAmq', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `idVenta` int(10) NOT NULL,
  `idProducto` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `idCajero` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `venta`
--

TRUNCATE TABLE `venta`;
--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idVenta`, `idProducto`, `cantidad`, `idCajero`) VALUES
(1, 1, 5, 3),
(2, 5, 2, 2),
(3, 5, 2, 2),
(4, 22, 2, 2),
(5, 22, 2, 2),
(6, 41, 3, 2),
(7, 34, 3, 2),
(8, 45, 1, 2),
(9, 26, 1, 2),
(10, 45, 2, 2),
(11, 4, 3, 2),
(12, 1, 1, 2),
(13, 24, 2, 2),
(14, 1, 2, 2),
(15, 21, 2, 2),
(16, 34, 1, 2),
(17, 2, 2, 2),
(18, 21, 1, 2),
(19, 34, 2, 2),
(20, 27, 1, 2),
(21, 45, 2, 2),
(22, 30, 1, 2),
(23, 31, 1, 2),
(24, 31, 2, 2),
(25, 49, 2, 2),
(26, 54, 2, 2),
(27, 52, 1, 2),
(28, 48, 1, 2),
(29, 4, 3, 2),
(30, 22, 2, 2),
(31, 44, 1, 2),
(32, 50, 1, 2),
(33, 31, 1, 2),
(34, 50, 2, 2),
(35, 50, 1, 2),
(36, 26, 2, 2),
(37, 24, 1, 2),
(38, 40, 1, 2),
(39, 1, 1, 13),
(40, 2, 1, 13),
(41, 1, 1, 13),
(42, 2, 1, 13),
(43, 2, 1, 13),
(44, 15, 1, 13),
(45, 37, 1, 13),
(46, 53, 1, 13),
(47, 2, 1, 13),
(48, 3, 1, 13),
(49, 4, 1, 13),
(50, 2, 1, 13),
(51, 3, 1, 13),
(52, 4, 1, 13),
(53, 1, 1, 13),
(54, 2, 1, 13),
(55, 3, 1, 13),
(56, 2, 1, 13),
(57, 2, 1, 13),
(58, 2, 1, 13),
(59, 2, 1, 13),
(60, 2, 1, 13),
(61, 2, 1, 13),
(62, 1, 1, 13),
(63, 61, 1, 13),
(64, 60, 1, 13),
(65, 36, 1, 13),
(66, 52, 1, 13),
(67, 58, 1, 13),
(68, 57, 1, 13),
(69, 1, 1, 13),
(70, 2, 1, 13),
(71, 3, 1, 13),
(72, 27, 1, 2),
(73, 57, 2, 2),
(74, 1, 1, 13),
(75, 61, 1, 13),
(76, 20, 2, 2),
(77, 2, 1, 13),
(78, 5, 2, 2),
(79, 52, 1, 2),
(80, 56, 2, 2),
(81, 24, 1, 2),
(82, 50, 1, 2),
(83, 59, 1, 2),
(84, 46, 1, 2),
(85, 1, 1, 13),
(86, 2, 1, 13),
(87, 1, 1, 13),
(88, 11, 1, 13),
(89, 1, 1, 13),
(90, 2, 1, 13),
(91, 3, 1, 13),
(0, 1, 1, 13);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`activoCategoria`) REFERENCES `activo` (`idActivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `marca`
--
ALTER TABLE `marca`
  ADD CONSTRAINT `marca_ibfk_1` FOREIGN KEY (`activoMarca`) REFERENCES `activo` (`idActivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idMarcaProducto`) REFERENCES `marca` (`idMarca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`tipoUsuario`) REFERENCES `tipousuario` (`tipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
