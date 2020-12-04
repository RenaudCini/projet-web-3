<?php

require_once '../template/bdd.php';

if (isset($_POST['typeRequete'], $_POST['idRecette'], $_POST['idUtilisateur'])) {
    $typeRequete = $_POST['typeRequete'];
    $idRecette = intval($_POST['idRecette']);
    $idUtilisateur = intval($_POST['idUtilisateur']);

    if ($typeRequete && $idRecette && $idUtilisateur) {

        $bdd = new BDD;

        if ($typeRequete == 'ajout') {
            // On regarde d'abord si l'utilisateur a déjà la recette en favori inactif :
            if ($bdd->selectUneDonne(
                "SELECT * FROM favoris WHERE id_recettes = :id_recettes AND id_utilisateurs = :id_utilisateurs",
                [
                    'id_recettes' => $idRecette,
                    'id_utilisateurs' => $idUtilisateur
                ]
            )) {
                if ($bdd->updateDonne(
                    'UPDATE favoris SET bool = 1 WHERE id_recettes = :id_recettes AND id_utilisateurs = :id_utilisateurs',
                    [
                        'id_recettes' => $idRecette,
                        'id_utilisateurs' => $idUtilisateur
                    ]
                )) {
                    echo json_encode('ok');
                }
            } else {
                if ($bdd->insertDonne(
                    'favoris',
                    'id_recettes, id_utilisateurs, bool',
                    ':id_recettes, :id_utilisateurs, 1',
                    [
                        'id_recettes' => $idRecette,
                        'id_utilisateurs' => $idUtilisateur
                    ]
                )) {
                    echo json_encode('ok');
                }
            }
        } else if ($typeRequete == 'retrait') {
            if ($bdd->updateDonne(
                'UPDATE favoris SET bool = 0 WHERE id_recettes = :id_recettes AND id_utilisateurs = :id_utilisateurs',
                [
                    'id_recettes' => $idRecette,
                    'id_utilisateurs' => $idUtilisateur
                ]
            )) {
                echo json_encode('ok');
            }
        }
    }
}
