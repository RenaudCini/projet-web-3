<?php

require_once 'creation_recette_sc.php';

if (filter_input(INPUT_POST, 'creationRecette') && filter_input(INPUT_POST, 'reponsesFormulaire')) {

    $bdd = new creation_recette_sc;

    echo json_encode(utf8_encode("La recette a bien été créée !"));
}
