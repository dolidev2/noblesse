<?php

include_once "Model.class.php";

/**
 * Classe  Dossier. 
 *
 * @version 1.0
 * @author zcorp & edotensei
 */

 class Dossier extends Model
 {

    public static function afficher($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM dossier WHERE eleve="'.$id.'" ');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Dossier');

        return $donne;        
    }

    public static function updateOne($champ,$id,$value)
    {
        $con = parent::getPDO();
        $ins = $con->prepare("UPDATE dossier SET $champ=? WHERE id_dossier=?");
        $ins->execute(array($value, $id ));
    }

    public static function InitEleve($id)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO dossier VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $ins->execute(array(NULL,NULL,0,0,0,0,0,0,'',NULL,'','',0,$id ));
    }



 }