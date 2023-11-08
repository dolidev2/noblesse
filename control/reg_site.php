<?php
session_start();
include_once '../model/Examen.class.php';
include_once '../model/Audit.class.php';

if (isset($_POST['nom'])  )
{
    $nom = strip_tags(htmlspecialchars(trim($_POST['nom'])));



    $desc_audit = 'Le site '.$nom.' a été ajouté';

    $data_audit = array(
        'desc' => $desc_audit,
        'action' => 'Ajout',
        'user' => $_SESSION['id']
    );
    Audit::register($data_audit);
    Examen::registerSite($nom);

    echo '
	    <script language="javascript">
			swal("Réussi", "Site Ajouté avec succès", "success");			
		</script>';
}
else
{
    echo '
	    <script language="javascript">
			swal("Erreur", "Ajout Site Non effectué ", "error");			
		</script>';
}










?>