<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require '../includes/class.pdogsb.inc.php';
        $pdo = PdoGsb::getPdoGsb();
        if(isset($_POST['nom'])){
            $nom = $_POST['nom'] ;
            $idPrepare = $pdo->getLeVisiteurId($nom);
            $id = $idPrepare[0]['id'];
            //print_r($idPrepare);
            //print_r('bonjour');
            $lesMois = $pdo->getLesMoisDisponiblesFicheNonValidee($id);
            //$lesMois = $pdo->getLesMoisDisponiblesFicheValidee($id);
            $result = array();
            $result['mois'] = $lesMois;
            $result['id'] = $id;
            print_r(json_encode($result));
            //print_r(json_encode('id=>'+ $id));
            //echo ('id=>'+ $id);
            //print_r($lesMois);
        }