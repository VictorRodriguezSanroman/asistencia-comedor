<?php
    include_once 'header.php';
    include_once 'nav.php';
    include_once 'funciones.php';  
?>
<div class="col-12 p-3">
    <h2 class="titulosPagina">Informes de asistencia</h2>
</div>

<div>
    <form action="informes.php" class="form-inline mb-2" METHOD="post">
        <div class="row">
            <div class="col-lg-2 m-1">
                    <!-- Aquí introducimos la fecha de inicio -->
                <label for="inicio" class="labelFechas">Inicio:</label>
                <input type="date" id="inicio" name="inicio" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div class="col-lg-2 m-1">
                <!-- Aquí introducimos la fecha final del periodo que queremos buscar -->
                <label for="final" class="labelFechas">Final:</label>
                <input type="date" id="final" name="final" value="<?php echo date("Y-m-d"); ?>">
            </div>   
        </div>
        <div clas="row">
                <div class="col-lg-4 m-2 ">
                    <!-- Botón de busqueda de fechas -->
                    <button class="col-lg-4 btn btn-primary" name="buscar">Buscar</button>
                </div>
        </div>
    </form>
</div>
    <?php
        if(isset($_POST['buscar'])){
            //Guerdamos en variables las fechas
            $fechaInicio = $_POST['inicio'];
            $fechaInicioSeparada = explode('-',$fechaInicio);
            $diaInicio = $fechaInicioSeparada[2];
            $mesInicio = $fechaInicioSeparada[1];
            $añoInicio = $fechaInicioSeparada[0];
            $fechaFinal = $_POST['final'];
            $fechaFinalSeparada = explode('-',$fechaFinal);
            $diaFinal = $fechaFinalSeparada[2];
            $mesFinal = $fechaFinalSeparada[1];
            $añoFinal = $fechaFinalSeparada[0];

            //Sentencia SQL y almacenar en $resultado su ejecución
            $sentencia = "SELECT a.dni, a.nombre, sum(CASE WHEN ASISTENCIA='SI' THEN 1 ELSE 0 END), 
                                                  sum(CASE WHEN ASISTENCIA='NO' THEN 1 ELSE 0 END), 
                                                  a.clave_curso,
                                                  MESA_ASIGNADA
                            FROM alumnos a JOIN asistencia c 
                            WHERE (a.dni = c.dni) and fecha >= '$fechaInicio' and fecha <= '$fechaFinal' 
                            group by a.dni
                            order by a.clave_curso;";
            $resultado = mysqli_query(conexionBBDD(),$sentencia);

            if(mysqli_query(conexionBBDD(),$sentencia)){
    ?>  
            <div class="col-12 p-3">
                <h4 class="text-center">Periodo del <?php echo $diaInicio . '/' . $mesInicio . '/' . $añoInicio; ?> al <?php echo $diaFinal. '/' . $mesFinal . '/' . $añoFinal; ?></h4>
            </div>
        <div class="col-lg-8 p-3 text-center" style="margin: 0 auto">
            <table class="table table-striped m-4 col-auto">
                <tr>
                    <?php
                        //Cabecera de la tabla de datos
                        $cabecera = array("DNI", "NOMBRE","ASISTENCIA","AUSENCIA","CURSO","MESA");
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