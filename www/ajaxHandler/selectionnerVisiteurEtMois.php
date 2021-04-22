<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$id = null;
if(isset($_POST['theId'])){
    $id = $_POST['theId'];
    var_dump($id);
    $lesMois = $pdo->getLesMoisDisponiblesFicheValidee($id);
    echo json_encode($lesMois);
}
 