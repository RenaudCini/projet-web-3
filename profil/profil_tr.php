<?php
require_once('profil_sc.php');




if ($_POST['type']=== 'ListeRecette')
{
    $profil = new profil_sc();

    $listeDesCoruses = $profil->afficheRecetteListeDeCourse(8);
    $afficheIngredientRecettes =$profil->afficheIngredientRecettes(8);

    $return = [$listeDesCoruses, $afficheIngredientRecettes];
    echo json_encode(['sucess','data' =>$return]);

}


?>



