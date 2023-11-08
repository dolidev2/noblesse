<?php

include_once '../../Eleve.class.php';


if(isset($_POST['id'])){

    $output = array();
    $eleves = Eleve::afficherOne($_POST['id']);

    foreach($eleves as $eleve){
        $output['id'] = $eleve->id_eleve;
        $output['matricule'] = $eleve->matricule;
        $output['nom'] = $eleve->nom;
        $output['prenom'] = $eleve->prenom;
    }
    echo json_encode($output);
}


?>