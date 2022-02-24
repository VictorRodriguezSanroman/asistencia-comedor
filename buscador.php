<?php
    include_once 'header.php';
    include_once 'nav.php';

 if(isset($_POST['buscar'])){
    conexionBBDD();
    buscador();
    
    $resultado = mysqli_query(conexionBBDD(),buscador());
 }
 if(mysqli_query(conexionBBDD(),buscador())){
    ?>
        <div class="col-lg-8 p-3 text-center" style="margin: 0 auto">
            <span>Resultados encontrados: <?php echo mysqli_num_rows($resultado) ?></span>
                <table class="table table-striped m-4 col-auto">
                    
                    <tr>
                        <?php
                            //Cabecera de la tabla
                            $cabecera = array("DNI","NOMBRE","CURSO","CUENTA CORRIENTE", "MESA");
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
                echo "</tr>";
            }
    ?>
                </table>
        </div>
    <?php          
            } 
            mysqli_free_result($resultado);
            mysqli_close(conexionBBDD());   
            include_once 'footer.php';
    ?>
