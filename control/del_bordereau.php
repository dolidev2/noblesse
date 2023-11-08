<?php 
session_start();
include_once '../model/Bordereau.class.php';
include_once '../model/Audit.class.php';

if ( isset($_POST['id_bord_csv']) AND isset($_POST['date_depot']) ) 
{
    $id=$_POST['id_bord_csv'];
    $bord = Bordereau::displayBoredereauOne($id);
    $desc_audit = 'Bordereau de dépôt du '.date('d/m/Y',strtotime( $bord[0]->date_depot));

    $data_audit = array(
        'desc' => $desc_audit,
        'action' => 'Suppression',
        'user' => $_SESSION['id']
    );
     Audit::register($data_audit);
     Bordereau::supprimerEleveCsv($id);
    header('location:../view/index.php?page=bordereau&date_depot='.$_POST['date_depot']);
}
