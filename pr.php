<?php 

include('conexiondb.php');

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Descargar informe Laboral</title>
</head>

<body>
    <div class="container">

        <div class="page-header text-left">
            <h1>Exportar informe </h1>
        </div>
        <div class="inpu">
             <label>Fecha de Registro<input type="date" name="fecha" class="texto" value="" required /></label>
             <input type="submit" name="generar_reporte">
         </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>id</td>
                    <td>nombre</td>
                    <td>apellido</td>
                    <td>cedula</td>
                    <td>ciudad</td>
                    <td>Direccion</td>
                </tr>

                <?php 
                $sql="SELECT * from  news_facturas";
                $result=mysqli_query($conexion,$sql);
                
                while($mostrar=mysqli_fetch_array($result)){
                ?>

                <tr>
                    <td><?php echo $mostrar['id']?></td>
                    <td><?php echo $mostrar['nombre']?></td>
                    <td><?php echo $mostrar['apellido']?></td>
                    <td><?php echo $mostrar['cedula']?></td>
                    <td><?php echo $mostrar['direccion']?></td>
                    <td><?php echo $mostrar['ciudad']?></td>
                </tr>
                <?php 
                }
                ?>
            </thead>

        </table>





</body>

</html>