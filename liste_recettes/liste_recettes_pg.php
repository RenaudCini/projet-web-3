<?php

$titrePage = 'Liste des recettes';
$js[] = 'liste_recettes.js';

require_once '../template/view/nav.php';
require_once 'liste_recettes_sc.php';

$recettes = new liste_recettes_sc;
$recettes = $recettes->listeRecettes('');
$compteur = 0;
?>

<div class="container">

    <div class="form-group row justify-content-center">
        <input type="text" class="form-control col-6 text-center" id="recherche" placeholder="Tapez votre recette ici">
    </div>
    <div class="row justify-content-center">
        <button class="btn btn-primary" id="buttonSearch">Rechercher</button>
    </div>

    <br>

    <div class="row">
        <?php
        foreach ($recettes as $recette) :
            if ($compteur % 3 === 0) : ?>
    </div>
    <div class="row">
    <?php endif; ?>
    <div class="col-md-4 pb-3">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title"><?= $recette['titre'] ?></h5>
                <div class="row">
                    <div class="col-md-6 text-right">Difficulté :</div>
                    <div class="col-md-6 text-left"><?= creerIcones($recette['difficulte'], 'circle') ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-right">Budget :</div>
                    <div class="col-md-6 text-left"><?= creerIcones($recette['budget'], 'circle') ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-right">Temps :</div>
                    <div class="col-md-6 text-left"><b><?= $recette['temps'] ?> min.</b></div>
                </div>
                <br>
                <p class="small text-secondary"> Ecrit par
                    <?= $recette['pseudo'] ?> le
                    <?= $recette['date'] ?>
                </p>
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

<?php require_once '../template/view/footer.php';
