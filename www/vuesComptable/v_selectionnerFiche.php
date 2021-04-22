<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>



<h2>Sélectionner une fiche</h2>
<div class="row">

    <div class="col-md-4">
        <form action="index.php?uc=validerFicheFrais&action=selectionnerVisiteur" 
              method="post" role="form">
            <div class="form-group">
                <label for="choixFiche" accesskey="n">fiche : </label>
                <select id="choixFiche" name="choixFiche" class="form-control" >
                    <?php 
                    
                    foreach ($infos as $uneInfo) {
                        
                        $idVisiteurFiche = $uneInfo['idVisiteur'];
                        $moisFiche = $uneInfo['mois'];
                        $montantFiche = $uneInfo['montant'];
                        
                        
                        var_dump($nomVisiteur);
                        $informations = $idVisiteurFiche.'-'.$moisFiche.'  '.'montant:  '.$montantFiche.' euros';
                            ?>
                            <option value="<?php echo $informations ?>">
                     
                                
                                <?php echo $informations  ?> </option>
                            <?php 
                            
                        
                    }
                    ?>    

                </select>
            </div>
             <input id="rechercherMois" type="submit" value="obtenir les mois" class="btn btn-success" 
                   role="button">
             
             
        </form>
    </div>
</div>      