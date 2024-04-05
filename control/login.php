<?php 

	include_once '../model/User.class.php';
	include_once '../model/Agence.class.php';

	if (isset($_POST['username']) AND isset($_POST['password'])) 
	{
		$username = strip_tags(htmlspecialchars(trim($_POST['username'])));
		$password = $_POST['password'];

		$confirm = User::login($username, $password);

		if ($confirm != 'NO') 
		{
			session_start();
			$_SESSION['id'] = $confirm[0]->id_user;
			$_SESSION['username'] = $confirm[0]->username;
			$_SESSION['fonction'] = $confirm[0]->fonction;
			$_SESSION['nom'] = $confirm[0]->nom_user;
			$_SESSION['prenom'] = $confirm[0]->prenom_user;
			$_SESSION['agence'] = $confirm[0]->agence;
            $agence = Agence::afficherAgenceOne($confirm[0]->agence);
			$_SESSION['position_agence'] = $agence[0]->position_agence;

			echo '
    		    <script>
					window.location.href = "view/index.php";
				</script>';
		}
		else
		{
			echo '
    		    <script>
					swal("Erreur!", "Utilisateur ou mot de passe Incorrects !", "error");
				</script>';
		}
	}
	else
	{
		echo '
		     <script>
		         swal("Erreur!", "Champs vides !", "error");
		    </script>';		    
	}

?>