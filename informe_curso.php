<?php
    include_once 'header.php';
    include_once 'nav.php'; 
?>
<div class="col-12 p-3">
    <h2 class="titulosPagina">Busqueda alumnos por curso</h2>
</div>

<div>
    <form action="informe_curso.php" class="form-inline mb-2 border p-4 text-center" style="width:50%; margin: 0 auto;" METHOD="post">
        <div>
            <div>
                <h3>Curso a buscar: </h3>
                <div>
                    <input type="radio" id="curso" name="curso" value="3inf">
                    <label>3º de Infantil - 3INF</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="curso" name="curso" value="4inf">
                    <label>4º de Infantil - 3INF</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="curso" name="curso" value="5inf">
                    <label>5º de Infantil - 3INF</label> 

                
            </div>
            <div class="pt-2">   
                <!-- Botón de busqueda de fechas -->
                <button class="btn btn-primary" name="buscar">Buscar</button>
            </div>
            
        </div>
    </form>
</div>
    <?php
        
        if(isset($_POST['buscar'])){
            $curso = $_POST['curso'];
            echo "<h4 class='titulosPagina'>Alumnos del curso: " . strtoupper($curso) . "</h4>" . "</h4>";
            //Sentencia SQL y almacenar en $resultado su ejecución
            $sentencia = "SELECT a.DNI, a.NOMBRE, a.MESA_ASIGNADA,sum(CASE WHEN ASISTENCIA='SI' THEN 1 ELSE 0 END), 
                                                                  sum(CASE WHEN ASISTENCIA='NO' THEN 1 ELSE 0 END)
                            FROM alumnos a JOIN asistencia c 
                            WHERE (a.dni = c.dni) and A.CLAVE_CURSO = '$curso' 
                            group by a.dni";
            $resultado = mysqli_query(conexionBBDD(),$sentencia);

            if(mysqli_query(conexionBBDD(),$sentencia)){
    ?>  
            <div class="col-lg-8 p-3 text-center" style="margin: 0 auto">
            <table class="table table-striped">
                <tr>
                    <?php
                        //Cabecera de la tabla de datos
                        $cabecera = array("DNI", "NOMBRE","MESA","Nº ASISTENCIAS TOTALES", "Nº AUSENCIAS TOTALES");
                        foreach($cabecera as $dato){
                            echo "<td class='fw-bold'>" . $dato . "</td>";
                        }
                    ?>
                </tr>
    <?php
            while ($registro = mysqli_fetch_row($resultado)){
                echo "<tr>";
                //Muestra cada uno de los valores de los campos de registro
                foreach ($registro as $valor){
                    echo "<td class='campo'>" . $valor . "</td>";
                }
                echo "</tr>";
            }
    ?>
            </table>
            </div>
    <?php
            }else{
                echo "Error: " . $sentencia . "<br>" . mysqli_error(conexionBBDD());
            }
            mysqli_free_result($resultado);
            mysqli_close(conexionBBDD());

        }

    ?>

<?php
    include 'footer.php';
?>