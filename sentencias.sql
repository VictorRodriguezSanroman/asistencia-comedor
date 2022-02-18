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