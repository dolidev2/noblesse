<?php 
	
  include_once '../model/User.class.php';

  if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['username']) AND 
      isset($_POST['fonction']) AND isset($_POST['id']) AND isset($_POST['password']) ) 
  {
  	$nom = strip_tags(htmlspecialchars(trim($_POST['nom'])));
	$prenom = strip_tags(htmlspecialchars(trim($_POST['prenom'])));
	$username = strip_tags(htmlspecialchars(trim($_POST['username'])));
	$fonction = strip_tags(htmlspecialchars(trim($_POST['fonction'])));
	$password = $_POST['password'];
	$id = $_POST['id'];

	$data = array(
		'nom_user' => $nom,
		'prenom_user' => $prenom,
		'username' => $username,
		'password' => $password,
		'id_user' => $id,
		'fonction' => $fonction);
	User::modifier($data);

	echo '
	    <script language="javascript">
	        //window.location.href = "index.php?page=utilisateur";
			swal("Réussi", "Utilisateur modifié avec succès, déconnectez vous pour appliquer", "success");			
		</script>';
  }
  else
  {
  	echo '
	     <script language="javascript">
			swal("Erreur!", "Données vides, veuillez remplir les champs !", "error");
		 </script>';
  }
	

 ?>