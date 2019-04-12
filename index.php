<?php
require('fpdf/fpdf.php');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('rabbit.png',30,20,33);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(140);
    // Título
    $this->Cell(20,12,'M4M INTERACTIVIDAD S.A.S',0,0,'C');
    $this->Ln(10);
    $this->cell(320,1, 'NIT. 830141002-0', 0, 0, 'C' ,0 );
    $this->Ln(5);
    $this->cell(310,1, utf8_decode('I.V.A RÉGIMEN COMÚN'), 0, 0, 'C' ,0 );
    $this->Ln(3);
    $this->cell(312,4, utf8_decode('No gran contribuyente'), 0, 0, 'C' ,0 );
    $this->Ln(4);
    $this->cell(318,5, utf8_decode('No autorretenedor'), 0, 0, 'C' ,0 );
    $this->Ln(5);
    $this->cell(311,5, utf8_decode('No retenedor de I.V.A'), 0, 0, 'C' ,0 );
    $this->Ln(4);
    $this->cell(300,5, utf8_decode('Actividad ICA Principal 9601'), 0, 0, 'C' ,0 );
    $this->Ln(5);
    $this->cell(263,5, utf8_decode('Formulario Dian 18762012345098 de 2019 / 01 / 17'), 0, 0, 'C' ,0 );
    $this->Ln(5);
    $this->cell(247,5, utf8_decode('Numeracion habilitada desde el N° CR 0001 hasta el CR 5000'), 0, 0, 'C' ,0 );
    $this->Ln(5);
    $this->cell(318,5, utf8_decode('Vigencia 18 meses'), 0, 1, 'C' ,0 );
    
    // Salto de línea
    $this->Ln(40);

    $this->cell(20, 10, 'id', 1, 0, 'C' , 0);
    $this->cell(50, 10, 'nombre', 1, 0, 'C' , 0);
    $this->cell(50, 10, 'apellido', 1, 0, 'C' , 0);
    $this->cell(50, 10, 'cedula', 1, 1, 'C' , 0);
    

    
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode ('Page ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'conexiondb.php';
$consulta = "SELECT * FROM news_facturas";
$resultado = mysqli_query($conexion,$consulta);

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

while($row =$resultado->fetch_assoc()){
    $pdf->cell(20, 10, $row ['id'], 1, 0, 'C' , 0);
    $pdf->cell(50, 10, $row ['nombre'], 1, 0, 'C' , 0);
    $pdf->cell(50, 10, $row ['apellido'], 1, 0, 'C' , 0);
    $pdf->cell(50, 10, $row ['cedula'], 1, 1, 'C' , 0);
}


$pdf->Output();
?>