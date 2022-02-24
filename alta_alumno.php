<?php
    include_once 'header.php';
    include_once 'nav.php';
?>
    <h2 class="titulosPagina">Alta alumno</h2>
    <div class="border border-primary rounded col-lg-4 p-3" style="margin: 0 auto">
        <form method="post">
            <div class="form-group">
                <label for="dni" class="form-control-label">DNI</label>
                <input type="text" class="form-control" name="dni" id="dni">
            </div>
            <div class="form-group">
                <label for="nombre" class="form-control-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre">
            </div>
            <div class="form-group">
                <label for="curso" class="form-control-label">Curso</label>
                <select name="curso" class="form-select" id="curso">
                    <option selected>Seleccione un curso</option>
                    <option value="3INF">Ciclo 3 Infantil - 3INF</option>
                    <option value="4INF">Ciclo 4 Infantil - 4INF</option>
                    <option value="5INF">Ciclo 5 Infantil - 5INF</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cuenta" class="form-control-label">Cuenta Corriente</label>
                <input type="number" class="form-control" name="cuenta" id="cuenta">
            </div>
            <div class="form-group"> 
                <label for="mesa" class="form-control-label">Mesa asignada</label>
                <input type="number" class="form-control" name="mesa" id="mesa">
            </div>  
            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                <br>
                <input type="submit" class="btn btn-primary" value="ALTA" name="alta">
            </div>
        </form>
    </div>
    

    <?php
    if(isset($_POST['alta'])){
        altaAlumnos();
    }
    ?>


<?php
    include 'footer.php';
?>