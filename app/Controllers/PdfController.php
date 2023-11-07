<?php

namespace App\Controllers;

use FPDF;

class PdfController extends BaseController
{
    protected $pdf;

    public function __construct()
    {
        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
    }

    public function index()
    {
        $this->pdf->Cell(40, 10, 'Hello, FPDF in CodeIgniter 4');
        $this->pdf->Output();
    }
}
