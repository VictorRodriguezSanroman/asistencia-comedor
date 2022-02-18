<!DOCTYPE html>
<?php
    include 'funciones.php';
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso</title>
</head>
<body>
    <form method="post" autocomplete="off">
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario">
        </div>
        <div>
            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" id="pass">
        </div>
        <div>
            <button>Validar</button>
        </div>
    </form>

    <?php
        if(count($_POST) > 0){
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];

            login($usuario, $pass);
        }
    ?>
    
</body>
</html>