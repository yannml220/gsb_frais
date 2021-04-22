<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<link type="text/css" rel="stylesheet" href="styles/style.css">

<hr>
<div class="row"  id ="descriptif">
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id']; ?>           
                <tr>
                    <td> <?php echo $date ?></td>
                    <td> <?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td><a href="index.php?uc=validerFicheFrais&action=refuserFrais&idFrais=<?php echo $id ?>&lastVisiteur=<?php echo $lastVisiteurId ?>&lastMois=<?php echo $leMois ?>" 
                           onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Refuser ce frais</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>
</div>

