<?php
include('inicio.php');// CONEXION A LA BD

$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];

if(isset($_POST['generar_reporte']))
{
    // NOMBRE DEL ARCHIVO Y CHARSET
    header('Content-Type:text/csv; charset=latin1');
    header('Content-Disposition: attachment; filename="Reporte_Mes_Laboral.csv"');

    // SALIDA DEL ARCHIVO
    $salida=fopen('php://output', 'w');
    // ENCABEZADOS las columnas del excel
    fputcsv($salida, array('Identificador', 'Fecha', 'Nombre', 'Apellido', 'Cliente','ingreso','egreso','Horasdias'));
    // QUERY PARA CREAR EL REPORTE
    $sumaCsv=$conexion->query("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(horasdias))) AS hours FROM actividades WHERE 
	(fecha_registro BETWEEN '$fecha1' AND '$fecha2')AND(nombre = '$nombre')AND(apellido = '$apellido')");
	
    $reporteCsv=$conexion->query("SELECT * FROM actividades WHERE ((fecha_registro BETWEEN '$fecha1' AND '$fecha2')AND
    (nombre = '$nombre')AND(apellido = '$apellido')) ORDER BY id ");
    
    while($filaR=$reporteCsv->fetch_assoc()){
        fputcsv($salida, array($filaR['id'],
								$filaR['fecha_registro'],		
                                $filaR['nombre'],
                                $filaR['apellido'],
                                $filaR['cliente'],
                                $filaR['ingreso'],
                                $filaR['egreso'],
                                $filaR['horasdias']));
									
	}
	if($fila=$sumaCsv->fetch_assoc())
        fputcsv($salida, array('', '', '', '', '','','TOTAL',
								$fila['hours']));
	
}



?>