<?php
    /************************************************************************************************
     ********************FUNCIONES NECESARIAS PARA EL FUNCIONAMIENTO DE LA APLICACIÓN ***************
     ************************************************************************************************/
    // Función para logearse en la app
    function login($usuario, $pass){
        if($usuario == 'vic' && $pass == '1234'){
            setcookie('acceso','Victor', 0);// Si los campos son correctos se creará la cookie (solo existirá mientras no cerremos el navegador)
            header('Location:index.php');//nos redirige una vez creada a la página principal de la intranet
        }else{
            echo "<div class='text-center text-danger'><strong>Error de usuario y/o contraseña</strong></div>";//Si introducimos un valor mal saldrá este mensaje
        }
    }

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
        $mesa = $_POST['mesa'];

        //Sentencia para introducir datos
        $sentencia = "INSERT INTO ALUMNOS VALUES ('$dni','$nombre','$curso',$cuenta,$mesa)"; 
        echo (mysqli_query(conexionBBDD(),$sentencia)) ? 
        '<div class="alert alert-success m-3 col-3" role="alert">
            Alta realizada correctamente. <a href="index.php" class="alert-link">Volver</a>.
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>' : 
        '<div class="alert alert-danger m-3 col-3" role="alert">
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
        header('Location:' . getenv('HTTP_REFERER'));
    }
    
    // Función pra editar alumnos
    function editarAlumno($dni){
        //incluimos la página conexión para establecer la conexión
        conexionBBDD();

        $dniMod = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $curso = $_POST['curso'];
        $cuenta = $_POST['cuenta'];
        $mesa = $_POST['mesa'];

        //Sentencia para modificar datos
        $sentencia = "UPDATE ALUMNOS SET DNI = '$dniMod',
                                         NOMBRE = '$nombre',
                                         CLAVE_CURSO = '$curso',
                                         CUENTA_CORRIENTE = $cuenta,
                                         MESA_ASIGNADA = $mesa
                      WHERE DNI = '$dni';"; 
        echo (mysqli_query(conexionBBDD(),$sentencia)) ? 
        '<div class="alert alert-success m-3 col-3" role="alert">
            Datos modificados correctamente. <a href="index.php" class="alert-link">Volver</a>.
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>' : 
        '<div class="alert alert-danger m-3 col-3" role="alert">
            Faltan campos por rellenar.
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        mysqli_close(conexionBBDD());
    }
?>