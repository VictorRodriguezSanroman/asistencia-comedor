<?php
    include_once 'header.php';
    include_once 'nav.php';

 if(isset($_POST['buscar'])){
    conexionBBDD();
    
    $palabraClave = explode(" ",$_POST['palabraClave']); 
    $sentencia = "SELECT * FROM ALUMNOS WHERE DNI LIKE '%" . $palabraClave[0] . "%' OR NOMBRE LIKE '%" . $palabraClave[0] . "%' OR clave_curso LIKE '%" . $palabraClave[0] . "%' OR cuenta_corriente LIKE '%" . $palabraClave[0] . "%' OR MESA_ASIGNADA LIKE '%" . $palabraClave[0] . "%' ";
    for ($i=1; $i < count($palabraClave); $i++){
        if(!empty($palabraClave[$i])){
            $sentencia .=" OR DNI LIKE '%" . $palabraClave[0] . "%'  OR NOMBRE like '%" . $palabraClave[$i] . "%' OR clave_curso LIKE '%" . $palabraClave[$i] . "%'OR cuenta_corriente LIKE '%" . $palabraClave[$i] . "%' OR MESA_ASIGNADA LIKE '%" . $palabraClave[$i] . "%' ";
            
            
        }
    }
    $resultado = mysqli_query(conexionBBDD(),$sentencia);
    
 }
 if(mysqli_query(conexionBBDD(),$sentencia)){
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
                
            } else {
                echo "Error: " . $sentencia . "<br>" . mysqli_error(conexionBBDD());
            }
            mysqli_free_result($resultado);
            mysqli_close(conexionBBDD());   
         
            include_once 'footer.php';
    ?>
