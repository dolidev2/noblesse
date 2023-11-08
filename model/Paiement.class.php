<?php

include_once "Model.class.php";
include_once "Caisse.class.php";
include_once "Eleve.class.php";

/**
 * Classe  Paiement. 
 *
 * @version 1.0
 * @author zcorp & edotensei
 */

 class Paiement extends Model
 {

    public static function register($data)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO paiement VALUES(?,?,?,?,?,?)');
        var_dump($ins->execute(array(null,$data['numero'], $data['date_paiement'], $data['somme'], $data['type'], 
            $data['id'] )));

        //Get data of student who pays
        $eleve = Eleve::afficherOne($data['id']);
        //Prepare data to insert to Caisse
        $desc = $data['type'].' '.$eleve[0]->nom.' '.$eleve[0]->prenom;
        $data_caisse = array(
            "type" => "entre",
            "somme" => $data['somme'],
            "desc" => $desc,
            "compte" => "compte",
            "mode" => "ESPECE",
            "date" => $data['date_paiement'],
            "eleve" => $data['id']
        );
        //Insert data to Caisse
        Caisse::register($data_caisse);
        $nb = Paiement::CountPaiementOne($data['id']);

        if($nb[0]->paiement == "1")
        {
            if ($eleve[0]->frais != 0)
            {
                //Prepare data to insert to Caisse
                $desc = 'FRAIS DE DOSSIER DE '.' '.$eleve[0]->nom.' '.$eleve[0]->prenom;
                $data_caisse_sortie = array(
                    "type" => "sortie",
                    "somme" =>$eleve[0]->frais ,
                    "desc" => $desc,
                    "compte" => "compte",
                    "mode" => "ESPECE",
                    "date" => $data['date_paiement'],
                    "eleve" => $data['id']
                );
                Caisse::register($data_caisse_sortie);
            }
        }
    }


     /*AFFicher nb Paiement élève*/
     public static function CountPaiementOne($id)
     {
         $con = parent::getPDO();
         $ins = $con->query('SELECT COUNT(*) AS paiement FROM paiement WHERE eleve="'.$id.'"');
         $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Paiement');

         return $donne;
     }
    public static function afficher($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM paiement WHERE eleve="'.$id.'" ORDER BY date_paiement');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Paiement');

        return $donne;        
    }

     public static function afficherOne($id)
     {
         $con = parent::getPDO();
         $ins = $con->query('SELECT * FROM paiement p, eleve e WHERE p.eleve = e.id_eleve AND id_paiement="'.$id.'" ');
         $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Paiement');

         return $donne;
     }
    public static function genererNumbRecu()
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT COUNT(id_paiement) AS nombre FROM paiement');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Paiement');

        return $donne;        
    }

    public static function afficherEleve($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query("SELECT * FROM paiement p, eleve e 
                            WHERE e.id_eleve=p.eleve
                            AND p.id_paiement = $id
                            AND statut=1");          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Paiement');

        return $donne;        
    }

   

    public static function afficherTotalOne($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT SUM(somme) as total FROM paiement WHERE eleve="'.$id.'"');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Paiement');

        return $donne;        
    }

    public static function afficherSomModif($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT somme  FROM paiement WHERE id_paiement="'.$id.'"');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Paiement');

        return $donne;        
    }

    /*
     * Fonction static Modification
     * @param array, $_POST
     */
    public static function modifier($data = array())
    {
        $con = parent::getPDO();
        $ins = $con->prepare('UPDATE paiement SET numero =?, date_paiement=?, somme=?, type=? WHERE id_paiement=?');
        $ins->execute(array($data['numero'],$data['date_paiement'], $data['somme'], $data['type'],
                            $data['id_paiement'] ));
    }

    /*
     * Fonction static Supprimer
     * @param array, $_POST
     */
    public static function supprimer($id)
    {
        $con = parent::getPDO();
        
        $sup = $con->prepare('DELETE FROM paiement WHERE id_paiement=?');
        $sup->execute(array($id));
        
        
    }

   


 }