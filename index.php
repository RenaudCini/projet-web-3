<?php $titrePage = 'Accueil'; ?>
<?php require_once 'template/view/nav.php';
require_once 'liste_recettes/liste_recettes_sc.php';

$recettes = new liste_recettes_sc;
$recettes = $recettes->listeRecettes('LIMIT 3');
?>

<body>
    <div class="container">

        <!-- La barre de recherche de la page -->
        <form method="get" action="/liste_recettes/liste_recettes_pg.php">
            <div class="form-group row justify-content-center">
                <input type="text" class="form-control col-6 text-center" id="recette" name="recette" placeholder="Tapez votre recette ici">
            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary mb-4" id="buttonSearch">Rechercher</button>
            </div>
        </form>

        <!-- Le carousel de la page -->
        <div id="carouselExampleIndicators" class="carousel slide rounded" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <!-- Premier carousel -->
            <div class="carousel-inner rounded">
                <div class="carousel-item active">
                    <img style="filter: brightness(0.4);" src="https://picsum.photos/1000/200?random=1" class="rounded d-block w-100" alt="First">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Une envie de légumes ?</h5>
                        <p>Découvrez nos recettes aux carottes.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img style="filter: brightness(0.4);" src="https://picsum.photos/1000/200?random=2" class="rounded d-block w-100" alt="Second">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Envie de nous partager une recette ?</h5>
                        <p>Inscrivez-vous ou connectez-vous pour écrire votre propre recette.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img style="filter: brightness(0.4);" src="https://picsum.photos/1000/200?random=3" class="rounded d-block w-100" alt="Third">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Besoin d'un renseignement ?</h5>
                        <p>N'hésitez pas à remplir notre formulaire de contact en cliquant sur "Nous contacter".</p>
                    </div>
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

        <hr class="my-4">

        <div class="col-12 text-center mb-5">
            <h3>Les nouveautés</h3>
        </div>

        <!-- Les 3 dernières recettes (les plus récentes)-->
        <div class="row">
            <?php
            $compteur = 0;
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

    <?php require_once 'template/view/footer.php'; ?>