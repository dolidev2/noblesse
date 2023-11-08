<?php 	
include_once '../model/Examen.class.php';

  if (isset($_POST['examen_eleve']) AND isset($_POST['resultat']) ) 
  {
  	$id_examen_eleve = strip_tags(htmlspecialchars(trim($_POST['examen_eleve'])));
	$resultat = strip_tags(htmlspecialchars(trim($_POST['resultat'])));	

    $data = array(
        'resultat' => $resultat,
        'examen_eleve' => $id_examen_eleve
    );
 
    Examen::modifierResultatOnly($data);
    header('location:../view/index.php?page=eleve_detail&id_eleve='.$_POST['eleve']);
}
else
{
    echo '
    <script language="javascript">
        alert("Modification Impossible ! ");
    </script>';

}

 ?>