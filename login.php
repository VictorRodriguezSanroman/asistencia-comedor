<!DOCTYPE html>
<?php
    include 'funciones.php';
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Acceso</title>
</head>
<body>
    <div class="container">
        <div class="row text-center login-page">
            <div class="col-md-12 login-form">
            <form method="post" autocomplete="off">
                <div class="row margenes">
                    <div class="col-md-12 login-form-header">
                        <p class="login-form-font-header">Dining <span>Room</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 login-form-row">
                        <input type="text" name="usuario" id="usuario" placeholder="Usuario" required>
                    </div>
                </div>
                <div class="row margenes">
                    <div class="col-md-12 login-form-row">
                        <input type="password" name="pass" id="pass" placeholder="Contraseña" required>
                    </div>
                </div>

                <div class="row margenes">
                    <div class="col-md-12 login-form-row">
                        <button class="btn btn-primary">Validar</button>
                    </div>
                </div>
                
            </form>
            </div>
        </div>
    </div>
    

    <?php
        if(count($_POST) > 0){
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];

            login($usuario, $pass);
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
</body>
</html>