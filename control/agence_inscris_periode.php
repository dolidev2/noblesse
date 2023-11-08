<?php

if(!empty ($_POST['dt_debut']) && !empty ($_POST['dt_fin'])  )
{
    $agence = $_POST['agence_inscris'];
    $debut = $_POST['dt_debut'];
    $fin = $_POST['dt_fin'];

    header('location: ../public/pdf/agence_inscris.php?agence='.$agence.'&debut='.$debut.'&fin='.$fin);


}


