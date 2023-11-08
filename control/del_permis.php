<?php 
    session_start();
	include_once '../model/Eleve.class.php';
	include_once '../model/Audit.class.php';

	if ( isset($_POST['retrait']))
	{
        $permis = Eleve::afficherPermisOne($_GET['retrait']);
        $desc_audit = 'Suppression  du permis numéro '.$permis[0]->permis.' datant du '.date('d/m/Y',strtotime( $permis[0]->date_retrait));

        $data_audit = array(
            'desc' => $desc_audit,
            'action' => 'Suppression',
            'user' => $_SESSION['id']
        );

        Audit::register($data_audit);
		Eleve::supprimerPermis($_POST['retrait']);

		header('location:../view/index.php?page=eleve_detail&id_eleve='.$_POST['eleve']);
	}
	else
	{
		echo 'Id no vue';
	}

 ?>