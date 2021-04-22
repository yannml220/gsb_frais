<?php


?>


<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript">
    function show(mo){
        console.log(mo);
    }
</script>
</head>
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
    <form action="index.php?uc=validerFicheFrais&action=modifierEtatFiche&mois=<?php echo $leMois ?>&etat=VA&lastVisiteurId=<?php echo $lastVisiteurId ?>" method="post" id="FORMID">
       
    
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
        
        
            <td class="qteForfait"><input onkeyup="show(this.value)" type="text" name="<?php echo $lesFraisForfait[$index]['idfrais'] ?>" value="<?php echo $quantite ?> "></td>
            
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
        <button type="submit" form="FORMID" >valider/actualiser</button>
    </form> 
       
 

</div>


 


<div class="panel panel-info">
    <div class="panel-heading">Descriptif des éléments hors forfait - 
        <?php echo $nbJustificatifs ?> justificatifs reçus</div>
    
    <table class="table table-bordered table-responsive">
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>
            <th>Justificatifs</th>
        </tr>
        <?php
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $date = $unFraisHorsForfait['date'];
            $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
            $montant = $unFraisHorsForfait['montant']; ?>
            <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><input type="text" id="name" value="<?php echo $montant ?>"><button>valider</button></td>
            </tr>
            <?php
        }
        ?>
    </table>
   
</div>
<script src="script/script1.js"></script>