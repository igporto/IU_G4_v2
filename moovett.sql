-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generaciÃƒÂ³n: 25-11-2016 a las 14:25:14
-- VersiÃƒÂ³n del servidor: 10.1.16-MariaDB
-- VersiÃƒÂ³n de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `moovett`
--

DROP DATABASE IF EXISTS `moovett`;

CREATE DATABASE IF NOT EXISTS `moovett` DEFAULT character SET utf8 collate utf8_spanish_ci;
USE `moovett`;

DROP USER 'adminMoovett'@'localhost';


CREATE USER 'adminMoovett'@'localhost';
SET PASSWORD FOR 'adminMoovett'@'localhost' = PASSWORD('moovett');
REVOKE ALL PRIVILEGES ON *.* FROM 'adminMoovett'@'localhost';
GRANT ALL PRIVILEGES ON *.* TO 'adminMoovett'@'localhost';

-- DROPS DE TABLAS
DROP TABLE IF EXISTS `actividad`;
DROP TABLE IF EXISTS `alumno`;
DROP TABLE IF EXISTS `alumno_tiene_lesion`;
DROP TABLE IF EXISTS `asistencia`;
DROP TABLE IF EXISTS `espacio`;
DROP TABLE IF EXISTS `calendario`;
DROP TABLE IF EXISTS `caja`;
DROP TABLE IF EXISTS `categoria`;
DROP TABLE IF EXISTS `consulta_fisio`;
DROP TABLE IF EXISTS `descuento`;
DROP TABLE IF EXISTS `documento`;
DROP TABLE IF EXISTS `empleado`;
DROP TABLE IF EXISTS `empleado_tiene_lesion`;
DROP TABLE IF EXISTS `evento`;
DROP TABLE IF EXISTS `factura`;
DROP TABLE IF EXISTS `linea_factura`;
DROP TABLE IF EXISTS `horario_actividad`;
DROP TABLE IF EXISTS `horas_posibles`;
DROP TABLE IF EXISTS `inscripcion`;
DROP TABLE IF EXISTS `lesion`;
DROP TABLE IF EXISTS `pago`;
DROP TABLE IF EXISTS `perfil`;
DROP TABLE IF EXISTS `controlador`;
DROP TABLE IF EXISTS `accion`;
DROP TABLE IF EXISTS `permiso`;
DROP TABLE IF EXISTS `permisos_perfil`;
DROP TABLE IF EXISTS `recibo`;
DROP TABLE IF EXISTS `reserva`;
DROP TABLE IF EXISTS `usuario_tiene_permiso`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `cliente_externo`;
DROP TABLE IF EXISTS `servicio`;
DROP TABLE IF EXISTS `log_acceso_lesion`;
DROP TABLE IF EXISTS `alerta`;
DROP TABLE IF EXISTS `notificacion`;
DROP TABLE IF EXISTS `usuario_recibe_alerta`;
DROP TABLE IF EXISTS `alumnos_recibe_notificacion`;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE  `actividad` (
  `id_actividad` int(4) NOT NULL,
  `nombre` varchar(45) NULL,
  `aforo` int(4) NULL,
  `id_categoria` int(4) NULL,
  `id_espacio` int(4) not null,
  `descuento` int(4) NOT NULL,
  `color` varchar(16) NOT NULL,
  `empleado_imparte` int(3) NOT NULL
);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(4) NOT NULL,
  `dni_alumno` varchar(9) NOT NULL,
  `nombre` varchar(15) NULL DEFAULT '',
  `apellidos` varchar(40) NULL DEFAULT '',
  `fecha_nac` date NULL DEFAULT '0000-00-00',
  `profesion` varchar(20) NULL DEFAULT '',
  `direccion_postal` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(50) DEFAULT '',
  `comentarios` text NULL,
  `clases_pendientes` int(4) NULL DEFAULT '0'
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_tiene_lesion`
--

CREATE TABLE `alumno_tiene_lesion` (
  `id_alumno` int(4) NOT NULL,
  `id_lesion` int(4) NOT NULL
) ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(4) NOT NULL,
  `fecha_as` date NOT NULL,
  `asiste` tinyint(1) NOT NULL,
  `id_alumno` int(4) NOT NULL,
  `id_empleado` int(3) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `espacio` (
  `id_espacio` int(4) NOT NULL,
  `nombre`varchar(100) NOT NULL,
  `aforo` int(4) NOT NULL,
  `descripcion` varchar(250) NULL
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `id_calendario` int(4) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
);


-- --------------------------------------------------------

--
-- table structure for table `caja`
--

create table `caja` (
  `id_caja` int(4) NOT NULL,
  `cantidad_inicial` int(6) NULL,
  `cantidad_actual` int(6) NULL,
  `cantidad_final` int(6) NULL,
  `id_pago` int(4) NOT NULL
) ;




-- --------------------------------------------------------

--
-- table structure for table `categoria`
--

CREATE TABLE `categoria`(
  `id_categoria` int(4) NULL,
  `nombre` varchar(10) null
) ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta_fisio`
--

CREATE TABLE `consulta_fisio` (
  `id_consulta` int(4) NOT NULL,
  `id_reserva` int(4) NOT NULL,
  `dia` date NOT NULL DEFAULT '0000-00-00',
  `hora_inicio` time NOT NULL DEFAULT '00:00:00',
  `hora_fin` time NOT NULL DEFAULT '00:00:00'
);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

CREATE TABLE `descuento` (
  `id_descuento` int(4) NOT NULL,
  `tipo` varchar(10) NULL,
  `porcentaje` int(2) NOT NULL DEFAULT '0',
  `descripcion` text NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id_documento` int (4) NOT NULL,
  `fecha_firma` date NOT NULL DEFAULT '0000-00-00',
  `id_alumno` int(4) NOT NULL,
  `id_empleado` int(3) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(3) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(15) NULL,
  `apellidos` varchar(40) NULL,
  `fech_nac` date NULL,
  `direccion_postal` varchar(25) NULL,
  `email` varchar(50) NULL,
  `comentario_personal` text NULL,
  `hora_entrada` time  NULL,
  `hora_salida` time  NULL,
  `num_cuenta` varchar(15)  NULL,
  `tipo_contrato` varchar(20) NULL,
  `cod_usuario` int(4) NULL
) ;


-- --------------------------------------------------------

--
-- table structure for table `lesion_empleado`
--

CREATE TABLE `empleado_tiene_lesion` (
  `id_empleado` int(3) NOT NULL,
  `id_lesion` int(4) NOT NULL
) ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id_evento` int(4) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `hora_inicio` time NOT NULL DEFAULT '00:00:00',
  `hora_fin` time NOT NULL DEFAULT '00:00:00',
  `fecha_evento` date NOT NULL DEFAULT '0000-00-00',
  `aforo` int(4) NOT NULL,
  `id_espacio` int(4) NOT NULL,
  `id_empleado` int(3) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_se_apunta_evento`
--

CREATE TABLE `alumno_se_apunta_evento` (
  `id_evento` int(4) NOT NULL,
  `id_alumno` int(4) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(4) NOT NULL,
  `fecha` int(4) NOT NULL,
  `id_pago` int(4) NOT NULL
) ;


-- --------------------------------------------------------

--
-- table structure for table `linea_factura`
--

CREATE TABLE `linea_factura` (
  `id_linea_factura` int(4) not null,
  `id_factura` int(4) not null,
  `concepto` text DEFAULT NULL,
  `unidades` int(4) DEFAULT NULL,
  `importe` smallint(6) DEFAULT NULL,
  `descuento` int(4) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_actividad`
--

CREATE TABLE `horario_actividad` (
  `hora_comienzo` time NOT NULL DEFAULT '00:00:00',
  `hora_final` time NOT NULL DEFAULT '00:00:00',
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `id_actividad` int(4) NOT NULL
) ;


-- --------------------------------------------------------

--
-- table structure for table `horas_posibles`
--

CREATE TABLE `horas_posibles` (
  `id_hora` int(4) not null,
  `dia` date not null,
  `hora_inicio` time not null,
  `hora_fin` time not null,
  `id_calendario` int(4) not null
) ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id_inscripcion` int(4) NOT NULL,
  `id_reserva` int(4) NULL,
  `fecha_inscripcion` date NOT NULL DEFAULT '0000-00-00',
  `id_pago` int(4) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lesion`
--

CREATE TABLE `lesion` (
  `id_lesion` int(4) NOT NULL,
  `descripcion` varchar(250) NULL,
  `tratamiento` text NULL,
  `fecha_lesion` date DEFAULT NULL,
  `tiempo_recuperacion` int(4) NULL,
  `fecha_recuperacion` date DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(4) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT '0000-00-00 00:00',
  `cantidad` smallint(6) not null,
  `metodo_pago` varchar(15) NOT NULL DEFAULT '',
  `descuento` int(4) NOT NULL,
  `tipo_cliente` VARCHAR (19) NULL,
  `dni_alum` VARCHAR (9) NULL,
  `dni_cliente_externo` VARCHAR (9) NULL
)  ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(4) NOT NULL,
  `nombre` varchar(25) NOT NULL
)  ;


--
-- Estructura de tabla para la tabla `controlador`
--

CREATE TABLE `controlador` (
  `id_controlador` int(4) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ;


--
-- Estructura de tabla para la tabla `accion`
--

CREATE TABLE `accion` (
  `id_accion` int(4) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ;


--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(4) NOT NULL,
  `id_controlador` int(4) NOT NULL,
  `id_accion` int(4) NOT NULL
) ;



--
-- Estructura de tabla para la tabla `permisos_perfil`
--

CREATE TABLE `permisos_perfil` (
  `id_perfil` int(4) NOT NULL,
  `id_permiso` int(4) NOT NULL
) ;



--
-- Estructura de tabla para la tabla `recibo`
--

CREATE TABLE `recibo` (
  `id_recibo` int(4) NOT NULL,
  `importe` int(5) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `descuento` int(4) NULL,
  `id_pago` int(4) NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_esp`
--

CREATE TABLE `reserva` (
  `id_reserva` int(4) NOT NULL,
  `id_espacio` int(4) NULL,
  `id_servicio` int(4) NULL,
  `id_alumno` int(4) NULL,
  `fecha_reserva` date NOT NULL DEFAULT '0000-00-00',
  `hora_inicio` time NOT NULL DEFAULT '00:00:00',
  `hora_fin` time NOT NULL DEFAULT '00:00:00',
  `precio_espacio` smallint(6)  NULL,
  `precio_fisio` smallint(6)  NULL
);



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tiene_permiso`
--

CREATE TABLE `usuario_tiene_permiso` (
  `cod_usuario` int(4) NOT NULL,
  `id_permiso` int(4) NOT NULL
) ;



--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cod_usuario` int(4) NOT NULL,
  `user` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `id_perfil` int(4) NULL
) ;



--
-- table structure for table `cliente_externo`
--

CREATE TABLE `cliente_externo` (
  `dni_cliente_externo` varchar(9) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(40) default null,
  `telefono` int(9) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ;


-- --------------------------------------------------------

--
-- table structure for table `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(4) NOT NULL,
  `fecha` date NOT NULL,
  `coste` int(4) NOT NULL,
  `descripcion` text,
  `dni_cliente_externo` varchar(9) NOT NULL
) ;


-- --------------------------------------------------------

--
-- table structure for table `log_acceso_lesion`
--

CREATE TABLE `log_acceso_lesion` (
  `id_log` int(4) NOT NULL,
  `id_lesion` int(4) NOT NULL,
  `id_empleado` int(3) NULL,
  `id_alumno` int(4) NULL,
  `cod_usuario` int(4) NOT NULL,
  `fecha` DATE NULL
) ;


-- --------------------------------------------------------

--
-- table structure for table `alerta`
--

CREATE TABLE `alerta` (
`id_alerta` int(4) NOT NULL,
  `descripcion` text NOT NULL,
  `id_pago` int(4) NULL,
  `id_asistencia` int(4) NULL,
  `cod_usuario` int(4) NULL
);

-- --------------------------------------------------------

--
-- table structure for table `notificacion`
--

CREATE TABLE `notificacion` (
  `id_notificacion` int(4) NOT NULL,
  `descripcion` text NOT NULL,
  `cod_usuario` int(4) NULL
);

-- --------------------------------------------------------

--
-- table structure for table `usuario_recibe_alerta`
--

CREATE TABLE `usuario_recibe_alerta` (
  `cod_usuario` int(4) NOT NULL,
  `id_alerta` int(4) NOT NULL
);


-- --------------------------------------------------------

--
-- table structure for table `alumnos_recibe_notificacion`
--

CREATE TABLE `alumnos_recibe_notificacion` (
  `id_notificacion` int(4) NOT NULL,
  `id_alumno` int(4) NOT NULL
);

CREATE TABLE `domiciliacion` (
  `id_domiciliacion` int(4) NOT NULL,
  `periodo` int(4) NOT NULL,
  `total` int(4) NOT NULL,
  `id_cliente` varchar(9) NOT NULL,
  `iban` varchar (32) NOT NULL
) ;




--
-- ÃƒÂndices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_espacio` (`id_espacio`),
  ADD KEY `descuento` (`descuento`),
  ADD KEY `empleado_imparte` (`empleado_imparte`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `alumno_tiene_lesion`
--
ALTER TABLE `alumno_tiene_lesion`
  ADD PRIMARY KEY (`id_lesion`,`id_alumno`),
  ADD KEY `id_lesion` (`id_lesion`),
  ADD KEY `id_alumno` (`id_alumno`);


--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `espacio`
--
ALTER TABLE `espacio`
  ADD PRIMARY KEY (`id_espacio`);

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id_calendario`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`),
  ADD KEY `id_pago` (`id_pago`);


--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);


--
-- Indices de la tabla `consulta_fisio`
--
ALTER TABLE `consulta_fisio`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `id_reserva` (`id_reserva`);


--
-- Indices de la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`id_descuento`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `cod_usuario` (`cod_usuario`);


--
-- Indices de la tabla `empleado_tiene_lesion`
--
ALTER TABLE `empleado_tiene_lesion`
  ADD PRIMARY KEY (`id_lesion`,`id_empleado`),
  ADD KEY `id_lesion` (`id_lesion`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_espacio` (`id_espacio`);

--
-- Indices de la tabla `alumno_se_apunta_evento`
--
ALTER TABLE `alumno_se_apunta_evento`
 ADD PRIMARY KEY (`id_evento`,`id_alumno`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_pago` (`id_pago`);

  --
-- Indices de la tabla `linea_factura`
--
ALTER TABLE `linea_factura`
  ADD PRIMARY KEY (`id_linea_factura`,`id_factura`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `descuento` (`descuento`);

--
-- Indices de la tabla `horario_actividad`
--
ALTER TABLE `horario_actividad`
  ADD PRIMARY KEY (`fecha`,`hora_comienzo`,`id_actividad`),
  ADD KEY `id_actividad` (`id_actividad`);


--
-- Indices de la tabla `horas_posibles`
--
ALTER TABLE `horas_posibles`
  ADD PRIMARY KEY (`id_hora`),
  ADD KEY `id_calendario` (`id_calendario`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `id_reserva` (`id_reserva`),
  ADD KEY `id_pago` (`id_pago`);

--
-- Indices de la tabla `lesion`
--
ALTER TABLE `lesion`
  ADD PRIMARY KEY (`id_lesion`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `descuento` (`descuento`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `controlador`
--
ALTER TABLE `controlador`
  ADD PRIMARY KEY (`id_controlador`);

--
-- Indices de la tabla `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`id_accion`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `permisos_perfil`
--
ALTER TABLE `permisos_perfil`
  ADD PRIMARY KEY (`id_perfil`,`id_permiso`),
  ADD KEY `id_perfil` (`id_perfil`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD PRIMARY KEY (`id_recibo`),
  ADD KEY `descuento` (`descuento`);

--
-- Indices de la tabla `reserva_esp`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_espacio` (`id_espacio`),
  ADD KEY `id_alumno` (`id_alumno`);


--
-- Indices de la tabla `usuario_tiene_permiso`
--
ALTER TABLE `usuario_tiene_permiso`
  ADD PRIMARY KEY (`cod_usuario`,`id_permiso`),
  ADD KEY `id_permiso` (`id_permiso`),
  ADD KEY `cod_usuario` (`cod_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD KEY `id_perfil` (`id_perfil`);


--
-- Indices de la tabla `cliente_externo`
--
ALTER TABLE `cliente_externo`
  ADD PRIMARY KEY (`dni_cliente_externo`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `dni_cliente_externo`(`dni_cliente_externo`);

--
-- indexes for table `log_acceso_lesion`
--
ALTER TABLE `log_acceso_lesion`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_lesion` (`id_lesion`),
  ADD KEY `id_alumno`(`id_alumno`),
  ADD KEY `id_empleado`(`id_empleado`),
  ADD KEY `cod_usuario` (`cod_usuario`);

--
-- indexes for table `alerta`
--
ALTER TABLE `alerta`
 ADD PRIMARY KEY (`id_alerta`),
 ADD KEY `id_pago` (`id_pago`),
 ADD KEY `id_asistencia` (`id_asistencia`),
 ADD KEY `cod_usuario` (`cod_usuario`);


--
-- indexes for table `notificacion`
--
ALTER TABLE `notificacion`
 ADD PRIMARY KEY (`id_notificacion`),
 ADD KEY `cod_usuario` (`cod_usuario`);


--
-- indexes for table `usuario_recibe_alerta`
--
ALTER TABLE `usuario_recibe_alerta`
 ADD PRIMARY KEY (`cod_usuario`,`id_alerta`),
 ADD KEY `cod_usuario` (`cod_usuario`),
 ADD KEY `id_alerta` (`id_alerta`);

--
-- indexes for table `alumno_recibe_notificacion`
--
ALTER TABLE `alumnos_recibe_notificacion`
 ADD PRIMARY KEY (`id_alumno`,`id_notificacion`),
 ADD KEY `id_alumno` (`id_alumno`),
 ADD KEY `id_notificacion` (`id_notificacion`);

ALTER TABLE `domiciliacion`
  ADD PRIMARY KEY (`id_domiciliacion`);

ALTER TABLE `domiciliacion`
  MODIFY `id_domiciliacion` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de las tablas volcadas
--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(4) NOT NULL AUTO_INCREMENT;
  --
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(4) NOT NULL AUTO_INCREMENT;
 --
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id_calendario` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `consulta_fisio`
--
ALTER TABLE `consulta_fisio`
  MODIFY `id_consulta` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `descuento`
--
ALTER TABLE `descuento`
  MODIFY `id_descuento` int(4) NOT NULL AUTO_INCREMENT;
  --
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id_documento` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `espacio`
--
ALTER TABLE `espacio`
  MODIFY `id_espacio` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `horas_posibles`
--
ALTER TABLE `horas_posibles`
  MODIFY `id_hora` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lesion`
--
ALTER TABLE `lesion`
  MODIFY `id_lesion` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `linea_factura`
--
ALTER TABLE `linea_factura`
  MODIFY `id_linea_factura` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `controlador`
--
ALTER TABLE `controlador`
  MODIFY `id_controlador` int(4) NOT NULL AUTO_INCREMENT;
-- AUTO_INCREMENT de la tabla `accion`
--
ALTER TABLE `accion`
  MODIFY `id_accion` int(4) NOT NULL AUTO_INCREMENT;
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `recibo`
--
ALTER TABLE `recibo`
  MODIFY `id_recibo` int(4) NOT NULL AUTO_INCREMENT;
 --
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(3) NOT NULL AUTO_INCREMENT;
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `log_acceso_lesion`
--
ALTER TABLE `log_acceso_lesion`
  MODIFY `id_log` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `alerta`
--
ALTER TABLE `alerta`
  MODIFY `id_alerta` int(4) NOT NULL AUTO_INCREMENT;
 --
-- AUTO_INCREMENT de la tabla `alerta`
--
ALTER TABLE `notificacion`
  MODIFY `id_notificacion` int(4) NOT NULL AUTO_INCREMENT;


--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_2` FOREIGN KEY (`descuento`) REFERENCES `descuento` (`id_descuento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_3` FOREIGN KEY (`empleado_imparte`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_4` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id_espacio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumno_tiene_lesion`
--
ALTER TABLE `alumno_tiene_lesion`
  ADD CONSTRAINT `alumno_tiene_lesion_ibfk_1` FOREIGN KEY (`id_lesion`) REFERENCES `lesion` (`id_lesion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_tiene_lesion_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`id_pago`) REFERENCES `pago` (`id_pago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consulta_fisio`
--
ALTER TABLE `consulta_fisio`
  ADD CONSTRAINT `consulta_fisio_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Filtros para la tabla `empleado_tiene_lesion`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Filtros para la tabla `empleado_tiene_lesion`
--
ALTER TABLE `empleado_tiene_lesion`
  ADD CONSTRAINT `empleado_tiene_lesion_ibfk_1` FOREIGN KEY (`id_lesion`) REFERENCES `lesion` (`id_lesion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleado_tiene_lesion_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id_espacio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumno_se_apunta_evento`
--
ALTER TABLE `alumno_se_apunta_evento`
  ADD CONSTRAINT `alumno_se_apunta_evento_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_se_apunta_evento_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_pago`) REFERENCES `pago` (`id_pago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `linea_factura`
--
ALTER TABLE `linea_factura`
  ADD CONSTRAINT `linea_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linea_factura_ibfk_2` FOREIGN KEY (`descuento`) REFERENCES `descuento` (`id_descuento`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Filtros para la tabla `horario_actividad`
--
ALTER TABLE `horario_actividad`
  ADD CONSTRAINT `horario_actividad_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horas_posibles`
--
ALTER TABLE `horas_posibles`
  ADD CONSTRAINT `horas_posibles_ibfk_1` FOREIGN KEY (`id_calendario`) REFERENCES `calendario` (`id_calendario`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`id_pago`) REFERENCES `pago` (`id_pago`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`descuento`) REFERENCES `descuento` (`id_descuento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`id_controlador`) REFERENCES `controlador` (`id_controlador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`id_accion`) REFERENCES `accion` (`id_accion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos_perfil`
--
ALTER TABLE `permisos_perfil`
  ADD CONSTRAINT `permisos_perfil_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_perfil_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD CONSTRAINT `recibo_ibfk_1` FOREIGN KEY (`id_pago`) REFERENCES `pago` (`id_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recibo_ibfk_2` FOREIGN KEY (`descuento`) REFERENCES `pago` (`descuento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id_espacio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_4` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_5` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_tiene_permiso`
--
ALTER TABLE `usuario_tiene_permiso`
  ADD CONSTRAINT `usuario_tiene_permiso_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_tiene_permiso_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE SET NULL ON UPDATE CASCADE;


--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`dni_cliente_externo`) REFERENCES `cliente_externo` (`dni_cliente_externo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `log_acceso_lesion`
--
ALTER TABLE `log_acceso_lesion`
  ADD CONSTRAINT `log_acceso_lesion_ibfk_1` FOREIGN KEY (`id_lesion`) REFERENCES `lesion` (`id_lesion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_acceso_lesion_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_acceso_lesion_ibfk_3` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_acceso_lesion_ibfk_4` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- constraints for table `alerta`
--

ALTER TABLE `alerta`
ADD CONSTRAINT `fk_alerta_pago1` FOREIGN KEY (`id_pago`) REFERENCES `pago` (`id_pago`)  ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_alerta_asistencia1` FOREIGN KEY (`id_asistencia`) REFERENCES `asistencia` (`id_asistencia`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_alerta_usuario1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`)  ON DELETE CASCADE ON UPDATE CASCADE;

--
-- constraints for table `notificacion`
--
ALTER TABLE `notificacion`
ADD CONSTRAINT `fk_notificacion_usuario1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- constraints for table `usuario_recibe_alerta`
--
ALTER TABLE `usuario_recibe_alerta`
ADD CONSTRAINT `fk_usuario_recibe_alerta_alerta1` FOREIGN KEY (`id_alerta`) REFERENCES `alerta` (`id_alerta`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_usuario_recibe_alerta_usuario1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- constraints for table `alumnos_recibe_notificacion`
--
ALTER TABLE `alumnos_recibe_notificacion`
ADD CONSTRAINT `fk_alumnos_recibe_notificacione_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_alumnos_recibe_notificacion_notificacion1` FOREIGN KEY (`id_notificacion`) REFERENCES `notificacion` (`id_notificacion`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Volcado de datos para la tabla `controlador`
--

INSERT INTO `controlador`(`id_controlador`,`nombre`) VALUES
(1, 'ACTION'),
(2, 'CONTROLLER'),
(3, 'PROFILE'),
(4, 'USER'),
(5, 'PERMISSION'),
(6, 'PAYMENT'),
(7, 'BILL'),
(8, 'DOMICILIATION'),
(9, 'CLIENT'),
(10, 'SERVICE'),
(11, 'CATEGORY'),
(12, 'ACTIVITY'),
(13, 'ATTENDANCE'),
(14, 'EMPLOYEE'),
(15, 'SPACE'),
(16, 'DISCOUNT'),
(17, 'EVENT'),
(18, 'ALUMN');


--
-- Volcado de datos para la tabla `accion`
--

INSERT INTO `accion`(`id_accion`,`nombre`) VALUES
(1, 'ADD'),
(2, 'EDIT'),
(3, 'DELETE'),
(4, 'SHOW'),
(5, 'VIEW');


--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_controlador`, `id_accion`) VALUES
(1 ,1),
(1 ,2),
(1 ,3),
(1 ,4),
(1 ,5),
(2 ,1),
(2 ,2),
(2 ,3),
(2 ,4),
(2 ,5),
(3 ,1),
(3 ,2),
(3 ,3),
(3 ,4),
(3 ,5),
(4 ,1),
(4 ,2),
(4 ,3),
(4 ,4),
(4 ,5),
(5 ,1),
(5 ,2),
(5 ,3),
(5 ,4),
(5 ,5),
(6 ,1),
(6 ,2),
(6 ,3),
(6 ,4),
(6 ,5),
(7 ,1),
(7 ,2),
(7 ,3),
(7 ,4),
(7 ,5),
(8 ,1),
(8 ,2),
(8 ,3),
(8 ,4),
(8 ,5),
(9 ,1),
(9 ,2),
(9 ,3),
(9 ,4),
(9 ,5),
(10 ,1),
(10 ,2),
(10 ,3),
(10 ,4),
(10 ,5),
(11 ,1),
(11 ,2),
(11 ,3),
(11 ,4),
(11 ,5),
(12 ,1),
(12 ,2),
(12 ,3),
(12 ,4),
(12 ,5),
(13 ,1),
(13 ,2),
(13 ,3),
(13 ,4),
(13 ,5),
(14 ,1),
(14 ,2),
(14 ,3),
(14 ,4),
(14 ,5),
(15 ,1),
(15 ,2),
(15 ,3),
(15 ,4),
(15 ,5),
(16 ,1),
(16 ,2),
(16 ,3),
(16 ,4),
(16 ,5),
(17 ,1),
(17 ,2),
(17 ,3),
(17 ,4),
(17 ,5),
(18 ,1),
(18 ,2),
(18 ,3),
(18 ,4),
(18 ,5);



--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre`) VALUES
(1, 'admin'),
(2, 'monitor');

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `user`, `password`, `id_perfil`) VALUES
(1, 'rodeiro', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(2, 'admin','21232f297a57a5a743894a0e4a801fc3',1),
(3, 'adri', '5e082012573775c13199192bf00694e7', 2),
(4, 'ivan', '2c42e5cf1cdbafea04ed267018ef1511', 1),
(5, 'lorena', '62a90ccff3fd73694bf6281bb234b09a', 2),
(6, 'monitor','08b5411f848a2581a41672a759c87380',2);


--
-- Volcado de datos para la tabla `usuario_tiene_permiso`
--

INSERT INTO `usuario_tiene_permiso` (`cod_usuario`, `id_permiso`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90);




/*ASIGNACIONS DE PERMISOS AOS PERFILES*/
            /*PERFIL ADMIN*/
            /*ACTION*/
            /*ASIGNACIONS DE PERMISOS AOS PERFILES*/
            /*PERFIL ADMIN*/
             /*ACTION*/
             INSERT INTO `permisos_perfil`(`id_perfil`, `id_permiso`) VALUES
              (1, 1),
              (1, 2),
              (1, 3),
              (1, 4),
              (1, 5),
            /*CONTROLLER*/
              (1, 6),
              (1, 7),
              (1, 8),
              (1, 9),
              (1, 10),
            /*PROFILE*/
              (1, 11),
              (1, 12),
              (1, 13),
              (1, 14),
              (1, 15),
            /*USER*/
              (1, 16),
              (1, 17),
              (1, 18),
              (1, 19),
              (1, 20),
            /*PERMISSION*/
              (1, 21),
              (1, 22),
              (1, 23),
              (1, 24),
              (1, 25),
              /*PAYMENT*/
              (1, 26),
              (1, 27),
              (1, 28),
              (1, 29),
              (1, 30),
              /*BILL*/
              (1, 31),
              (1, 32),
              (1, 33),
              (1, 34),
              (1, 35),
              /*DOMICILIATION*/
              (1, 36),
              (1, 37),
              (1, 38),
              (1, 39),
              (1, 40),
              /* CLIENT */
              (1, 41),
              (1, 42),
              (1, 43),
              (1, 44),
              (1, 45),
              /* SERVICE */
              (1, 46),
              (1, 47),
              (1, 48),
              (1, 49),
              (1, 50),
              /*ENGADIDO POR IVAN DENDE AQUI OS PERMISOS*/
              /*CATEGORY*/
              (1, 51),
              (1, 52),
              (1, 53),
              (1, 54),
              (1, 55),
              /*ACTIVITY*/
              (1, 56),
              (1, 57),
              (1, 58),
              (1, 59),
              (1, 60),
              /*ATTENDANCE*/
              (1, 61),
              (1, 62),
              (1, 63),
              (1, 64),
              (1, 65),
              /*EMPLOYEE*/
              (1, 66),
              (1, 67),
              (1, 68),
              (1, 69),
              (1, 70),
              /*SPACE*/
              (1, 71),
              (1, 72),
              (1, 73),
              (1, 74),
              (1, 75),
              /*DISCOUNT*/
              (1, 76),
              (1, 77),
              (1, 78),
              (1, 79),
              (1, 80),
              /*ALUMN*/
              (1, 86),
              (1, 87),
              (1, 88),
              (1, 89),
              (1, 90),
              /* ENGADIDO POR IVAN ATA AQUI OS PERMISOS*/
              /*ENGADIDO POR BRUNO*/
              /*EVENT*/
              (1, 81),
              (1, 82),
              (1, 83),
              (1, 84),
              (1, 85);
              /*ENGADIDO POR BRUNO*/
/*ENGADIDO POR IVAN */
--
-- Volcado de datos para la tabla `categoria`
--
INSERT INTO `categoria`(`id_categoria`, `nombre`) VALUES
  (1, "AZUL"),
  (2, "ROSA");




--
-- Volcado de datos para la tabla `espacio`
--
INSERT INTO `espacio`(`id_espacio`, `nombre`, `aforo`, `descripcion`) VALUES
  (1, "Aula 1.1", "30", "Aula da primeira Planta Porta 1"),
  (2, "Aula 1.2", "20", "Aula da primeira Planta Porta 2"),
  (3, "Aula 0", "10", "Zona para as clases de TRX e zona de musculación");



--
-- Volcado de datos para la tabla `empleado`
--
INSERT INTO `empleado`(`id_empleado`, `dni`, `nombre`, `apellidos`, `fech_nac`, `direccion_postal`, `email`, `comentario_personal`, `hora_entrada`, `hora_salida`, `num_cuenta`, `tipo_contrato`, `cod_usuario`) VALUES
(1, '44654552J', 'Lorena', 'Domínguez', "1994-01-01", "Ourense", "lorena@moveett.es", "nada que dicir", "09:00:00", "20:00:00", 111111111111111111, "Fixo", 5),
(2, '34562321A', 'Adrián', 'Reboredo', "1994-04-01", "Ourense", "adrian@moveett.es", "nada que dicir", "09:00:00", "20:00:00", 111111111111111112, "Fixo", 3),
(3, '44432654I', 'Iván', 'Guardado', "1994-02-01", "Ourense", "ivan@moveett.es", "nada que dicir", "09:00:00", "20:00:00", 111111111111111113, "Fixo", 4);



--
-- Volcado de datos para la tabla `descuento`
--
INSERT INTO `descuento`(`id_descuento`, `tipo`, `porcentaje`, `descripcion`) VALUES
  (1, "Xoven", "25", "Desconto para as persoas menores de 30 anos"),
  (2, "Desemprego", "50", "Desconto para as persoas desempregadas"),
  (3, "Estudantes", "25", "Desconto para estudantes"),
  (4, "Familiar", "45", "Desconto aplicado se empregan o ximnasio mais de 2 persoas da mesma familia"),
  (5, "Parella", "20", "Desconto aplicado para persoas que usen o ximnasio xuntos"),
  (6, "Rosa", "10", "Desconto aplicado as actividades con categoria ROSA"),
  (7, "Azul", "15", "Desconto aplicado as actividades con categoria AZUL");



--
-- Volcado de datos para la tabla `actividad`
--
INSERT INTO `actividad`(`id_actividad`, `nombre`, `aforo`, `id_categoria`, `id_espacio`, `descuento`, `empleado_imparte`, `color`) VALUES
  ( 1, "ZUMBA KIDS", 30 , 1, 1, 6, 2, "#000000"),
  ( 2, "ZUMBA JUNIOR", 20 , 2, 2, 7, 1, "#000000"),
  ( 3, "TRX", 10, 1, 3, 6, 3, "#000000"),
  ( 4, "ZUMBA", 20 , 2, 2, 7, 1, "#000000");


  --
-- Volcado de datos para la tabla `actividad`
--
INSERT INTO `alumno`(`id_alumno`, `dni_alumno`, `nombre`, `apellidos`, `fecha_nac`, `profesion`, `direccion_postal`, `email`, `comentarios`, `clases_pendientes`) VALUES
(1, '44654552J', 'Lorena', 'Domínguez', "1994-01-01","Estudante", "Ourense", "lorena@moveett.es", "nada que dicir", 0),
(2, '34562321A', 'Adrián', 'Reboredo', "1994-04-01", "Administrativo", "Ourense", "adrian@moveett.es", "nada que dicir", 0),
(3, '44432654I', 'Iván', 'Guardado', "1994-02-01", "Profesor de ESO", "Ourense", "ivan@moveett.es", "nada que dicir", 0);




/* FIN DE ENGADIDO POR IVAN */
/* Engadido por Bruno */

--
-- Volcado de datos para la tabla `evento`
--


INSERT INTO `evento` (`nombre`, `hora_inicio`, `hora_fin`, `fecha_evento`, `aforo`, `id_espacio`, `id_empleado`) VALUES
  ('Danza', '10:00:00', '12:00:00', '2017-20-12', 300, 1, 1),
  ('Zumba', '12:05:00', '13:30:00', '2017-23-12', 150, 1, 1);

--
-- Volcado de datos para la tabla `alumno_se_apunta_evento`
--

INSERT INTO `alumno_se_apunta_evento` (`id_evento`, `id_alumno`) VALUES
  (1,1),
  (1,2),
  (2,1),
  (2,3);

/* Engadido por Bruno */
/* Engadido por Lore */


--
-- Volcado de datos para la tabla `cliente_externo`
--


INSERT INTO `cliente_externo` (`dni_cliente_externo`, `nombre`, `apellido`, `telefono`, `email`) VALUES
  ('44654552J', 'Lorena', 'DomÃ­nguez', 988656565, 'lore@email.com'),
  ('34562321A', 'Adrián', 'Reboredo', 600125478, 'adrian@email.com'),
  ('44432654I', 'Iván', 'Guardado', 902202122, 'ivan@email.com'),
  ('34999524J', 'Javier', 'Rodeiro', 600848484, 'javi@email.com'),
  ('44612345B', 'Bruno', 'Cruz', 603456587, 'bruno@email.com'),
  ('36955684Y', 'Yeray', 'Lage', 988123123, 'yeray@email.com'),
  ('48575233D', 'Daniel', 'ResÃºa', 603125125, 'dani@email.com');

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`fecha`, `coste`, `descripcion`, `dni_cliente_externo`) VALUES
  ('2016-12-22',35, 'Servicio 1', '44654552J'),
  ('2016-11-17',125, 'Servicio 2', '34562321A'),
  ('2016-12-30',50, 'Servicio 3', '44432654I'),
  ('2016-12-14',69, 'Servicio 4', '34999524J');

/* Engadido por Lore */