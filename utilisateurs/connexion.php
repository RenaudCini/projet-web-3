<?php

session_start();

require_once '../template/bdd.php';

/**
 * Vérifie que l'utilisateur a rentré les bons identifiants.
 * @param string $pseudo Le pseudo à vérifier.
 * @param string $mot_de_passe Le mot de passe à vérifier.
 * @return array Array comprenant le type d'alerte à afficher et le message d'erreur (ce-dernier étant nul si succès).
 */
function connectUtilisateur($pseudo, $mot_de_passe)
{

    $bdd = new BDD;

    $result = $bdd->selectUneDonne('SELECT id, pseudo, mdp, id_roles FROM utilisateurs WHERE pseudo = :pseudo', ['pseudo' => $pseudo]);

    if (!$result) {
        $return = array(
            'type_alert' => 'danger',
            'message' => 'Pseudo ou mot de passe incorrect.'
        );
    } else {
        $checkPassword = password_verify($mot_de_passe, $result['mdp']);
        if ($checkPassword) {
            $return = array(
                'type_alert' => 'success'
            );
            $_SESSION['id'] = $result['id'];
            $_SESSION['pseudo'] = $result['pseudo'];
            $_SESSION['id_roles'] = $result['id_roles'];
        } else {
            $return = array(
                'type_alert' => 'danger',
                'message' => 'Pseudo ou mot de passe incorrect.'
            );
        }
    }

    echo json_encode($return);
}

/* ________________________________________________________________
 *
 *                               AJAX
 * ________________________________________________________________
 */

// Si on demande une connexion :
if (isset($_POST['connect_user'])) {
    // Si on a bien un pseudo et mdp renseignés :
    if (isset($_POST['pseudo'], $_POST['mot_de_passe'])) {
        connectUtilisateur($_POST['pseudo'], $_POST['mot_de_passe']);
    }
    // Sinon, si on n'a pas un pseudo et mdp renseignés :
    else {
        $return = array(
            'type_alert' => 'danger',
            'message' => 'Les champs obligatoires n\'ont pas été remplis. Veuillez réessayer.'
        );
        echo json_encode($return);
    }
}

// Si on demande une déconnexion :
else if (isset($_POST['logout_user'])) {
    session_destroy();
}
