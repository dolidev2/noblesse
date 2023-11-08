<?php 

include_once '../model/Bordereau.class.php';

if ( isset($_POST['eleve_bordereau'])  ) 
{
    $id=$_POST['eleve_bordereau'];
    Bordereau::supprimerEleveBordereau($id);
    header('location:../view/index.php?page=bordereau&bordereau='.$_POST['id_bordereau']);
}
