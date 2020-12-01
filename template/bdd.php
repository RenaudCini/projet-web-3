<?php

class BDD
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=lesrecettesdudeveloppeur;charset=utf8', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Permet de récupérer un enregistrement dans la base de données.
     *
     * @param string $sql
     * @param array $params
     * @return array|false
     */
    public function selectUneDonne(string $sql, array $params = [])
    {
        $requete = $this->db->prepare($sql);
        $requete->execute($params);

        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Permet de récupérer plusieurs enregistrements dans la base de données.
     *
     * @param string $sql
     * @param array $params
     * @param string $limit
     * @return array|false
     */
    public function selectTouteDonne(string $sql, string $limit, string $orderby, array $params = [])
    {

        $sql .= ' ' . $orderby . ' ' . $limit;
        $requete = $this->db->prepare($sql);

        $requete->execute($params);

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertDonne(string $table, string $colone, string $value, array $array): int
    {
        $req = $this->db->prepare("INSERT INTO $table ($colone) VALUES($value)");
        $req->execute($array);

        return $this->db->lastInsertId();
    }

    /**
     * Permet de retouner le dernier id
     *
     * @return string
     */
    public function dernierIdInsere()
    {
        return $this->db->lastInsertId();
    }
}
