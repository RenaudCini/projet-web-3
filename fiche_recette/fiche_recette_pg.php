<?php

require_once 'fiche_recette_sc.php';

$titrePage = 'Fiche recette';

require_once '../template/view/nav.php';
?>

        <div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <img src="https://picsum.photos/1000/200?random=10" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Sauté de boeuf</h5>
                </div>
            </div>
        </div>
    </div>
            <div id="idRecettes" class="d-none" idRecettes="<?= $recette['id'] ?>"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <img src="https://picsum.photos/1000/200?random=10" class="card-img-top" alt="...">
                        <div class="card-body row">
                            <div class="col-md-6">
                                <h4 class="card-title"><?= $recette['titre'] ?></h4>
                            </div>
                            <div class="col text-center">
                                <b>Temps</b><br>
                                <?= $recette['temps'] ?> min.
                            </div>
                            <div class="col text-center">
                                <b>Budget</b><br>
                                <?php creerIcones($recette['budget'], 'circle'); ?>
                            </div>
                            <div class="col text-center">
                                <b>Difficulté</b><br>
                                <?php creerIcones($recette['difficulte'], 'circle'); ?>
                            </div>
                            <div class="col text-center">
                                <b>Note</b><br>
                                <?php creerIcones($noteMoyenne, 'star'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Ingrédients</h5>
                            <br>
                            <ul>
                                <?php
                                foreach ($ingredients as $ingredient) {
                                    echo '<li>' . $ingredient['ingredient'] . ' (' . $ingredient['quantite'] . ' ' . $ingredient['mesure'] . ')</li>';
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center mb-4">Etapes de préparation</h5>
                            <br>

                            <?php foreach ($etapes as $etape) : ?>
                                <div class="etape row">
                                    <div class="offset-md-1 col-md-1 text-right">
                                        <h3><span class="badge badge-pill badge-dark p-2 px-3"><?= $etape['no_etape'] ?></span></h3>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <?= $etape['contenu'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-left"><button class="btn btn-danger btnSuppr d-none">X</button></div>
                                </div>
                            <?php endforeach; ?>

                            <hr>

                            <h5 class="text-center my-4">Commentaires</h5>

                            <?php
                            if ($commentaires) {
                                foreach ($commentaires as $commentaire) { ?>
                                    <div class="row">
                                        <div class="col-6">
                                            <b><?= $commentaire['pseudo'] ?></b>
                                            <span class="px-4"><?php creerIcones($commentaire['note'], 'star') ?></span>
                                        </div>
                                        <div class="col-6 text-right">
                                            <?php
                                            $timestampCommentaire = strtotime($commentaire['date']);
                                            echo date('\l\e d-m-Y à H:i:s', $timestampCommentaire);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="px-3"><?= $commentaire['contenu'] ?></div>
                                    <hr>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="text-center">Pas de commentaire à afficher.</div>
                                <hr>
                            <?php
                            }
                            ?>

                            <h5 class="text-center my-4">Laisser un commentaire</h5>


                            <?php if (isset($_SESSION['id'])) : ?>

                                <!-- Si l'utilisateur est connecté : -->
                                <div class="text-center">
                                    <div id="infoAjax">
                                        <!-- Message chargé en AJAX en cas de besoin. -->
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">Votre pseudo : <div><b><?= $_SESSION['pseudo'] ?></b></div>
                                        </div>
                                        <div class="col-6">
                                            Note :
                                            <div class="etoilesNote">
                                                <span class='etoileNote far fa-star fa-xs'></span>
                                                <span class='etoileNote far fa-star fa-xs'></span>
                                                <span class='etoileNote far fa-star fa-xs'></span>
                                                <span class='etoileNote far fa-star fa-xs'></span>
                                                <span class='etoileNote far fa-star fa-xs'></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" id="commentaire" rows="3" style="resize:none;"></textarea>
                                    </div>
                                    <button id="btnEnvoiCommentaire" class="btn btn-success">Envoyer</button>
                                </div>

                            <?php else : ?>

                                <!-- Sinon, s'il n'est pas connecté : -->
                                <div class="card text-center">
                                    <div class="card-body">
                                        <a href="#" data-toggle="modal" data-target="#modal_connexion">Connectez-vous</a> ou <a href="#" data-toggle="modal" data-target="#modal_inscription">inscrivez-vous</a> pour poster un commentaire.
                                    </div>
                                </div>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php
    }
    // Si on n'a pas d'informations pour la recette demandée :
    else {
    }
}
// Si aucun ID n'a été renseigné en GET :
else {
    echo 'Hé non';
}

require_once '../template/view/footer.php';

?>
