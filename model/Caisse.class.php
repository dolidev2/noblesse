<?php 

include_once "Model.class.php";
include_once "Eleve.class.php";
include_once "Paiement.class.php";

/**
 * Classe  Caisse. 
 *
 * @version 1.0
 * @author zcorp & edotensei
 */

 class Caisse extends Model
 {
 	public static function register($data)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO caisse VALUES(?,?,?,?,?,?,?,?)');
        $ins->execute(array(NULL,$data['type'], $data['somme'], $data['desc'],$data['compte'],$data['mode'],
                        $data['date'],$data['eleve'] ));
    }

    public static function registerRecette($data)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO recette VALUES(?,?,?)');
        $ins->execute(array(NULL,  $data['date'], $data['somme']));
    }


    public static function afficherAll()
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM caisse ORDER BY date DESC');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Caisse');

        return $donne;        
    }

    public static function get_total_all_records_caisse()
    {
        $con = parent::getPDO();
        $statement = $con->prepare("SELECT * FROM caisse ORDER BY date DESC ");
        $statement->execute();
        $result = $statement->fetchAll();
        return $statement->rowCount();
    }  

    public static function afficherFondCaisse()
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM caisse ORDER BY date DESC');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Caisse');

        return $donne;        
    }

    /*
     *Return all data of one entry from Caisse
     * @param : id integer
     */
     public static function afficherOne($id)
     {
         $con = parent::getPDO();
         $get = $con->prepare('SELECT * FROM caisse WHERE id_caisse=? ');
         $get->execute(array($id));
         $data = $get->fetchAll(PDO::FETCH_CLASS, 'Caisse');

         return $data;
     }

     /*
     *Update all data for one entry of Caisse
     * @param : data array
     */
     public static function updateCaisse($data)
     {
         $con = parent::getPDO();
         $update = $con->query('UPDATE caisse SET type="'.$data['type'].'", somme="'.$data['somme'].'", desc_caisse="'.$data['desc'].'", compte="'.$data['compte'].'", mode="'.$data['mode'].'", date="'.$data['date'].'" WHERE id_caisse="'.$data['caisse'].'" ');
        }
     /*
     *Return all the entries of this day from the caisse
     * @param : day date
     */
     public static function readDayEntryCaisse($day)
     {
         $type="entre";
         $con = parent::getPDO();
         $select = $con->prepare('SELECT * FROM caisse WHERE type=? AND date=?');
         $select->execute(array($type,$day));

         $data = $select->fetchAll(PDO::FETCH_CLASS,'Caisse');

         return $data;
     }

     /*
   *Return solde restant of scolarity
   * @param : id integer
   */
     public static function Solde($id)
     {
         $solde = Eleve::afficherOne($id);
         $total = Paiement::afficherTotalOne($id);
         $data = $solde[0]->solde - $total[0]->total;

         return $data;

     }
     /*
     *Return all the entries of this month from the caisse
     * @param : day date
     */
     public static function readMonthEntryCaisse($day)
     {
         $type="entre";
         //Extraire date
         $mydate =explode('-',$day);
         $month = $mydate[1];
         $year  = $mydate[0];
         $m1 = $year.'-'.$month.'-'.'01';
         $m2 = $year.'-'.$month.'-'.'31';
         $con = parent::getPDO();
         $select = $con->prepare('SELECT * FROM caisse WHERE type=? AND date BETWEEN ? AND ?');
         $select->execute(array($type,$m1,$m2));

         $data = $select->fetchAll(PDO::FETCH_CLASS,'Caisse');

         return $data;

     }

     public static function readMonthFondCaisse($debut,$fin)
     {
        $dt_debut = new DateTime($debut);
        $dt_fin = new DateTime($fin);
        $jours = $dt_fin->diff($dt_debut)->format("%a");

        $con = parent::getPDO();

        $goodDate = date('Y-m-d', strtotime('-1 day', strtotime($debut)));
        $recette = $con->prepare('SELECT * FROM recette WHERE date_recette = ? ');
        $recette->execute(array($goodDate));
        $result = $recette->fetchAll(PDO::FETCH_CLASS,'Caisse');

        $data = [];
        $goodDate = $debut;

        for($i=0; $i<=intval($jours); $i++)
        {
            $caisse = $con->prepare('SELECT * FROM caisse WHERE date = ? ');
            $caisse->execute(array($goodDate));
            $resultCaisse = $caisse->fetchAll(PDO::FETCH_CLASS,'Caisse');

            $recette = $con->prepare('SELECT * FROM recette WHERE date_recette = ? ');
            $recette->execute(array($goodDate));
            $resultRecette = $recette->fetchAll(PDO::FETCH_CLASS,'Caisse');

            $item = array(
                'date'=> $goodDate,
                'caisse'=>$resultCaisse,
                'recette'=>$resultRecette
            );
            array_push($data,$item);
            $goodDate = date('Y-m-d', strtotime("+1 day", strtotime($goodDate)));
        }  
        return [$result,$data];
     }

     public static function readMonthSortyCaisse($day)
     {
         $type="sortie";
         //Extraire date
         $mydate =explode('-',$day);
         $month = $mydate[1];
         $year  = $mydate[0];
         $m1 = $year.'-'.$month.'-'.'01';
         $m2 = $year.'-'.$month.'-'.'31';

         $con = parent::getPDO();
         $select = $con->prepare('SELECT * FROM caisse WHERE type=? AND date BETWEEN ? AND ?');
         $select->execute(array($type,$m1,$m2));

         $data = $select->fetchAll(PDO::FETCH_CLASS,'Caisse');

         return $data;

     }

     /*
     *Return all the sorties of this day from the caisse
     * @param : day date
     */
     public static function readDaySortyCaisse($day)
     {
         $type="sortie";
         $con = parent::getPDO();
         $select = $con->prepare('SELECT * FROM caisse WHERE type=? AND date=?');
         $select->execute(array($type,$day));

         $data = $select->fetchAll(PDO::FETCH_CLASS,'Caisse');

         return $data;

     }

     /*
    *Return all the Sorties of this Year from the caisse
    * @param : day date
    */
     public static function readYearSortyCaisse($day)
     {
         $type="sortie";
         //Extraire date
         $mydate =explode('-',$day);
         $year  = $mydate[0];
         $m1 = $year.'-'.'01'.'-'.'01';
         $m2 = $year.'-'.'12'.'-'.'31';

         $con = parent::getPDO();
         $select = $con->prepare('SELECT * FROM caisse WHERE type=? AND date BETWEEN ? AND ?');
         $select->execute(array($type,$m1,$m2));

         $data = $select->fetchAll(PDO::FETCH_CLASS,'Caisse');

         return $data;

     }

     /*
   *Return all the Entries of this Year from the caisse
   * @param : day date
   */
     public static function readYearEntryCaisse($day)
     {
         $type="entre";
         //Extraire date
         $mydate =explode('-',$day);
         $year  = $mydate[0];
         $m1 = $year.'-'.'01'.'-'.'01';
         $m2 = $year.'-'.'12'.'-'.'31';

         $con = parent::getPDO();
         $select = $con->prepare('SELECT * FROM caisse WHERE type=? AND date BETWEEN ? AND ?');
         $select->execute(array($type,$m1,$m2));

         $data = $select->fetchAll(PDO::FETCH_CLASS,'Caisse');

         return $data;

     }

    public static function afficherCompte()
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM caisse
                            WHERE compte="COMPTE" ORDER BY date ');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Caisse');

        return $donne;        
    }

    public static function entreMoi($date)
    {
        $con = parent::getPDO();
        $moi = date_parse($date)['month'];
        $annee = date_parse($date)['year'];
        $start_int = $annee.'-'.$moi.'-01';
        $end_int = $annee.'-'.$moi.'-31';         
        $ins = $con->query(' SELECT SUM(somme) AS total 
        	                 FROM caisse 
        	                 WHERE type="entre"
        	                 AND date 
        	                 BETWEEN "'.$start_int.'" AND "'.$end_int.'" ');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Caisse');

        return $donne;        
    }

    public static function sortieMoi($date)
    {
        $con = parent::getPDO();
        $moi = date_parse($date)['month'];
        $annee = date_parse($date)['year'];
        $start_int = $annee.'-'.$moi.'-01';
        $end_int = $annee.'-'.$moi.'-31';         
        $ins = $con->query(' SELECT SUM(somme) AS total 
        	                 FROM caisse 
        	                 WHERE type="sortie"
        	                 AND date 
        	                 BETWEEN "'.$start_int.'" AND "'.$end_int.'" ');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Caisse');

        return $donne;        
    }

    public static function entreAnnee($date)
    {
        $con = parent::getPDO();        
        $annee = date_parse($date)['year'];
        $start_int = $annee.'-01-01';
        $end_int = $annee.'-12-31';         
        $ins = $con->query(' SELECT SUM(somme) AS total 
        	                 FROM caisse 
        	                 WHERE type="entre"
        	                 AND date 
        	                 BETWEEN "'.$start_int.'" AND "'.$end_int.'" ');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Caisse');

        return $donne;        
    }

    public static function sortieAnnee($date)
    {
        $con = parent::getPDO();        
        $annee = date_parse($date)['year'];
        $start_int = $annee.'-01-01';
        $end_int = $annee.'-12-31';         
        $ins = $con->query(' SELECT SUM(somme) AS total 
        	                 FROM caisse 
        	                 WHERE type="sortie"
        	                 AND date 
        	                 BETWEEN "'.$start_int.'" AND "'.$end_int.'" ');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Caisse');

        return $donne;        
    }

    public static function totalEntree($date)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT SUM(somme) as total FROM paiement WHERE eleve="'.$date.'"');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Paiement');

        return $donne;        
    }

    public static function totalSortie($date)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT SUM(somme) as total FROM caisse WHERE eleve="'.$date.'"');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Paiement');

        return $donne;        
    }
    /*
     * Delete a entry of Caisse
     */
     public static function supprimer($id){
         $con = parent::getPDO();
         $delete = $con->prepare('DELETE FROM caisse WHERE id_caisse=?');
         $delete->execute(array($id));
     }

     public static function afficherRecette()
     {
        $con = parent::getPDO();
        $select = $con->query('SELECT * FROM recette ORDER BY date_recette DESC');
        $donne = $select->fetchAll(PDO::FETCH_CLASS, 'Caisse');

        return $donne;
    }

    public static function afficherRecetteOne($recette)
    {
       $con = parent::getPDO();
       $select = $con->query('SELECT * FROM recette WHERE id_recette = "'.$recette.'" ');
       $donne = $select->fetchAll(PDO::FETCH_CLASS, 'Caisse');

       return $donne;
   }

   public static function updateRecette($data)
    {
        $con = parent::getPDO();
        $update = $con->query('UPDATE recette SET date_recette="'.$data['date'].'", somme_recette="'.$data['somme'].'"  WHERE id_caisse="'.$data['recette'].'" ');
    }


    public static function supprimerRecette($recette)
    {
        $con = parent::getPDO();
        $delete = $con->prepare('DELETE FROM recette WHERE id_recette=?');
        $delete->execute(array($recette));
    }




 }