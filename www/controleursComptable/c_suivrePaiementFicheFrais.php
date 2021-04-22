<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//$action =  filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ;
$action =  filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ;
switch ($action){

    case 'selectionnerFiche':
        
        /*echo 'bonjour tout le monde';
        $index = 0;
        $infos = $pdo->getFichesFraisEtatVa();*/
        
        //var_dump($infos[0]);
       /*$idVisiteur = $infosFiche[$index]['idVisiteur'];
        $mois = $infosFiche[$index]['mois'];
        $montant = $infosFiche[$index]['montant'];*/
        //include 'vuesComptable/v_selectionnerFiche.php';
        $lesVisiteurs = $pdo->getLesVisiteursDisponibles();
            $lesCles = array_keys($lesVisiteurs);
            $visiteurToSelect = $lesCles[26];
            $visiteurSelectionne = $_POST['lastVisiteur'];
            $visiteurId = $pdo->getLeVisiteurId($visiteurSelectionne);
            $leId = $visiteurId[0]['id'];


                //var_dump($visiteurId);
            //var_dump($leId);
            //var_dump($visiteurSelectionne);
            $lesMois = $pdo->getLesMoisDisponiblesFicheValidee($leId);
            $formAction = "index.php?uc=suivrePaiement&action=accederFicheFraisValidee&lastVisiteurId=$leId";
            $ajaxformAction = "index.php?uc=suivrePaiement&action=accederFicheFraisValidee";
            if(empty($lesMois)){
                //$formAction = "#";
                $disabled = "true";
                echo 'les mois sont vides';
            }
            else
            {
                //$formAction = "index.php?uc=validerFicheFrais&action=accederFicheFrais&lastVisiteurId=$leId";
                $disabled = "false";
            }



            //var_dump($lesMois);  //si il existe des mois pour le visiteur selectionné on les affiches à partir du dernier


            if(!($lesMois == null)){
                $lesClesMois = array_keys($lesMois);
                $moisASelectionner = $lesClesMois[0];
             }
            include 'vuesComptable/v_selectionnerFicheFraisValidee.php';
            $loopAgain = false ;
            break;
    case 'accederFicheFraisValidee':  
        $lastVisiteurId = filter_input(INPUT_GET, 'lastVisiteurId', FILTER_SANITIZE_STRING);
        var_dump($lastVisiteurId);
            $nom = $pdo->getNameVisiteur($lastVisiteurId);
            $prenom = $pdo->getFirstNameVisiteur($lastVisiteurId);
            var_dump($nom);
            //$leMois = filter_input(INPUT_GET, 'lastMois', FILTER_SANITIZE_STRING);

            $leMois = $_GET['lstMois'];
            
       
            
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($lastVisiteurId, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($lastVisiteurId, $leMois);
            var_dump($lesFraisForfait);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($lastVisiteurId, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
            //var_dump($lesInfosFicheFrais);
            var_dump($lastVisiteurId);
            var_dump($leMois);
            var_dump($lesFraisForfait);
            $listeDesEtats = $pdo->getListeEtats();
            $optionsEtats[] = array();
            $optionsEtats = array('PA','RB');
            
            //var_dump($listeDesEtats);
            $lesClesEtat = array_keys($listeDesEtats);
            $etatPreSelectionne = $lesClesEtat[1];

            $result[] = array();
            
            include 'vuesComptable/v_detailFicheFraisValidee.php';
            //require 'vuesComptable/v_listeFraisHorsForfaitComptable.php';
            $loopAgain = false ;
            break;
        
        case 'modifierEtatFicheValidee':
            $lastVisiteurId = filter_input(INPUT_GET, 'lastVisiteurId', FILTER_SANITIZE_STRING);
            $lemois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
            $etat = filter_input(INPUT_POST ,'listeEtats', FILTER_SANITIZE_STRING);
            
            
                //$pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);//modifier les lignes de frais 
               // $lemontant = $pdo->calculeMontantTotal($lastVisiteurId,$lemois);//modifier le montant
            $pdo->majEtatFicheFrais($lastVisiteurId, $lemois, $etat); //met à jour l'état de la fiche 
            var_dump($lemontant);
                //$pdo->ComptableMajFicheFrais($lastVisiteurId);
        
            
            var_dump($_POST);
            var_dump($etat);
            var_dump($lemois);
            var_dump($lastVisiteurId);
            var_dump($_POST);
            
            
            $lesFrais = $_POST;
            //$pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);
            //$lemontant = $pdo->calculeMontantTotal($lastVisiteurId,$lemois);
            //var_dump($lemontant);
            //$pdo->majEtatFicheFrais($lastVisiteurId, $lemois, $etat); //ajouter une condition pour pouvoir ne modif que le mois et pas l'état si la fiche était déjà validée
            //$pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);
            break;
            //$idVisiteur, $mois, $etat

             
    
}

?>