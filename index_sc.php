<?php

function listeRecettes()
{

    $pdo = new PDO('mysql:host=localhost;dbname=lesrecettesdudeveloppeur;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);


    /**
     * 2. Récupération des trois dernières recettes
     */
    $resultats = $pdo->query('SELECT * FROM recettes AS r INNER JOIN utilisateurs AS u ON r.id_utilisateurs = u.id ORDER BY r.id DESC LIMIT 3');
    /* 
        * $recettes continent toutes les variables dont nous auront besoin 
        */
    return $resultats->fetchAll(PDO::FETCH_ASSOC);
}
