<?php 

include_once "../model/Bordereau.class.php";

if (isset($_POST['depot'])) {


    if (isset($_POST['data'])) 
    {
        $date = $_POST['depot'];
        $agence = $_POST['agence'];
        $eleves = $_POST['data'];
        $desc_depot = strip_tags(htmlspecialchars(trim($_POST['desc_depot'])));
        $date_creation = date("Y-m-d H:i:s");

        $data = array(
            'date_depot' => $date,
            'desc_depot' => $desc_depot,
            'agence' => $agence,
            'date_creation' => $date_creation,
        );
        Bordereau::addBordereau($data);

        $depot = Bordereau::afficherByDateAndDesc($date,$desc_depot);
        foreach ($eleves as $eleve) 
        {
            $data = array(
                'eleve' => $eleve['id'],
                'bordereau' => $depot[0]->id_bordereau
            );
            Bordereau::addBordereauEleve($data);
        }
    }
}

