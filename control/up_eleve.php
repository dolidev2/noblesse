<?php
session_start();
	include_once '../model/Eleve.class.php';
	include_once '../model/Audit.class.php';

	if (isset($_POST['nom']) AND isset($_POST['prenom'])
        AND isset($_POST['contact']) AND isset($_POST['profession'])
        AND isset($_POST['dob']) AND isset($_POST['pob'])
        AND isset($_POST['categorie']) AND isset($_POST['forfait'])
        AND isset($_POST['solde']) AND isset($_POST['sexe'])
        AND isset($_POST['adresse']) AND isset($_POST['id'])
        AND isset($_POST['statut'])AND isset($_POST['agence']) )
	  {
	  	$nom = strip_tags(htmlspecialchars(trim($_POST['nom'])));
		$prenom = strip_tags(htmlspecialchars(trim($_POST['prenom'])));
		$contact = strip_tags(htmlspecialchars(trim($_POST['contact'])));
		$profession = strip_tags(htmlspecialchars(trim($_POST['profession'])));
		$dob = strip_tags(htmlspecialchars(trim($_POST['dob'])));
		$pob = strip_tags(htmlspecialchars(trim($_POST['pob'])));
		$dor = strip_tags(htmlspecialchars(trim($_POST['dor'])));
		$categorie = strip_tags(htmlspecialchars(trim($_POST['categorie'])));
		$forfait = strip_tags(htmlspecialchars(trim($_POST['forfait'])));
		$solde = strip_tags(htmlspecialchars(trim($_POST['solde'])));
		$sexe = strip_tags(htmlspecialchars(trim($_POST['sexe'])));
		$adresse = strip_tags(htmlspecialchars(trim($_POST['adresse'])));
		$statut = strip_tags(htmlspecialchars(trim($_POST['statut'])));
		$recommandation = strip_tags(htmlspecialchars(trim($_POST['recommandation'])));
		$agence = strip_tags(htmlspecialchars(trim($_POST['agence'])));

		$id = $_POST['id'];

		$data = array(
			'nom' => $nom,
			'prenom' => $prenom,
			'contact' => $contact,
			'profession' => $profession,
			'dob' => $dob,
			'pob' => $pob,
			'categorie' => $categorie,
			'forfait' => $forfait,
			'solde' => $solde,
			'sexe' => $sexe,
			'adresse' => $adresse,
			'agence' => $agence,
			'id_eleve' => $id,
			'dor' => $dor,
            'recommandation' => $recommandation,
			'statut' => $statut);
		    $elev = Eleve::afficherOne($id);

          $desc_audit = 'Modification des informations de l\'élève '.$nom.' '.$prenom.' dont le matricule est '.$elev[0]->maticule;

          $data_audit = array(
              'desc' => $desc_audit,
              'action' => 'Modification',
              'user' => $_SESSION['id']
          );
          Audit::register($data_audit);
		Eleve::modifier($data);


		echo '
		    <script language="javascript">
				swal("Réussi", "Elève Modifier avec succès", "success");
				window.location.href = "index.php?page=eleve";
			</script>';
	  }
	  else
	  {
	  	echo '
		     <script language="javascript">
				swal("Erreur!", "Données vides, veuillez remplir les champs !", "error");
			 </script>';
	  }



 ?>