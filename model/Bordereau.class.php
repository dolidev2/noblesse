<?php

include_once "Model.class.php";

/**
 * Classe  Model.
 * Super Classe pour tous les models.
 * Utilise PDO comme PHP Data Object
 *
 * @version 1.0
 * @author zcorp & edotensei
 */

 class Bordereau extends Model
 {
     public function register($data)
     {
         $con = parent::getPDO();

         $insert = $con->prepare('INSERT INTO bordereau_csv VALUES (?,?,?,?,?,?,?,?)');
         $insert->execute(array(null,$data['nom'],$data['prenom'],$data['prenom']
         ,$data['dob'],$data['pob'],$data['agence'],$data['categorie'],$data['date']));

     }
     public static function addBordereau($data){

        $con = parent::getPDO();

        $insert = $con->prepare('INSERT INTO bordereau VALUES (?,?,?,?)');
        $insert->execute(array(null,$data['date_depot'],$data['desc_depot'],$data['date_creation']));
     }

     public static function addBordereauEleve($data)
     {
         $con = parent::getPDO();

         $insert = $con->prepare('INSERT INTO bordereau_eleve VALUES (?,?,?)');
         $insert->execute(array(null,$data['eleve'],$data['bordereau']));
   }

     public static function displayBordereauDepotOne(){

        $con = parent::getPDO();

        $select = $con->query("SELECT * FROM bordereau ORDER BY date_depot DESC");
        $data = $select->fetchAll(PDO::FETCH_CLASS, 'Bordereau');

        return $data;
     }

     public static function displayParticipantDepot($depot){

        $con = parent::getPDO();

        $select = $con->query('SELECT count(id_bordereau_eleve) AS participant FROM bordereau_eleve WHERE bordereau="'.$depot.'" ');
        $data = $select->fetchAll(PDO::FETCH_CLASS, 'Bordereau');

        return $data;
     }

     public static function displayBoredereauOne($depot){

        $con = parent::getPDO();

        $select = $con->query('SELECT * FROM bordereau WHERE id_bordereau="'.$depot.'"');
        $data = $select->fetchAll(PDO::FETCH_CLASS, 'Bordereau');

        return $data;
     }

     public static function afficherOne($id)
     {
         $con = parent::getPDO();

         $select = $con->query('SELECT * FROM bordereau WHERE id_bordereau="'.$id.'"');
         $data = $select->fetchAll(PDO::FETCH_CLASS, 'Bordereau');

         return $data;
     }  
     
     public static function afficherByDateAndDesc($date,$desc)
     {
         $con = parent::getPDO();

         $select = $con->query('SELECT * FROM bordereau WHERE date_depot="'.$date.'" AND desc_bordereau="'.$desc.'" ORDER BY date_creation DESC LIMIT 0,1' );
         $data = $select->fetchAll(PDO::FETCH_CLASS, 'Bordereau');

         return $data;
     }

     public static function afficherBoredereauParticipant($bordereau){

        $con = parent::getPDO();

        $select = $con->query('SELECT * FROM bordereau b, bordereau_eleve be, eleve e, agence a WHERE e.agence=a.id_agence AND e.id_eleve=be.eleve AND 
                              b.id_bordereau=be.bordereau AND  b.id_bordereau="'.$bordereau.'" ');
        $data = $select->fetchAll(PDO::FETCH_CLASS, 'Bordereau');

        return $data;
     }

     public static function afficherParticipantCsv($id)
     {
        $con = parent::getPDO();

        $select = $con->query('SELECT * FROM bordereau_csv WHERE id_bord_csv="'.$id.'" ');
        $data = $select->fetchAll(PDO::FETCH_CLASS, 'Bordereau');

        return $data;
     }
     
     public static function supprimerEleveBordereau($id)
     {
        $con = parent::getPDO();

        $delete = $con->prepare('DELETE  FROM bordereau_eleve WHERE id_bordereau_eleve=? ');
        $delete->execute(array($id));
     }

     public static function supprimerEleveCsv($id)
     {
        $con = parent::getPDO();

        $delete = $con->prepare('DELETE  FROM bordereau_csv WHERE id_bord_csv=? ');
        $delete->execute(array($id));
     }
     public static function supprimerBordereau($bordereau)
     {
        $con = parent::getPDO();

        $delete = $con->prepare('DELETE  FROM bordereau_eleve WHERE bordereau=? ');
        $delete->execute(array($bordereau));
        $delete = $con->prepare('DELETE  FROM bordereau WHERE id_bordereau=? ');
        $delete->execute(array($bordereau));
     }
     
     
       //Importation du fichier csv dans la base de données
    public static function import($file,$date_depot){

        $con= parent::getPDO();
        
       //Le chemin d'acces a ton fichier sur le serveur
    $fichier = fopen($file, "r");
 
	//tant qu'on est pas a la fin du fichier :
	while (!feof($fichier))
	{
        // On recupere toute la ligne
        $uneLigne = addslashes(fgets($fichier));
        //On met dans un tableau les differentes valeurs trouvés (ici séparées par un ';')
        $tableauValeurs = explode(';', $uneLigne);

        
        // On crée la requete pour inserer les donner 
        $sql="INSERT INTO bordereau_csv VALUES (?,?,?,?,?,?,?,?)";

        if(feof($fichier))
            break;
        else
        {
            $req = $con->prepare($sql);
            if ($tableauValeurs[0] != 'NOM' AND $tableauValeurs[1] != 'PRENOMS' AND
                $tableauValeurs[0] != '' AND $tableauValeurs[1] != '') {
            	# code...
            	$req->execute(array(null,$tableauValeurs[0], $tableauValeurs[1], 
            	$tableauValeurs[2], $tableauValeurs[3], $tableauValeurs[4], $tableauValeurs[5], $date_depot ));
            }
            
            // la ligne est finie donc on passe a la ligne suivante (boucle)
        }
    //vérification et envoi d'une réponse à l'utilisateur
    
     }
     if($req)
        return 1;
    else
        return 0;
    }
 }