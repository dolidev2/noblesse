<?php 	
include_once '../model/Examen.class.php';


  if (isset($_POST['date']) AND isset($_POST['examinateur']) AND isset($_POST['type']) ) 
  {
  	$date = strip_tags(htmlspecialchars(trim($_POST['date'])));
	$examinateur = strip_tags(htmlspecialchars(trim($_POST['examinateur'])));
	$type = strip_tags(htmlspecialchars(trim($_POST['type'])));
	$id_examen = strip_tags(htmlspecialchars(trim($_POST['id_examen'])));
	
		$data = array(
          'date' => $date,
          'examinateur' => $examinateur,
          'type' => $type,
          'id_examen' => $id_examen
      );

		Examen::modifier($data);
		header('location:../view/index.php?page=examen');
	}
	else
	{
		echo '
		<script language="javascript">
			alert("Modification Impossible ! ");			
		</script>';

		
	}
 


 ?>