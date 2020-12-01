<?php
require_once 'bdd.php';

class model
{
    /**
     * model constructor.
     */
    public function __construct()
    {
        $this->db = new \BDD;
    }

    /**
     * Permet de récupérer les données de tous les articles.
     *
     * @return array
     */
    public function RecupereRecette(): array
    {
        $articles = $this->db->queryAll("SELECT * FROM `recettes` ORDER BY date DESC");
        return $articles;
    }

    /**
     * Permet d'ajouter un nouvel recette.
     *
     * @param string $colone format colonne1,colonne 2,colonne 3,
     * @param string $value format :nom de la valeur 1,:nom de valeur 2,
     * @param array $array format nom => valeur
     * @return int L'ID de la recette nouvellement créé.
     */

    public function insertRecette(string $colone, string $value, array $array): int
    {

        $req = $this->db->prepare("INSERT INTO recettes($colone) VALUES($value)");
        $req->execute($array);

        return $this->db->lastInsertId();
    }

}
