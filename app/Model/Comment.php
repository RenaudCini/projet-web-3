<?php

namespace Model;

class Comment extends Model
{
    protected $table = 'comment';

    /**
     * Permet de récupérer les commentaires d'un article donné.
     *
     * @param integer $article_id L'ID de l'article concerné.
     * @return array
     */
    public function findAllComments(int $article_id)
    {
        $comments = $this->db->queryAll("SELECT * FROM comment WHERE article_id = :article_id", ['article_id' => $article_id]);
        return $comments;
    }

    /**
     * Permet d'ajouter un commentaire sur un article.
     *
     * @param string $author Le nom/pseudo de l'expéditeur.
     * @param string $content Le contenu du commentaire.
     * @param integer $article_id L'ID de l'article commenté.
     */
    public function insertComment(string $author, string $content, int $article_id)
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

    }
}
