<?php

include_once'../model/Examen.class.php';

//Submit is succeed
if(isset($_POST)){
    if(!empty($_POST['data']) && !empty($_POST['exam'])){
        foreach ($_POST['data'] as $el) {

            $data = array(
                'examen' => $_POST['exam'],
                'eleve' => $el['id']
            );

            Examen::registerProgram($data);
        }
    }
}
