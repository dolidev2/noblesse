<?php 

include_once '../model/Caisse.class.php';

if ( isset($_POST['recette_sup'])) 
{
    Caisse::supprimerRecette($_POST['recette_sup']);
    header('location:../view/index.php?page=caisse');
}
else
{
    header('location:../view/index.php?page=caisse');
}
