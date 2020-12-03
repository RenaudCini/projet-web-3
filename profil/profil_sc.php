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
        return $this->db->selectTouteDonne("select i.nom ingredient,sum(c.quantite) quantite,m.nom mesure ,r.titre nomRecette,r.id idRecette from  listes l
                                              INNER JOIN recettes r ON l.id_recettes =r.id
                                              INNER JOIN compositions c on r.id = c.id_recettes
                                              INNER JOIN ingredients i on c.id_ingredients = i.id
                                              INNER JOIN mesures m on c.id_mesures = m.id
                                              WHERE l.id_utilisateurs = :id 
                                              Group BY  i.nom",'','',['id'=>$id]);


    }


    public function afficherRecettesFavorites($id)
    {
        return $this->db->selectTouteDonne("select r.*  from favoris f
                                                 INNER JOIN recettes r on f.id_recettes = r.id         
                                                 WHERE f.id_utilisateurs = :id", '', '', ['id' => $id]);
    }


}
