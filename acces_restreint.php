<?php
session_start();

$titrePage = 'Création de recette';

require_once 'template/view/nav.php';

?>

<div class="container">
    <div class="card">
        <div class="card-body text-center">
            <h1 class="card-title">Accès restreint</h1>

            <br>

            <a href="#" data-toggle="modal" data-target="#modal_connexion">Connectez-vous</a> ou <a href="#" data-toggle="modal" data-target="#modal_inscription">inscrivez-vous</a> pour avoir accès à cette page.

            <br><br>

            <a href="/" class="btn btn-outline-dark">Revenir à l'accueil</a>
        </div>
    </div>
</div>

<?php
require_once 'template/view/footer.php';
