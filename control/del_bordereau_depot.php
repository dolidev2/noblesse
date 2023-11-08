<?php 
session_start();
include_once '../model/Bordereau.class.php';
include_once '../model/Audit.class.php';

if ( isset($_POST['id_depot']) ) 
{
    $id=$_POST['id_depot'];
    $bord = Bordereau::displayBoredereauOne($id);
    $desc_audit = 'Bordereau de dépôt du '.date('d/m/Y',strtotime( $bord[0]->date_depot));

    $data_audit = array(
        'desc' => $desc_audit,
        'action' => 'Suppression',
        'user' => $_SESSION['id']
    );
    Audit::register($data_audit);
    Bordereau::supprimerBordereau($id);
    header('location:../view/index.php?page=eleve');
}
