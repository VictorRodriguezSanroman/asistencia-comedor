-- Creación de tablas
CREATE TABLE IF NOT EXISTS `ALUMNOS`(
    `DNI` VARCHAR(9) NOT NULL PRIMARY KEY,
    `NOMBRE` VARCHAR(20) NOT NULL,
    `CLAVE_CURSO` VARCHAR(4) NOT NULL,
    `CUENTA_CORRIENTE` INT(20),
    `MESA_ASIGNADA` INT(11)
);

CREATE TABLE `ASISTENCIA`(
    `DNI` VARCHAR(9) NOT NULL,
    `FECHA` VARCHAR(10) NOT NULL,
    `ASISTENCIA` ENUM('SI', 'NO'),
    `CLAVE_CURSO` VARCHAR(4) NOT NULL,
    FOREIGN KEY (`DNI`) REFERENCES `ALUMNOS`(`DNI`) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Queries
select a.dni DNI, a.nombre NOMBRE, sum(case when asistencia='SI' THEN 1 ELSE 0 END) AS SI, 
				   sum(case when asistencia='NO' then 1 else 0 end) as NO, 
				   MESA_ASIGNADA
from alumnos a join asistencia_comedor c 
where (a.dni = c.dni) and fecha >= '2022-02-13' and fecha <= '2022-02-17' 
group by a.dni;



select a.dni, a.nombre, sum(case when asistencia='SI' THEN 1 ELSE 0 END) AS SI, 
			sum(case when asistencia='NO' then 1 else 0 end) as NO 
from alumnos a join asistencia_comedor c 
where (a.dni = c.dni) and fecha >= '2022-02-13' and fecha <= '2022-02-17' 
group by a.dni;