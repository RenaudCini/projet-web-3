<?php require_once 'template/view/nav.php';
require_once 'liste_recettes/liste_recettes_sc.php';

$recettes = new liste_recettes_sc;
$recettes = $recettes->listeRecettes('LIMIT 3');

?>

<body>

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://picsum.photos/1000/200?random=1" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://picsum.photos/1000/200?random=2" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://picsum.photos/1000/200?random=3" alt="Third slide">
            </div>
        </div>
    </div>

    <div class="row">
        <?php foreach ($recettes as $recette) {
        ?>
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
        <?php  } ?>
    </div>

    <?php require_once 'template/view/footer.php'; ?>
