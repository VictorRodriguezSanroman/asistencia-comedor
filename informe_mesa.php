<?php
    include_once 'header.php';
    include_once 'nav.php'; 
?>
<div class="col-12 p-3">
    <h2 class="titulosPagina">Busqueda alumnos por mesa</h2>
</div>
<div>
    <form action="informe_mesa.php" class="form-inline mb-2 border p-4 text-center" style="width:50%; margin: 0 auto;" METHOD="post">
        <div>
            <div>
                <h3>Selecciona la mesa: </h3>
                <div>
                    <input type="radio" id="mesa" name="mesa" value="1">
                    <label>Mesa 1</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="mesa" name="mesa" value="2">
                    <label>Mesa 2</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="mesa" name="mesa" value="3">
                    <label>Mesa 3</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="mesa" name="mesa" value="4">
                    <label>Mesa 4</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="mesa" name="mesa" value="5">
                    <label>Mesa 5</label>
                    <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <input type="radio" id="mesa" name="mesa" value="6">
                    <label>Mesa 6</label>     
                </div>
            <div class="pt-2">   
                <!-- Botón de busqueda de fechas -->
                <button class="btn btn-primary" name="buscar">Buscar</button>
            </div>
            
        </div>
    </form>
</div>
    <?php
        
        if(isset($_POST['buscar'])){

 
            if(isset($_POST['mesa'])){
                $mesa = $_POST['mesa'];
            }else{
                $mesa = NULL;
            }


            if($mesa == NULL){
                echo " ";
            }else{
                echo "<h4 class='titulosPagina'>Alumnos sentados en la mesa: " . $mesa . "</h4>";
            }
           
            
            //Sentencia SQL y almacenar en $resultado su ejecución
            $sentencia = "SELECT DNI, NOMBRE, CLAVE_CURSO
                            FROM ALUMNOS 
                            WHERE MESA_ASIGNADA = '$mesa'";
            $resultado = mysqli_query(conexionBBDD(),$sentencia);

            if(mysqli_query(conexionBBDD(),$sentencia)){
    ?>  
            <div class="col-lg-8 p-3 text-center" style="margin: 0 auto">
            <table class="table table-striped">
                <tr>
                    <?php
                        //Cabecera de la tabla de datos
                        if($mesa == NULL){
                            echo '<div class="alert alert-danger" role="alert">
                            Selecciona una mesa.
                            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        }else{
                            $cabecera = array("DNI", "NOMBRE","CURSO");
                            foreach($cabecera as $dato){
                                echo "<td class='fw-bold'>" . $dato . "</td>";
                            }
                        }
                        
                    ?>
                </tr>
    <?php
            while ($registro = mysqli_fetch_row($resultado)){
                echo "<tr>";
                //Muestra cada uno de los valores de los campos de registro
                foreach ($registro as $valor){
                    echo "<td class='campo'>" . $valor . "</td>";
                }
                echo "</tr>";
            }
    ?>
            </table>
            </div>
    <?php
            }else{
                echo "Error: " . $sentencia . "<br>" . mysqli_error(conexionBBDD());
            }
            mysqli_free_result($resultado);
            mysqli_close(conexionBBDD());

        }

    ?>

<?php
    include 'footer.php';
?>