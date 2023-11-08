<?php 
  include_once '../model/Dossier.class.php';

 if (isset($_POST['id_dossier']) ) 
 {
 	$champ = $_POST['ind'];
 	$id = $_POST['id_dossier'];
 	$value = $_POST[$champ];

 	if ($value == NULL) 
 	{
 		$value = 0;
 	}elseif ($value == 'on') 
 	{
 		$value = 1;
 	}else
 	{
 		$value = $_POST[$champ];
 	}	

 	Dossier::updateOne($champ, $id, $value);
 	header('location:../view/index.php?page=eleve_examen&id_eleve='.$_POST['id_eleve']);
 }
 ?>