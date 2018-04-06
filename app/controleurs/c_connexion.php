<?php
/**
 * Gestion de la connexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);

if (!$uc) {
    $uc = 'demandeConnexionVisiteur';
}

switch ($action) {
case 'demandeConnexionVisiteur':
    include 'vues/v_connexionVisiteur.php';
    break;
case 'demandeConnexionComptable':
    include 'vues/v_connexionComptable.php';
    break;
case 'valideConnexion':
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
    $utilisateur = $pdo->getInfosUtilisateur($type, $login, $mdp);
    if ($type == 'visiteur') {
        if (!is_array($utilisateur)) {
            ajouterErreur('Login ou mot de passe incorrect');
            include 'vues/v_erreurs.php';
            include 'vues/v_connexionVisiteur.php';
        } else {
            $id = $utilisateur['id'];
            $nom = $utilisateur['nom'];
            $prenom = $utilisateur['prenom'];
            connecterVisiteur($id, $nom, $prenom);
            header('Location: index.php');
        }
    } else if ($type == 'comptable') {
        if (!is_array($utilisateur)) {
            ajouterErreur('Login ou mot de passe incorrect');
            include 'vues/v_erreurs.php';
            include 'vues/v_connexionComptable.php';
        } else {
            $id = $utilisateur['id'];
            $nom = $utilisateur['nom'];
            $prenom = $utilisateur['prenom'];
            connecterComptable($id, $nom, $prenom);
            header('Location: index.php');
        }
    } else {
        // Affiche une erreur si un malin modifie le formulaire pour enlever le type d'utilisateur au lieu d'une page blanche.
        ajouterErreur('Seuls les visiteurs et les comptables peuvent se connecter.');
        include 'vues/v_erreurs.php';
        include 'vues/v_connexion.php';
    }

    break;
default:
    include 'vues/v_connexion.php';
    break;
}
