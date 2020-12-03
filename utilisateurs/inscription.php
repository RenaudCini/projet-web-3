<?php

require_once '../template/bdd.php';

/**
 * Vérifie si le pseudo existe déjà en BDD.
 * @param string $pseudo Le pseudo à vérifier.
 * @return int Le nombre d'occurrences du pseudo en BDD.
 */
function checkPseudo($pseudo)
{
    $bdd = new BDD;
    $result = $bdd->selectUneDonne('SELECT COUNT(*) as nb_occurences FROM utilisateurs WHERE pseudo = :pseudo', ['pseudo' => $pseudo]);
    return intval($result['nb_occurences']);
}

/**
 * Vérifie si l'adresse email existe déjà en BDD.
 * @param string $email L'adresse email à vérifier.
 * @return int Le nombre d'occurrences de l'email en BDD.
 */
function checkEmail($mail)
{
    $bdd = new BDD;
    $result = $bdd->selectUneDonne('SELECT COUNT(*) as nb_occurences FROM utilisateurs WHERE mail = :mail', ['mail' => $mail]);
    return intval($result['nb_occurences']);
}

/**
 * Insère l'utilisateur en BDD.
 * @param string $pseudo Le pseudo de l'utilisateur.
 * @param string $email L'adresse email de l'utilisateur.
 * @param string $mot_de_passe Le mot de passe de l'utilisateur.
 * @return array Array comprenant le type d'alert et le message à afficher.
 */
function insertUtilisateur($pseudo, $email, $mot_de_passe)
{
    $bdd = new BDD;
    $query = $bdd->insertDonne(
        'utilisateurs',
        'pseudo, mail, mdp, date_inscription, id_roles',
        ':pseudo, :mail, :mdp, NOW(), :id_roles',
        [
            'pseudo' => htmlspecialchars($pseudo),
            'mail' => htmlspecialchars($email),
            'mdp' => password_hash($mot_de_passe, PASSWORD_DEFAULT),
            'id_roles' => '3'
        ]
    );
    if ($query) {
        $return = array(
            'type_alert' => 'success',
            'message' => 'Inscription validée. <b><a id="lien_connexion" href="#">Cliquez ici</a></b> pour vous connecter.'
        );
    } else {
        $return = array(
            'type_alert' => 'danger',
            'message' => 'Votre inscription n\'a pas pu être effectuée. Veuillez réessayer.'
        );
    }
    echo json_encode($return);
}

/* ____________________________________________________________________
 *
 *                     VALIDATION INSCRIPTION AJAX
 * ____________________________________________________________________
 */

// Si l'appel est OK :
if (isset($_POST['validation_user'])) {
    // Si on a bien un pseudo, mail, mdp et mdp confirm :
    if (isset($_POST['pseudo'], $_POST['email'], $_POST['mot_de_passe'], $_POST['mot_de_passe_confirm'])) {
        // Si les deux mots de passe renseignés sont bien identiques :
        if ($_POST['mot_de_passe'] == $_POST['mot_de_passe_confirm']) {
            // Si les infos du formulaire rentrent bien dans les limites fixées :

            // if (
            //     preg_match('#^[\w\.-]{1,25}$#', $_POST['pseudo']) && // Pseudo : (lettres.-_) 1 à 25
            //     preg_match('#^[\w\.-]{1,60}@[\w\.-]{2,60}\.[a-z]{2,4}$#', $_POST['email']) && // Email : (lettres.-_)[1 à 60] @ (lettres.-_) [2 à 60] . (lettres) 2 à 4
            //     preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,25}$/', $_POST['mot_de_passe']) // MDP : 1min, 1maj, 1chiffres, 1 carac spé (#?!@$%^&*-) min, 8 a 25
            // ) {
            $checkPseudo = checkPseudo($_POST['pseudo']);
            $checkEmail = checkEmail($_POST['email']);
            if ($checkPseudo == 0 && $checkEmail == 0) {
                insertUtilisateur($_POST['pseudo'], $_POST['email'], $_POST['mot_de_passe']);
            } else {
                $return = array(
                    'type_alert' => 'danger',
                    'message' => 'Votre inscription n\'a pas pu être effectuée, pour les motifs suivants : <ul>'
                );
                if ($checkPseudo > 0) {
                    $return['message'] .= '<li>Le pseudo est déjà pris.</li>';
                }
                if ($checkEmail > 0) {
                    $return['message'] .= '<li>L\'adresse email est déjà utilisée avec un autre compte.</li>';
                }
                $return['message'] .= '</ul>';
                echo json_encode($return);
            }
            // }
            // // Sinon, si les infos du formulaire ne rentrent pas dans les limites fixées :
            // else {
            //     $return = array(
            //         'type_alert' => 'danger',
            //         'message' => 'Votre inscription n\'a pas pu être effectuée, pour les motifs suivants : <ul>'
            //     );
            //     if (!preg_match('#^[\w\.-]{1,25}$#', $_POST['pseudo'])) {
            //         $return['message'] .= '<li>Votre <b>pseudo</b> doit être compris entre 1 et 25 caractères et ne contenir que des chiffres, lettres, 
            //         ou caractères spéciaux suivants : <br/><b>. - _</b></li>';
            //     }
            //     if (!preg_match('#^[\w\.-]{1,60}@[\w\.-]{2,60}\.[a-z]{2,4}$#', $_POST['email'])) {
            //         $return['message'] .= '<li>Votre <b>email</b> n\'est pas au bon format.</li>';
            //     }
            //     if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_.]).{8,25}$/', $_POST['mot_de_passe'])) {
            //         $return['message'] .= '<li>Votre <b>mot de passe</b> doit être compris entre 8 et 25 caractères et comprendre au moins 1 majuscule, 1 minuscule,
            //         1 chiffre et 1 caractère spécial parmi les suivants : <br/><b># ? ! @ $ % ^ & * . - _</b></li>';
            //     }
            //     $return['message'] .= '</ul>';
            //     echo json_encode($return);
            // }
        }
        // Sinon, si les deux mots de passe ne sont pas identiques :
        else {
            $return = array(
                'type_alert' => 'danger',
                'message' => 'Les deux mots de passe ne sont pas identiques. Veuillez réessayer.'
            );
            echo json_encode($return);
        }
    }
    // Sinon, si on n'a pas un pseudo, mail, mdp et mdp confirm :
    else {
        $return = array(
            'type_alert' => 'danger',
            'message' => 'Les champs obligatoires n\'ont pas été remplis. Veuillez réessayer.'
        );
        echo json_encode($return);
    }
}
