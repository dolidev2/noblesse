<?php 

include_once '../model/Examen.class.php';

if ( isset($_POST['id_program']) AND isset($_POST['id_examen'])) 
{
    $exam=$_POST['id_examen'];
    Examen::supprimerEleveProgram($_POST['id_program']);
    header('location:../view/index.php?page=program&id_examen='.$exam);
}
else
{
    echo $_POST['id_program'];
}
