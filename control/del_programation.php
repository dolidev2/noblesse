<?php 

include_once '../model/Programation.class.php';

if ( isset($_POST['id_programation']) AND isset($_POST['id_examen'])) 
{
    $exam=$_POST['id_examen'];
    Programation::supprimerEleveProgram($_POST['id_programation']);
    header('location:../view/index.php?page=program&id_examen='.$exam);
}
else
{
    echo $_POST['id_programation'];
}
