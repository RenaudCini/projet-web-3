<?php
$titrePage = 'Fiche recette';

require_once '../template/view/nav.php';
?>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <img src="https://picsum.photos/1000/200?random=10" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Sauté de boeuf</h5>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Ingrédients</h5>
                    <br>
                    1 litre de lait
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Etapes de préparation</h5>
                    <br>
                    <div class="etape row">
                        <div class="offset-md-1 col-md-1 text-right">
                            <h3><span class="badge badge-pill badge-dark p-2 px-3">1</span></h3>
                        </div>
                        <div class="form-group col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    Couper les steaks.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 text-left"><button class="btn btn-danger btnSuppr d-none">X</button></div>
                    </div>

                    <hr>

                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once '../template/view/footer.php'; ?>
