<?php 
 include_once '../model/Examen.class.php';

  if (isset($_POST['id_eleve']) AND isset($_POST['id_examen']) AND isset($_POST['resultat']) ) 
  {
  	$data = array(
  	    'id_eleve'=>$_POST['id_eleve'],
        'id_examen'=>$_POST['id_examen'],
        'resultat'=>$_POST['resultat']
    );

  	Examen::registerExamenEleve($data);
  	header('location:../view/index.php?page=eleve_examen&id_eleve='.$_POST['id_eleve']);
  }
  else
  {
  	echo 'Erreur';
  }

?>