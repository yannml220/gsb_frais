<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$action =  filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ;
switch ($action){

    case 'selectionnerFiche':
        
  
            $lesVisiteurs = $pdo->getLesVisiteursDisponibles();

            include 'vuesComptable/v_selectionnerFicheFraisValidee.php';
          
            break;
    case 'accederFicheFraisValidee':  
        $lastVisiteurId = filter_input(INPUT_GET, 'lastVisiteurId', FILTER_SANITIZE_STRING);
        //var_dump($lastVisiteurId);
            $nom = $pdo->getNameVisiteur($lastVisiteurId);
            $prenom = $pdo->getFirstNameVisiteur($lastVisiteurId);
           // var_dump($nom);
        

            $leMois = $_GET['lstMois'];
            
       
            
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($lastVisiteurId, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($lastVisiteurId, $leMois);
            //var_dump($lesFraisForfait);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($lastVisiteurId, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
            
            //var_dump($lastVisiteurId);
            //var_dump($leMois);
            //var_dump($lesFraisForfait);
            $listeDesEtats = $pdo->getListeEtats();
            $optionsEtats[] = array();
            $optionsEtats = array('PA','RB');
            
           
            $lesClesEtat = array_keys($listeDesEtats);
            $etatPreSelectionne = $lesClesEtat[1];

            $result[] = array();
            
            include 'vuesComptable/v_detailFicheFraisValidee.php';
            include 'vuesComptable/v_listeFraisHorsForfaitComptable.php';
           
            $loopAgain = false ;
            break;
        
        case 'modifierEtatFicheValidee':
            $lastVisiteurId = filter_input(INPUT_GET, 'lastVisiteurId', FILTER_SANITIZE_STRING);
            $lemois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
            $etat = filter_input(INPUT_POST ,'listeEtats', FILTER_SANITIZE_STRING);
            
            
                //$pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);//modifier les lignes de frais 
               // $lemontant = $pdo->calculeMontantTotal($lastVisiteurId,$lemois);//modifier le montant
            $pdo->majEtatFicheFrais($lastVisiteurId, $lemois, $etat); //met à jour l'état de la fiche 
            //var_dump($lemontant);
                //$pdo->ComptableMajFicheFrais($lastVisiteurId);
        
            /*
            var_dump($_POST);
            var_dump($etat);
            var_dump($lemois);
            var_dump($lastVisiteurId);
            var_dump($_POST);*/
            
            
            $lesFrais = $_POST;
            //$pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);
            //$lemontant = $pdo->calculeMontantTotal($lastVisiteurId,$lemois);
            //var_dump($lemontant);
            //$pdo->majEtatFicheFrais($lastVisiteurId, $lemois, $etat); //ajouter une condition pour pouvoir ne modif que le mois et pas l'état si la fiche était déjà validée
            //$pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);
            break;
            

             
    
}

?>