<?php
    /************************************************************************************************
     ********************FUNCIONES NECESARIAS PARA EL FUNCIONAMIENTO DE LA APLICACIÓN ***************
     ************************************************************************************************/
    // Función para logearse en la app
    function login($usuario, $pass){
        conexionBBDD();
        $sentenciaLogeo = "SELECT * FROM `LOGIN` WHERE USUARIO = '$usuario' AND `PASSWORD` = '$pass'";
        $resultado = mysqli_query(conexionBBDD(),$sentenciaLogeo);
        while ($registro = mysqli_fetch_row($resultado)){
            setcookie('acceso',$registro[1], 0);// Si los campos son correctos se creará la cookie (solo existirá mientras no cerremos el navegador)
            header('Location:index.php');//nos redirige una vez creada a la página principal de la intranet
        }
        if(empty($registro)){
            echo "<div class='confirmacion text-center text-danger'><strong>Error de usuario y/o contraseña</strong></div>";//Si introducimos un valor mal saldrá este mensaje
        }
    }

    //Función para salir del login borrando las cookies
    function salirLogin() {
        setcookie('acceso','salir',time()-1);
    }
    
    // Función que redirige a la pantalla de login si no hay cookies
    function redireccion(){
        //Comprobamos si la cookie existe
        if(isset($_COOKIE['acceso'])){
            $existe = $_COOKIE['acceso'];
        }else{
            $existe = NULL;
        }
        //Si la cookie está vacía nos redigirá al archivo de validación
        if(empty($existe)){
            header("Location:login.php");
        }
    }

    //Función para conectarnos a la base de datos
    function conexionBBDD(){
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $baseDatos = 'comedor';

        $conexion = mysqli_connect($host, $user, $password, $baseDatos);

        mysqli_query($conexion,"SET NAMES 'utf-8'");
        return $conexion;
    }

    // Función para dar de alta a un alumno
    function altaAlumnos(){
        //incluimos la página conexión para establecer la conexión
        conexionBBDD();

        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $curso = $_POST['curso'];
        $cuenta = $_POST['cuenta'];
        if(isset($_POST['mesa'])){
            $mesa = $_POST['mesa'];
        }else{
            $mesa = NULL;
        }
        

        //Sentencia para introducir datos
        $sentencia = "INSERT INTO ALUMNOS VALUES ('$dni','$nombre','$curso',$cuenta,$mesa)"; 
        echo (mysqli_query(conexionBBDD(),$sentencia)) ? 
        '<div class="confirmacion alert alert-success m-3 col-3" role="alert">
            Alta realizada correctamente. <a href="index.php" class="alert-link">Volver</a>.
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>' : 
        '<div class="confirmacion alert alert-danger m-3 col-3" role="alert">
            Faltan campos por rellenar.
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';   
        mysqli_close(conexionBBDD());   
    }

    // Función para borrar alumnos
    function borrarAlumnos($dni){
        conexionBBDD();
        $dni = $_GET['id'];
        $sentencia = "DELETE FROM ALUMNOS WHERE DNI = '$dni'";
        mysqli_query(conexionBBDD(),$sentencia);
        mysqli_close(conexionBBDD());
        header('Location:' . getenv('HTTP_REFERER'));//Volvemos a la página anterior
    }
    
    // Función pra editar alumnos
    function editarAlumno($dni){
        //incluimos la página conexión para establecer la conexión
        conexionBBDD();

        $dniMod = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $curso = $_POST['curso'];
        $cuenta = $_POST['cuenta'];
        if(isset($_POST['mesa'])){
            $mesa = $_POST['mesa'];
        }else{
            $mesa = NULL;
        }

        //Sentencia para modificar datos
        $sentencia = "UPDATE ALUMNOS SET DNI = '$dniMod',
                                         NOMBRE = '$nombre',
                                         CLAVE_CURSO = '$curso',
                                         CUENTA_CORRIENTE = $cuenta,
                                         MESA_ASIGNADA = $mesa
                      WHERE DNI = '$dni';"; 
        echo (mysqli_query(conexionBBDD(),$sentencia)) ? 
        '<div class="confirmacion alert alert-success m-3 col-3" role="alert">
            Datos modificados correctamente. <a href="index.php" class="alert-link">Volver</a>.
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>' : 
        '<div class="confirmacion alert alert-danger m-3 col-3" role="alert">
            Faltan campos por rellenar.
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        mysqli_close(conexionBBDD());
        
        
    }

    // Función del buscador
    function buscador(){
        //Convertimos las palabras introducidas en un array
        $palabraClave = explode(" ",$_POST['palabraClave']); 
        $sentencia = "SELECT * FROM ALUMNOS WHERE DNI LIKE '%" . $palabraClave[0] . "%' OR NOMBRE LIKE '%" . $palabraClave[0] . "%' OR clave_curso LIKE '%" . $palabraClave[0] . "%' OR cuenta_corriente LIKE '%" . $palabraClave[0] . "%' OR MESA_ASIGNADA LIKE '%" . $palabraClave[0] . "%' ";
        // Bucle para añadir el resto de palabras del array a la sentencia
        for ($i=1; $i < count($palabraClave); $i++){
            if(!empty($palabraClave[$i])){
                $sentencia .=" OR DNI LIKE '%" . $palabraClave[0] . "%'  OR NOMBRE like '%" . $palabraClave[$i] . "%' OR clave_curso LIKE '%" . $palabraClave[$i] . "%'OR cuenta_corriente LIKE '%" . $palabraClave[$i] . "%' OR MESA_ASIGNADA LIKE '%" . $palabraClave[$i] . "%' ";     
            }
        }
        return $sentencia;
    }

    // Función para pasar lista de cada curso
    function pasarLista($curso) {
        $sentencia = "SELECT dni, nombre FROM ALUMNOS WHERE CLAVE_CURSO = $curso";
        $resultado = mysqli_query(conexionBBDD(),$sentencia);

        //Muestra el número de registros del resultado de la consulta SQL
        echo "Registros: " . mysqli_num_rows($resultado) . "<br>";

        if(mysqli_query(conexionBBDD(),$sentencia)){
            ?>
                <table class="table table-striped">
                    <tr>
                        <form id="registroAsistencia" name="registroAsistencia" method="post">
                            <input type="date" name="fecha"  value="<?php echo date("Y-m-d");?>">
                        </form>
                    </tr>
                    <tr>
                    <?php
                        //Cabecera de la tabla
                        $cabecera = array("DNI","NOMBRE","ASISTENCIA","EDITAR", "BORRAR");
                        foreach($cabecera as $dato){
                            echo "<td class='fw-bold'>" . $dato . "</td>";
                        }
                    ?>
                    </tr>
            <?php
                //Se obtiene un registro del resultado de la consulta
                //SAi no hay más regsitros sale del bucle while
                while ($registro = mysqli_fetch_row($resultado)){
                    
                    echo "<tr>";
                    //Muestra cada uno de los valores de los campos de registro
                    foreach ($registro as $valor){
                        echo "<td class='campo'>" . $valor . "</td>";
                    }
                    echo "<td>";
            ?>

                    <select name="<?php echo $registro[0]?>asistencia" id="asistencia" class="form-select p-0" style="width:70px; height:30px;" form="registroAsistencia">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                    </select>
            <?php
                    echo "</td>";
                    echo "<td><a href='editar_alumno.php?id=" . $registro[0] . "&nombre=" . $registro[1] . "'>Editar</a></td>";
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
                    echo "Error: " . $sentencia . "<br>" . mysqli_error(conexionBBDD());
                }
                mysqli_free_result($resultado);
                mysqli_close(conexionBBDD());   
                 
            ?>
                <br>
                <br>
            <?php
                if(isset($_POST['botonAsistencia'])){
                    conexionBBDD();
                    $sentencia = "SELECT DNI FROM ALUMNOS WHERE CLAVE_CURSO = $curso";
                    $resultado = mysqli_query(conexionBBDD(),$sentencia);
                    $fecha = $_POST['fecha'];
                    $busquedaFecha = "SELECT FECHA FROM ASISTENCIA WHERE FECHA = '$fecha'";
                    $resultadoFecha = mysqli_query(conexionBBDD(),$busquedaFecha);
                    $registroFecha = mysqli_fetch_row($resultadoFecha); 
                
                    while ($registro = mysqli_fetch_row($resultado)){
                        //Muestra cada uno de los valores de los campos de registro
                        if(isset($registroFecha[0])){
                            //Si encontramos una coincidencia la borramos
                            foreach ($registro as $DNI){
                                $fecha = $_POST['fecha'];
                                $asistencia = $_POST[$DNI.'asistencia'];
                                $borrado = "DELETE FROM ASISTENCIA WHERE FECHA = '$fecha' AND CLAVE_CURSO = $curso";
                                mysqli_query(conexionBBDD(),$borrado);       
                            }
                                //Y volvemos a guardar los datos sustituyendo a los borrados anteriormente
                                do{
                                    foreach ($registro as $DNI){
                                        $fecha = $_POST['fecha'];
                                        $asistencia = $_POST[$DNI.'asistencia'];
                                        $sentencia = "INSERT INTO ASISTENCIA VALUES ('$DNI','$fecha','$asistencia',$curso)";
                                        mysqli_query(conexionBBDD(),$sentencia);
                                    }
                                }while($registro = mysqli_fetch_row($resultado));      
                        }else{
                            //Si no hay registros se crean de 0
                            foreach ($registro as $DNI){
                                $fecha = $_POST['fecha'];
                                $asistencia = $_POST[$DNI.'asistencia'];
                                $sentencia = "INSERT INTO ASISTENCIA VALUES ('$DNI','$fecha','$asistencia',$curso)";
                                mysqli_query(conexionBBDD(),$sentencia);
                            }   
                        }        
                    }   
                            echo '<div class="confirmacion alert alert-success m-3 col-3" role="alert">
                            Asistencia registrada.
                            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    mysqli_close(conexionBBDD());
                }
    }
?>