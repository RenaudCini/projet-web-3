<?php
require_once 'template/model.php';
class index_sc extends model
{

    function listeRecettes($limit)
    {

        /**
         * 2. Récupération des trois dernières recettes
         */
        return $this->db->selectTouteDonne('SELECT * FROM recettes AS r INNER JOIN utilisateurs AS u ON r.id_utilisateurs = u.id ORDER BY r.id DESC', 'LIMIT 3');
    }
}
