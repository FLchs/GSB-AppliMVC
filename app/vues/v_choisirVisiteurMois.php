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
        <form action="./"
        method="get" role="form">
        <input type="hidden" name="uc" value="<?php echo $uc; ?>">
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
                            $nAnnee = $unMois['numAnnee'];
                            $nMois = $unMois['numMois'];
                                ?>
                                <option value="<?php echo $mois ?>" <?php
                                    if ($leMois == $mois) {
                                        echo('selected ');
                                    }
                                    ?>>
                                    <?php echo $nMois . '/' . $nAnnee ?> </option>
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
