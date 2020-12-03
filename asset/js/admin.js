$(document).ready(function () {
 let table = $('#example').DataTable({
        "ajax": {
            "url": "admin_tr.php",
            type: 'post',
            data: {
                'action': 'datatable',

            }
        },
        "columnDefs": [{
            "targets": -1,
            "data": data,
            "defaultContent": "<button>Click!</button>"
        }]
    });

    $('#example tbody').on('click', 'button', function () {
        var data = table.row($(this).parents('tr')).data();
        alert(data[0] + "'s salary is: " + data[5]);
    });
});
