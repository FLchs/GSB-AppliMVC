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
namespace ns;
?>

<div class="row">
    <div class="col-md-12">
        <h1 class="yellow">Valider la ficher des frais</h1>
    </div>
</div>


<div class="panel panel-primary">
    <div class="panel-heading">Fiche de frais du mois
        <?php echo $numMois . '-' . $numAnnee ?> : </div>
    <div class="panel-body">
        <strong><u>Etat :</u></strong> <?php echo $libEtat ?>
        depuis le <?php echo $dateModif ?> <br>
        <strong><u>Montant validé :</u></strong> <?php echo $montantValide ?>
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
            <th>Frais Kilométriques</th>
        </tr>
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $quantite = $unFraisForfait['quantite']; ?>
                <td class="qteForfait"><?php echo $quantite ?> </td>
                <?php
            }
            ?>
            <td><?php echo $fraisKilometriques; ?></td>
        </tr>
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
            <th class="action"></th>
        </tr>
        <?php
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $date = $unFraisHorsForfait['date'];
            $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
            $montant = $unFraisHorsForfait['montant'];
            $id = $unFraisHorsForfait['id']; ?>
            <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                <td><a href="./?uc=suivrepaiement&visiteur=<?php echo($idVisiteur);?>&mois=<?php echo($leMois);?>&id=<?php echo $id ?>&action=refuser"
                       onclick="return confirm('Voulez-vous vraiment refuser ce frais?');">Refuser ce frais</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>



<div class="row">
<?php if ($libEtat == 'Validée') { ?>
    <form action="./?uc=suivrepaiement&visiteur=<?php echo($idVisiteur);?>&mois=<?php echo($leMois);?>&action=mettreEnPaiement"
    method="post" role="form">
    <input type="hidden" name="uc" value="validerfichefrais">
        <div class="form-group col-md-12">
            <h3 class="yellow">Changer état :</h1>
            <button class="btn btn-warning" type="submit">
                <span class="glyphicon glyphicon-euro"></span>
                En paiement
            </button>
        </div>
    </form>
<?php } elseif ($libEtat == 'Mise en paiement') { ?>
    <form action="./?uc=suivrepaiement&visiteur=<?php echo($idVisiteur);?>&mois=<?php echo($leMois);?>&action=rembourser"
    method="post" role="form">
    <input type="hidden" name="uc" value="validerfichefrais">
        <div class="form-group col-md-12">
            <h3 class="yellow">Changer état :</h1>
            <button class="btn btn-success" type="submit">
                <span class="glyphicon glyphicon-retweet"></span>
                Remboursement émis
            </button>
        </div>
    </form>
<?php } ?>
</div>
