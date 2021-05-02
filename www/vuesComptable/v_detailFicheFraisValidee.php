<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>







<h3>Page des détails de la fiche de frais de <?php echo $nom[0]['nom'].' '.$prenom[0]['prenom']  ?></h3>

<hr>
<div class="panel panel-primary">
    <div class="panel-heading">Fiche de frais du mois 
        <?php echo $numMois . '-' . $numAnnee ?> : </div>
    <div class="panel-body">
        <strong><u>Etat :</u></strong> <?php echo $libEtat ?>
        depuis le <?php echo $dateModif ?> <br> 
        <strong><u>Montant validé :</u></strong> <?php echo $montantValide ?>
    </div>
</div>
<div class="panel panel-info">
    
    <div class="panel-heading">Eléments forfaitisés</div>
    <form action="index.php?uc=suivrePaiement&action=modifierEtatFicheValidee&mois=<?php echo $leMois ?>&etat=VA&lastVisiteurId=<?php echo $lastVisiteurId ?>" method="post" id="FORMID" class="ajaxForm">
    
    
        <table class="table table-bordered table-responsive">
    
        <tr>
            <?php
            global $etat;
            foreach ($lesFraisForfait as $unFraisForfait) {
                $libelle = $unFraisForfait['libelle']; 
                $result = array( 'info'=>$libelle )?>
                <th> <?php echo htmlspecialchars($libelle) ?></th>
               
                <?php
            }
            ?>
        </tr>
        <tr>
       
            <?php
            $index = 0;
            foreach ($lesFraisForfait as $unFraisForfait) {
                $quantite = $unFraisForfait['quantite']; ?>
        
        
            <td class="qteForfait"><?php echo $quantite ?></td>
            
                <?php
               
                $index++;
            }
            
            ?>
         
        </tr>
        
        
       
    </table>
                       <span id="modificationEtatLigne">
           <b>modifier l' état de la fiche de frais du visiteur  <?php echo $nom[0]['nom'].' '.$prenom[0]['prenom']  ?>   pour la date du <?php echo $numMois . '-' . $numAnnee ?></b>
           
                <select id="listeEtats" name="listeEtats" class="item1" >
                    <option selected="" disabled="">inchangé</option>
                    <option id="option1" value=<?php echo $optionsEtats[0];?>>
                             
                                
                                <?php echo $optionsEtats[0]; ?> </option>
                    
                    <option id="option2" value=<?php echo $optionsEtats[1];?>>
                             
                                
                                <?php echo $optionsEtats[1] ?> </option>
        

                </select>
           

          
       </span>  
        <input type="submit" value="valider" id="submitButton" name="valider" >
    </form> 
       
 

</div>


 


<!-- <script src="script/script1.js"></script> -->
