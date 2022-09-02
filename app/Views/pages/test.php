<?php
require('C:\wamp64\www\CodeIgniter4-4.0.0-rc.3\app\Views\pages\fpdf\fpdf.php');

echo("TESTE");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
?>
<p>Home page</p>