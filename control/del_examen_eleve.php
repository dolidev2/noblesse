<?php 
session_start();
	include_once '../model/Eleve.class.php';
	include_once '../model/Audit.class.php';

	if ( isset($_POST['examen_eleve'])) 
	{
        $eleve = Eleve:: afficherOneExamenEleve($_POST['examen_eleve']);
        $desc_audit = 'suppression du résultat de '.$eleve[0]->nom.' '.$eleve[0]->prenom.
            ' avec le matricule '.$eleve[0]->matricule.' de l\'examen de '.$eleve[0]->type.' à la date du '.date("d/m/Y", strtotime($eleve[0]->date_examen));

        $data_audit = array(
            'desc' => $desc_audit,
            'action' => 'Suppression',
            'user' => $_SESSION['id']
        );
   
        Audit::register($data_audit);
		Eleve:: supprimerExamenEleve($_POST['examen_eleve']); 
 		header('location:../view/index.php?page=eleve_detail&id_eleve='.$eleve[0]->id_eleve); 
	}
	else
	{
		echo $_POST['examen_eleve'];
	}
 ?>