<?php
session_start();

require_once 'admin_sc.php';

if (isset($_POST['action']) && $_POST['action'] === 'datatable') {
    $admin = new admin_sc();

    $data = $admin->afficherToutUtilisateur();


    echo json_encode(['data' => $data]);
} else if (isset($_POST['modifierUtilisateur'], $_POST['id'], $_POST['role'], $_POST['actif'])) {

    $model = new admin_sc();

    $id = intval($_POST['id']);
    $role = intval($_POST['role']);
    $actif = intval($_POST['actif']);

    if ($model->modifierUtilisateur($id, $role, $actif)) {
        echo json_encode('ok');
    }
}
