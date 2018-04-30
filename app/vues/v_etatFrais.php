<?php
/**
 * Vue État de Frais
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
namespace ns;
?>
<hr>
<div class="panel panel-primary">
    <div class="panel-heading">Fiche de frais du mois
        <?php echo $numMois . '-' . $numAnnee ?> : </div>
    <div class="panel-body">
        <div class="col-md-10">
            <strong><u>Etat :</u></strong> <?php echo $libEtat ?>
            depuis le <?php echo $dateModif ?> <br>
            <strong><u>Montant validé :</u></strong> <?php echo $montantValide ?>
        </div>
        <div class="col-md-2">
            <?php if ($idEtat == 'RB' ||$idEtat == 'MP') {?>
                <a class="btn btn-primary" href="index.php?uc=genererPdf&leMois=<?php echo $leMois; ?>" role="button" target="_blank"><span class="glyphicon glyphicon-save"></span> Telécharger PDF</a>
            <?php } ?>
        </div>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">Eléments forfaitisés</div>
    <table class="table table-bordered table-responsive">
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $libelle = $unFraisForfait['libelle']; ?>
                <th> <?php echo htmlspecialchars($libelle) ?></th>
                <?php
            }
            ?>
        </tr>
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $quantite = $unFraisForfait['quantite']; ?>
                <td class="qteForfait"><?php echo $quantite ?> </td>
                <?php
            }
            ?>
        </tr>
    </table>
</div>


<div class="panel panel-info">
    <div class="panel-heading">Frais Kilométrique</div>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th class="date">Véhicule</th>
                <th class="libelle">Distance</th>
                <th class="montant">Montant</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($lesFraisKilometriques as $unFraisKilometriques) {
            $libelle = htmlspecialchars($unFraisKilometriques['libelle']);
            $id = $unFraisKilometriques['id'];
            $vehicule = $unFraisKilometriques['vehicule'];
            $distance = $unFraisKilometriques['distance'];
            $montant = $unFraisKilometriques['montant'];?>
             <tr>
                 <td> <?php echo $vehicule ?></td>
                 <td> <?php echo $distance ?></td>
                 <td> <?php echo $montant ?></td>
             </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<div class="panel panel-info">
    <div class="panel-heading">Descriptif des éléments hors forfait -
        <?php echo $nbJustificatifs ?> justificatifs reçus</div>
    <table class="table table-bordered table-responsive">
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>
        </tr>
        <?php
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $date = $unFraisHorsForfait['date'];
            $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
            $montant = $unFraisHorsForfait['montant']; ?>
            <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
