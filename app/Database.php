<?php

class Database
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=lesrecettesdudeveloppeur", "root", "");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Permet de récupérer un enregistrement dans la base de données.
     *
     * @param string $sql La requête SQL à exécuter.
     * @param array $params Un tableau associatif des paramètres.
     * @return array|false
     */
    public function queryOne(string $sql, array $params = [])
    {
        $requete = $this->db->prepare($sql);
        $requete->execute($params);

        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Permet de récupérer plusieurs enregistrements dans la base de données.
     *
     * @param string $sql La requête SQL à exécuter.
     * @param array $params Un tableau associatif des paramètres.
     * @return array
     */
    public function queryAll(string $sql, array $params = [])
    {
        $requete = $this->db->prepare($sql);
        $requete->execute($params);

        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute(string $sql, array $params = [])
    {
        $requete = $this->db->prepare($sql);
        $requete->execute($params);
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }




}
