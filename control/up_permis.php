<?php
session_start();
include_once '../model/Eleve.class.php';
include_once '../model/Audit.class.php';

if ( isset($_POST['permis']))
{
 
    $permis = strip_tags(htmlspecialchars(trim($_POST['permis'])));

    $data = array(
        'permis' => $permis ,
        'retrait' => $retrait
    );

    $desc_audit =' Modification  du permis provisoire numéro '.$permis;

    $data_audit = array(
        'desc' => $desc_audit,
        'action' => 'Modification',
        'user' => $_SESSION['id']
    );
    var_dump($_POST);
    
    Audit::register($data_audit);
    Eleve::modifierPermis($data);

    header('location:../view/index.php?page=eleve_detail&id_eleve='.$_POST['eleve']);
}
else{
    header('location:../view/index.php?page=eleve_detail&id_eleve='.$_POST['eleve']);
}



