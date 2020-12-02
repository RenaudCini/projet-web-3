<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/asset/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/asset/css/styles.css">
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

            <?php if (isset($_SESSION['id'], $_SESSION['pseudo'])) : ?>
                <div class="my-0">
                    <a class="btn btn-outline-light" href="/" role="button">
                        Bonjour, <b><?= $_SESSION['pseudo'] ?></b>
                    </a>
                </div>';
            <?php else : ?>
                <div class="my-0">
                    <button class="btn btn-outline-light" data-toggle="modal" data-target="#modal_connexion">Connexion</button>
                </div>';
            <?php endif; ?>
        </div>
    </nav>

    <!-- Modal connexion -->
    <div class="modal fade" id="modal_connexion" tabindex="-1" role="dialog" aria-labelledby="modal_connexion" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title text-center" id="titre_modal_connexion"><b>Connexion</b></h5>
                </div>
                <div class="modal-body">
                    <div class="info_erreur"></div>
                    <form id="form_modal_connexion">
                        <div class="form-group">
                            <label class="sr-only" for="pseudo">Pseudo</label>
                            <input type="text" class="form-control" name="pseudo" id="pseudo" aria-describedby="emailHelp" placeholder="Pseudo" maxlength="25" />
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="mot_de_passe">Mot de passe</label>
                            <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" maxlength="25" />
                        </div>
                        <div class="text-center">
                            <button type="button" id="btn_envoi_connexion" class="btn btn-outline-primary">Se connecter</button>
                            <br /><br />
                            <small class="form-text text-muted">
                                <a href="/">Mot de passe oublié ?</a> &bull;
                                <a id="lien_inscription" href="#">S'inscrire</a>
                            </small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal inscription -->
    <div class="modal fade" id="modal_inscription" tabindex="-1" role="dialog" aria-labelledby="modal_inscription" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title text-center" id="titre_modal_inscription"><b>Inscription</b></h5>
                </div>
                <div class="modal-body">
                    <div class="info_erreur"></div>
                    <form id="form_modal_inscription">
                        <div class="form-group">
                            <label class="sr-only" for="pseudo">Pseudo</label>
                            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" maxlength="25" />
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="email">Adresse mail</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Adresse email" maxlength="126">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="mot_de_passe">Mot de passe</label>
                            <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" maxlength="25" />
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="mot_de_passe_confirm">Confirmation du mot de passe</label>
                            <input type="password" class="form-control" name="mot_de_passe_confirm" id="mot_de_passe_confirm" placeholder="Confirmez le mot de passe" maxlength="25" />
                        </div>
                        <div class="text-center">
                            <small id="emailHelp" class="form-text text-muted">
                                En vous inscrivant sur Les Recettes du Développeur, vous acceptez nos <a href="#">conditions générales d'utilisation</a>.
                            </small>
                            <br />
                            <button type="button" id="btn_envoi_inscription" class="btn btn-outline-primary">S'inscrire</button>
                            <br /><br />
                            <small class="form-text text-muted">
                                <a id="lien_connexion" href="#">Déjà membre ?</a>
                            </small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <br>
