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
<div class="row">
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
        <form method="post"
              action="./?uc=validerfichefrais&visiteur=<?php echo($idVisiteur);?>&mois=<?php echo($leMois);?>&action=validerMajFraisForfait"
              role="form">
            <fieldset>
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite']; ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais"
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5"
                               value="<?php echo $quantite ?>"
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                <button class="btn btn-success" type="submit">Corriger</button>
                <button class="btn btn-danger" type="reset">Réinitialiser</button>
            </fieldset>
        </form>
    </div>
</div>
<hr>
<div class="row">
        <div class="panel panel-info panel-info-yellow">
            <div class="panel-heading">Frais Kilométrique</div>
            <table class="table table-bordered-yellow table-responsive">
                <thead>
                    <tr>
                        <th class="date">Véhicule</th>
                        <th class="libelle">Distance</th>
                        <th class="action"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($lesFraisKilometriques as $unFraisKilometriques) {
                    $id = $unFraisKilometriques['id'];
                    $vehicule = $unFraisKilometriques['vehicule'];
                    $distance = $unFraisKilometriques['distance'];
                    $montant = $unFraisKilometriques['montant'];?>
                     <tr>
                         <form method="post"
                             action="./?uc=validerfichefrais&visiteur=<?php echo($idVisiteur);?>&mois=<?php echo($leMois);?>&action=validerMajFraisKilometriques"
                             role="form">
                             <input type="hidden" name="id" value="<?php echo $id ?>">
                             <fieldset>
                                 <td>
                                     <select name="idvehicule" class="form-control">
                                         <?php foreach ($lesVehicules as $unVehicule) { ?>
                                             <?php if ($unVehicule['immatriculation'] == $vehicule) { ?>
                                                 <option value="<?php echo $unVehicule['immatriculation']; ?>" selected><?php echo $unVehicule['immatriculation']; ?></option>
                                            <?php } else { ?>
                                                <option value=<?php echo $unVehicule['immatriculation']; ?>><?php echo $unVehicule['immatriculation']; ?></option>
                                            <?php }
                                                } ?>
                                   </select>
                                 </td>
                                 <td>
                                     <input type="text" id="distance"
                                        name="distance"
                                        size="10" maxlength="10"
                                        value="<?php echo $distance ?>"
                                        class="form-control">
                                 </td>
                                 <td>
                                     <input type="text" id="distance"
                                        name="distance"
                                        size="10" maxlength="10"
                                        value="<?php echo $montant ?>"
                                        class="form-control" disabled>
                                 </td>
                                 <td>
                                     <button class="btn btn-success" type="submit">Corriger</button>
                                     <button class="btn btn-danger" type="reset">Réinitialiser</button>
                                 </td>
                             </fieldset>
                         </form>
                     </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
</div>
<div class="row">
    <div class="panel panel-info panel-info-yellow">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered-yellow table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>
                    <th class="montant">Montant</th>
                    <th class="action">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id']; ?>
                <tr>
                    <form method="post"
                        action="./?uc=validerfichefrais&visiteur=<?php echo($idVisiteur);?>&mois=<?php echo($leMois);?>&action=validerMajFraisHorsForfait"
                        role="form">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <fieldset>
                            <td>
                                <input type="text" id="date"
                                   name="dateFrais"
                                   size="10" maxlength="10"
                                   value="<?php echo $date ?>"
                                   class="form-control">
                            </td>
                            <td>
                                <input type="text" id="libelle"
                                   name="libelle"
                                   size="10" maxlength="10"
                                   value="<?php echo $libelle ?>"
                                   class="form-control">
                            </td>
                            <td>
                                <input type="text" id="montant"
                                   name="montant"
                                   size="10" maxlength="10"
                                   value="<?php echo $montant ?>"
                                   class="form-control">
                            </td>
                            <td>
                                <button class="btn btn-success" type="submit">Corriger</button>
                                <button class="btn btn-danger" type="reset">Réinitialiser</button>
                            </td>
                        </fieldset>
                    </form>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <form action="./?uc=validerfichefrais&visiteur=<?php echo($idVisiteur);?>&mois=<?php echo($leMois);?>&action=validerLaFiche"
    method="post" role="form">
    <input type="hidden" name="uc" value="validerfichefrais">
        <div class="form-group col-md-6">
            <label for="lstMois" accesskey="n" class="col-md-5 inl-label">Nombre de justificatifs : </label>
            <div class="col-md-2">
                <input type="integer" id="libelle"
                   name="justificatif"
                   size="2" maxlength="3"
                   value="<?php echo $laFicheDeFrais['nbJustificatifs'] ?>"
                   class="form-control">
            </div>
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-success" type="submit">Valider</button>
            <button class="btn btn-danger" type="reset">Réinitialiser</button>
        </div>
    </form>
</div>
