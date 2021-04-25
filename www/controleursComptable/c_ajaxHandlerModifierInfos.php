<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require '../includes/class.pdogsb.inc.php';
$pdo = PdoGsb::getPdoGsb();
$lastVisiteurId = filter_input(INPUT_GET, 'lastVisiteurId', FILTER_SANITIZE_STRING);
            $lemois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
            $etat = filter_input(INPUT_POST ,'listeEtats', FILTER_SANITIZE_STRING);
            print_r($_POST) ;
            if($etat == 'VA'){
                $pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);//modifier les lignes de frais 
                $lemontant = $pdo->calculeMontantTotal($lastVisiteurId,$lemois);//modifier le montant
                $pdo->majEtatFicheFrais($lastVisiteurId, $lemois, $etat); //met à jour l'état de la fiche 
                //print_r($lemontant);
            } 
          
            
            //print_r($lastVisiteurId) ;
           
            //$pdo->majFraisForfait($lastVisiteurId, $lemois, $lesFrais);//mettre à jour les lignes de frais 
            //$lemontant = $pdo->calculeMontantTotal($lastVisiteurId,$lemois);//avant de pouvoir calculer new montant
            //print_r($lemontant);