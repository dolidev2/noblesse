<?php

include_once'../model/Bordereau.class.php';

//Submit is succeed
if(isset($_POST)){
    if(!empty($_POST['data']) && !empty($_POST['depot'])){
        foreach ($_POST['data'] as $el) {

            $data = array(
                'bordereau' => $_POST['depot'],
                'eleve' => $el['id']
            );

            Bordereau::addBordereauEleve($data);
        }
    }
}
