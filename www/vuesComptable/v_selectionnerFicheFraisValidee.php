<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
        
        $(document).ready(function(){
            var lastVisiteurId;
            var id = null ;
            let lastMois;

             
            
             $("#selectionAj").on('submit',function(event){
                event.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = {
                    lastVisiteur : lastVisiteurId
                };
                
                $.ajax({
                    url : url,
                    method : method,
                    data : 'nom='+ lastVisiteurId
                   
                }).done(function(result){
                    
                    result = JSON.parse(result);
                    //console.log(mois);
                    listeMois = result['mois'];
                    id = result['id'];
                    console.log(id);
                    console.log(listeMois);
                    
                    $("#lstMois").empty();
                    //$("#lstMois").append('<option selected="" disabled="">les mois disponibles pour  '+lastVisiteurId+ '</option>')
                    console.log(listeMois[0]);
                    console.log(listeMois[1]);
                    //var premierMois = listeMois[1];
                    $("#lstMois").append('<option selected="" disabled="">'+listeMois[0]['mois']+'</option>')
                    listeMois.forEach(function(lemois){
                        
                         
                        
                        $("#lstMois").append('<option>'+lemois['mois']+'</option>');
                        
                    });
                });    
             
                
       
        });
        
         $("#lastVisiteur").change(function(){
         lastVisiteurId = $("#lastVisiteur").val();

                //let etat = $('option').filter(":selected").val();
         console.log(lastVisiteurId);
                
         });
         
         $("#lstMois").change(function(){
              lastMois = $("#lstMois").val();
              console.log(lastMois);
          });
             
        
        
        $("#selectionAjSubmit").on('submit',function(event){
               
                if($("#lstMois").val() == null){
                    event.preventDefault();
                    console.log('il n\'y a pas de mois disponible');
                   
                        
                    
                }
                else {
                    //event.preventDefault();
                    var form2 = $(this);
                    var url2 = "index.php?uc=suivrePaiement&action=accederFicheFraisValidee&lastVisiteurId="+id+"&lstMois="+lastMois;
                    var method2 = form2.attr('method');
                    var data2 = {
                    lastVisiteurId : id ,
                    lstMois : lastMois 
                    
                    };
                   
                    $.ajax({
                        url : url2,
                        method : method2,
                        data : data2
                    }).done(function (){
                        window.location.replace(url2);
                        console.log('ok');
                         console.log(id);
                    console.log(lastMois);
                    });
                    
                
                }
              
                   
                });
       
        
        
        
    });
</script>



<h2>Sélectionner un visiteur</h2>
<div class="row">

    <div class="col-md-4">
        <!-- <form action="index.php?uc=suivrePaiement&action=selectionnerFiche" -->
        <form id="selectionAj" action="controleursComptable/c_ajaxhandler.php" method="post">
              
            <div class="form-group">
                <label for="lastVisiteur" accesskey="n">nom du visiteur : </label>
                <select  id="lastVisiteur" name="lastVisiteur" class="form-control" >
                    <option selected="" disabled="">selection visiteur</option>
                    <?php 
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $visiteur = $unVisiteur['nom'];?>
                

                            <option id="targetedOption" value="<?php echo $visiteur ?>">
                     
                                
                                <?php echo $visiteur ?> </option>
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
        

<div class="row">

    <div class="col-md-4">
        <form id ="selectionAjSubmit" action="" method="get">
           
            <div class="form-group">
                
                <label for="lstMois" accesskey="n">Mois : </label>
            
                <select id="lstMois" name="lstMois" class="form-control">
                 <option selected="" disabled="">selection mois</option>
 

                </select>
            
               
            </div>
          
            
            <button  type="submit" form="selectionAjSubmit">valider</button>
        </form>
    </div>
</div>      
            
