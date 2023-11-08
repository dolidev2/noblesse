<?php 

include_once "../model/Examen.class.php";



if(isset($_POST['id'])){

    $exam =$_POST['id'];

    if(isset( $_POST['data']))
    {
        $dt = $_POST['data'];
        foreach ($dt as $el) {

            $data = array(
                'examen' => $exam,
                'eleve' => $el['id']
            );
            Examen::registerProgram($data);
        }
    }
}




