<?php

namespace App\Libraries;

use FPDF;

class CustomFPDF extends FPDF
{
    public function getStringHeight($width, $text)
    {
        $this->SetFont($this->FontFamily, $this->FontStyle, $this->FontSizePt);
        $lines = $this->MultiCell($width, 0, $text);
        $lineHeight = $this->FontSize; // Height of each line (assuming no change in font size)

        return $lineHeight * count($lines); // Total height of the text
    }
}
