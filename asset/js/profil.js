$(document).ready(function () {

    $.ajax({
        url: location.origin + "/profil/profil_tr.php/",
        type: 'post',
        data: {
            type: 'ListeRecette'
        },
        success: function (data) {
            data = JSON.parse(data)
            data = data.data
            let recetteUtilisateur = data[0];
            let ingredientRecettes = data[1]
            let id
            let recette
            let listGroup = $('#list-tab')
            let navTabContent = $('#nav-tabContent')
            let div
            let a
            let aId
            let href
            let divId
            recetteUtilisateur.forEach(function (item) {
                id = item.id
                recette = item.recette

                listGroup.append("<a></a>");
                a = $('#list-tab a:last-child')
                a.addClass('list-group-item list-group-item-action')
                aId = 'list-' + recette + '-list'
                href = '#list-' +id
                a.attr('id', aId).attr("data-toggle", "list").attr('href', href).attr('role', 'tab').attr('aria-controls', id)
                a.text(recette)

                navTabContent.append("<div></div>")
                div = $('#nav-tabContent div:last-child')
                div.addClass("tab-pane fade show")
                divId = 'list-' + id
                div.attr('id', divId).attr('role','tabpanel').attr('aria-labelledby', aId)

                ingredientRecettes.forEach(function (i) {
                    let ingredientRecette = []
                    if (i.idRecette === id ) {

                        div.text(i.ingredient + i.quantite +i.mesure)
                    }

                })

            });


        },
        error: function () {

        }
    });

});
