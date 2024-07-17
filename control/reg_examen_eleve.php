<?php 
 include_once '../model/Examen.class.php';

  if (isset($_POST['id_eleve']) AND isset($_POST['id_examen']) AND isset($_POST['resultat']) ) 
  {
  	$data = array(
  	    'id_eleve'=>intval( $_POST['id_eleve']),
        'id_examen'=> intval($_POST['id_examen']),
        'resultat'=>$_POST['resultat']
    );

  	Examen::registerExamenEleve($data);
      echo '
		    <script >
				swal("Réussi", "Résultat examen ajouté avec succès", "success");
			</script>';
  	header('location:../view/index.php?page=eleve_examen&id_eleve='.$_POST['id_eleve']);
  }


?>