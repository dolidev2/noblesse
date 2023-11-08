<?php
session_start();
include_once '../model/Caisse.class.php';
include_once '../model/Audit.class.php';

if(!empty($_POST['type']) && !empty($_POST['somme'])  && !empty($_POST['desc'])
    && !empty($_POST['mode']) && !empty($_POST['compte']) && !empty($_POST['caisse']) ){

    $data = Caisse::afficherOne($id);
    if(!empty($_POST['date'])){
        $date = htmlspecialchars(strip_tags(trim($_POST['date'])));
    }else{
        $date = $data[0]->date;
    }
    $type = htmlspecialchars(strip_tags(trim($_POST['type'])));
    $somme = htmlspecialchars(strip_tags(trim($_POST['somme'])));
    $desc = htmlspecialchars(strip_tags(trim($_POST['desc'])));
    $mode= htmlspecialchars(strip_tags(trim($_POST['mode'])));
    $compte = htmlspecialchars(strip_tags(trim($_POST['compte'])));
    $caisse = htmlspecialchars(strip_tags($_POST['caisse']));

    $update_data = array(
        "type" => $type,
        "somme" => $somme,
        "date" => $date,
        "desc" => $desc,
        "mode" => $mode,
        "compte" => $compte,
        "caisse" => $caisse
    );

     Caisse::updateCaisse($update_data);

     $desc_audit = $update_data['somme'].' '.$update_data['desc'].' Caisse';

     $data_audit = array(
         'desc' => $desc_audit,
         'action' => 'Modification',
         'user' => $_SESSION['id']
     );
     Audit::register($data_audit);

    echo '
	    <script language="javascript">
			swal("Réussi", "Caisse modifiée avec succès", "success");
		</script>';

}
else{
    echo '
	    <script language="javascript">
			swal("Erreur", "Veuillez remplir tous les champs", "error");
		</script>';
}



