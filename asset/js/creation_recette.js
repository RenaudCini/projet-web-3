$(document).ready(function () {

    // Ajout d'un input ingrédient :
    $('.btnAddIngredient').click(function () {
        let inputIngredient = $('.inputIngredientModele').html();
        $('.ingredients').append(inputIngredient);
        $('.ingredients > .ingredient:last-child .btnSuppr').removeClass('d-none');
    });

    // Ajout d'un input étape :
    $('.btnAddEtape').click(function () {
        let inputEtape = $('.inputEtapeModele').html();
        $('.etapes').append(inputEtape);
        $('.etapes > .etape:last-child .btnSuppr').removeClass('d-none').attr('typeInput', 'etape');
        let maxEtape = recupMaxEtape();
        let newEtape = maxEtape + 1;
        $('.etapes > .etape:last-child .etapeContenu').attr('noEtape', newEtape);
        $('.etapes > .etape:last-child .badge').html("&nbsp;" + newEtape + "&nbsp;");
    });

    // Suppression d'un input :
    $('body').on('click', '.btnSuppr', function () {
        $(this).parent().parent().remove();
        if ($(this).attr('typeInput') === 'etape') {
            remplacerEtapes();
        }
    });

    // Budget et difficulté :
    $('.noteCercle').click(function () {
        $(this).addClass('fas').removeClass('far');
        $(this).prevAll().addClass('fas').removeClass('far');
        $(this).nextAll().addClass('far').removeClass('fas');
    });

    // Envoi du formulaire :
    $('.btnEnvoiFormulaire').click(function () {

        let titre = $('#titre').val();
        let budget = $('.budgetCercles .fas').length;
        let difficulte = $('.difficulteCercles .fas').length;
        let temps = $('#temps').val();
        let image = $('#image').val();


        let reponsesFormulaire = {
            titre,
            ingredients: [],
            etapes: [],
            budget,
            difficulte,
            temps,
            image
        };

        // Ingrédients :
        $.each($('.ingredient'), function () {
            let nom = $(this).find('.ingredientNom').val();
            let quantite = $(this).find('.quantite').val();
            let mesure = $(this).find('.mesure option:selected').val();

            let jsonIngredient = {
                "nom": nom,
                "quantite": quantite,
                "mesure": mesure
            }
            reponsesFormulaire.ingredients.push(jsonIngredient);
        });

        // Etapes :
        $.each($('.etapeContenu'), function () {
            let noEtape = parseInt($(this).attr('noEtape'));
            let contenu = $(this).val();

            let jsonEtape = {
                "etape": noEtape,
                "contenu": contenu
            }
            reponsesFormulaire.etapes.push(jsonEtape);
        });

        $.ajax({
            type: 'post',
            url: 'creation_recette_tr.php',
            data: {
                creationRecette: true,
                reponsesFormulaire
            },
            success: function (data) {
                data = $.parseJSON(data);
                $('.retourAjax').html("<div class='alert alert-info'>" + data + "</div>")
            }
        })

        console.log(reponsesFormulaire);
    });

    /**
     * Permet de récupérer le numéro d'étape maximum pour pouvoir créer une nouvelle étape qui sera ce nombre + 1.
     */
    function recupMaxEtape() {
        let etapes = [];
        $.each($('.etapeContenu'), function () {
            etapes.push(parseInt($(this).attr('noEtape')));
        });
        return Math.max.apply(null, etapes);
    }

    /**
     * Permet de remplacer les numéros d'étapes par les bons numéros en cas de suppression d'une étape.
     */
    function remplacerEtapes() {
        let i = 1;
        $.each($('.etape'), function () {
            $(this).find('.etapeContenu').attr('noEtape', i);
            $(this).find('.badge').html("&nbsp;" + i + "&nbsp;");
            i++;
        });
    }

});