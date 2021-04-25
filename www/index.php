<?php
/**
 * Index du projet GSB
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


require 'includes/fct.inc.php';
require 'includes/class.pdogsb.inc.php';
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
//var_dump($_SESSION);
if(isset($_SESSION['idVisiteur'])) {
    require 'vues/v_entete.php';
}
else {
    require 'vuesComptable/v_enteteComptable.php';
}

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
if ($uc && !$estConnecte) {
    $uc = 'connexion';
    
    
} elseif (empty($uc)) {
    $uc = 'accueil';
}
//var_dump($_SESSION);


if(isset($_SESSION['idVisiteur'])) {
   $uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
    switch ($uc) {
    case 'connexion':
        include 'controleurs/c_connexion.php';
        break;
    case 'accueil':
        include 'controleurs/c_accueil.php';
        break;
    case 'gererFrais':
        include 'controleurs/c_gererFrais.php';
        break;
    case 'etatFrais':
        include 'controleurs/c_etatFrais.php';
        break;
    case 'deconnexion':
        include 'controleurs/c_deconnexion.php';
        break;
    }
    require 'vues/v_pied.php';
}
else 
{
    switch ($uc) {
       
    case 'connexion':
        include 'controleurs/c_connexion.php';
        break;
    case 'accueil':
        include 'controleursComptable/c_accueilComptable.php';
        break;
    case 'deconnexion':
        include 'controleurs/c_deconnexion.php';
        break;
    case 'validerFicheFrais':
        include 'controleursComptable/c_validerFicheFrais.php';
        break;
    case 'suivrePaiement':
        include 'controleursComptable/c_suivrePaiementFicheFrais.php';
        }
}
echo "$uc";

