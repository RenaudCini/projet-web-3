<?php
require_once('profil_sc.php');

$profil = new profil_sc();
$titrePage = 'Profil';
$js[] = 'profil.js';

$utilisateur = $profil->afficherUnUtilisateur(3);
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

                <div>
                    <!--liste de courses s -->
                    <div>
                        <div class="row">
                            <div class="col-4">
                                <div class="list-group" id="list-tab" role="tablist">

                                </div>
                            </div>
                            <div class="col-8">
                                <div class="tab-content" id="nav-tabContent">

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--favoris -->
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once '../template/view/footer.php';
