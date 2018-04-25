<?php
/**
 * Gestion des frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    François Lachèse
 * @version   GIT: <0>
 * @link      https://github.com/FLchs/GSB-AppliMVC
 */
$idVisiteur = filter_input(INPUT_GET, 'visiteur', FILTER_SANITIZE_STRING);
$leMois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

$lesVisiteurs = $pdo->getLesVisiteurs();
$lesMois = $pdo->getTousLesMoisDisponibles();

// Si aucun mois n'est sélectionné, on choisi le mois en cours par defaut.
if (!$leMois) {
    $leMois = date('Ym');
}
$numAnnee = substr($leMois, 0, 4);
$numMois = substr($leMois, 4, 2);

// Si aucun visiteur n'est sélectionné, on choisi le premier par defaut.
if (!$idVisiteur) {
    $idVisiteur = $lesVisiteurs[0]['id'];
}

switch ($action) {
case 'mettreEnPaiement':
    $pdo->majEtatFicheFrais($idVisiteur, $leMois, 'RB');
    break;
}
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
$laFicheDeFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
$dateModif = dateAnglaisVersFrancais($laFicheDeFrais['dateModif']);
$libEtat = $laFicheDeFrais['libEtat'];
$montantValide = $laFicheDeFrais['montantValide'];
$nbJustificatifs = $laFicheDeFrais['nbJustificatifs'];

require 'vues/v_choisirVisiteurMois.php';

// Verifie si le visiteur posséde une fiche de frais pour le mois choisi
if (empty($laFicheDeFrais)) {
    ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
    include 'vues/v_erreurs.php';
} else {
    require 'vues/v_suivrePaiement.php';
}
