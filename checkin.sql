-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2022 a las 06:17:09
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `checkin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checkin`
--

CREATE TABLE `checkin` (
  `Cod_checkIn` int(11) NOT NULL,
  `Cod_vuelo` int(11) NOT NULL,
  `Id_cliente` int(11) NOT NULL,
  `Cod_reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `checkin`
--

INSERT INTO `checkin` (`Cod_checkIn`, `Cod_vuelo`, `Id_cliente`, `Cod_reserva`) VALUES
(1, 4563, 123456, 123456),
(2, 4563, 7987915, 123456),
(3, 4563, 123456, 141516),
(4, 4563, 897151, 141516),
(5, 4563, 5444632, 141516),
(6, 4563, 71656565, 141516),
(7, 4563, 77494155, 141516);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id_cliente` int(11) NOT NULL,
  `Tipo_doc_cliente` varchar(15) DEFAULT NULL,
  `Nombre_cliente` varchar(45) DEFAULT NULL,
  `Apellido_cliente` varchar(45) DEFAULT NULL,
  `Email_cliente` varchar(25) DEFAULT NULL,
  `Telefono_cliente` bigint(20) DEFAULT NULL,
  `Genero_cliente` varchar(10) DEFAULT NULL,
  `Fecha_Nac_cliente` date DEFAULT NULL,
  `Edad_cliente` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_cliente`, `Tipo_doc_cliente`, `Nombre_cliente`, `Apellido_cliente`, `Email_cliente`, `Telefono_cliente`, `Genero_cliente`, `Fecha_Nac_cliente`, `Edad_cliente`) VALUES
(123456, 'CC', 'LUCIA DEL CARMEN', 'VASQUEZ TIRADO', 'sofiavargasmadrid@hotmail', 343535354, 'F', '2001-10-16', 20),
(897151, 'CC', 'JAVIER', 'MARTELO', 'sp@app.com', 23423424, 'M', '1943-01-15', 79),
(5444632, 'CC', 'ELINORA', 'TERAN', 'sv@app.com', 534535, 'F', '1985-09-25', 36),
(7987915, 'CC', 'JAVIER', 'PEREZ IBARRA', 'superUsuario@app.com', 34445646, 'M', '1985-12-14', 36),
(71656565, 'TI', 'MARIA LUCIA', 'VARGAS MADRID', 'sp@app.com', 4535435, 'F', '2012-01-01', 10),
(77494155, 'CC', 'JULIA', 'CASTRO', 'sofiavargasmadrid@hotmail', 242424234, 'F', '1945-10-15', 76);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallereserva`
--

CREATE TABLE `detallereserva` (
  `idDet` int(11) NOT NULL,
  `idReserv` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idVuelo` int(11) NOT NULL,
  `estado_reserva` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallereserva`
--

INSERT INTO `detallereserva` (`idDet`, `idReserv`, `idCliente`, `idVuelo`, `estado_reserva`) VALUES
(1, 123456, 7987915, 4563, 'Confirmado'),
(2, 123456, 123456, 4563, 'Confirmado'),
(3, 141516, 123456, 4563, 'Confirmado'),
(4, 141516, 897151, 4563, 'Confirmado'),
(5, 141516, 5444632, 4563, 'Confirmado'),
(6, 141516, 71656565, 4563, 'Confirmado'),
(7, 141516, 77494155, 4563, 'Confirmado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `Cod_reserva` int(11) NOT NULL,
  `Fecha_reserva` date DEFAULT NULL,
  `CiudadSalida_reserva` varchar(30) DEFAULT NULL,
  `CiudadLlegada_reserva` varchar(30) DEFAULT NULL,
  `NoAdultos_reserva` int(11) NOT NULL,
  `NoNinos_reserva` int(11) NOT NULL,
  `Valor_vuelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`Cod_reserva`, `Fecha_reserva`, `CiudadSalida_reserva`, `CiudadLlegada_reserva`, `NoAdultos_reserva`, `NoNinos_reserva`, `Valor_vuelo`) VALUES
(123456, '2022-04-13', 'Monteria', 'Bogotá', 2, 0, 450000),
(141516, '2022-04-08', 'Corozal', 'Cali', 4, 1, 2150000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo`
--

CREATE TABLE `vuelo` (
  `Cod_vuelo` int(11) NOT NULL,
  `Nombre_avion_vuelo` varchar(45) DEFAULT NULL,
  `No_asientos_vuelo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`Cod_vuelo`, `Nombre_avion_vuelo`, `No_asientos_vuelo`) VALUES
(1415, 'AVIANCA AIRLINES 1415', 110),
(1987, 'AVIANCA AIRLINES 1987', 120),
(4563, 'LATAM 4563', 80),
(5688, 'VIVA AIR 5688', 85),
(6635, 'SATENA AIRLINES 6635', 45);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`Cod_checkIn`),
  ADD KEY `check_fk_1` (`Cod_reserva`),
  ADD KEY `check_fk_2` (`Cod_vuelo`),
  ADD KEY `check_fk_3` (`Id_cliente`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_cliente`);

--
-- Indices de la tabla `detallereserva`
--
ALTER TABLE `detallereserva`
  ADD PRIMARY KEY (`idDet`),
  ADD KEY `detalle_fk_1` (`idReserv`),
  ADD KEY `detalle_fk_2` (`idCliente`),
  ADD KEY `detalle_fk_3` (`idVuelo`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`Cod_reserva`);

--
-- Indices de la tabla `vuelo`
--
ALTER TABLE `vuelo`
  ADD PRIMARY KEY (`Cod_vuelo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `checkin`
--
ALTER TABLE `checkin`
  MODIFY `Cod_checkIn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detallereserva`
--
ALTER TABLE `detallereserva`
  MODIFY `idDet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `checkin`
--
ALTER TABLE `checkin`
  ADD CONSTRAINT `check_fk_1` FOREIGN KEY (`Cod_reserva`) REFERENCES `reserva` (`Cod_reserva`) ON DELETE NO ACTION,
  ADD CONSTRAINT `check_fk_2` FOREIGN KEY (`Cod_vuelo`) REFERENCES `vuelo` (`Cod_vuelo`) ON DELETE NO ACTION,
  ADD CONSTRAINT `check_fk_3` FOREIGN KEY (`Id_cliente`) REFERENCES `cliente` (`Id_cliente`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `detallereserva`
--
ALTER TABLE `detallereserva`
  ADD CONSTRAINT `detalle_fk_1` FOREIGN KEY (`idReserv`) REFERENCES `reserva` (`Cod_reserva`) ON DELETE NO ACTION,
  ADD CONSTRAINT `detalle_fk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`Id_cliente`) ON DELETE NO ACTION,
  ADD CONSTRAINT `detalle_fk_3` FOREIGN KEY (`idVuelo`) REFERENCES `vuelo` (`Cod_vuelo`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
