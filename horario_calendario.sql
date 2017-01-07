
CREATE TABLE `sesion`(
	`fecha` date NOT NULL DEFAULT '2000/01/01',
	`hora_inicio` time NOT NULL DEFAULT '10:00:00',
  	`hora_fin` time NOT NULL DEFAULT '11:30:00',
	`id_empleado` int(4),
	`id_espacio` int(4) NOT NULL,
	`id_actividad` int(4),
	`id_evento` int(4),
	`id_sesion` int(11) NOT NULL
);



ALTER TABLE `sesion`
ADD PRIMARY KEY (`id_sesion`),
MODIFY `id_sesion` int(11) NOT NULL AUTO_INCREMENT,
ADD CONSTRAINT `sesion_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `sesion_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `sesion_ibfk_3` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `sesion_ibfk_4` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id_espacio`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `sesion_ibfk_5` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE;



CREATE TABLE `asistencia`(
	`id_sesion` int(11),
	`id_alumno` int(4),
	`asiste` tinyint(1)
);

ALTER TABLE `asistencia`
ADD PRIMARY KEY (`id_sesion`, `id_alumno`),
ADD CONSTRAINT `alumn_sesion_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `alumn_sesion_ibfk_2` FOREIGN KEY (`id_sesion`) REFERENCES `sesion` (`id_sesion`) ON DELETE CASCADE ON UPDATE CASCADE;

-- ENTÉNDASE COMO HORAS LIBRES
-- horario furrula
-- formato 'YYYY/MM/DD'
CREATE TABLE `horario`(
	`fecha_inicio` date NOT NULL DEFAULT '2000/01/01',
	`fecha_fin` date NOT NULL DEFAULT '2000/01/01',
	`id_horario` int(4) NOT NULL,
	`nombre` varchar(40) NOT NULL
);


ALTER TABLE `horario`
ADD PRIMARY KEY (`id_horario`),
MODIFY `id_horario` int(4) NOT NULL AUTO_INCREMENT;

CREATE TABLE `jornada`(
	`dia_semana` int(1) NOT NULL,
	`hora_inicio` time NOT NULL DEFAULT '09:00:00',
	`hora_fin` time NOT NULL DEFAULT '17:00:00',
	`id_jornada` int(11) NOT NULL,
	`id_horario` int(4) NOT NULL
);

ALTER TABLE `jornada`
ADD PRIMARY KEY (`id_jornada`),
ADD CONSTRAINT `jornada_ibfk_1` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CHECK (`dia_semana`>=0 AND `dia_semana`<7),
MODIFY `id_jornada` int(11) NOT NULL AUTO_INCREMENT;
