<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/asset/lib/bootstrap/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>


    <p>Bootcamp</p>

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

    <footer>
        <script src="/asset/lib/jquery/jquery.min.js"></script>
        <script src="/asset/lib/popper/popper.min.js"></script>
        <script src="/asset/lib/bootstrap/bootstrap.min.js"></script>
    </footer>

</body>

</html>