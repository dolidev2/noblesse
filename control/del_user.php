<?php 
   session_start();

	include_once '../model/User.class.php';
	include_once '../model/Audit.class.php';

	if ( isset($_POST['id_user']) AND $_SESSION['id'] != $_POST['id_user'] ) 
	{
		$user= User::afficherOne($_POST['id_user']);
		$desc_audit = 'l\'utilisateur  '.$user[0]->nom_user.' '.$user[0]->prenom_user. ' a été supprimé';

		$data_audit = array(
			'desc' => $desc_audit,
			'action' => 'Suppression',
			'user' => $_SESSION['id']
		);
		Audit::register($data_audit);
		User::supprimer($_POST['id_user']);
		header('location:../view/index.php?page=utilisateur');
	}
	else
	{
		echo '<h3 style="color:red">
		         Impossible de supprimer l\'utilisateur en cours 
		      </h3>';
	}

 ?>
