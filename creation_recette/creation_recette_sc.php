<?php
require_once '../template/model.php';

class creation_recette_sc extends model
{

    public function listeMesures()
    {
        return $this->db->selectTouteDonne("SELECT * FROM mesures", '', 'ORDER BY nom');
    }

    public function insertionEtape()
    {

    }

}


