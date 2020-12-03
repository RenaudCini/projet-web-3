<?php
require_once('profil_sc.php');

$model = new profil_sc();
$titrePage = 'Profil';
$js[] = 'profil.js';
$js[] = 'liste_courses.js';

require_once '../template/view/nav.php';


$ingredients = $model->afficheIngredient($_SESSION['id']);
$favoris = $model->afficherRecettesFavorites($_SESSION['id']);
$mesRecettes = $model->afficherMesRecettes($_SESSION['id']);
?>

<div class="container">
    <div class="row">
        <div class="col-10">
            <h1><?= $_SESSION['pseudo'] ?></h1>
        </div>
        <div class="col-2 text-right">
            <button class="btn btn-outline-dark"><i class="fas fa-sign-out-alt pr-2"></i>Se déconnecter</button>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 row">
                        <div class="col">Ma liste de courses</div>
                        <div class="col text-right">
                            <?php if ($ingredients) : ?>
                                <button id="supprListe" class="btn btn-outline-danger" data-idUtilisateur="<?= $_SESSION['id'] ?>">
                                    <i class="fas fa-times pr-2"></i>Supprimer la liste
                                </button>
                            <?php endif; ?>
                        </div>
                    </h4>

                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="tableListeCourses table table-sm table-borderless">

                                <?php if ($ingredients) : ?>
                                    <thead>
                                        <tr>
                                            <th>Ingrédient</th>
                                            <th>Quantité</th>
                                            <th>Mesure</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ingredients as $ingredient) { ?>
                                            <tr>
                                                <td> <?php echo ($ingredient['ingredient']) ?></td>
                                                <td> <?php echo ($ingredient['quantite']) ?></td>
                                                <td> <?php echo ($ingredient['mesure']) ?></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                <?php else : ?>
                                    <div class="card">
                                        <div class="card-body text-center">
                                            Aucun article n'a été ajouté à votre liste de courses.<br>
                                            Rendez-vous sur une fiche recette et cliquez sur "<b>Ajouter à ma liste de courses</b>" pour ajouter des ingrédients.
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-outline-dark btn-block"><i class="far fa-envelope pr-2"></i>Envoyer par mail</button>
                        </div>
                        <div class="col-6">
                            <form action="/utilisateurs/export_PDF.php" method="post" target="_blank">
                                <input type="hidden" name="listeCourses" value="1">
                                <input type="hidden" name="idUtilisateur" value="<?= $_SESSION['id'] ?>">

                                <button type="submit" id="btnExportListePDF" class="btn btn-outline-dark btn-block"><i class="fas fa-download pr-2"></i>Exporter en PDF</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Mes recettes favorites</h4>
                    <?php foreach ($favoris as $favori) : ?>
                        <a class="btn btn-outline-dark btn-block text-left" target="_blank" href="/fiche_recette/fiche_recette_pg?id=<?= $favori['id'] ?>">
                            <?= $favori['titre'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>


    </div>

    <div class="row my-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Mes recettes</h4>


                    <div class="row">
                        <?php
                        $compteur = 0;
                        foreach ($mesRecettes as $recette) :
                            if ($compteur % 3 === 0) : ?>
                    </div>
                    <div class="row">
                    <?php endif; ?>
                    <div class="col-md-4 pb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $recette['titre'] ?></h5>
                                <div class="row">
                                    <div class="col-md-6 text-right">Budget :</div>
                                    <div class="col-md-6 text-left"><?= creerIcones($recette['budget'], 'circle') ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-right">Difficulté :</div>
                                    <div class="col-md-6 text-left"><?= creerIcones($recette['difficulte'], 'circle') ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-right">Temps :</div>
                                    <div class="col-md-6 text-left"><b><?= $recette['temps'] ?> min.</b></div>
                                </div>
                                <br>
                                <a class="btn btn-outline-dark" target="_blank" href="/fiche_recette/fiche_recette_pg.php?id=<?= $recette['id'] ?>">Voir la recette</a>
                            </div>
                        </div>
                    </div>
                <?php
                            $compteur++;
                        endforeach;
                ?>
                    </div>

                </div>
            </div>
        </div>
    </div>



</div>
<?php
require_once '../template/view/footer.php';
