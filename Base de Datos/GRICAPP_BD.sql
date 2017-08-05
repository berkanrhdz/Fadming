-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-07-2017 a las 12:17:37
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `GRICAPP_BD`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EMPRESA`
--

CREATE TABLE `EMPRESA` (
  `CODIGO` int(4) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `CALLE` varchar(50) NOT NULL,
  `NUMERO` int(5) NOT NULL,
  `POBLACION` varchar(50) NOT NULL,
  `CODIGO_POSTAL` int(5) NOT NULL,
  `TELEFONO` int(9) NOT NULL,
  `FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CODIGO_USUARIO` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `EMPRESA`
--

INSERT INTO `EMPRESA` (`CODIGO`, `NOMBRE`, `CALLE`, `NUMERO`, `POBLACION`, `CODIGO_POSTAL`, `TELEFONO`, `FECHA_REGISTRO`, `CODIGO_USUARIO`) VALUES
(1, 'Cultivos La Candelaria', 'Robayna Almentara', 97, 'Santa Cruz de Tenerife', 38009, 902519811, '2017-05-28 22:50:47', 1),
(2, 'Agrupación de Agricultores Ecológicos de Canarias', 'Pérez Carmona', 18, 'Arafo', 38550, 922525494, '2017-07-15 14:53:17', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADO`
--

CREATE TABLE `ESTADO` (
  `CODIGO` int(4) NOT NULL,
  `NOMBRE` varchar(35) NOT NULL,
  `DESCRIPCION` varchar(150) NOT NULL,
  `FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CODIGO_USUARIO` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ESTADO`
--

INSERT INTO `ESTADO` (`CODIGO`, `NOMBRE`, `DESCRIPCION`, `FECHA_REGISTRO`, `CODIGO_USUARIO`) VALUES
(1, 'Abono 4673K', 'Añadir en las raíces de las plantas, intentando que se almacene un 30% de la máquina.', '2017-07-05 13:31:54', 1),
(2, 'Recoger fruto', 'Coger los frutos de cada una de las plantas, empezando por las que tengan los primeros identificadores.', '2017-07-05 13:33:05', 1),
(3, 'Cortar ramas', 'Quitar las ramas, teniendo especial atención con aquellas que se sitúen en la parte trasera.', '2017-07-05 13:34:27', 1),
(4, 'Abono 8492L', 'Echar sobre las hojas una cantidad proporcional al 5% de la máquina.', '2017-07-05 13:36:35', 1),
(5, 'Limpiar tallos', 'Limpiar cada uno de los tallos eliminando también aquellas hojas sobrantes.', '2017-07-05 13:54:42', 1),
(6, 'Regar', 'Regar toda la planta, echando también agua por encima de las hojas.', '2017-07-05 13:56:11', 1),
(7, 'Abono 94L92', 'Añadir en el agua antes de regar cada una de las plantas para que se realice la filtración.', '2017-07-05 13:58:42', 1),
(8, 'Abono 7483L', 'Echar el abono cerca de las raíces a primera hora de la mañana.', '2017-07-05 17:58:43', 1),
(9, 'Abono 7439X', 'Rellenar la máquina entera y echar encima de todas las plantas de la finca.', '2017-07-06 14:29:09', 3),
(10, 'Abono 4955K', 'Abono especial para insectos y roedores.', '2017-07-20 15:03:49', 1),
(11, 'Eliminar frutos suelo', 'Recoger todos aquellos frutos del suelo y tirarlos a la basura.', '2017-07-20 15:05:38', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FINCA`
--

CREATE TABLE `FINCA` (
  `CODIGO` int(4) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `SUPERFICIE` int(15) NOT NULL,
  `FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CODIGO_EMPRESA` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `FINCA`
--

INSERT INTO `FINCA` (`CODIGO`, `NOMBRE`, `SUPERFICIE`, `FECHA_REGISTRO`, `CODIGO_EMPRESA`) VALUES
(1, 'Los Pelados', 50, '2017-05-29 10:24:20', 1),
(2, 'Lutgardita', 23, '2017-05-29 10:26:22', 2),
(3, 'Los Güines', 78, '2017-05-29 10:26:44', 1),
(4, 'Loma Lico', 36, '2017-05-29 10:27:11', 1),
(5, 'La Viuda', 28, '2017-05-29 10:27:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GRUPOS_ESTADOS`
--

CREATE TABLE `GRUPOS_ESTADOS` (
  `CODIGO` int(4) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `ESTADOS` varchar(50) NOT NULL,
  `FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CODIGO_USUARIO` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `GRUPOS_ESTADOS`
--

INSERT INTO `GRUPOS_ESTADOS` (`CODIGO`, `NOMBRE`, `ESTADOS`, `FECHA_REGISTRO`, `CODIGO_USUARIO`) VALUES
(1, 'Platanera', '1 3 2 6', '2017-07-06 21:43:14', 1),
(2, 'Habichuela', '4 7 3 5 6', '2017-07-06 21:44:28', 1),
(3, 'Aguacatero', '8 4 7', '2017-07-14 00:06:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HUERTO`
--

CREATE TABLE `HUERTO` (
  `CODIGO` int(4) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `SUPERFICIE` int(15) NOT NULL,
  `FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CODIGO_FINCA` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `HUERTO`
--

INSERT INTO `HUERTO` (`CODIGO`, `NOMBRE`, `SUPERFICIE`, `FECHA_REGISTRO`, `CODIGO_FINCA`) VALUES
(1, 'Plataneras', 8, '2017-05-29 11:09:33', 1),
(2, 'Aguacateros', 3, '2017-05-29 11:09:33', 3),
(3, 'Huerto más grande', 10, '2017-05-29 11:09:33', 4),
(4, 'Manzanos', 6, '2017-05-29 11:09:33', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PLANTA`
--

CREATE TABLE `PLANTA` (
  `CODIGO` int(4) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ESTADOS` varchar(50) NOT NULL,
  `CODIGO_HUERTO` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `PLANTA`
--

INSERT INTO `PLANTA` (`CODIGO`, `NOMBRE`, `FECHA_REGISTRO`, `ESTADOS`, `CODIGO_HUERTO`) VALUES
(1, 'Platanera', '2017-05-29 11:14:07', '1 3 4 5', 1),
(2, 'Platanera', '2017-05-29 11:18:12', '', 1),
(3, 'Tomatera', '2017-07-16 12:43:38', '', 2),
(4, 'Naranjo', '2017-07-16 12:44:00', '', 3),
(5, 'Platanera', '2017-07-16 12:44:00', '1 3 4', 3),
(6, 'Manzano', '2017-07-16 12:44:15', '', 2),
(7, 'Tomatera', '2017-07-16 12:44:37', '', 4),
(8, 'Platanera', '2017-07-16 12:44:37', '', 4),
(9, 'Aguacatero', '2017-07-18 16:33:05', '1 2 3 4 6 8 11 12', 1),
(10, 'Tomatera', '2017-07-18 16:33:05', '3 4', 1),
(11, 'Platanera', '2017-07-18 16:33:05', '', 1),
(12, 'Calabaza', '2017-07-18 16:33:05', '', 1),
(13, 'Habichuela', '2017-07-18 16:33:05', '', 1),
(14, 'Platanera', '2017-07-18 16:33:05', '', 1),
(15, 'Lechuga', '2017-07-18 16:33:05', '', 1),
(16, 'Manzano', '2017-07-18 16:33:05', '', 1),
(17, 'Habichuela', '2017-07-18 16:33:05', '', 1),
(18, 'Bubango', '2017-07-18 16:33:05', '', 1),
(19, 'Platanera', '2017-07-18 16:33:05', '', 1),
(20, 'Bubango', '2017-07-18 16:33:05', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ROL`
--

CREATE TABLE `ROL` (
  `TIPO` varchar(30) NOT NULL,
  `VALOR` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ROL`
--

INSERT INTO `ROL` (`TIPO`, `VALOR`) VALUES
('ADMINISTRADOR', 1),
('TRABAJADOR', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

CREATE TABLE `USUARIO` (
  `ID_USUARIO` int(4) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDOS` varchar(50) NOT NULL,
  `CORREO` varchar(50) NOT NULL,
  `NOMBRE_USUARIO` varchar(25) NOT NULL,
  `CONTRASENA` varchar(50) NOT NULL,
  `FECHA_REGISTRO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ROL` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `USUARIO`
--

INSERT INTO `USUARIO` (`ID_USUARIO`, `NOMBRE`, `APELLIDOS`, `CORREO`, `NOMBRE_USUARIO`, `CONTRASENA`, `FECHA_REGISTRO`, `ROL`) VALUES
(1, 'Eduardo', 'Escobar Alberto', 'eduescal13@gmail.com', 'eduescal13', 'MRTU0fJLLK/174QvZ88yDFoQCWBwgj2Q2V/p/0QidZg=', '2017-06-21 15:46:25', 1),
(2, 'Berkan', 'Reyes Hernández', 'berkanrh95@gmail.com', 'berkanrh95', 'LSYJhRDXrIWwAXm/MzfE5/x5cXxzXF/WVktI2QW7/0M=', '2017-06-21 16:02:34', 1),
(3, 'Alba', 'Escobar Alberto', 'albaescobar@gmail.com', 'albaea93', '91FPGppCEhNKNFbHuAdzxhd8Xw2eScC6LGsGcrq7Rcw=', '2017-06-21 18:09:38', 1),
(4, 'Naday', 'Páez Delgado', 'nadaypaezdelgado95@gmail.com', 'nadaypd95', '91FPGppCEhNKNFbHuAdzxhd8Xw2eScC6LGsGcrq7Rcw=', '2017-06-24 17:39:32', 1),
(5, 'Eduardo', 'Martín de los Santos Rodríguez de Vera', 'edumartin95@gmail.com', 'edumartin95', '91FPGppCEhNKNFbHuAdzxhd8Xw2eScC6LGsGcrq7Rcw=', '2017-06-24 19:59:03', 1),
(6, 'Claudia', 'Díaz Alberto', 'claudia-diaz-alberto-12@outlook.com', 'claudial1211', '91FPGppCEhNKNFbHuAdzxhd8Xw2eScC6LGsGcrq7Rcw=', '2017-07-04 20:12:41', 1),
(9, 'Alejandro', 'Díaz Rosa', 'alexdiazr5@gmail.com', 'alexdiazr5', '91FPGppCEhNKNFbHuAdzxhd8Xw2eScC6LGsGcrq7Rcw=', '2017-07-22 15:21:36', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `EMPRESA`
--
ALTER TABLE `EMPRESA`
  ADD PRIMARY KEY (`CODIGO`),
  ADD UNIQUE KEY `TELEFONO` (`TELEFONO`),
  ADD KEY `FK_EMP_USU` (`CODIGO_USUARIO`);

--
-- Indices de la tabla `ESTADO`
--
ALTER TABLE `ESTADO`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `FK_EST_USU` (`CODIGO_USUARIO`);

--
-- Indices de la tabla `FINCA`
--
ALTER TABLE `FINCA`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `FK_FINC_EMP` (`CODIGO_EMPRESA`);

--
-- Indices de la tabla `GRUPOS_ESTADOS`
--
ALTER TABLE `GRUPOS_ESTADOS`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `FK_GRUP_USU` (`CODIGO_USUARIO`);

--
-- Indices de la tabla `HUERTO`
--
ALTER TABLE `HUERTO`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `FINC_HUER_FK` (`CODIGO_FINCA`);

--
-- Indices de la tabla `PLANTA`
--
ALTER TABLE `PLANTA`
  ADD PRIMARY KEY (`CODIGO`),
  ADD KEY `HUER_PLANT_FK` (`CODIGO_HUERTO`);

--
-- Indices de la tabla `ROL`
--
ALTER TABLE `ROL`
  ADD PRIMARY KEY (`VALOR`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD UNIQUE KEY `CORREO` (`CORREO`),
  ADD UNIQUE KEY `USUARIO` (`NOMBRE_USUARIO`),
  ADD KEY `ROL_USU_FK` (`ROL`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `EMPRESA`
--
ALTER TABLE `EMPRESA`
  MODIFY `CODIGO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ESTADO`
--
ALTER TABLE `ESTADO`
  MODIFY `CODIGO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `FINCA`
--
ALTER TABLE `FINCA`
  MODIFY `CODIGO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `GRUPOS_ESTADOS`
--
ALTER TABLE `GRUPOS_ESTADOS`
  MODIFY `CODIGO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `HUERTO`
--
ALTER TABLE `HUERTO`
  MODIFY `CODIGO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `PLANTA`
--
ALTER TABLE `PLANTA`
  MODIFY `CODIGO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `ROL`
--
ALTER TABLE `ROL`
  MODIFY `VALOR` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `ID_USUARIO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `EMPRESA`
--
ALTER TABLE `EMPRESA`
  ADD CONSTRAINT `FK_EMP_USU` FOREIGN KEY (`CODIGO_USUARIO`) REFERENCES `USUARIO` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ESTADO`
--
ALTER TABLE `ESTADO`
  ADD CONSTRAINT `FK_EST_USU` FOREIGN KEY (`CODIGO_USUARIO`) REFERENCES `USUARIO` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `FINCA`
--
ALTER TABLE `FINCA`
  ADD CONSTRAINT `FK_FINC_EMP` FOREIGN KEY (`CODIGO_EMPRESA`) REFERENCES `EMPRESA` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `GRUPOS_ESTADOS`
--
ALTER TABLE `GRUPOS_ESTADOS`
  ADD CONSTRAINT `FK_GRUP_USU` FOREIGN KEY (`CODIGO_USUARIO`) REFERENCES `USUARIO` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `HUERTO`
--
ALTER TABLE `HUERTO`
  ADD CONSTRAINT `FINC_HUER_FK` FOREIGN KEY (`CODIGO_FINCA`) REFERENCES `FINCA` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `PLANTA`
--
ALTER TABLE `PLANTA`
  ADD CONSTRAINT `HUER_PLANT_FK` FOREIGN KEY (`CODIGO_HUERTO`) REFERENCES `HUERTO` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD CONSTRAINT `ROL_USU_FK` FOREIGN KEY (`ROL`) REFERENCES `ROL` (`VALOR`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
