<?php
    include_once 'header.php';
    include_once 'nav.php';
    include_once 'funciones.php';  
?>
<div class="col-12 p-3">
    <h1 class="text-center">Informes de asistencia</h1>
</div>

<div>
    <form action="informes.php" class="form-inline mb-2" METHOD="post">
        <div>
            <!-- Aquí introducimos la fecha de inicio -->
            <label for="inicio">Fecha de inicio</label>
            <input type="date" id="inicio" name="inicio" value="<?php echo date("Y-m-d"); ?>">
            <!-- Aquí introducimos la fecha final del periodo que queremos buscar -->
            <label for="final">Fecha final</label>
            <input type="date" id="final" name="final" value="<?php echo date("Y-m-d"); ?>">
            
            <!-- Botón de busqueda de fechas -->
            <button class="btn btn-primary" name="buscar">Buscar</button>
        </div>
    </form>
</div>
    <?php
        if(isset($_POST['buscar'])){
            //Guerdamos en variables las fechas
            $fechaInicio = $_POST['inicio'];
            $fechaInicioSeparada = explode('-',$fechaInicio);
            $diaInicio = (int)$fechaInicioSeparada[2];
            $mesInicio = (int)$fechaInicioSeparada[1];
            $añoInicio = (int)$fechaInicioSeparada[0];
            $fechaFinal = $_POST['final'];
            $fechaFinalSeparada = explode('-',$fechaFinal);
            $diaFinal = (int)$fechaFinalSeparada[2];
            $mesFinal = (int)$fechaFinalSeparada[1];
            $añoFinal = (int)$fechaFinalSeparada[0];
            switch ($mesFinal) {
                case 1:
                    $mes = "Enero";
                    break;
                case 2:
                    $mes = "Febrero";
                    break;
                case 3:
                    $mes = "Marzo";
                    break;
                case 4:
                    $mes = "Abril";
                    break;
                case 5:
                    $mes = "Mayo";
                    break;
                case 6:
                    $mes = "Junio";
                    break;
                case 7:
                    $mes = "Julio";
                    break;
                case 8:
                    $mes = "Agosto";
                    break;
                case 9:
                    $mes = "Septiembre";
                    break;
                case 10:
                    $mes = "Octubre";
                    break;
                case 11:
                    $mes = "Noviembre";
                    break;
                case 12:
                    $mes = "Diciembre";
                    break;
            }
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
                <h4 class="text-center">Periodo del <?php echo $diaInicio; ?> al  <?php echo $diaFinal; ?> de <?php echo $mes ?> del <?php echo $añoFinal; ?></h4>
            </div>
            <table class="table table-striped">
                <tr>
                    <?php
                        //Cabecera de la tabla de datos
                        $cabecera = array("DNI", "NOMBRE","SI","NO","CURSO","MESA");
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