<?php $titrePage = 'Accueil'; ?>
<?php require_once '../template/view/nav.php';
require_once '../liste_recettes/liste_recettes_sc.php';
?>

<!-- Modal inscription -->
<div class="container text-center">
    <br>
    <div class="card shadow offset-sm-2 col-sm-8 ">
        <br>

        <div class="card-body">
            <h1> Contactez nous </h1>
            <br><br>

            <form method="POST" action="nous_contacter.php">
                <div class="form-group row">
                    <label for="pseudo" class="col-sm-2 offset-sm-1 col-form-label text-right">Pseudo </label>
                    <div class="col-sm-6 mb-4">
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 offset-sm-1 col-form-label text-right" required>Email *</label>
                    <div class="col-sm-6 mb-4">
                        <input type="email" class="form-control" id="inputEmail3" name="email">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sujet" class="col-sm-2 offset-sm-1 col-form-label text-right" required>Sujet * </label>
                    <div class="col-sm-6 mb-4">
                        <input type="text" class="form-control" id="sujet" name="sujet">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="message" class="col-sm-3 col-form-label text-right" required>Votre message * </label>
                    <div class="col-sm-6 mb-4">
                        <textarea rows="4" class="form-control" id="message" name="message"></textarea>
                    </div>
                </div>

                <p class="text-muted small">Les champs marqués par une astérisque * sont obligatoires. </p>

                <div class="row">
                    <div class="offset-sm-3 col-sm-6 text-right">
                        <button class="btn btn-success" type="submit" value="Envoyer">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once '../template/view/footer.php'; ?>