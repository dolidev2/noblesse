<?php
session_start();

include_once '../model/Versement.class.php';
include_once '../model/Audit.class.php';

if ( isset($_POST['id_ver'])  )
{
    $info = Versement::read_single($_POST['id_ver']);
    $desc_audit = $info[0]->somme.' '.$info[0]->desc_ver.' Versement';

    $data_audit = array(
        'desc' => $desc_audit,
        'action' => 'Suppression',
        'user' => $_SESSION['id']
    );
    Audit::register($data_audit);
    Versement::delete($_POST['id_ver']);
    header('location:../view/index.php?page=caisse');
}
else
{
    header('location:../view/index.php?page=caisse');
}

?>
