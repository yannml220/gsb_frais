<?php


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
    <form   action="index.php?uc=validerFicheFrais&action=modifierEtatFiche&mois=<?php echo $leMois ?>&etat=VA&lastVisiteurId=<?php echo $lastVisiteurId ?>" method="post" id="formModification">
            
    
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
        
        
            <td class="qteForfait"><input  type="text" name="<?php echo $lesFraisForfait[$index]['idfrais'] ?>" value="<?php echo $quantite ?> "></td>
            
                <?php
               
                $index++;
            }
            
            ?>
         
        </tr>
        
        
       
    </table>
                       <span id="modificationEtatLigne">
           <b>modifier l' état de la fiche de frais du visiteur  <?php echo $nom[0]['nom'].' '.$prenom[0]['prenom']  ?>   pour la date du <?php echo $numMois . '-' . $numAnnee ?></b>
           
                <select id="listeEtats" name="listeEtats" class="item1" >
                    <?php 
                    foreach ($optionsEtats as $unEtat) {
                        
                        //$etat = $unEtat['id'];
                      
                            ?>
                    <option  value=<?php echo $unEtat;?>>
                             
                                
                                <?php echo $unEtat ?> </option>
                            <?php 
                        }
                    
                    ?>    

                </select>
           

          
       </span>  
        <button type="submit" form="formModification" >valider/actualiser</button>
    </form> 
       
 

</div>


 



