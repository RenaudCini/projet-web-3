<?php

namespace Model;


class Recette extends Model
{
    protected $table = 'recette';

    /**
     * Permet de récupérer les données de tous les recettes.
     *
     * @return array
     */
    public function findRecettes()
    {
        return $this->db->queryAll();
    }



    /**
     * Permet d'ajouter une nouvel recette.
     *
     * @param string $title Le titre de la recette.
     * @param string $short La description brève de l'article.
     * @param string $content Le contenu de l'article.
     * @param string $image L'URL de l'image de l'article.
     * @return int L'ID de l'article nouvellement créé.
     */

    public function insertRecette($title, $short, $content, $image)
    {

        $req = $this->db->prepare('INSERT INTO recette (nom, possesseur, console, prix, nbre_joueurs_max, commentaires) VALUES(:nom, :possesseur, :console, :prix, :nbre_joueurs_max, :commentaires)');
        $req->execute(array(
            'nom' => $nom,
            'possesseur' => $possesseur,
            'console' => $console,
            'prix' => $prix,
            'nbre_joueurs_max' => $nbre_joueurs_max,
            'commentaires' => $commentaires
        ));

        return $this->db->lastInsertId();
    }

    /**
     * @param $id
     * @return array|false
     */
    public function findRecette($id)
    {
        $article = $this->db->queryOne("SELECT * FROM article WHERE id = :id", ['id' => $id]);
        return $article;
    }

}
