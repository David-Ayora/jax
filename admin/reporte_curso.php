<?php
require('./fpdf/fpdf.php');

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
require('./conexion.php');
$pdf = new PDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(-115, 10, utf8_decode('REPORTE GENERAL'), 0, 0, 'C');


$pdf->SetXY(10, 50);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(33, 10, utf8_decode('Emision del reporte:'), 0, 0, 'L');
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain', 'Spanish');
$fecha_actual = strftime('%A, %d de %B de %Y', time());
$pdf->Cell(50, 10, ucfirst($fecha_actual), 0, 1, 'L');

$pdf->SetXY(15, 80);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(180, 10, 'Informe General de Estudiantes en la Unidad Educativa "Principe de paz"', 1, 0, 'C');

$pdf->SetXY(15, 90);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(140, 10, "Grado estudiantil ", 1, 0, 'L');
$pdf->Cell(40, 10, "Cantidad de estudiantes", 1, 1, 'L');
$grados_estudiantiles = array("Primero", "Segundo", "Tercero", "Cuarto", "Quinto", "Sexto", "Septimo", "Octavo", "Noveno", "Decimo", "Primero BGU", "Segundo BGU", "Tercero BGU");


for ($i = 0; $i < count($grados_estudiantiles); $i++) {
    $pdf->SetX(15);
    $pdf->Cell(140, 10, $grados_estudiantiles[$i], 1, 0, 'L');
    $sentencia = "SELECT count(grado_estudiantil) as '" . $grados_estudiantiles[$i] . "' FROM student_info WHERE grado_estudiantil = '" . $grados_estudiantiles[$i] . "'";
    $query_report = mysqli_query($conexion, $sentencia);
    $valor_recorrido = mysqli_fetch_assoc($query_report);
    $nombreColumna = mysqli_fetch_field_direct($query_report, 0)->name;
    if ($nombreColumna == $grados_estudiantiles[$i]) {
        $valor = $valor_recorrido[$grados_estudiantiles[$i]];
    } else {
        $valor = 0;
    }

    $pdf->Cell(40, 10, $valor, 1, 1, 'C');
}
$pdf->Output('Reporte General '.$fecha_actual, 'I');
