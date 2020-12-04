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

function recupererRecette($idRecette)
{
    $bdd = new BDD;
    return $bdd->selectUneDonne("SELECT * FROM recettes WHERE id = :id", ['id' => $idRecette]);
}

function recupererEtapes($idRecette)
{
    $bdd = new BDD;
    return $bdd->selectTouteDonne("SELECT no_etape, contenu FROM etapes WHERE id_recettes = :id_recettes", '', 'ORDER BY no_etape', ['id_recettes' => $idRecette]);
}

function recupererIngredients($idRecette)
{
    $bdd = new BDD;
    return $bdd->selectTouteDonne(
        "SELECT i.nom as ingredient, c.quantite, m.nom as mesure
        FROM compositions AS c
        INNER JOIN ingredients AS i ON c.id_ingredients = i.id
        INNER JOIN mesures AS m ON c.id_mesures = m.id
        WHERE c.id_recettes = :id_recettes",
        '',
        'ORDER BY i.nom',
        ['id_recettes' => $idRecette]
    );
}

// Export PDF liste courses :
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

// Export PDF Recette : 
else if (isset($_POST['recette'], $_POST['idRecette'])) {

    $id = intval($_POST['idRecette']);

    // Ajout titre et temps :
    $recette = recupererRecette($id);
    $titre = utf8_decode($recette['titre']);
    $contenu = utf8_decode('Temps : ' . $recette['temps'] . " minutes \r\n\r\n");

    // Ajout ingrédients :
    $ingredients = recupererIngredients($id);
    $contenu .= utf8_decode("Ingrédients : \r\n");
    foreach ($ingredients as $ingredient) {
        $contenu .= utf8_decode("     " . $ingredient['ingredient'] . " (" . $ingredient['quantite'] . " " . $ingredient['mesure'] . ")\r\n");
    }

    // Ajout étapes :
    $etapes = recupererEtapes($id);
    $contenu .= utf8_encode("\r\nEtapes :\r\n");
    foreach ($etapes as $etape) {
        $contenu .= utf8_decode("     Etape n°" . $etape['no_etape'] . " : " . $etape['contenu'] . "\r\n");
    }

    // pour lister reccete
    $pdf = new PDF();
    $pdf->SetTitle($titre);
    $pdf->EcrireContenu($contenu);
    $pdf->Output();
}
