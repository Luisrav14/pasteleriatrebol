<?php

require('../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage('PORTRAIT', 'letter');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->SetFont('Arial', 'B', 12); 
    $this->Cell(0, 5, utf8_decode('Pastelería Trébol'), 0, 0, 'C');
    $this->Image('../img/trebol-icon.png', 175, 5, 25, 'png');
}

// Pie de página
function Footer()
{

    $this->SetFont('Arial','I',8);
    $this->SetY(-15);
    $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'conngraph.php';
$query = "SELECT * FROM sucursal";
$resultado = $conex->query($query);

$pdf = new PDF('P', 'mm', 'letter', true);
$pdf->AddPage('portrait', 'letter');
$pdf->SetFont('Arial','B',14);
$pdf->SetY(30);
$pdf->SetTextColor(11, 118, 73);
$pdf->Cell(0, 5, 'Reporte de Sucursales', 0, 0, 'C');
$pdf->SetDrawColor(18, 148, 93);
$pdf->SetLineWidth(0.5);
$pdf->Line(70, 38, 145, 38);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor (240, 240, 240);   
$pdf->Ln(20);
$pdf-> AliasNbPages();

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(1, 118, 73);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(47, 47, 48);

$pdf->Cell(50, 10,'Nombre', 0, 0, 'C', 1);
$pdf->Cell(150, 10, utf8_decode('Dirección'), 0, 0, 'C', 1);
$pdf->Ln();
$pdf->SetDrawColor(18, 148, 93);
$pdf->SetLineWidth(1);
$pdf->Line(15, 60, 200, 60);

$pdf->SetLineWidth(0.2);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Ln(5);

while($row = $resultado->fetch_assoc()) {
    $pdf->Cell(50, 10, utf8_decode($row['nombre']), 1, 0, 'C', 1);
    $pdf->Cell(150, 10, utf8_decode($row['direccion']), 1, 0, 'C', 1);
    $pdf->Ln();
}

$pdf->Output();