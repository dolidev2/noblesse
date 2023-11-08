<?php
session_start();
include_once '../model/Paiement.class.php';
include_once '../model/Eleve.class.php';
include_once '../model/Audit.class.php';


  if (isset($_POST['somme']) AND isset($_POST['type']) AND
      isset($_POST['id']) )
  {
	
  	$date = date('Y-m-d');
	$somme = strip_tags(htmlspecialchars(trim($_POST['somme'])));
	$type = strip_tags(htmlspecialchars(trim($_POST['type'])));
	$id = strip_tags(htmlspecialchars(trim($_POST['id'])));

	$Numb = Paiement::genererNumbRecu();
	$Inc = (int)$Numb[0]->nombre;
	$Inc+=1;
	$letter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$fin = substr(str_shuffle($letter),0,3 );
	$fin = $fin.'-'.$Inc;


	$data = array(
		'date_paiement' => $date,
		'somme' => $somme,
		'type' => $type,
		'numero' => $fin,
		'id' => $id);

	$eleve = Eleve::afficherOne($id);
	$desc_audit = 'Paiement de frais de scolarité de '
		.$eleve[0]->nom.' '.$eleve[0]->prenom.' avec le matricule'.$eleve[0]->matricule.
          ' correspondant au'.$type.' dont la somme est '.$somme;

	$data_audit = array(
		'desc' => $desc_audit,
		'action' => 'Ajout',
		'user' => $_SESSION['id']
	);

	Audit::register($data_audit);
	Paiement::register($data);

	echo '
	    <script language="javascript">
			swal("Réussi", "Paiement effectué avec succès", "success");
		</script>';
  }
  else
  {
  	echo '
	    <script language="javascript">
			swal("Erreur", "Paiement Non effectué avec succès", "error");
		</script>';
  }
