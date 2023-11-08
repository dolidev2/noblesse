<?php 


 session_start(); 
 	include_once '../model/Examen.class.php';
	include_once '../model/Audit.class.php';

	if ( isset($_POST['id_examen']))
	{
        $exam = Examen::afficherOneExamen($_POST['id_examen']);
        $desc_audit = 'Examen de '.$exam[0]->type.' fait le '.date('d/m/Y',strtotime($exam[0]->date_examen));

        $data_audit = array(
            'desc' => $desc_audit,
            'action' => 'Suppression',
            'user' => $_SESSION['id']
        );
        Audit::register($data_audit);
		Examen::supprimer($_POST['id_examen']);
		header('location:../view/index.php?page=examen');
	}
	else
	{
		echo $_POST['id_examen'];
	}
 
 ?>