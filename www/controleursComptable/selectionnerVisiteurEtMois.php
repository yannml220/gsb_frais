<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$id = null;
if(isset($_POST['id'])){
    $id = $_POST['id'];
    var_dump('bonjour');
    $lesMois = $pdo->getLesMoisDisponiblesFicheValidee($id);
    echo json_encode($lesMois);
}
 
