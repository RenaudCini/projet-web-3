<?php

require_once '../template/bdd.php';
require_once '../template/fpdf/PDF.php';

function recupererListeCourses($idUtilisateur)
{
    $bdd = new BDD;
    return $bdd->selectTouteDonne(
        "SELECT i.nom AS ingredient, sum(c.quantite) AS quantite, m.nom AS mesure
            FROM listes l
            INNER JOIN recettes r ON l.id_recettes = r.id
            INNER JOIN compositions c on r.id = c.id_recettes
            INNER JOIN ingredients i on c.id_ingredients = i.id
            INNER JOIN mesures m on c.id_mesures = m.id
            WHERE l.id_utilisateurs = :id 
            GROUP BY i.nom, m.nom",
        '',
        'ORDER BY i.nom ASC',
        ['id' => $idUtilisateur]
    );
}

// Export PDF :
if (isset($_POST['listeCourses'], $_POST['idUtilisateur'])) {
    $idUtilisateur = intval($_POST['idUtilisateur']);

    $dataListe = recupererListeCourses($idUtilisateur);

    foreach ($dataListe as $index => $line) {
        $data[$index] = array_values($line);
    }

    $pdf = new PDF();
    // Titres des colonnes
    $header = array('Ingredient', utf8_decode('Quantité'), 'Mesure');
    // Chargement des données
    $pdf->SetFont('Arial', '', 14);
    $pdf->AddPage();
    $pdf->FancyTable($header, $data);
    $pdf->Output();
}
