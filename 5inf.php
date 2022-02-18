<?php
    include_once 'header.php';
    include_once 'nav.php';


    $sentencia = "SELECT dni, nombre FROM ALUMNOS WHERE CLAVE_CURSO = '5INF'";
    $resultado = mysqli_query($conexion,$sentencia);

     //Muestra el número de registros del resultado de la consulta SQL
     echo "Registros: " . mysqli_num_rows($resultado) . "<br>";

     if(mysqli_query($conexion,$sentencia)){
        ?>
                    <table class="tabla">
                        <tr>
                            <form id="registroAsistencia" name="registroAsistencia" method="post">
                            <input type="date" name="fecha"  value="<?php echo date("Y-m-d");?>">
                            </form>
                        </tr>
                        <tr>
                            <?php
                                //Cabecera de la tabla
                                $cabecera = array("DNI","NOMBRE");
                                foreach($cabecera as $dato){
                                    echo "<td class='cabecera'>" . $dato . "</td>";
                                }
                            ?>
                        </tr>
        <?php
                //Se obtiene un registro del resultado de la consulta
                //SAi no hay más regsitros rale del bucle while
                while ($registro = mysqli_fetch_row($resultado)){
                    
                    echo "<tr>";
                    //Muestra cada uno de los valores de los campos de registro
                    foreach ($registro as $valor){
                        echo "<td class='campo'>" . $valor . "</td>";
                    }
                    echo "<td>";
                    ?>

                    <select name="<?php echo $registro[0]?>asistencia" id="asistencia" form="registroAsistencia">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
                    <?php
                    echo "</td>";
                    echo "<td><a href='editar_alumno.php?id=" . $registro[0] . "'>Editar</a></td>";
                    echo "<td><a href='borrar_alumno.php?id=" . $registro[0] . "'>Borrar</a></td>";
                    echo "</tr>";
                }
        ?>
        <tr>
            <input type="submit" value="Guardar Asistencia" id="botonAsistencia" name="botonAsistencia" form="registroAsistencia">
        </tr>
        </table>
        <?php
                    
                } else {
                    echo "Error: " . $sentencia . "<br>" . mysqli_error($conexion);
                }
                mysqli_free_result($resultado);
                mysqli_close($conexion);   
                 
        ?>
        <br>
        <br>
        <div id="botones">
            <a href="index.php"><button id="volver">Volver</button></a>
        </div>
     

        <?php
            if(isset($_POST['botonAsistencia'])){
                conexionBBDD();
                $sentencia = "SELECT DNI FROM ALUMNOS WHERE CLAVE_CURSO = '5inf'";
                $resultado = mysqli_query($conexion,$sentencia);
                
                
                $fecha = $_POST['fecha'];
                $busquedaFecha = "SELECT FECHA FROM ASISTENCIA_COMEDOR WHERE FECHA = '$fecha'";
                $resultadoFecha = mysqli_query($conexion,$busquedaFecha);

                
                $registroFecha = mysqli_fetch_row($resultadoFecha); 
                
                
               while ($registro = mysqli_fetch_row($resultado)){
                
                    
                    //Muestra cada uno de los valores de los campos de registro
                    if(isset($registroFecha[0])){
                        foreach ($registro as $DNI){
                            $fecha = $_POST['fecha'];
                            $asistencia = $_POST[$DNI.'asistencia'];
                            $borrado = "DELETE FROM ASISTENCIA_COMEDOR WHERE FECHA = '$fecha' AND CLAVE_CURSO = '5INF'";
                            mysqli_query($conexion,$borrado);       
                        }
                       
                        do{
                            foreach ($registro as $DNI){
                                $fecha = $_POST['fecha'];
                                $asistencia = $_POST[$DNI.'asistencia'];
                                $sentencia = "INSERT INTO ASISTENCIA_COMEDOR VALUES ('$DNI','$fecha','$asistencia','5INF')";
                                mysqli_query($conexion,$sentencia);
                            }
                        }while($registro = mysqli_fetch_row($resultado));
                        
                    }else{
                        foreach ($registro as $DNI){
                            $fecha = $_POST['fecha'];
                            $asistencia = $_POST[$DNI.'asistencia'];
                            $sentencia = "INSERT INTO ASISTENCIA_COMEDOR VALUES ('$DNI','$fecha','$asistencia','5INF')";
                            mysqli_query($conexion,$sentencia);
                        }
                    
                    }
                     
                } 
              
                mysqli_close($conexion);
            }
        ?>


   
</main><!-- OJO -->
</body>
</html>