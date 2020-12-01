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

            <!-- Titre -->
            <div class="offset-md-2 col-md-8">
                <input type="text" id="titre" class="text-center form-control" placeholder="Titre de la recette">
            </div>

            <br>

            <!-- Ingrédients -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingrédients</h5>

                    <br>

                    <div class="ingredients">
                        <div class="inputIngredientModele">
                            <div class="ingredient row">
                                <div class="offset-md-2 col-md-8">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" class="text-center form-control ingredientNom" placeholder="Ingrédient">
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
                                </div>
                                <div class="col-md-2 text-left"><button class="btn btn-danger btnSuppr d-none">X</button></div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="text-center"><button class="btn btn-primary btnAddIngredient">Ajouter un ingrédient</button></div>
                </div>
            </div>

            <br>

            <!-- Préparation -->
            <div class="card preparation">
                <div class="card-body">
                    <h5 class="card-title">Préparation</h5>

                    <br>

                    <div class="etapes">
                        <div class="inputEtapeModele">
                            <div class="etape row">
                                <div class="offset-md-1 col-md-1 text-right">
                                    <h3><span class="badge badge-dark p-2">&nbsp;1&nbsp;</span></h3>
                                </div>
                                <div class="form-group col-md-8">
                                    <textarea class="form-control etapeContenu" noEtape="1" rows="3"></textarea>
                                </div>
                                <div class="col-md-2 text-left"><button class="btn btn-danger btnSuppr d-none">X</button></div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="text-center"><button class="btn btn-primary btnAddEtape">Ajouter une étape</button></div>

                </div>
            </div>

            <br>

            <!-- Informations (difficulté, budget, temps) -->
            <div class="card informations">
                <div class="card-body">
                    <form class="offset-md-2 col-md-8">
                        <div class="form-group row">
                            <label for="budget" class="text-right col-sm-2 col-form-label">Budget</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="budget">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="difficulte" class="text-right col-sm-2 col-form-label">Difficulté</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="difficulte">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="temps" class="text-right col-sm-2 col-form-label">Temps</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="temps">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <br>

            <!-- Image -->
            <div class="offset-md-2 col-md-8">
                <input type="text" id="image" class="text-center form-control" placeholder="URL de l'image">
            </div>
            <br>
            <button class="btn btn-success btnEnvoiFormulaire">Valider</button>
            <br><br>
        </div>

    </div>

    <footer>
        <script src="/asset/lib/jquery/jquery.min.js"></script>
        <script src="/asset/lib/popper/popper.min.js"></script>
        <script src="/asset/lib/bootstrap/bootstrap.min.js"></script>
        <script src="/asset/js/creation_recette.js"></script>
    </footer>

</body>

</html>
