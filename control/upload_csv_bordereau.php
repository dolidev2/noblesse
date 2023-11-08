<?php

include_once "../model/Bordereau.class.php";
include_once "../spreadsheet/vendor/autoload.php";

if($_FILES['file']['name'] != ''){

    $con = Model::getPDO();

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

    $data = $spreadsheet->getActiveSheet()->toArray();
    $programData = [];

    $i = 0;
    foreach( $data as $row){
        if ($i == 0)
        {

        }
        else{
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4]) && !empty($row[5]))
            {
                $insert_data = array(
                    'nom' => $row[0],
                    'prenom' => $row[1],
                    'dob' => date('Y-m-d', strtotime($row[2])),
                    'pob' => $row[3],
                    'agence' => $row[4],
                    'categorie' => $row[5],
                    'date'=>$_GET['date_depot']
                );

                Bordereau::register($insert_data);
            }
        }
        $i++;
    }

    header('Location:../view/index.php?page=bordereau&date_depot='.$_GET['date_depot']);
}
else
{
    echo '
    Aucun fichier selectionne !
    ';
}




?>