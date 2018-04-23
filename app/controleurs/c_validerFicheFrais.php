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
$pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
switch ($action) {
case 'validerMajFraisForfait':
    $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
    if (lesQteFraisValides($lesFrais)) {
        if ($pdo->estPremierFraisMois($idVisiteur, $leMois)) {
            $pdo->creeNouvellesLignesFrais($idVisiteur, $leMois);
        }
        $pdo->majFraisForfait($idVisiteur, $leMois, $lesFrais);
    } else {
        ajouterErreur('Les valeurs des frais doivent être numériques');
        include 'vues/v_erreurs.php';
    }
    break;
case 'validerMajFraisHorsForfait':
    $dateFrais = filter_input(INPUT_POST, 'dateFrais', FILTER_SANITIZE_STRING);
    $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
    $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_FLOAT);
    valideInfosFrais($dateFrais, $libelle, $montant);
    if (nbErreurs() != 0) {
        include 'vues/v_erreurs.php';
    } else {
        $pdo->majFraisHorsForfait(
            $libelle,
            $dateFrais,
            $montant,
            $id
        );
    }
    break;
}
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);

require 'vues/v_validerFicheFrais.php';
