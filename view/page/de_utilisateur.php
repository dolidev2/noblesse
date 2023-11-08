<?php 
   include_once'../model/User.class.php'; 
   $user = User::afficherOne($_GET['id_user']);
 ?>
<form role="form" id="formulaire_save">
    <div class="col-lg-4">
        <div class="form-group">
            <label>Nom</label>
            <input id="nom_save" type="text" class="form-control" value="<?=$user[0]->nom_user; ?>" required>
            
        </div>
        <div class="form-group">
            <label>Prénom</label>
            <input id="prenom_save" type="text" class="form-control" value="<?=$user[0]->prenom_user; ?>" required>
        </div>
        <div class="form-group">
            <label>Nom Utilisateur</label>
            <input id="username_save" type="text" class="form-control" value="<?=$user[0]->username; ?>" required>
            
        </div>      
    </div>

    <div class="col-lg-4">                    
        <div class="form-group">
            <label>Mot de passe</label>
            <input id="password_save" type="password" value="<?=$user[0]->password; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Répéter le mot de passe</label>
            <input id="rpassword_save" type="password" value="<?=$user[0]->password; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Fonction</label>
            <select id="fonction_save" class="form-control" required>
               <option selected value="<?=$user[0]->fonction; ?>"><?=$user[0]->fonction;?></option>
               <option value="secretaire">administrateur</option>
               <option value="secretaire">secretaire</option>
               <option value="gerant">gérant</option>                            
            </select>
        </div>           

    </div>
    <input type="hidden" id="id_user" value="<?=$user[0]->id_user;?>"> 
    <div class="col-lg-4"><br><br><br><br><br>
        <div class="form-group">
            <button type="submit" class="btn-lg btn-primary">Modifier</button>        
        </div>        
    </div>            
</form>
<div id="comment"></div>

<script type="text/javascript">
    // Save User 
    $('#formulaire_save').submit( function()
        {
              var nom = $('#nom_save').val();
              var prenom = $('#prenom_save').val();
              var username = $('#username_save').val();
              var fonction = $('#fonction_save').val();
              var password = $('#password_save').val();
              var rpassword = $('#rpassword_save').val();
              var id = $('#id_user').val();
              if (password === rpassword) 
              {
                $.post('../control/up_user.php', {nom:nom,prenom:prenom,username:username,fonction:fonction,password:password,id:id}, function(response)
                {
                   /* $('#nom_save').val('');
                    $('#prenom_save').val('');
                    $('#username_save').val('');                    
                    $('#password_save').val('');
                    $('#rpassword_save').val('');*/

                    $('#comment').html(response);                   
                });

              }
              else
              {
                swal("Erreur!", "Les Mots de passe ne correspondent pas !", "error");
                //alert('Les mots de passe ne correspondent pas !!!');
              }    

           return false;         

        });

</script>