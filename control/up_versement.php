<?php
session_start();
include_once '../model/Versement.class.php';
include_once '../model/Audit.class.php';

if( !empty($_POST['somme']) && !empty($_POST['desc'])
    && !empty($_POST['mode']) && !empty($_POST['compte']) && !empty($_POST['ver']) ){

    $data = Versement::read_single($_POST['ver']);
    if(!empty($_POST['date'])){
        $date = htmlspecialchars(strip_tags(trim($_POST['date'])));
    }else{
        $date = $data[0]->date;
    }

    $somme = htmlspecialchars(strip_tags(trim($_POST['somme'])));
    $desc = htmlspecialchars(strip_tags(trim($_POST['desc'])));
    $mode= htmlspecialchars(strip_tags(trim($_POST['mode'])));
    $compte = htmlspecialchars(strip_tags(trim($_POST['compte'])));
    $ver = htmlspecialchars(strip_tags($_POST['ver']));

    $update_data = array(
        "somme" => $somme,
        "date" => $date,
        "desc" => $desc,
        "mode" => $mode,
        "compte" => $compte,
        "ver" => $ver
    );
    Versement::update($update_data);
    $desc_audit = $update_data['somme'].' '.$update_data['desc'].' Versement';

    $data_audit = array(
        'desc' => $desc_audit,
        'action' => 'Modification',
        'user' => $_SESSION['id']
    );
    Audit::register($data_audit);

    echo '
	    <script language="javascript">
			swal("Réussi", "Versement modifiée avec succès", "success");
		</script>';

}
else{
    echo '
	    <script language="javascript">
			swal("Erreur", "Veuillez remplir tous les champs", "error");
		</script>';
}



