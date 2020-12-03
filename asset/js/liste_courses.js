$(document).ready(function () {

    // Ajout des ingrédients d'une recette :
    $('#btnActionListeCourses').click(function () {

        let idRecette = $(this).attr('data-idRecette');
        let idUtilisateur = $(this).attr('data-idUtilisateur');
        let action = $(this).attr('data-action')
        console.log(idRecette, idUtilisateur);

        $.ajax({
            url: "/utilisateurs/liste_courses.php",
            type: "post",
            data: {
                actionRecetteListeCourses: true,
                idRecette,
                idUtilisateur,
                action
            },
            success: function (data) {
                data = $.parseJSON(data);
                $('#ajaxListeCourses').html('<div class="alert alert-info alert-dissmissible">'
                    + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                    + data.message
                    + '</div>')
                if (data.remplacerButton === true) {
                    if (action === 'ajout') {
                        $('#btnActionListeCourses').attr('data-action', 'retrait').find('.contenuVariableBoutonListe').text('Retirer de');
                    } else if (action === 'retrait') {
                        $('#btnActionListeCourses').attr('data-action', 'ajout').find('.contenuVariableBoutonListe').text('Ajouter à');
                    }
                }
            }
        })

    });

    // Ajout des ingrédients d'une recette :
    $('#supprListe').click(function () {

        let idUtilisateur = $(this).attr('data-idUtilisateur');

        $.ajax({
            url: "/utilisateurs/liste_courses.php",
            type: "post",
            data: {
                supprListeCourses: true,
                idUtilisateur,
            },
            success: function (data) {
                data = $.parseJSON(data);
                $('#ajaxSupprListeCourses').html('<div class="alert alert-info alert-dissmissible">'
                    + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                    + data.message
                    + '</div>')
                if (data.ok === true) {
                    $('.tableListeCourses').html('<div class="card">' +
                        '<div class="card-body text-center">' +
                        'Aucun article n\'a été ajouté à votre liste de courses.<br>' +
                        'Rendez-vous sur une fiche recette et cliquez sur "<b>Ajouter à ma liste de courses</b>" pour ajouter des ingrédients.' +
                        '</div></div>');
                    $('#supprListe').remove();
                }
            }
        })

    });

});