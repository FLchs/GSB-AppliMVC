<?php
/**
 * Index du projet GSB
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

require_once 'includes/fct.inc.php';
require_once 'includes/class.pdogsb.inc.php';
session_start();
$pdo = PdoGsb::getPdoGsb();
$estComptable = estConnecteComptable();
$estVisiteur = estConnecteVisiteur();
$estConnecte = $estVisiteur || $estComptable ? true : false;
// Début de la mise en tampon pour éviter les avertissements du type "Warning: Cannot modify header information - headers already sent".
// En attente d'une solution plus élégante via réecriture du routage.
ob_start();
require 'vues/v_entete.php';
$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
if (!$estConnecte) {
    include 'controleurs/c_connexion.php';
} elseif (empty($uc)) {
    $uc = 'accueil';
}
// Routes communes à tous les utilisateurs connectés
if ($estConnecte) {
    switch ($uc) {
    case 'connexion':
        include 'controleurs/c_connexion.php';
        break;
    case 'accueil':
        include 'controleurs/c_accueil.php';
        break;
    case 'deconnexion':
        include 'controleurs/c_deconnexion.php';
        break;
    }
}
// Routes reservées aux visiteurs
if ($estVisiteur) {
    switch ($uc) {
    case 'gererFrais':
        include 'controleurs/c_gererFrais.php';
        break;
    case 'etatFrais':
        include 'controleurs/c_etatFrais.php';
        break;
    case 'genererPdf':
        $leMois = filter_input(INPUT_GET, 'leMois', FILTER_SANITIZE_STRING);
        include 'controleurs/c_genererPdf.php';
        break;
    }
}
// Routes reservées aux comptables
if ($estComptable) {
    switch ($uc) {
    case 'validerfichefrais':
        include 'controleurs/c_validerFicheFrais.php';
        break;
    case 'suivrepaiement':
        include 'controleurs/c_suivrePaiement.php';
        break;
    }
}

// fin de la mise en tampon.
ob_end_flush();
require 'vues/v_pied.php';
