-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2016 a las 14:25:14
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `moovett`
--

CREATE DATABASE IF NOT EXISTS `moovett` DEFAULT character SET utf8 collate utf8_spanish_ci;
USE `moovett`;

CREATE USER 'adminMoovett'@'localhost';
SET PASSWORD FOR 'adminMoovett'@'localhost' = PASSWORD('moovett');
REVOKE ALL PRIVILEGES ON *.* FROM 'adminMoovett'@'localhost';
GRANT ALL PRIVILEGES ON *.* TO 'adminMoovett'@'localhost';



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE  `actividad` (
  `id_actividad` int(4) NOT NULL,
  `nombre` varchar(45) NULL,
  `aforo` int(4) NULL,
  `id_categoria` int(4) NOT NULL,
  `id_espacio` int(4) not null,
  `descuento` int(4) NOT NULL,
  `empleado_imparte` varchar(9) NOT NULL
);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `dni_alum` varchar(9) NOT NULL,
  `nombre` varchar(15) NULL DEFAULT '',
  `apellidos` varchar(40) NULL DEFAULT '',
  `fecha_nac` date NULL DEFAULT '0000-00-00',
  `profesion` varchar(20) NULL DEFAULT '',
  `direccion_postal` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(50) DEFAULT '',
  `comentarios` text NULL,
  `motivo_baja` text NULL,
  `clases_pendientes` varchar(50) NULL DEFAULT ''
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_tiene_lesion`
--

CREATE TABLE `alumno_tiene_lesion` (
  `dni_alum` varchar(9) NOT NULL,
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
  `dni_alum` varchar(9) NOT NULL,
  `dni` varchar(9) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `espacio` (
  `id_espacio` int(4) NOT NULL,
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
  `dni_alum` varchar(9) NOT NULL,
  `dni` varchar(9) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
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
  `dni` varchar(9) NOT NULL,
  `id_lesion` int(4) NOT NULL
) ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id_evento` int(4) NOT NULL,
  `hora_inicio` time NOT NULL DEFAULT '00:00:00',
  `hora_fin` time NOT NULL DEFAULT '00:00:00',
  `fecha_evento` date NOT NULL DEFAULT '0000-00-00',
  `aforo` int(4) NOT NULL,
  `id_espacio` int(4) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `dni_alum` varchar(9) NOT NULL
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
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `cantidad` smallint(6) not null,
  `metodo_pago` varchar(15) NOT NULL DEFAULT '',
  `descuento` int(4) NOT NULL,
  `id_inscripcion` int(4) NULL,
  `id_servicio` int(4) NULL,
  `id_reserva` int(4) NULL
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
  `dni_alum` varchar(9) NULL,
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
  `id_perfil` int(4) NOT NULL
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
  `dni` VARCHAR(9) NULL,
  `dni_alum` VARCHAR(9) NULL,
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
  `dni_alum` varchar(9) NOT NULL
);






--
-- Índices para tablas volcadas
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
  ADD PRIMARY KEY (`dni_alum`);

--
-- Indices de la tabla `alumno_tiene_lesion`
--
ALTER TABLE `alumno_tiene_lesion`
  ADD PRIMARY KEY (`id_lesion`,`dni_alum`),
  ADD KEY `id_lesion` (`id_lesion`),
  ADD KEY `dni_alum` (`dni_alum`);


--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `dni_alum` (`dni_alum`),
  ADD KEY `dni` (`dni`);

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
  ADD KEY `dni` (`dni`),
  ADD KEY `dni_alum` (`dni_alum`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `cod_usuario` (`cod_usuario`);


--
-- Indices de la tabla `empleado_tiene_lesion`
--
ALTER TABLE `empleado_tiene_lesion`
  ADD PRIMARY KEY (`id_lesion`,`dni`),
  ADD KEY `id_lesion` (`id_lesion`),
  ADD KEY `dni` (`dni`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `dni` (`dni`),
  ADD KEY `dni_alum` (`dni_alum`),
  ADD KEY `id_espacio` (`id_espacio`);

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
  ADD KEY `descuento` (`descuento`),
  ADD KEY `id_reserva` (`id_reserva`),
  ADD KEY `id_inscripcion` (`id_inscripcion`),
  ADD KEY `id_servicio` (`id_servicio`);

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
  ADD KEY `dni_alum` (`dni_alum`);


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
  ADD KEY `dni_alum`(`dni_alum`), 
  ADD KEY `dni`(`dni`), 
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
 ADD PRIMARY KEY (`dni_alum`,`id_notificacion`), 
 ADD KEY `dni_alum` (`dni_alum`), 
 ADD KEY `id_notificacion` (`id_notificacion`);



--
-- AUTO_INCREMENT de las tablas volcadas
--

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
  ADD CONSTRAINT `actividad_ibfk_3` FOREIGN KEY (`empleado_imparte`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_4` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id_espacio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumno_tiene_lesion`
--
ALTER TABLE `alumno_tiene_lesion`
  ADD CONSTRAINT `alumno_tiene_lesion_ibfk_1` FOREIGN KEY (`id_lesion`) REFERENCES `lesion` (`id_lesion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_tiene_lesion_ibfk_2` FOREIGN KEY (`dni_alum`) REFERENCES `alumno` (`dni_alum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`dni_alum`) REFERENCES `alumno` (`dni_alum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`dni_alum`) REFERENCES `alumno` (`dni_alum`) ON DELETE CASCADE ON UPDATE CASCADE;


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
  ADD CONSTRAINT `empleado_tiene_lesion_ibfk_2` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`dni_alum`) REFERENCES `alumno` (`dni_alum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evento_ibfk_3` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id_espacio`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `permisos_perfil_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `permisos_perfil_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`);

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
  ADD CONSTRAINT `reserva_ibfk_5` FOREIGN KEY (`dni_alum`) REFERENCES `alumno` (`dni_alum`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE CASCADE ON UPDATE CASCADE;


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
  ADD CONSTRAINT `log_acceso_lesion_ibfk_2` FOREIGN KEY (`dni_alum`) REFERENCES `alumno` (`dni_alum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_acceso_lesion_ibfk_3` FOREIGN KEY (`dni`) REFERENCES `empleado` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
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
ADD CONSTRAINT `fk_alumnos_recibe_notificacione_alumno1` FOREIGN KEY (`dni_alum`) REFERENCES `alumno` (`dni_alum`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_alumnos_recibe_notificacion_notificacion1` FOREIGN KEY (`id_notificacion`) REFERENCES `notificacion` (`id_notificacion`) ON DELETE CASCADE ON UPDATE CASCADE;




--
-- Volcado de datos para la tabla `controlador`
--

INSERT INTO `controlador`(`id_controlador`,`nombre`) VALUES
(1, 'ACTION'),
(2, 'CONTROLLER'),
(3, 'PROFILE'),
(4, 'USER');

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
(4 ,5);



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
(3, 'adri', '19606a576b4e1a6f376b72f36e89524f', 2),
(4, 'qegbve', '510c43ca1b53ea91f4e69010baba00e6', 1),
(5, 'sdfagd', '461fdc9677d4e04afb9f072a3cb94d5d', 2),
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
(1, 20);







/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

