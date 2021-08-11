<?php

require_once '../vendor/autoload.php';

$fpdf = new Fpdf\Fpdf();
$fpdf->AddPage();
$fpdf->SetFont('Arial', 'B', 16);
$fpdf->Cell(0, 20, 'Hello world', 1, 0, 'C');

$fpdf->Output('F');