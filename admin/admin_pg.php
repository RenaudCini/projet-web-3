
<?php
session_start();
if (isset($_SESSION['id'])) :

require_once 'admin_sc.php';
$titrePage = 'Administration';
$js[] = 'admin.js';


require_once '../template/view/nav.php';

?>

<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>id</th>
        <th>pseudo</th>
        <th>mail</th>
        <th>mdp</th>
        <th>date_inscription</th>
        <th>id_roles</th>
        <th>actif</th>
    </tr>
    </thead>
</table>
    <?php
    require_once '../template/view/footer.php';

else :
    header('Location: /acces_restreint.php');
endif;
?>
