<?php

include_once "../model/Paiement.class.php";
include_once "../spreadsheet/vendor/autoload.php";

if($_FILES['file']['name'] != ''){

    $con = Model::getPDO();

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

    $data = $spreadsheet->getActiveSheet()->toArray();

    $i = 0;
    foreach( $data as $row){
        if ($i == 0)
        {

        }
        else{
            if ( !empty($row[0]) )
            {

                $Numb = Paiement::genererNumbRecu();
                $Inc = (int)$Numb[0]->nombre;
                $Inc+=1;
                $letter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $fin = substr(str_shuffle($letter),0,3 );
                $fin = $fin.'-'.$Inc;

                $data = array(
                    'date_paiement' => $row[1],
                    'somme' => $row[2],
                    'type' => $row[3],
                    'numero' => $fin,
                    'id' => $row[0],
                );

                Paiement::register($data);
            }
        }
        $i++;
    }

   echo "bon";
}





?>