<?php

session_start();

require_once '../template/bdd.php';

function insererCommentaire($idRecettes, $idUtilisateur, $note, $contenu)
{
    $bdd = new BDD;
    $query = $bdd->insertDonne(
        'commentaires',
        'id_recettes, id_utilisateurs, note, contenu, date',
        ':id_recettes, :id_utilisateurs, :note, :contenu, NOW()',
        [
            'id_recettes' => htmlspecialchars($idRecettes),
            'id_utilisateurs' => $idUtilisateur,
            'note' => $note,
            'contenu' => htmlspecialchars($contenu),
        ]
    );
    if ($query) {
        return 'ok';
    } else {
        return 'ko';
    }
}

/* ________________________________________________________
 *
 *                     TRAITEMENT AJAX
 * ________________________________________________________
 */

if ($_POST['insererCommentaire'] && $_SESSION['id'] && $_POST['idRecettes'] && $_POST['note'] && $_POST['contenu']) {
    $return = insererCommentaire($_POST['idRecettes'], $_SESSION['id'],  $_POST['note'], $_POST['contenu']);
    echo json_encode($return);
}
