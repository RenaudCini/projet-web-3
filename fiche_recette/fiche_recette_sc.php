<?php

require_once '../template/bdd.php';

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

function recupererCommentaires($idRecette)
{
    $bdd = new BDD;
    return $bdd->selectTouteDonne(
        "SELECT  u.pseudo, c.note, c.contenu, c.date
        FROM commentaires AS c 
        INNER JOIN utilisateurs AS u ON c.id_utilisateurs = u.id
        WHERE id_recettes = :id_recettes",
        '',
        'ORDER BY date DESC',
        ['id_recettes' => $idRecette]
    );
}

function creerIcones($valeur, $typeIcones)
{
    $nbIconesRemplies = intval($valeur);
    $nbIconesVides = 5 - $nbIconesRemplies;

    for ($i = 0; $i < $nbIconesRemplies; $i++) {
        echo "<i class='fas fa-$typeIcones fa-xs'></i> ";
    }
    for ($i = 0; $i < $nbIconesVides; $i++) {
        echo "<i class='far fa-$typeIcones fa-xs'></i> ";
    }
}

function checkSiUtilisateurAListe($idRecette, $idUtilisateur)
{
    $bdd = new BDD;
    return $bdd->selectUneDonne(
        "SELECT * FROM listes WHERE id_recettes = :id_recettes AND id_utilisateurs = :id_utilisateurs",
        [
            'id_recettes' => $idRecette,
            'id_utilisateurs' => $idUtilisateur
        ]
    );
}

function favoriUtilisateur($idRecette, $idUtilisateur)
{
    $bdd = new BDD;
    return $bdd->selectUneDonne(
        "SELECT * FROM favoris WHERE id_recettes = :id_recettes AND id_utilisateurs = :id_utilisateurs AND bool = 1",
        [
            'id_recettes' => $idRecette,
            'id_utilisateurs' => $idUtilisateur
        ]
    );
}
