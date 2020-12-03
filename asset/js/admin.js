$(document).ready(function () {
    $('#example').DataTable({
        "processing": true,

        "ajax": {
            "url": "admin_tr.php",
            "type": 'post',
            "data": {
                'action': 'datatable',
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "pseudo" },
            { "data": "mail" },
            { "data": "date_inscription" },
            { "data": "derniere_connexion" },
            { "data": "id_roles" },
            { "data": "actif" },
            {
                "data": "button",
                'render': function (data) {
                    return data = "<button type='button' class='btn btn-sm btn-warning text-light buttonAdmin' data-toggle='modal' data-target='#modalUtilisateur'>Modifier</button>"

                }
            }
        ]
    });


    $('body').on('click', '.buttonAdmin', function () {
        let id = $(this).parent().parent().find('td:nth-child(1)').text();
        let role = $(this).parent().parent().find('td:nth-child(6)').text();
        let actif = $(this).parent().parent().find('td:nth-child(7)').text();
        console.log(id);

        $('#modalUtilisateur #role option[value="' + role + '"]').prop('selected', true);
        $('#modalUtilisateur #actif option[value="' + actif + '"]').prop('selected', true);

        $('#btnSauvegarderUtilisateur').attr('data-id', id);
    });

    $('#btnSauvegarderUtilisateur').click(function () {
        let id = $('#btnSauvegarderUtilisateur').attr('data-id');
        let role = $('#modalUtilisateur #role option:selected').val();
        let actif = $('#modalUtilisateur #actif option:selected').val();

        $.ajax({
            url: '/admin/admin_tr.php',
            type: 'post',
            data: {
                modifierUtilisateur: true,
                id,
                role,
                actif
            },
            success: function (data) {
                data = $.parseJSON(data);
                if (data == 'ok') {
                    window.location.reload();
                } else {
                    $('#ajaxAdminUtilisateurs').html('<div class="alert alert-info alert-dissmissible">'
                        + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                        + 'L\'utilisateur n\'a pas pu être modifié.'
                        + '</div>')
                }
            }
        })
    });
});

