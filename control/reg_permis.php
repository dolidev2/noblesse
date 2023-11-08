<?php
session_start();

    include_once '../model/Eleve.class.php';
    include_once '../model/Audit.class.php';
  
    if ( isset($_POST['permis']))
    {

    
        $permis = strip_tags(htmlspecialchars(trim($_POST['permis'])));
        $date = strip_tags(htmlspecialchars(trim($_POST['date_permis'])));

        $data = array(
            'permis' => $permis,
            'eleve' => $_POST['eleve'],
            'date' => $date
        );
        $desc_audit =' Retrait du permis provisoire numéro '.$permis;

        $data_audit = array(
            'desc' => $desc_audit,
            'action' => 'Ajout',
            'user' => $_SESSION['id']
        );

        Audit::register($data_audit);
        Eleve::ajouterPermis($data);

        header('location: ../view/index.php?page=eleve_detail&id_eleve='.$_POST['eleve']);

    }
    else{
        header('location:../view/index.php?page=eleve_detail&id_eleve='.$_POST['eleve']);
    }



 ?>