<?php
session_start();

require_once 'admin_sc.php';

if ($_POST['action'] === 'datatable') {
    $admin = new admin_sc();

   $data = $admin->afficherToutUtilisateur();
   echo json_encode(['respons'=>'sucess','data'=>$data]);
}



