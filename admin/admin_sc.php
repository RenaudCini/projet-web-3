<?php
require_once '../template/model.php';

class admin_sc extends model
{


    public function statutUtilisateur(bool $bool, $id)
    {
        $array = [
            'bool'=>$bool,
            'id' => $id
        ];
        $this->db->updateDonne("UPDATE utilisateurs SET actif = :bool WHERE id = :id",$array);
    }

    public function afficherToutUtilisateur()
    {
        $this->db->selectTouteDonne("SELECT * FROM utilisateurs", '', 'ORDER BY nom');
    }


}


