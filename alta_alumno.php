<?php
    include_once 'header.php';
    include_once 'nav.php';
?>
    <h2 class="titulosPagina">Alta alumno</h2>
    <div class="border border-primary rounded col-lg-4 p-3" style="margin: 0 auto">
        <form method="post">
            <div class="form-group">
                <label for="dni" class="form-control-label">DNI</label>
                <input type="text" class="form-control" name="dni" id="dni" minlength="9" maxlength="9">
            </div>
            <div class="form-group">
                <label for="nombre" class="form-control-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="30">
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
                <input type="text" class="form-control" name="cuenta" id="cuenta" maxlength="23">
            </div>
            <div class="form-group"> 
                <label for="mesa" class="form-control-label">Mesa asignada</label>
                <div class="text-center">
                    <input type="radio" id="mesa" name="mesa" value="1">
                    <label>Mesa 1</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="mesa" name="mesa" value="2">
                    <label>Mesa 2</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="mesa" name="mesa" value="3">
                    <label>Mesa 3</label><hr>
                    <input type="radio" id="mesa" name="mesa" value="4">
                    <label>Mesa 4</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="mesa" name="mesa" value="5">
                    <label>Mesa 5</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="mesa" name="mesa" value="6">
                    <label>Mesa 6</label>     
                </div>
            </div>  
            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                <br>
                <input type="submit" class="btn btn-primary" id="alta" value="ALTA" name="alta">
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