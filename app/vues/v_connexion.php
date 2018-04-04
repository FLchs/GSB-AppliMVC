<?php
/**
 * Vue Connexion
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
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="jumbotron">
        <h2 class="h2 text-center">Bienvenue sur l'Intranet du Laboratoire Galaxy-Swiss Bourdin</h2>
        <p><h4 class="h4 text-center">Quel est votre profil:</h3></p>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <a class="btn btn-primary btn-lg" href="?uc=connexion&action=demandeConnexionVisiteur" role="button">Visiteur</a>
          <a class="btn btn-warning btn-lg" href="?uc=connexion&action=demandeConnexionComptable" role="button">Comptable</a>
        </div>
      </div>
    </div>
</div>
