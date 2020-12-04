<?php
require_once dirname(dirname(__DIR__)) . '/asset/lib/fpdf.php';

class PDF extends FPDF
{

    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
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
        $w = array(40, 35, 45);
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


    function Header()
    {
        global $titre;

        // Arial gras 15
        $this->SetFont('Arial', 'B', 15);
        // Calcul de la largeur du titre et positionnement
        $w = $this->GetStringWidth($titre) + 6;
        $this->SetX((210 - $w) / 2);
        // Couleurs du cadre, du fond et du texte
        $this->SetDrawColor(0, 80, 180);
        $this->SetFillColor(230, 230, 0);
        $this->SetTextColor(220, 50, 50);
        // Epaisseur du cadre (1 mm)
        $this->SetLineWidth(1);
        // Titre
        $this->Cell($w, 9, $titre, 1, 1, 'C', true);
        // Saut de ligne
        $this->Ln(10);
    }

    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Arial italique 8
        $this->SetFont('Arial', 'I', 8);
        // Couleur du texte en gris
        $this->SetTextColor(128);
        // Numéro de page
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function CorpsChapitre($txt)
    {
        // Times 12
        $this->SetFont('Times', '', 12);
        // Sortie du texte justifié
        $this->MultiCell(0, 5, $txt);
        // Saut de ligne
        $this->Ln();
        // Mention en italique
        $this->SetFont('', 'I');
    }

    function EcrireContenu($contenu)
    {
        $this->AddPage();
        $this->CorpsChapitre($contenu);
    }
}
// pour lister reccete
//$pdf = new PDF();
//$titre = 'Vingt mille lieues sous les mers';
//$pdf->SetTitle($titre);
//$pdf->SetAuthor('Jules Verne');
//$pdf->AjouterChapitre(1, 'UN ÉCUEIL FUYANT', '20k_c1.txt');
//$pdf->Output();

// $data = [0=>[0=>'marseille',1=>25,2=>'lyon']];
// $pdf = new PDF();
// // Titres des colonnes
// $header = array('Ingredient', 'Quantité','Mesure');
// // Chargement des données
// $pdf->SetFont('Arial','',14);
// $pdf->AddPage();
// $pdf->FancyTable($header,$data);
// $pdf->Output();
