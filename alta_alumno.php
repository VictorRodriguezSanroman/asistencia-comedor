<?php
    include_once 'header.php';
    include_once 'nav.php';
    include 'funciones.php';
?>
    <form method="post">
        <div>
            <label>DNI</label>
            <input type="text" name="dni" id="dni">
        </div>
        <div>
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div>
            <label>Curso</label>
            <select name="curso" id="curso">
                <option value="3INF">Ciclo 3 Infantil</option>
                <option value="4INF">Ciclo 4 Infantil</option>
                <option value="5INF">Ciclo 5 Infantil</option>
            </select>
        </div>
        <div>
            <label>Cuenta Corriente</label>
            <input type="number" name="cuenta" id="cuenta">
        </div>
        <div>
            <label>Mesa asignada</label>
            <input type="number" name="mesa" id="mesa">
        </div>  
        <div>
            <input type="submit" value="ALTA" name="alta">
        </div>
    </form>
    <?php
    if(isset($_POST['alta'])){
        altaAlumnos();
    }
    ?>

    <div>
        <a href="index.php"><button id="volver">Volver</button></a>
    </div>
    </main><!-- //OJO -->
</body>
</html>