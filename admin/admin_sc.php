<?php
require_once '../template/model.php';

class admin_sc extends model
{


    public function statutUtilisateur(bool $bool, $id)
    {
        $array = [
            'bool' => $bool,
            'id' => $id
        ];
        $this->db->updateDonne("UPDATE utilisateurs SET actif = :bool WHERE id = :id", $array);
    }

    public function afficherToutUtilisateur()
    {
        return $this->db->selectTouteDonne("SELECT pseudo,mail,date_inscription,derniere_connexion,id_roles,actif,id button FROM utilisateurs", '', '');
    }

    public function afficherToutRole()
    {
        return $this->db->selectTouteDonne("SELECT * FROM roles", '', '');

    }

    public function afficherRole($id)
    {
        return $this->db->selectUneDonne("SELECT * FROM roles where id= :id", ["id"=> $id]);

    }
    public function afficheUtilisateur($id)
    {
        return $this->db->selectUneDonne("SELECT * FROM utilisateurs where id= :id", ["id"=> $id]);
    }


}


