<?php 
    include_once'../model/Eleve.class.php'; 
    include_once'../model/Agence.class.php'; 
    $eleve = Eleve::afficherOne($_GET['id_eleve']);
 ?>
<div class="btn btn-primary btn-lg"><?=$eleve[0]->nom.' '.$eleve[0]->prenom;?></div>
<form role="form" id="formulaire_up">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Nom</label>
            <input id="nom_save" type="text" class="form-control" value="<?=$eleve[0]->nom; ?>" required>
            
        </div>
        <div class="form-group">
            <label>Prénom</label>
            <input id="prenom_save" type="text" class="form-control" value="<?=$eleve[0]->prenom; ?>" required>
        </div>
        <div class="form-group">
            <label>Contact</label>
            <input id="contact_save" type="text" class="form-control" value="<?=$eleve[0]->contact; ?>" required>
        </div>
        <div class="form-group">
            <label>Profession</label>
            <input id="profession_save" type="text" class="form-control" value="<?=$eleve[0]->profession; ?>" required>
        </div>
        <div class="form-group">
            <label>Adresse</label>
            <input id="adresse_save" type="text" class="form-control" value="<?=$eleve[0]->adresse; ?>" required>
        </div>
        <div class="form-group">
            <label>Date d'inscription</label>
            <input id="dor_save" type="date" class="form-control" value="<?= date("Y-m-d",strtotime($eleve[0]->dor)); ?>" required>
        </div>
        <div class="form-group">
            <label>Date de Naissance</label>
            <input id="dob_save" type="date" class="form-control" value="<?=$eleve[0]->dob; ?>" required>                                        
        </div>
        <div class="form-group">
            <label>Lieu de Naissance</label>
            <input id="pob_save" type="text" class="form-control" value="<?=$eleve[0]->pob; ?>" required>
        </div>
    </div>

    <div class="col-lg-6">

        <div class="form-group">
            <label>Catégorie Permis</label>
            <select id="categorie_save" class="form-control" required>
               <option selected value="<?=$eleve[0]->categorie; ?>"><?=$eleve[0]->categorie; ?></option>
               <option  value="A">A</option>
               <option  value="B">B</option>
               <option  value="C">C</option>
               <option  value="D">D</option>
               <option  value="E">E</option>
               
            </select>
        </div>                    
        <div class="form-group">
            <label>Forfait</label>
            <input id="forfait_save" type="text" class="form-control" value="<?=$eleve[0]->forfait; ?>" required>
        </div>
        <div class="form-group">
            <label>Solde Forfait</label>
            <input id="solde_save" type="number" class="form-control" value="<?=$eleve[0]->solde; ?>" required>
        </div>
        <div class="form-group">
            <label>Recommandation</label>
            <input id="recommandation" type="text" class="form-control" value="<?=$eleve[0]->recommandation; ?>" >
        </div>
        <div class="form-group">
            <label>Agence</label>
            <select id="agence" class="form-control" required>
                <?php $agence = Agence::afficherAgenceOne($eleve[0]->agence); ?>
                <option value="<?= $eleve[0]->agence ?>" selected><?= $agence[0]->nom_agence ?></option>
                <?php
                $ag = Agence::afficherAgenceDiff($eleve[0]->agence);
                    foreach($ag as $agence){
                        ?>
                        <option value="<?= $agence->id_agence ?>"><?= $agence->nom_agence ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>

        <?php 
        include_once'../model/Paiement.class.php';
        //$paiement = Paiement::afficher($eleve[0]->id_eleve);
        $total = Paiement::afficherTotalOne($eleve[0]->id_eleve);
        $som = $total[0]->total;
        if ($som == NULL) 
        {
          $som = 0;   
        }
        else
        {
          $som = floatval($som);
        }

        if ($som == $eleve[0]->solde) { ?>
        <div class="form-group">
            <label>Statut</label>            
            <select id="statut_save" class="form-control" required>
               <option selected value="<?=$eleve[0]->statut; ?>"><?=$eleve[0]->statut; ?></option>
               <option value="1">1</option>
               <option value="0">0</option>
            </select>
        </div>
        <?php } else { ?>

        <div class="form-group">
            <label>Statut</label>    
            <input id="statut_save" type="text" class="form-control" value="<?=$eleve[0]->statut; ?>" readonly>
        </div>  

        <?php } ?>

                                           
        <div class="form-group">
            <label>Sexe</label>
            <select id="sexe_save" class="form-control" required>
               <option selected value="<?=$eleve[0]->sexe; ?>"><?=$eleve[0]->sexe; ?></option>
               <option value="masculin">masculin</option>
               <option value="feminin">feminin</option>
            </select>
        </div>
        <div class="form-group">            
            <input id="id_eleve" type="hidden" class="form-control" value="<?=$eleve[0]->id_eleve; ?>" readonly>
        </div>                                            
        <div class="form-group">
            <button type="submit" class="btn-lg btn-primary">Modifier</button>        
        </div>                         
  </div>                                           
</form>

<form action="../control/reg_photo.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Photo</label>
                <input name="img" type="file" class="form-control" >
                <input type="hidden" name="id" value="<?= $eleve[0]->id_eleve ?>">
            </div>
            <button class="btn btn-primary">Ajouter</button>
        </div>
    </div>
</form>
<div id="comment"></div>

<script type="text/javascript">
    // Save User 
    $('#formulaire_up').submit( function()
        {
              var nom = $('#nom_save').val();
              var prenom = $('#prenom_save').val();
              var contact = $('#contact_save').val();
              var profession = $('#profession_save').val();
              var adresse = $('#adresse_save').val();
              var dob = $('#dob_save').val();
              var pob = $('#pob_save').val();
              var categorie = $('#categorie_save').val();
              var forfait = $('#forfait_save').val();
              var solde = $('#solde_save').val();
              var sexe = $('#sexe_save').val();
              var id = $('#id_eleve').val();
              var statut = $('#statut_save').val();
              var recommandation = $('#recommandation').val();
              var agence = $('#agence').val();
              var dor = $('#dor_save').val();

                $.post('../control/up_eleve.php', {nom:nom,prenom:prenom,contact:contact,profession:profession,adresse:adresse,dob:dob,pob:pob,categorie:categorie,
                  forfait:forfait,solde:solde,sexe:sexe,id:id,statut:statut,recommandation:recommandation,agence:agence,dor:dor}, function(response)
                {
                  $('#comment').html(response);                   
                });

           return false;         

        });

</script>