<?php
session_start();
include_once '../model/Examen.class.php';
include_once '../model/Audit.class.php';

  if (isset($_POST['date']) AND isset($_POST['examinateur']) AND isset($_POST['type']) ) 
  {
  	$date = strip_tags(htmlspecialchars(trim($_POST['date'])));
	$examinateur = strip_tags(htmlspecialchars(trim($_POST['examinateur'])));
	$type = strip_tags(htmlspecialchars(trim($_POST['type'])));	
	$site = strip_tags(htmlspecialchars(trim($_POST['sites'])));
	$desc_examen = strip_tags(htmlspecialchars(trim($_POST['desc_examen'])));


	$data = array(
		'date' => $date,
		'examinateur' => $examinateur,
		'type' => $type,
        'site'=>$site,
        'desc_examen'=>$desc_examen
    );

      $desc_audit = 'Examen de '.$type.' à la date du '.$date.' a été ajouté';

      $data_audit = array(
          'desc' => $desc_audit,
          'action' => 'Ajout',
          'user' => $_SESSION['id']
      );
    Audit::register($data_audit);
	Examen::register($data);

	echo '
	    <script language="javascript">
			swal("Réussi", "Examen Ajouté avec succès", "success");
		</script>';
  }
  else
  {
  	echo '
	    <script language="javascript">
			swal("Erreur", "Ajout Examen Non effectué ", "error");			
		</script>';
  }
 ?>