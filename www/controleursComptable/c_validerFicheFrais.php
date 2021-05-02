<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$action =  filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
//$lastVisiteurId = filter_input(INPUT_GET, 'lastVisiteurId', FILTER_SANITIZE_STRING);



    switch ($action){
        case 'selectionnerVisiteur' :
            $lesVisiteurs = $pdo->getLesVisiteursDisponibles();

            include 'vuesComptable/v_selectionnerFicheFrais.php';
           
            break;
        case 'accederFicheFrais' :
            $lastVisiteurId = filter_input(INPUT_GET, 'lastVisiteurId', FILTER_SANITIZE_STRING);
            $leMois = $_GET['lstMois'];
            $nom = $pdo->getNameVisiteur($lastVisiteurId);
            $prenom = $pdo->getFirstNameVisiteur($lastVisiteurId);
            //var_dump($nom);
            
            
            
       
            
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
            $optionsEtats = array('CR','VA');
            
            //var_dump($listeDesEtats);
            $lesClesEtat = array_keys($listeDesEtats);
            $etatPreSelectionne = $lesClesEtat[1];

            $result[] = array();
            
            include 'vuesComptable/v_detailFicheFrais.php';
            include 'vuesComptable/v_listeFraisHorsForfaitComptable.php';
           
            break;

        case 'supprimerFrais':
            $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
            $pdo->supprimerFraisHorsForfait($idFrais);
          
           
            
            break;

        case 'refuserFrais':
            $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
            //var_dump($idFrais);
            $libelleFrais =  $pdo->getNomFraisHorsForfait($idFrais);
            var_dump($libelleFrais['libelle']);
            $pdo->refuserFraisHorsForfait($idFrais,$libelleFrais);
            $action ='accederFicheFrais';
            //$uc = 'validerFicheFrais';
            
           
            break;
        

        case 'modifierEtatFiche':
            $lastVisiteurId = filter_input(INPUT_GET, 'lastVisiteurId', FILTER_SANITIZE_STRING);
            $lemois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
            $etat = filter_input(INPUT_POST ,'listeEtats', FILTER_SANITIZE_STRING);
            
            if($etat == 'VA'){
                $pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);//modifier les lignes de frais 
                $lemontant = $pdo->calculeMontantTotal($lastVisiteurId,$lemois);//modifier le montant
                $pdo->majEtatFicheFrais($lastVisiteurId, $lemois, $etat); //met à jour l'état de la fiche 
                var_dump($lemontant);
                //$pdo->ComptableMajFicheFrais($lastVisiteurId);
            }
            
            var_dump($_POST);
            var_dump($etat);
            var_dump($lemois);
            var_dump($lastVisiteurId);
          
            
            
            $lesFrais = $_POST;
            $pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);//mettre à jour les lignes de frais 
          
            var_dump($lemontant);
            //$pdo->majEtatFicheFrais($lastVisiteurId, $lemois, $etat); //ajouter une condition pour pouvoir ne modif que le mois et pas l'état si la fiche était déjà validée
            //$pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);
            break;
            //$idVisiteur, $mois, $etat
            

    }



