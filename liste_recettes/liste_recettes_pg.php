<?php
require_once '../template/view/nav.php';
require_once 'liste_recettes_sc.php';
$recettes = new liste_recettes_sc;
$recettes = $recettes->listeRecettes('');
$compteur = 0;
?>

<body>
    <div class="form-group row justify-content-center">
        <input type="text" class="form-control col-6 text-center" id="recherche" placeholder="Tapez votre recette ici">
    </div>
    <div class="row justify-content-center">
        <button class="btn btn-primary" id="buttonSearch">Rechercher</button>
    </div>

    <script>
        let buttonSearch = $("#buttonSearch");
        buttonSearch.click(function() {
            let valeur = $("#recherche").val();
            console.log(valeur);
        });
    </script>
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
    <?php require_once '../template/view/footer.php';
