<?php $titrePage = 'Accueil'; ?>
<?php require_once 'template/view/nav.php';
require_once 'liste_recettes/liste_recettes_sc.php';

$recettes = new liste_recettes_sc;
$recettes = $recettes->listeRecettes('LIMIT 3');
?>

<body>
    <div class="container">
        <!-- La barre de recherche de la page -->
        <div class="form-group row justify-content-center">
            <input type="text" class="form-control col-6 text-center mt-4 mb-4" id="recherche" placeholder="Tapez votre recette ici">
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-primary mt-4 mb-4" id="buttonSearch">Rechercher</button>
        </div>

        <!-- Le carousel de la page -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <!-- Premier carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://picsum.photos/1000/200?random=1" class="d-block w-100" alt="First">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/1000/200?random=2" class="d-block w-100" alt="Second">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/1000/200?random=3" class="d-block w-100" alt="Third">
                </div>
            </div>
            <!-- Deuxième -->
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Précédent</span>
            </a>
            <!-- Troisième -->
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Suivant</span>
            </a>
        </div>

        <div class="col-12 text-center mt-2">
            <h3>Les nouveautés</h3>
        </div>

        <!-- Les 3 dernières recettes (les plus récentes)-->
        <div class="row">
            <?php foreach ($recettes as $recette) {
            ?>
                <div class="col-md-4 pb-3 mt-4">
                    <a class="card" style="text-decoration: none;" href="http://lesrecettesdudeveloppeur.test/fiche_recette/fiche_recette_pg.php?id=<?= $recette['id'] ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $recette['titre'] ?></h5>
                            <p class="card-text"><?= $recette['difficulte'] ?></p>
                            <p class="text-right small text-secondary"> Ecrit par
                                <?= $recette['pseudo'] ?> le
                                <?= $recette['date'] ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php  } ?>
        </div>
    </div>

    <?php require_once 'template/view/footer.php'; ?>