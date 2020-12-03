$(document).ready(function () {

    $('.etoileNote').click(function () {
        $(this).addClass('fas').removeClass('far');
        $(this).prevAll().addClass('fas').removeClass('far');
        $(this).nextAll().addClass('far').removeClass('fas');
    });

    // Envoi du commentaire :
    $('#btnEnvoiCommentaire').click(function () {
        let idRecettes = $('#idRecettes').attr('idRecettes');
        console.log(idRecettes);
        let note = $('.etoilesNote .fas').length;
        let contenu = $('#commentaire').val().trim();

        // Si pas de note ou de contenu, on renvoie un message d'erreur :
        if (note === 0 || contenu === '') {
            $('#infoAjax').html('<div class="alert alert-danger alert-dismissible">Veuillez écrire un message et donner une note pour pouvoir valider votre commentaire.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '</div>')
        }
        // Sinon, si note et contenu renseignés, on insère le commentaire et on reload la page :
        else {
            $.ajax({
                url: '/utilisateurs/commentaire.php',
                type: 'post',
                data: {
                    insererCommentaire: true,
                    idRecettes,
                    note,
                    contenu
                },
                success(data) {
                    data = $.parseJSON(data);
                    if (data === 'ok') {
                        window.location.reload();
                    }
                    else {
                        $('#infoAjax').html('<div class="alert alert-danger alert-dismissible">Votre commentaire n\'a pas pu être inséré. Veuillez réessayer.' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '</div>')
                    }
                }
            });
        }
    });

});