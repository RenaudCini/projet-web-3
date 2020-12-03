$(document).ready(function () {

    let root_path = 'http://lesrecettesdudeveloppeur.test/';

    /* ____________________________________________________________
     *
     *                   CONNEXION/INSCRIPTION
     * ____________________________________________________________ 
     */

    /* Affichage plus net du modal d'inscription par dessus le modal de connexion 
     * Affichage plus net du modal de connexion lorsque l'utilisateur s'inscrit et qu'il clique ensuite sur le lien "Connectez-vous"
     * depuis le modal d'inscription
     */
    var show_modal_inscription = false;
    var show_modal_connexion = false;

    $('#modal_connexion').on('hidden.bs.modal', function () {
        if (show_modal_inscription) {
            $('#modal_inscription').modal('show');
            show_modal_inscription = false;
        }
    });

    $('#modal_inscription').on('hidden.bs.modal', function () {
        if (show_modal_connexion) {
            $('#modal_connexion').modal('show');
            show_modal_connexion = false;
        }
    });

    $('#modal_connexion #lien_inscription').on('click', function () {
        $('#modal_connexion').modal('hide');
        show_modal_inscription = true;
    });

    // Fermeture du modal inscription et ouverture du modal connexion (délégation pour le lien généré par AJAX après inscription)
    $('body').on('click', '#lien_connexion', function () {
        $('#modal_inscription').modal('hide');
        show_modal_connexion = true;
    })

    // Inscription
    $('#modal_inscription').on('click', '#btn_envoi_inscription', function () {
        if (
            $('#form_modal_inscription #pseudo').val() == '' ||
            $('#form_modal_inscription #email').val() == '' ||
            $('#form_modal_inscription #mot_de_passe').val() == '' ||
            $('#form_modal_inscription #mot_de_passe_confirm').val() == ''
        ) {
            $('#modal_inscription .info_erreur').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Veuillez remplir tous les champs.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            $.ajax({
                url: location.origin + "/utilisateurs/inscription.php",
                type: 'post',
                data: {
                    validation_user: true,
                    pseudo: $('#form_modal_inscription #pseudo').val(),
                    email: $('#form_modal_inscription #email').val(),
                    mot_de_passe: $('#form_modal_inscription #mot_de_passe').val(),
                    mot_de_passe_confirm: $('#form_modal_inscription #mot_de_passe_confirm').val()
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    if (data.type_alert == 'success') {
                        $('#modal_inscription .info_erreur').html('<div class="alert alert-' + data.type_alert +
                            ' alert-dismissible fade show" role="alert">' + data.message +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                    } else {
                        $('#modal_inscription .info_erreur').html('<div class="alert alert-' + data.type_alert +
                            ' alert-dismissible fade show" role="alert">' + data.message +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                },
                error: function () {
                    $('#modal_connexion .info_erreur').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'Une erreur est survenue. Veuillez réessayer.' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
            });
        }
    });

    // Connexion
    $('#modal_connexion').on('click', '#btn_envoi_connexion', function () {
        if (
            $('#form_modal_connexion #pseudo').val() == '' ||
            $('#form_modal_connexion #mot_de_passe').val() == ''
        ) {
            $('#modal_connexion .info_erreur').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Veuillez remplir tous les champs.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            $.ajax({
                url: location.origin + "/utilisateurs/connexion.php",
                type: 'post',
                async: false,
                data: {
                    connect_user: true,
                    pseudo: $('#form_modal_connexion #pseudo').val(),
                    mot_de_passe: $('#form_modal_connexion #mot_de_passe').val()
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    if (data.type_alert == 'success') {
                        location.reload();
                    } else {
                        $('#modal_connexion .info_erreur').html('<div class="alert alert-' + data.type_alert +
                            ' alert-dismissible fade show" role="alert">' + data.message +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                },
                error: function () {
                    $('#modal_connexion .info_erreur').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'Une erreur est survenue. Veuillez réessayer.' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
            });
        }
    });

    // Déconnexion
    $('#btnLogout').on('click', function () {
        $.ajax({
            url: "/utilisateurs/connexion.php",
            type: 'post',
            async: false,
            data: {
                logout_user: true
            },
            success: function (data) {
                window.location.replace("/index.php");
            },
            error: function () {
                location.reload();
            }
        });
    })

});