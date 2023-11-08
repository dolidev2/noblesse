<?php
session_start();
include_once '../model/Caisse.class.php';
include_once '../model/Audit.class.php';

if(!empty($_POST['date']) && !empty($_POST['somme']))
{
    $recette = Caisse::afficherRecetteOne($_POST['recette']);
    $date = htmlspecialchars(strip_tags(trim($_POST['date'])));
    $somme = htmlspecialchars(strip_tags(trim($_POST['somme'])));

    $data = array(
        "somme" => $somme,
        "date" => $date,
        "recette" => $_POST['recette'],
    );

    Caisse::updateRecette($data);

    $desc_audit = $data['somme'].' '.$data['date'].' Recette';

    $data_audit = array(
        'desc' => $desc_audit,
        'action' => 'Modification',
        'user' => $_SESSION['id']
    );
    Audit::register($data_audit);

    echo '
	    <script language="javascript">
			swal("Réussi", "Recette modifiée avec succès", "success");
		</script>';

}
else{
    echo '
	    <script language="javascript">
			swal("Erreur", "Veuillez remplir tous les champs", "error");
		</script>';
}



