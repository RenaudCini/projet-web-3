<?php

function listeRecettes()
{

    $pdo = new PDO('mysql:host=localhost;dbname=lesrecettesdudeveloppeur;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);


    /**
     * 2. Récupération des recettes
     */
    $resultats = $pdo->query('SELECT * FROM recettes AS r INNER JOIN utilisateurs AS u ON r.id_utilisateurs = u.id');
    /* 
        * $recettes continent toutes les variables dont nous auront besoin 
        */
    return $resultats->fetchAll(PDO::FETCH_ASSOC);
}
