<?php
session_start();
  include_once '../model/User.class.php';
  include_once '../model/Audit.class.php';

  if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['username']) AND 
      isset($_POST['fonction']) AND isset($_POST['password']) ) 
  {
  	$nom = strip_tags(htmlspecialchars(trim($_POST['nom'])));
	$prenom = strip_tags(htmlspecialchars(trim($_POST['prenom'])));
	$username = strip_tags(htmlspecialchars(trim($_POST['username'])));
	$fonction = strip_tags(htmlspecialchars(trim($_POST['fonction'])));
	$agence = strip_tags(htmlspecialchars(trim($_POST['agence'])));
	$password = $_POST['password'];

	$data = array(
		'nom_user' => $nom,
		'prenom_user' => $prenom,
		'username' => $username,
		'password' => $password,
		'fonction' => $fonction,
		'agence' =>$agence,
    );

      $desc_audit = $nom.' '.$prenom.' ajouté comme utilisateur';

      $data_audit = array(
          'desc' => $desc_audit,
          'action' => 'Ajout',
          'user' => $_SESSION['id']
      );
      Audit::register($data_audit);
	User::register($data);

	echo '
	    <script language="javascript">
			swal("Réussi", "Utilisateur ajouté avec succès", "success");
			window.location.href = "index.php?page=utilisateur";
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