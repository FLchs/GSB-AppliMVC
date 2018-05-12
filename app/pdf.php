<?php
/**
 * Generation de fiche de frais au format PDF
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    François Lachèse
 * @version   GIT: <0>
 * @link      https://github.com/FLchs/GSB-AppliMVC
 */

require_once 'includes/fct.inc.php';
require_once 'includes/class.pdogsb.inc.php';
session_start();
require('includes/fpdf.php');

$pdo = PdoGsb::getPdoGsb();
$estVisiteur = estConnecteVisiteur();

if (!$estVisiteur) {
    header('Location: index.php');
} else {
    $idVisiteur = $_SESSION['idVisiteur'];

    $leMois = filter_input(INPUT_GET, 'leMois', FILTER_SANITIZE_STRING);
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
    $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
    $lesFraisKilometriques = $pdo->getLesFraisKilometriques($idVisiteur, $leMois);
    $numAnnee = substr($leMois, 0, 4);
    $numMois = substr($leMois, 4, 2);
    $libEtat = $lesInfosFicheFrais['libEtat'];
    $montantValide = $lesInfosFicheFrais['montantValide'];
    $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
    $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);

    // Données affichées
    $nomPrenom = $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
    $dateFiche = getNomDuMois($numMois) . ' ' . $numAnnee;
    $totalFiche = 0;

    // Configuration du document
    $tailleLogo = "50";
    $largeurPage = "210";
    $tiersPage = (($largeurPage-20)/3); // Le 20 corespond aux marges
    $quartPage = (($largeurPage-20)/4); // Le 20 corespond aux marges
    $positionLogo=(210-$tailleLogo)/2; // Pour centrer le logo

    // Création du PDF
    $pdf = new FPDF();
    $pdf->AddPage('P', 'A4');
    $pdf->SetFont('Arial', 'B', 16);

    // Affichage du logo
    $pdf->Image('images/logo.jpg', $positionLogo, 5, $tailleLogo);
    $pdf->ln($tailleLogo);

    $pdf->SetTextColor(31, 73, 125);
    $pdf->Cell(0, 12, 'REMBOURSEMENT DE FRAIS ENGAGES', 1, 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell($tiersPage, 12, 'Visiteur : ');
    $pdf->Cell($tiersPage, 12, $idVisiteur);
    $pdf->Cell($tiersPage, 12, $nomPrenom, 0, 1);
    $pdf->Cell($tiersPage, 12, 'Mois : ');
    $pdf->Cell($tiersPage, 12, $dateFiche, 0, 1);

    $pdf->SetFont('Times', 'BI', 11);
    $pdf->SetTextColor(31, 73, 125);
    $pdf->SetDrawColor(31, 73, 125);
    $pdf->Cell($quartPage, 12, 'Frais forfaitaires', 'L T B', 0, 'C');
    $pdf->Cell($quartPage, 12, utf8_decode('Quantité'), 'T B', 0, 'C');
    $pdf->Cell($quartPage, 12, 'Montant unitaire', 'T B', 0, 'C');
    $pdf->Cell($quartPage, 12, 'Total', 'T B R', 1, 'C');


    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Times', '', 11);
    foreach ($lesFraisForfait as $unFraisForfait) {
        $libelle = utf8_decode($unFraisForfait['libelle']);
        $quantite = utf8_decode($unFraisForfait['quantite']);
        if ($quantite > 0) { // Inutile d'affiche si la quantité est nulle
            $montant = utf8_decode($unFraisForfait['montant']);
            $total = utf8_decode($unFraisForfait['total']);
            // Addition au total
            $totalFiche += number_format($total, 2, '.', '');
            // Affichage
            $pdf->Cell($quartPage, 12, $libelle, '1', 0, 'L');
            $pdf->Cell($quartPage, 12, $quantite, '1', 0, 'R');
            $pdf->Cell($quartPage, 12, $montant, '1', 0, 'R');
            $pdf->Cell($quartPage, 12, $total, '1', 1, 'R');
        }
    }
    $pdf->Cell(0, 12, utf8_decode('Frais kilométrique'), '1', 1, 'L');

    foreach ($lesFraisKilometriques as $unFraisKilometriques) {
        $vehicule = $unFraisKilometriques['vehicule'];
        $distance = $unFraisKilometriques['distance'];
        $montant = $unFraisKilometriques['montant'];
        $bareme = $unFraisKilometriques['bareme'];
        // Addition au total
        $totalFiche += number_format($montant, 2, '.', '');
        // Affichage
        $pdf->Cell($quartPage, 12, $vehicule, '1', 0, 'L');
        $pdf->Cell($quartPage, 12, $distance, '1', 0, 'R');
        $pdf->Cell($quartPage, 12, $bareme, '1', 0, 'R');
        $pdf->Cell($quartPage, 12, $montant, '1', 1, 'R');
    }

    $pdf->SetFont('Times', 'BI', 11);
    $pdf->SetTextColor(31, 73, 125);
    $pdf->Cell(0, 20, '', 'L T R', 1, 'C');
    $pdf->Cell(0, 15, 'Autres frais', 'L B R', 1, 'C');

    $pdf->Cell($tiersPage, 12, 'Frais forfaitaires', 'L T B', 0, 'C');
    $pdf->Cell($tiersPage, 12, utf8_decode('Quantité'), 'T B', 0, 'C');
    $pdf->Cell($tiersPage, 12, 'Montant unitaire', 'T B R', 1, 'C');

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Times', '', 11);

    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
        $date = $unFraisHorsForfait['date'];
        $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
        $montant = $unFraisHorsForfait['montant'];
        // Addition au total
        $totalFiche += number_format($montant, 2, '.', '');
        // Affichage
        $pdf->Cell($tiersPage, 12, $date, '1', 0, 'L');
        $pdf->Cell($tiersPage, 12, $libelle, '1', 0, 'L');
        $pdf->Cell($tiersPage, 12, $montant, '1', 1, 'R');
    }

    $pdf->ln();
    $pdf->Cell(2*$quartPage, 12, '');
    $pdf->Cell($quartPage, 12, 'TOTAL 07/2017', '1', 0, 'L');
    $pdf->Cell($quartPage, 12, $totalFiche, '1', 1, 'R');
    $pdf->ln();
    // Évite que la signature soit seule sur la nouvelle page
    if ($pdf->GetY() > 250) {
        $pdf->AddPage('P', 'A4');
    }
    $pdf->Cell(2*$tiersPage, 12, '');
    $pdf->Cell($quartPage, 12, 'Fait a Paris, le '.getDateEnLettres($lesInfosFicheFrais['dateModif']), '0', 1, 'L');
    $pdf->Cell(2*$tiersPage, 12, '');
    $pdf->Cell($quartPage, 12, 'Vu l\'agent comptable', '0', 1, 'L');
    $pdf->Cell(2*$tiersPage, 12, '');
    $pdf->Image('images/signature-comptable.jpg');
    $pdf->Output();
    //$pdf->Output('F', 'save/file.pdf'); // Pour enregistrer
}
