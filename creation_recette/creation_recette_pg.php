<?php require_once 'creation_recette_sc.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/asset/lib/bootstrap/bootstrap.min.css">
    <title>Création recette</title>
</head>

<body>

    <div class="container">

        <br><br>

        <div class="text-center">

            <!-- Ingrédients -->
            <div class="card ingredients">
                <div class="card-body">
                    <h5 class="card-title">Ingrédients</h5>

                    <br>

                    <div class="offset-md-2 col-md-8">
                        <form>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="text-center form-control ingredient" placeholder="Ingrédient">
                                </div>
                                <div class="col">
                                    <input type="text" class="text-center form-control quantite" placeholder="Quantité">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <select class="text-center form-control mesure">
                                            <option value='null'>Unité</option>
                                            <?php
                                            $bdd = new creation_recette_sc;
                                            $mesures = $bdd->listeMesures();
                                            foreach ($mesures as $mesure) : ?>
                                                <option value='<?= $mesure['id'] ?>'><?= $mesure['nom'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <br>

                    <div class="text-center"><button class="btn btn-primary">Ajouter un ingrédient</button></div>
                </div>
            </div>

            <br>

            <div class="card preparation">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
            <br>
            <div class="card informations">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
            <br>
            <div class="card image">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
        </div>




    </div>

    <footer>
        <script src="/asset/lib/jquery/jquery.min.js"></script>
        <script src="/asset/lib/popper/popper.min.js"></script>
        <script src="/asset/lib/bootstrap/bootstrap.min.js"></script>
    </footer>

</body>

</html>