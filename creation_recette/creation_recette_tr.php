<?php
session_start();

require_once 'creation_recette_sc.php';

if ($_POST['creationRecette'] && $_POST['reponsesFormulaire']) {

    $bdd = new BDD;

    $reponses = $_POST['reponsesFormulaire'];
    var_dump($reponses);
    die;

    $titre = $reponses['titre'];
    $difficulte = intval($reponses['difficulte']);
    $budget = intval($reponses['budget']);
    $temps = intval($reponses['temps']);
    $image = $reponses['image'];

    $ingredients = $reponses['ingredients'];
    $etapes = $reponses['etapes'];

    if ($titre && $difficulte && $budget && $temps && $image && count($ingredients) > 0 && count($etapes) > 0) {

        // Insertion dans la table recettes :
        $idRecette = $bdd->insertDonne(
            'recettes',
            'titre, difficulte, budget, temps, date, image, id_utilisateurs',
            ':titre, :difficulte, :budget, :temps, NOW(), :image, :id_utilisateurs',
            [
                'titre' => $titre,
                'difficulte' => $difficulte,
                'budget' => $budget,
                'temps' => $temps,
                'image' => $image,
                'id_utilisateurs' => $_SESSION['id']
            ]
        );

        // Insertion des étapes :
        foreach ($etapes as $etape) {
            $bdd->insertDonne(
                'etapes',
                'no_etape, contenu, id_recettes',
                ':no_etape, :contenu, :id_recettes',
                [
                    'no_etape' => $etape['etape'],
                    'contenu' => $etape['contenu'],
                    'id_recettes' => $idRecette
                ]
            );
        }

        // Insertion de la composition :
        foreach ($ingredients as $ingredient) {
            // On regarde si l'ingrédient existe déjà, si oui on récupère son ID, si non on l'insère :
            $select = 'SELECT id FROM ingredients WHERE nom = :nom';
            $resultat = $bdd->selectUneDonne($select, ['nom' => $ingredient['nom']]);
            if ($resultat) {
                $idIngredient = $resultat['id'];
            } else {
                $idIngredient = $bdd->insertDonne(
                    'ingredients',
                    'nom',
                    ':nom',
                    ['nom' => $ingredient['nom']]
                );
            }

            // On insère enfin la composition :
            $bdd->insertDonne(
                'compositions',
                'id_recettes, id_ingredients, id_mesures, quantite',
                ':id_recettes, :id_ingredients, :id_mesures, :quantite',
                [
                    'id_recettes' => $idRecette,
                    'id_ingredients' => $idIngredient,
                    'id_mesures' => $ingredient['mesure'],
                    'quantite' => $ingredient['quantite'],
                ]
            );
        }

        // Retour AJAX :
        echo json_encode("La recette a bien été créée !");
    } else {
        // Retour AJAX :
        echo json_encode("Certains champs ne sont pas remplis, ou ne sont pas correctement remplis.");
    }
}
