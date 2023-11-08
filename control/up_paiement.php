<?php
session_start();
include_once '../model/Paiement.class.php';
include_once '../model/Eleve.class.php';
include_once '../model/Audit.class.php';



  if (isset($_POST['date_paiement']) AND isset($_POST['somme']) AND isset($_POST['type']) AND 
      isset($_POST['id']) AND isset($_POST['numero_pai']) ) 
  {
  	$date = strip_tags(htmlspecialchars(trim($_POST['date_paiement'])));
	$somme = strip_tags(htmlspecialchars(trim($_POST['somme'])));
	$type = strip_tags(htmlspecialchars(trim($_POST['type'])));
	$numero = strip_tags(htmlspecialchars(trim($_POST['numero_pai'])));
	$id = strip_tags(htmlspecialchars(trim($_POST['id'])));
	$id_paiement = strip_tags(htmlspecialchars(trim($_POST['id_paiement'])));
	$total = Paiement::afficherTotalOne($id);
	$eleve = Eleve::afficherOne($id);
	$somModif=Paiement::afficherSomModif($id_paiement);
	$somModif=$somModif[0]->somme;
	$som = $total[0]->total;	
	$som = floatval($som)-$somModif;

    echo $som + $somme.'<br/>';
    echo $eleve[0]->solde;

	if ( ($som + $somme) <= $eleve[0]->solde) 
	{
		$data = array(
		'date_paiement' => $date,
		'somme' => $somme,
		'type' => $type,
		'id' => $id,
		'numero' =>$numero,
	    'id_paiement' => $id_paiement);

		$elev = Eleve::afficherOne($id);
        $desc_audit = 'Modification des informations de paiement de l\'élève '.$elev[0]->nom
        .' '.$elev[0]->prenom.'dont le matricule est '.$elev[0]->maticule.
        '. Somme versée '.$somme.' correspondant au '. $type;

        $data_audit = array(
            'desc' => $desc_audit,
            'action' => 'Modification',
            'user' => $_SESSION['id']
        );
        Audit::register($data_audit);
		Paiement::modifier($data);
		header('location:../view/index.php?page=de_eleve&id_eleve='.$data["id"]);
	}
	else
	{
		echo '
		<script language="javascript">
			alert("Modification Impossible; Total supérieur au Forfait");			
		</script>';

		
	}
	
  }
 


 ?>