<?php

include "../model/Examen.class.php";
include "../config/config.php";
var_dump($_POST);
if($_POST){

    $tab = $_POST['data'];
    $idexam = $_POST['idexam'];
    $i=0;
    foreach ( $tab as $item) {

        $it = array(
            'resultat'=>$item['resultat'],
            'examen'=>$idexam,
            'eleve'=>$item['id'],
            'exam'=>$item['exam'],
        );
        $info = Examen::afficherResultatUnique($idexam,$item['id']);
        if (isset($info) && !empty($info))
        {
            if($item['resultat'] == 'admis' or $item['resultat'] == 'ajourné' or $item['resultat'] == 'absent' or $item['resultat'] == 'FNT' )
                Examen::modifierResultat($it);
            if($item['exam'] ==  $CONFIG['CRENEAU'] or $item['exam'] ==  $CONFIG['CIRCULATION'] )
                Examen::modifierResultatExamen($it);
            if($item['exam'] != ''  && $item['resultat'] != ''){
                Examen::modifierResultat($it);
                Examen::modifierResultatExamen($it);
            }
        }

        else
            Examen::addResultat($it);

        $i++;
    }

    echo '
		    <script language="javascript">
				swal("Réussi", "Resultat ajouté avec succès", "success");
				
			</script>';
}else{
    echo '
		     <script language="javascript">
				swal("Erreur!", "Données vides, veuillez remplir les champs !", "error");
			 </script>';
}
?>