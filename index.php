<?php
    echo "<p>Bienvenido/a " . $_COOKIE['acceso'] . " <a href='borrar_cookie.php'><small>(Salir)</small></a></p>";
    include 'funciones.php';
    include_once 'header.php';
    include_once 'nav.php';

    redireccion();//comprobamos si la cookie esta o no
    conexionBBDD();//Conectamos a la base de datos
?>
    <div class="row">
        <div class="col-12 text-center p-3 mb-5">
            <h2>Curso donde quieres pasar lista</h2>
        </div> 
        
    </div>
    
    <div class="row">
        <div class="col-lg m-4 text-center">
            <a href="3inf.php"><button class="btn-primary p-5">3er Ciclo de Infantil</button></a>
        </div>
        <div class="col-lg m-4 text-center">
            <a href=""><button class="btn-primary p-5">4º Ciclo de Infantil</button></a>
        </div>
        <div class="col-lg m-4   text-center">
            <a href="5inf.php"><button class="btn-primary p-5">5º Ciclo de Infantil</button></a>
        </div>
    </div>
    

</main><!-- //OJO -->
</body>
</html>