<?php
require_once (dirname (__FILE__) . '/../template/model.php');

class liste_recettes_sc extends model
{

    public function listeRecettes($limit)
    {
        /**
         * Récupération des  recettes
         */
        return $this->db->selectTouteDonne('SELECT * FROM recettes AS r INNER JOIN utilisateurs AS u ON r.id_utilisateurs = u.id ', $limit, 'ORDER BY r.id DESC');
    }
}
