<?php
require_once 'bdd.php';

class model
{
    /**
     * model constructor.
     */
    public function __construct()
    {
        $this->db = new \BDD;
    }

}
