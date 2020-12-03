<?php

require_once '../template/bdd.php';

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

function ajouterListe($idRecette, $idUtilisateur)
{
    $bdd = new BDD;
    return $bdd->insertDonne(
        'listes',
        'id_recettes, id_utilisateurs',
        ':id_recettes, :id_utilisateurs',
        [
            'id_recettes' => $idRecette,
            'id_utilisateurs' => $idUtilisateur
        ]
    );
}

function retirerListe($idRecette, $idUtilisateur)
{
    $bdd = new BDD;
    return $bdd->supprDonnee(
        'listes',
        'id_recettes = :id_recettes AND id_utilisateurs = :id_utilisateurs',
        [
            'id_recettes' => $idRecette,
            'id_utilisateurs' => $idUtilisateur
        ]
    );
}

function supprimerTouteListe($idUtilisateur)
{
    $bdd = new BDD;
    return $bdd->supprDonnee(
        'listes',
        'id_utilisateurs = :id_utilisateurs',
        [
            'id_utilisateurs' => $idUtilisateur
        ]
    );
}

if (isset($_POST['actionRecetteListeCourses'], $_POST['idRecette'], $_POST['idUtilisateur'], $_POST['action'])) {
    $idRecette = intval($_POST['idRecette']);
    $idUtilisateur = intval($_POST['idUtilisateur']);

    $action = $_POST['action'];

    // Si ajout :
    if ($action === 'ajout') {
        // Si les id recette et utilisateur sont bien des entiers :
        if ($idRecette && $idUtilisateur) {
            $bdd = new BDD;

            // Si l'utilisateur a déjà ajouté la recette a sa liste de courses :
            if (checkSiUtilisateurAListe($idRecette, $idUtilisateur)) {
                $data = [
                    'message' => "Déjà ajouté à la liste de courses.",
                    'remplacerButton' => false
                ];
            }
            // Sinon, si l'utilisateur n'a pas encore ajouté la recette a sa liste de courses : 
            else {
                ajouterListe($idRecette, $idUtilisateur);
                $data = [
                    'message' => "La recette a bien été ajoutée à la liste de courses.",
                    'remplacerButton' => true
                ];
            }
        }
        // Si les id recette et utilisateurs ne sont pas des entiers :
        else {
            $data = [
                'message' => "Erreur lors de l'ajout à la liste de courses.",
                'remplacerButton' => false
            ];
        }
    }

    // Si retrait :
    else if ($action == 'retrait') {
        // Si les id recette et utilisateur sont bien des entiers :
        if ($idRecette && $idUtilisateur) {
            $bdd = new BDD;

            // Si l'utilisateur a déjà ajouté la recette a sa liste de courses :
            if (checkSiUtilisateurAListe($idRecette, $idUtilisateur)) {
                retirerListe($idRecette, $idUtilisateur);
                $data = [
                    'message' => "La recette a bien été retirée de la liste de courses.",
                    'remplacerButton' => true
                ];
            }
            // Sinon, si l'utilisateur n'a pas encore ajouté la recette a sa liste de courses : 
            else {
                $data = [
                    'message' => "Cette recette n'a pas été ajoutée à la liste de courses.",
                    'remplacerButton' => false
                ];
            }
        }
        // Si les id recette et utilisateurs ne sont pas des entiers :
        else {
            $data = [
                'message' => "Erreur lors du retrait de la liste de courses.",
                'remplacerButton' => false
            ];
        }
    }
    echo json_encode($data);
}
// Suppression de toute la liste de courses :
else if (isset($_POST['supprListeCourses'], $_POST['idUtilisateur'])) {
    $idUtilisateur = intval($_POST['idUtilisateur']);
    if ($idUtilisateur) {
        supprimerTouteListe($idUtilisateur);
        $data = [
            'message' => "La liste de courses a bien été supprimée.",
            'ok' => true
        ];
    } else {
        $data = [
            'message' => "Erreur lors de la suppression de la liste.",
            'ok' => false
        ];
    }
    echo json_encode($data);
}
