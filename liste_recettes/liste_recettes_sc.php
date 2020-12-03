<?php
require_once(__DIR__ . '/../template/model.php');

class liste_recettes_sc extends model
{

    public function listeRecettes($limit)
    {
        /**
         * Récupération des  recettes
         */
        return $this->db->selectTouteDonne('SELECT r.id, r.titre, r.budget, r.difficulte, r.temps, r.date, r.image, u.pseudo
         FROM recettes AS r INNER JOIN utilisateurs AS u ON r.id_utilisateurs = u.id ', $limit, 'ORDER BY r.id DESC');
    }
}

function creerIcones($valeur, $typeIcones)
{
    $nbIconesRemplies = intval($valeur);
    $nbIconesVides = 5 - $nbIconesRemplies;

    for ($i = 0; $i < $nbIconesRemplies; $i++) {
        echo "<i class='fas fa-$typeIcones fa-xs'></i> ";
    }
    for ($i = 0; $i < $nbIconesVides; $i++) {
        echo "<i class='far fa-$typeIcones fa-xs'></i> ";
    }
}
