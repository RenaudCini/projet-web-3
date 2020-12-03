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
            {"data": "pseudo"},
            {"data": "mail"},
            {"data": "date_inscription"},
            {"data": "derniere_connexion"},
            {"data": "id_roles"},
            {"data": "actif"},
            {
                "data": "button",
                'render': function (data) {
                    return data =
                "<button type='button' id=' + data + ' class='btn  btn-secondary buttonAdmin' data-toggle='modal' data-target='#exampleModal'>Modifer </button>"

                }
            }
        ]
    });


    $('body').on('click', '.buttonAdmin',function () {
        let button = $('.buttonAdmin ')


    });
});

