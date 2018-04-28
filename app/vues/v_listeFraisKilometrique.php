<?php
/**
 * Vue liste des frais kilométrique
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
<hr>
<div class="row">
    <div class="col-md-10">
        <div class="panel panel-info">
            <div class="panel-heading">Frais Kilométrique</div>
            <table class="table table-bordered table-responsive">
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
                    $libelle = htmlspecialchars($unFraisKilometriques['libelle']);
                    $id = $unFraisKilometriques['id'];
                    $vehicule = $unFraisKilometriques['idvehicule'];
                    $distance = $unFraisKilometriques['distance'];?>
                     <tr>
                         <td> <?php echo $vehicule ?></td>
                         <td> <?php echo $distance ?></td>
                         <td><a href="index.php?uc=gererFrais&action=supprimerFraisKilometrique&idFrais=<?php echo $id ?>"
                                onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
                     </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <h3>Nouveau frais kilométrique</h3>
    <div class="col-md-2">
        <form action="index.php?uc=gererFrais&action=validerCreationFraisKilometrique"
              method="post" role="form">
              <div class="form-group">
                <label for="exampleInputName2">Puissance fiscale</label>
                <select name="idvehicule" class="form-control">
                  <option>AA-123-AA</option>
                  <option>AB-123-AB</option>
              </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail2">Distance</label>
                <input type="text" name="distance" class="form-control" id="exampleInputEmail2" placeholder="0">
              </div>
            <button class="btn btn-success" type="submit">Ajouter</button>
            <button class="btn btn-danger" type="reset">Effacer</button>
        </form>
    </div>
</div>
