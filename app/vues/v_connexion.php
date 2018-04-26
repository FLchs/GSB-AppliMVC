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
    <div class="col-md-8 col-md-offset-2">
      <div class="jumbotron">
        <h2 class="h2 text-center">Bienvenue sur l'Intranet du Laboratoire Galaxy-Swiss Bourdin</h2>
        <p><h4 class="h4 text-center">Quel est votre profil:</h3></p>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <a class="btn btn-primary btn-lg" href="?uc=connexion&action=demandeConnexionVisiteur" role="button">
              <span class="glyphicon glyphicon-briefcase"></span>
              <br>
              Visiteur
          </a>
          <a class="btn btn-warning btn-lg" href="?uc=connexion&action=demandeConnexionComptable" role="button">
              <span class="glyphicon glyphicon-folder-open"></span>
              <br>
              Comptable
          </a>
        </div>
      </div>
    </div>
</div>
