<?php

require_once 'creation_recette_sc.php';

if (filter_input(INPUT_POST, 'creationRecette') && filter_input(INPUT_POST, 'reponsesFormulaire')) {

    $bdd = new BDD;
    $bdd->insertDonne(
        'recettes',
        'titre, difficulte, budget, temps, date, image, id_utilisateurs',
        ':titre, :difficulte, :budget, :temps, :date, :image, :id_utilisateurs',
        [
            'titre' => 'Titre test',
            'difficulte' => '3',
            'budget' => '4',
            'temps' => '50 min',
            'date' => 'NOW()',
            'image' => 'test.com',
            'id_utilisateurs' => '2'
        ]
    );

    echo json_encode(utf8_encode("La recette a bien été créée !"));
}
