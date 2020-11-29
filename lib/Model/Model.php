<?php

namespace Model;



abstract class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = new \Database;
    }

    /**
     *  Permet de récupérer une donné par rapport a l'id.
     * @param int $id
     * @return array|false
     */
    public function find(int $id)
    {
        $result = $this->db->queryOne("SELECT * FROM $this->table WHERE id = :id", ['id' => $id]);
        return $result;
    }

    public function delete(int $id)
    {
        $this->db->execute("DELETE FROM $this->table WHERE id = :id", ['id' => $id]);
    }

}
