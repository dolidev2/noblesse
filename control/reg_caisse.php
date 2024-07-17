<?php 
session_start();
  include_once '../model/Caisse.class.php';
  include_once '../model/Audit.class.php';

  if (isset($_POST['type']) AND isset($_POST['somme']) AND isset($_POST['desc'])  AND isset($_POST['date']) ) 
  {
  	$type = strip_tags(htmlspecialchars(trim($_POST['type'])));
    $somme = strip_tags(htmlspecialchars(trim($_POST['somme'])));
    $desc = strip_tags(htmlspecialchars(trim($_POST['desc'])));
    $date = strip_tags(htmlspecialchars(trim($_POST['date'])));
    $agence = strip_tags(htmlspecialchars(trim($_POST['agence'])));

    $data = array(
      'type' => $type,
      'somme' => $somme,
      'desc' => $desc,
      'compte' => 'COMPTE',
      'mode' => 'ESPECE',
      'date' => $date,
      'agence' => intval($agence),
      'eleve'=> 0);

    $desc_audit = $type.' ajoutée dont la somme est '.$somme.' et le motif est '.$desc;

    $data_audit = array(
        'desc' => $desc_audit,
        'action' => 'Ajout',
        'user' => $_SESSION['id']
    );
    Audit::register($data_audit);
    Caisse::register($data);

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