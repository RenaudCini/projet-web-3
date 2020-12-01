<?php require_once 'liste_recettes_sc.php';
require_once '../nav.php';
$recettes = listeRecettes();
$compteur = 0;
?>

<body>
    <div class="row">
        <?php foreach ($recettes as $recette) {
            if ($compteur % 3 === 0) :
        ?> </div>
    <div class="row">
    <?php endif ?>
    <div class="col-md-4 pb-3">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title"><?= $recette['titre'] ?></h5>
                <p class="card-text"><?= $recette['difficulte'] ?></p>
                <p class="text-right small text-secondary"> Ecrit par
                    <?= $recette['pseudo'] ?> le
                    <?= $recette['date'] ?>
                </p>
            </div>
        </div>
    </div>
<?php $compteur++;
        } ?>
    </div>
    <?php require_once '../footer.php';
