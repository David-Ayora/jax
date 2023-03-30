<?php
require('./fpdf/fpdf.php');
include('./conexion.php');
$id = base64_decode($_GET['id']);
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('images/logo_unidad_educativa.png', 15, 3, 20);
        // Arial bold 15

        $this->SetFont('Arial', 'B', 11);
        // Movernos a la derecha
        $this->Cell(25);
        // Título
        $this->Cell(145, 0, utf8_decode('UNIDAD EDUCATIVA PARTICULAR "PRÍNCIPE DE PAZ"'), 0, 0, 'C');
        // Salto de línea
        $this->Ln(11);


        $this->SetFont('Arial', 'B', 10);
        // Movernos a la derecha
        $this->Cell(25);
        // Título
        $this->Cell(145, -12, utf8_decode('La palabra de Dios en la educación integral de nuestros hijos, hace la diferencia'), 0, 0, 'C');
        // Salto de línea
        $this->Ln(10);


        $this->SetFont('Arial', 'B', 10);
        // Movernos a la derecha
        $this->Cell(45);
        // Título
        $this->Cell(105, -20, utf8_decode('DEPARTAMENTO DE CONSEJERÍA ESTUDIANTIL'), 0, 0, 'C');
        // Salto de línea
        $this->SetLineWidth(0.2);
        $this->SetFillColor(0, 255, 0);
        $this->Line(190, 25, 25, 25);

        // $this->Line(10, 50, 200, 50); // Dibuja una línea desde (10, 50) hasta (200, 50)

    }









    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, -5, utf8_decode("Dirección: Carlos V 3-176 y 1º de Mayo      Telefax: (593-7) 288-64-52 / 288-25-88 / 288-40-43"), 0, 0, 'C');


        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 5, utf8_decode("EMAIL: ccarboldevida@yahoo.com; ueprincipedepaz@yahoo.com"), 0, 0, 'C');

        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 15, utf8_decode("CUENCA-ECUADOR"), 0, 0, 'C');
    }
}




$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(-115, 10, utf8_decode('INFORME'), 0, 0, 'C');


$consulta_representante = "SELECT r_name, r_last_name FROM student_representante WHERE id_estudiante = $id";
$resultado_representante = $conexion->query($consulta_representante);
$row_r = $resultado_representante->fetch_assoc();
$representante = $row_r['r_name'] . " "  . $row_r['r_last_name'];

$pdf->SetXY(40, 50);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(25, 10, utf8_decode('PARA:'), 0, 1, 'L');


$pdf->SetXY(55, 50);
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(70, 10, utf8_decode($representante), 0, 1, 'L');



$pdf->SetXY(40, 60);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(25, 10, utf8_decode('DE: '), 0, 1, 'L');


$pdf->SetXY(49, 60);
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(115, 10, utf8_decode('Unidad Educativa Particular "Príncipe de Paz"'), 0, 1, 'L');



$pdf->SetXY(40, 70);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(25, 10, utf8_decode('ASUNTO: '), 0, 0, 'L');

$pdf->SetXY(62, 70);
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(70, 10, utf8_decode('Asignación de cupo.'), 0, 1, 'L');




$pdf->SetXY(40, 80);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(25, 10, utf8_decode('FECHA: '), 0, 0, 'L');


$pdf->SetXY(58, 80);
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(70, 10, utf8_decode('21 de marzo del 2023'), 0, 1, 'L');


$pdf->Ln();


$consulta = "SELECT * FROM student_info WHERE id = $id;";
$resultado = $conexion->query($consulta);
$cadena1 = "Luego de la entrevista y posterior análisis de la documentación de la estudiante, ";
$cadena2 = 'el Rectorado juntamente con el Departamento de Consejería Estudiantil de la Unidad Educativa Particular "Príncipe de Paz", acuerdan: otorgar el cupo solicitado por ' . $representante. ', representante legal de la postulante, para ';
$cadena3 = ', con las siguientes recomendaciones: ';
$name_pdf;
while ($row = $resultado->fetch_assoc()) {
    $matricula = $row['matricula'];
    $name_pdf = $matricula;
    $pdf->SetXY(20, 100);
    $pdf->MultiCell(175, 10, utf8_decode($cadena1 . $row['name'] . " " . $row['last_name'] . " con numero de cedula " . $row['cedula'] . " " . $cadena2 . $row['grado_estudiantil'] .  $cadena3), 0, 'L', false, 50, 50);
}

$pdf->SetXY(36, 160);
$pdf->Cell(158, 10, utf8_decode('-  Acompañamiento continúo en tareas y trabajos.'), 0, 1, 'L');
$pdf->SetXY(37, 170);
$pdf->Cell(158, 10, utf8_decode('-  Comunicación constante con la Unidad Educativa. '), 0, 1, 'L');
$pdf->SetXY(37, 180);
$pdf->Cell(158, 10, utf8_decode('-  Compromiso y participación en las actividades realizadas por la Institución'), 0, 1, 'L');
$pdf->SetXY(37, 190);
$pdf->Cell(158, 10, utf8_decode('-  Cumplimento de las obligaciones como representante legal. '), 0, 1, 'L');

$pdf->SetXY(25, 210);
$pdf->Cell(158, 10, utf8_decode('Atentamente,'), 0, 1, 'C');


$pdf->SetXY(25, 250);
$pdf->Cell(58, 10, utf8_decode('Master. Diego Rivas C.'), 0, 1, 'C');
$pdf->SetXY(25, 256);
$pdf->Cell(58, 10, utf8_decode('Rector'), 0, 1, 'C');


$pdf->SetXY(125, 250);
$pdf->Cell(58, 10, utf8_decode('Lcdo. Rafael Largo Zh.'), 0, 1, 'C');
$pdf->SetXY(125, 256);
$pdf->Cell(58, 10, utf8_decode('DECE'), 0, 1, 'C');


$pdf->Output($name_pdf, 'I');
