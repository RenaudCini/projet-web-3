$(document).ready(function () {

    $('.btnAjoutFavori').click(function () {
        let idRecette = $(this).attr('data-idRecette');
        let idUtilisateur = $(this).attr('data-idUtilisateur');
        let typeRequete = $(this).hasClass('far') ? 'ajout' : 'retrait';

        console.log(idRecette, idUtilisateur, typeRequete);

        $.ajax({
            url: '/utilisateurs/favori.php',
            type: 'post',
            data: {
                typeRequete,
                idRecette,
                idUtilisateur
            },
            success: function (data) {
                data = $.parseJSON(data);
                if (data === 'ok') {
                    let message = '';
                    $('.btnAjoutFavori').toggleClass('far fas');
                    if (typeRequete == 'ajout') {
                        message = 'La recette a bien été ajoutée à vos favoris.';
                    } else if (typeRequete == 'retrait') {
                        message = 'La recette a bien été retirée de vos favoris.';
                    }
                    $('#ajaxFavoris').html('<div class="alert alert-info alert-dissmissible mt-4">'
                        + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                        + message
                        + '</div>')
                }
            }
        })
    });

});