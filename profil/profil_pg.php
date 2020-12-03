<?php
require_once('profil_sc.php');

$profil = new profil_sc();
$titrePage = 'Profil';
$js[] = 'profil.js';

$ingredients = $profil->afficheIngredient(8);
$utilisateur = $profil->afficherUnUtilisateur(8);
$favoris = $profil->afficherRecettesFavorites(8);
require_once '../template/view/nav.php';
?>

    <div class="container-fluid">
        <div class="row">

            <!--pseudo & btn deconnexion -->
            <div class="col-12">
                <div class="d-flex justify-content-between row 3">
                    <h2 class="ml-6"><?php echo $utilisateur['pseudo'] ?> .</h2>
                    <button type="button" class="btn btn-light mr-5">Se déconnecter</button>
                </div>
                <HR class="col-11">
                <div class="col-1"></div>
            </div>
            <div class="col-1"></div>
            <!--liste de courses s -->
            <div class="col-4 cadre mr-2 p-2">
                <h2>Ma liste de courses</h2>
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>ingredient</th>
                        <th>quantite</th>
                        <th>Mesure</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ingredients as $ingredient) { ?>
                        <tr>
                            <td> <?php echo($ingredient['ingredient']) ?></td>
                            <td> <?php echo($ingredient['quantite']) ?></td>
                            <td> <?php echo($ingredient['mesure']) ?></td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
            </div>
            <!--favoris -->
            <div class="col-6 mr-2  p-2 cadre">

            </div>
            <div class="1"></div>

        </div>
    </div>
<?php
require_once '../template/view/footer.php';
