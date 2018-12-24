-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 24-12-2018 a las 22:43:20
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente`
--

CREATE TABLE `Cliente` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `cedula` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Cliente`
--

INSERT INTO `Cliente` (`idCliente`, `nombre`, `cedula`) VALUES
(1, 'Santiago J', 5589372),
(2, 'Julian F', 3982573);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalle_venta`
--

CREATE TABLE `Detalle_venta` (
  `idDetalle_venta` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `valor` varchar(10) NOT NULL,
  `descuento` varchar(10) DEFAULT NULL,
  `IVA` varchar(10) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `idVentas` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Detalle_venta`
--

INSERT INTO `Detalle_venta` (`idDetalle_venta`, `descripcion`, `valor`, `descuento`, `IVA`, `total`, `idVentas`, `idProducto`) VALUES
(7, 'mi primer venta', '500000', '0.2', '0.1', 10120000, 13, 1),
(8, 'mi primer venta', '700000', '0.5', '0.1', 10120000, 14, 2),
(9, 'mi primer venta', '200000', '0.15', '0.1', 10120000, 15, 4),
(10, 'mi segunda venta', '700000', '0', '0.19', 3332000, 16, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto`
--

CREATE TABLE `Producto` (
  `idProducto` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `valor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Producto`
--

INSERT INTO `Producto` (`idProducto`, `descripcion`, `valor`) VALUES
(1, 'Televisor', 500000),
(2, 'Computador', 700000),
(3, 'Portatil', 350000),
(4, 'Mueble', 200000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ventas`
--

CREATE TABLE `Ventas` (
  `idVentas` int(11) NOT NULL,
  `consecutivo` varchar(50) NOT NULL,
  `subtotal` float NOT NULL,
  `descuento` float DEFAULT NULL,
  `IVA` int(11) NOT NULL,
  `totalNeto` float NOT NULL,
  `idCliente` int(11) NOT NULL,
  `fechaVenta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Ventas`
--

INSERT INTO `Ventas` (`idVentas`, `consecutivo`, `subtotal`, `descuento`, `IVA`, `totalNeto`, `idCliente`, `fechaVenta`, `cantidad`) VALUES
(13, '1', 5000000, 1100000, 500000, 4400000, 1, '2018-12-20 23:54:47', 10),
(14, '1', 7000000, 3850000, 700000, 3850000, 1, '2018-12-20 23:54:47', 10),
(15, '1', 2000000, 330000, 200000, 1870000, 1, '2018-12-20 23:54:47', 10),
(16, '2', 2800000, 0, 532000, 3332000, 2, '2018-12-20 23:57:25', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `Detalle_venta`
--
ALTER TABLE `Detalle_venta`
  ADD PRIMARY KEY (`idDetalle_venta`),
  ADD KEY `fk_Detalle_venta_Ventas_idx` (`idVentas`),
  ADD KEY `fk_Detalle_venta_Producto1_idx` (`idProducto`);

--
-- Indices de la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `Ventas`
--
ALTER TABLE `Ventas`
  ADD PRIMARY KEY (`idVentas`),
  ADD KEY `fk_Ventas_Cliente1_idx` (`idCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Cliente`
--
ALTER TABLE `Cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Detalle_venta`
--
ALTER TABLE `Detalle_venta`
  MODIFY `idDetalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Producto`
--
ALTER TABLE `Producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `Ventas`
--
ALTER TABLE `Ventas`
  MODIFY `idVentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Detalle_venta`
--
ALTER TABLE `Detalle_venta`
  ADD CONSTRAINT `fk_Detalle_venta_Producto1` FOREIGN KEY (`idProducto`) REFERENCES `Producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Detalle_venta_Ventas` FOREIGN KEY (`idVentas`) REFERENCES `Ventas` (`idVentas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Ventas`
--
ALTER TABLE `Ventas`
  ADD CONSTRAINT `fk_Ventas_Cliente1` FOREIGN KEY (`idCliente`) REFERENCES `Cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
