<?php 
    session_start();
	include_once '../model/Paiement.class.php';
	include_once '../model/Audit.class.php';

	if ( isset($_GET['id_paiement'])) 
	{
        $eleve = Paiement::afficherOne($_GET['id_paiement']);
        $desc_audit = 'Paiement de frais de scolarité de '.$eleve[0]->nom.' '.$eleve[0]->prenom.
            ' avec le matricule '.$eleve[0]->matricule.' datant du '.date('d/m/Y',strtotime( $eleve[0]->date_paiement)).' dont la somme est '.
            $eleve[0]->somme;

        $data_audit = array(
            'desc' => $desc_audit,
            'action' => 'Suppression',
            'user' => $_SESSION['id']
        );
        Audit::register($data_audit);
		Paiement::supprimer($_GET['id_paiement']);
		header('location:../view/index.php?page=de_eleve&id_eleve='.$_GET['id_eleve']);
	}
	else
	{
		echo 'Id no vue';
	}




 ?>