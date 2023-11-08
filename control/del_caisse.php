<?php
session_start();

include_once '../model/Caisse.class.php';
include_once '../model/Audit.class.php';

if (isset($_POST['id_caisse'])) {

    $info = Caisse::afficherOne($_POST['id_caisse']);
    $desc_audit = $info[0]->somme.' '.$info[0]->desc_caisse.' Caisse';

    $data_audit = array(
        'desc' => $desc_audit,
        'action' => 'Suppression',
        'user' => $_SESSION['id']
    );
    Audit::register($data_audit);
    Caisse::supprimer($_POST['id_caisse']);

    header('location:../view/index.php?page=caisse');
} else {
    header('location:../view/index.php?page=caisse');
}





