<?php
require_once(__DIR__ . '/../template/model.php');

class profil_sc extends model
{
    public function afficherUnUtilisateur(int $id)
    {
        return $this->db->selectUneDonne("select * from utilisateurs where id = :id", ['id' => $id]);
    }

    public function afficheRecetteListeDeCourse($id): array
    {
        return $this->db->selectTouteDonne("select distinct l.id_utilisateurs,r.id, r.titre recette from  listes l 
                                                 INNER JOIN recettes r ON l.id_recettes =r.id
                                                 INNER JOIN compositions c on r.id = c.id_recettes       
                                                 WHERE l.id_utilisateurs = :id  ", '', '', ['id' => $id]);

        /*return $this->db->selectTouteDonne("select i.nom ingredient,c.quantite,m.nom mesure ,r.titre nomRecette from  listes l
                                                 INNER JOIN recettes r ON l.id_recettes =r.id
                                                 INNER JOIN compositions c on r.id = c.id_recettes
                                                 INNER JOIN ingredients i on c.id_ingredients = i.id
                                                 INNER JOIN mesures m on c.id_mesures = m.id
                                                 WHERE l.id_utilisateurs = :id  ",'','',['id'=>$id]);*/
    }

    public function afficheIngredient($id)
    {
        return $this->db->selectTouteDonne(
            "SELECT i.nom AS ingredient, sum(c.quantite) AS quantite, m.nom AS mesure, r.titre AS nomRecette, r.id AS idRecette 
                FROM listes l
                INNER JOIN recettes r ON l.id_recettes = r.id
                INNER JOIN compositions c on r.id = c.id_recettes
                INNER JOIN ingredients i on c.id_ingredients = i.id
                INNER JOIN mesures m on c.id_mesures = m.id
                WHERE l.id_utilisateurs = :id 
                GROUP BY i.nom, m.nom",
            '',
            'ORDER BY i.nom ASC',
            ['id' => $id]
        );
    }


    public function afficherRecettesFavorites($id)
    {
        return $this->db->selectTouteDonne(
            "select r.*  from favoris f
            INNER JOIN recettes r on f.id_recettes = r.id         
            WHERE f.id_utilisateurs = :id AND f.bool = 1",
            '',
            '',
            ['id' => $id]
        );
    }

    public function afficherMesRecettes($id)
    {
        return $this->db->selectTouteDonne(
            "SELECT *
            FROM recettes
            WHERE id_utilisateurs = :id",
            '',
            '',
            ['id' => $id]
        );
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
