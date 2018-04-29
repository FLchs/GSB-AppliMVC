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

// Si aucun mois n'est sélectionné, on choisi le mois en cours par defaut.
if (!$leMois) {
    $leMois = date('Ym');
}
// Si aucun visiteur n'est sélectionné, on choisi le premier par defaut.
if (!$idVisiteur) {
    $idVisiteur = $lesVisiteurs[0]['id'];
}

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
case 'validerMajFraisKilometriques':
    $idvehicule = filter_input(INPUT_POST, 'idvehicule', FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $distance = filter_input(INPUT_POST, 'distance', FILTER_VALIDATE_FLOAT);
    valideFraisKilometrique($distance);
    if (nbErreurs() != 0) {
        include 'vues/v_erreurs.php';
    } else {
        $pdo->majFraisKilometriques(
            $id,
            $idvehicule,
            $distance
        );
    }
    break;
case 'validerLaFiche':
    $pdo->majEtatFicheFrais($idVisiteur, $leMois, 'VA');
    break;
case 'supprimerFraisKilometrique':
    $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
    $pdo->supprimerFraisKilometrique($idFrais);
    break;
}
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
$lesFraisKilometriques = $pdo->getLesFraisKilometriques($idVisiteur, $leMois);
$lesVehicules = $pdo->getLesVehicules($idVisiteur);
$laFicheDeFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);

require 'vues/v_choisirVisiteurMois.php';
// Verifie si le visiteur posséde une fiche de frais pour le mois choisi
if (empty($laFicheDeFrais)) {
    ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
    include 'vues/v_erreurs.php';
} else {
    switch ($laFicheDeFrais['idEtat']) {
        case 'RB':
        ajouterErreur('Fiche déjà remboursée');
        include 'vues/v_erreurs.php';
            break;
        case 'VA':
        ajouterErreur('Attention fiche déjà validée');
        include 'vues/v_avertissement.php';
        require 'vues/v_validerFicheFrais.php';
            break;
        case 'CR':
        ajouterErreur('Fiche non clôturée');
        include 'vues/v_erreurs.php';
            break;
        case 'CL':
        require 'vues/v_validerFicheFrais.php';
            break;
    }
}
