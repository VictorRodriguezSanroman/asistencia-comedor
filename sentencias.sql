-- Queries
SELECT a.dni DNI, a.nombre NOMBRE, SUM(CASE WHEN ASISTENCIA='SI' THEN 1 ELSE 0 END) AS SI, 
				                   SUM(CASE WHEN ASISTENCIA='NO' THEN 1 ELSE 0 END) AS NO, 
	   MESA_ASIGNADA
FROM alumnos a JOIN asistencia c 
WHERE (a.dni = c.dni) AND fecha >= '2022-02-13' AND fecha <= '2022-02-21' 
GROUP BY a.dni;



select a.dni, a.nombre, sum(case when asistencia='SI' THEN 1 ELSE 0 END) AS SI, 
			sum(case when asistencia='NO' then 1 else 0 end) as NO 
from alumnos a join asistencia c 
where (a.dni = c.dni) and fecha >= '2022-02-13' and fecha <= '2022-02-17' 
group by a.dni;