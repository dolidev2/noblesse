<?php 
session_start();
  include_once '../model/Caisse.class.php';
  include_once '../model/Audit.class.php';

  if (isset($_POST['somme'])  AND isset($_POST['date']) ) 
  {

	$somme = strip_tags(htmlspecialchars(trim($_POST['somme'])));
	$date = strip_tags(htmlspecialchars(trim($_POST['date'])));
	
	$data = array(
		'somme' => $somme,
	    'date' => $date,
	    'agence' => $_SESSION['agence'],
    );


      $desc_audit = 'ajoutée dont la somme est '.$somme;

      $data_audit = array(
          'desc' => $desc_audit,
          'action' => 'Ajout',
          'user' => $_SESSION['id']
      );
     Audit::register($data_audit);
	Caisse::registerRecette($data);

	header('location:../view/index.php?page=caisse');
  }
  else
  {?>
  	<script type="text/javascript">
  		alert("Impossible champs vides")
  	</script>
  	
  <?php
      header('location:../view/index.php?page=caisse');
  }
 ?>