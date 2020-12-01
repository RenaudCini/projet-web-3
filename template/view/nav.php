<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/asset/lib/bootstrap/bootstrap.min.css">
    <?php
    if (isset($css)) {
        foreach ($css as $style) {
            echo "<link rel='stylesheet' href='/asset/css/$style'>";
        }
    }
    ?>
    <title><?= $titrePage ?> &bull; Les recettes du développeur</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/liste_recettes/liste_recettes_pg.php">Nos recettes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/creation_recette/creation_recette_pg.php">Créer votre recette</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <br>