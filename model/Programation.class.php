<?php

include_once "Model.class.php";

/**
 * Classe  Dossier. 
 *
 * @version 1.0
 * @author zcorp & edotensei
 */

 class Programation extends Model
 {
     public static function register($data)
     {
         $con = parent::getPDO();
         $ins = $con->prepare('INSERT INTO programation VALUES(?,?,?,?,?,?,?,?)');
         $ins->execute(array(NULL,$data['nom'],$data['prenom'],$data['dob'],$data['pob'],$data['agence'],$data['categorie'],$data['examen'] ));
     }

    public static function afficher($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM programation WHERE examen="'.$id.'" ORDER BY nom,prenom ');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Programation');

        return $donne;        
    }



    public static function updateOne($champ,$id,$value)
    {
        $con = parent::getPDO();
        $ins = $con->prepare("UPDATE dossier SET $champ=? WHERE id_dossier=?");
        $ins->execute(array($value, $id ));
    }

    public static function supprimerEleveProgram($id)
    {
        $con = parent::getPDO();
        
        $sup = $con->prepare('DELETE FROM programation WHERE id_programation=?');
        $sup->execute(array($id));
    }

    public static function InitEleve($id)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO dossier VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $ins->execute(array(NULL,NULL,0,0,0,0,0,0,'',NULL,'','',0,$id ));
    }

    public static function supprimer($id)
    {
        $con = parent::getPDO();
        
        $sup = $con->prepare('DELETE FROM programation WHERE id_programation=?');
        $sup->execute(array($id));        
    }

 }