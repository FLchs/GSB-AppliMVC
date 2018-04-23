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
?>
<div class="row">
    <div class="col-md-12">
        <form action="./"
        method="get" role="form">
        <input type="hidden" name="uc" value="validerfichefrais">
            <div class="form-group col-md-5">
                <label for="lstMois" accesskey="n" class="col-md-5 inl-label">Choisir visiteur : </label>
                <div class="col-md-7">
                    <select id="lstMois" name="visiteur" class="form-control">
                        <?php
                        foreach ($lesVisiteurs as $visiteur) {
                            ?>
                            <option value="<?php echo($visiteur['id']);?>" <?php
                                if ($visiteur['id'] == $idVisiteur) {
                                    echo('selected ');
                                }
                             ?>> <?php echo($visiteur['nom'].' '.$visiteur['prenom']); ?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="lstMois" accesskey="n" class="col-md-3 inl-label">Mois : </label>
                <div class="col-md-8">

                    <select id="lstMois" name="mois" class="form-control">
                        <?php
                        foreach ($lesMois as $unMois) {
                            $mois = $unMois['mois'];
                            $numAnnee = $unMois['numAnnee'];
                            $numMois = $unMois['numMois'];
                                ?>
                                <option value="<?php echo $mois ?>" <?php
                                    if ($leMois == $mois) {
                                        echo('selected ');
                                    } elseif (!$lemois && $mois == date('Ym')) {
                                        echo('selected ');
                                    }
                                    ?>>
                                    <?php echo $numMois . '/' . $numAnnee ?> </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-2">
                <input id="ok" type="submit" value="Valider" class="btn btn-success"
                role="button">
            </div>

        </form>
    </div>
</div>
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
    <form action="./"
    method="get" role="form">
    <input type="hidden" name="uc" value="validerfichefrais">
        <div class="form-group col-md-6">
            <label for="lstMois" accesskey="n" class="col-md-5 inl-label">Nombre de justificatifs : </label>
            <div class="col-md-2">
                <input type="integer" id="libelle"
                   name="justificatif"
                   size="2" maxlength="3"
                   value=""
                   class="form-control">
            </div>
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-success" type="submit">Corriger</button>
            <button class="btn btn-danger" type="reset">Réinitialiser</button>
        </div>
    </form>
</div>
