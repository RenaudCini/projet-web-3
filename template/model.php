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
    public function RecupereRecette() :array
    {
        $articles = $this->db->queryAll("SELECT * FROM `recettes` ORDER BY date DESC");
        return $articles;
    }

    /**
     * Permet d'ajouter un nouvel recette.
     *
     * @param string $titre
     * @param string $difficulte
     * @param int $budget
     * @param string $temps
     * @param string $image L'URL de l'image de l'article.
     * @param int $id_utilisateur
     * @return int L'ID de l'article nouvellement créé.
     */

    public function insertRecette( string $titre,  string $difficulte,int $budget,string $temps,string $image, int $id_utilisateur = 1) : int
    {
        $this->db->execute(
            'INSERT INTO recette SET
            titre = :titre,
            difficulte = :difficulte,
            budget = :budget,
            image = :image,
            id_utilisateur = :id_utilisateur,
            temps = :temps',
            ['titre' => $titre,
                'difficulte' => $difficulte,
                'budget' => $budget,
                'image' => $image,
                'id_utilisateur' => $id_utilisateur,
                'temps' => $temps,
                'date' => 'NOW()'
            ]
        );

        return $this->db->lastInsertId();
    }

}
