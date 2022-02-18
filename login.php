<?php
    include 'header.php';
?>
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

    <?php
        if(count($_POST) > 0){
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];

            login($usuario, $pass);
        }
        include 'footer.php';
    ?>
