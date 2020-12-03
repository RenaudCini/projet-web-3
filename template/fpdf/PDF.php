<?php
require('../asset/lib/fpdf.php');

class PDF extends FPDF
{

    public function __construct( $orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
    }


// Tableau simple
    public function BasicTable($header, $data)
    {
        // En-tête
        foreach ($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln();
        // Données
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }

// Tableau amélioré
    public function ImprovedTable($header, $data)
    {
        // Largeurs des colonnes
        $w = array(40, 35, 45, 40);
        // En-tête
        for ($i = 0, $iMax = count($header); $i < $iMax; $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();
        // Données
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR');
            $this->Cell($w[1], 6, $row[1], 'LR');
            $this->Cell($w[2], 6, number_format($row[2], 0, ',', ' '), 'LR', 0, 'R');
            $this->Cell($w[3], 6, number_format($row[3], 0, ',', ' '), 'LR', 0, 'R');
            $this->Ln();
        }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T');
    }

// Tableau coloré
    public function FancyTable($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // En-tête
        $w = array(40, 35, 45, 40);
        for ($i = 0, $iMax = count($header); $i < $iMax; $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Données
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, number_format($row[1], 0, ',', ' '), 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

$data = [0=>[0=>'marseille',1=>25,2=>'lyon']];
$pdf = new PDF();
// Titres des colonnes
$header = array('Ingredient', 'Quantité','Mesure');
// Chargement des données
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();

