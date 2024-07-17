<?php

include_once "Model.class.php";

/**
 * Classe  Examen. 
 *
 * @version 1.0
 * @author zcorp & edotensei
 */

 class Examen extends Model
 {

    public static function register($data)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO examen VALUES(?,?,?,?,?,?)');
        $ins->execute(array(null, $data['date'], $data['examinateur'], $data['type'], $data['site'], $data['desc_examen'] ));
    }

     public static function registerSite($nom)
     {
         $con = parent::getPDO();
         $ins = $con->prepare('INSERT INTO site VALUES(?,?)');
         $ins->execute(array(null, $nom ));
     }

    public static function registerProgram($data)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO program VALUES(?,?,?)');
        $ins->execute(array(null, $data['eleve'], $data['examen'] ));
    }

    public static function afficherProgram($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query("SELECT count(*) AS nombre FROM examen e, program p WHERE e.id_examen=p.examen AND id_examen=$id  ORDER BY date_examen DESC");          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

        return $donne;        
    }

     public static function afficherSite()
     {
         $con = parent::getPDO();
         $ins = $con->query("SELECT * FROM site");
         $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

         return $donne;
     }

     public static function afficherSiteExamen($examen)
     {
         $con = parent::getPDO();
         $ins = $con->query('SELECT nom_site FROM site s, examen e WHERE s.id_site =e.site AND e.id_examen="'.$examen.'"');
         $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

         return $donne;
     }

    public static function registerExamenEleve($data)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO examen_eleve VALUES(?,?,?,?,?)');
        $ins->execute(array(null, $data['id_eleve'], $data['id_examen'], $data['resultat'],null ));
    }

     public static function afficher()
     {
         $con = parent::getPDO();
         $ins = $con->query('SELECT * FROM examen  ORDER BY date_examen DESC');
         $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

         return $donne;
     }

    public static function afficherExamenSite($site)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM examen WHERE site="'.$site.'" AND type!="code" ORDER BY date_examen DESC');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

        return $donne;        
    }
     public static function afficherExamenCode()
     {
         $type='code';
         $con = parent::getPDO();
         $ins = $con->query('SELECT * FROM examen WHERE type="'.$type.'" ORDER BY date_examen DESC');
         $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

         return $donne;
     }


     public static function afficherOne($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM eleve WHERE id_eleve="'.$id.'"');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Eleve');

        return $donne;        
    }

     public static function afficherOneExamen($id)
     {
         $con = parent::getPDO();
         $ins = $con->query('SELECT * FROM examen WHERE id_examen="'.$id.'"');
         $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

         return $donne;
     }


     public static function supprimerEleveProgram($id)
    {
        $con = parent::getPDO();
        
        $sup = $con->prepare('DELETE FROM program WHERE id_program=?');
        $sup->execute(array($id));
    }

    public static function afficherExamenOne($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM examen WHERE id_examen="'.$id.'"');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

        return $donne;        
    }

    public static function afficherExamen()
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM examen ORDER BY date_examen DESC');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

        return $donne;        
    }

    public static function afficherParticipant($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT COUNT(eleve) as participant FROM examen e, examen_eleve ex 
                            WHERE e.id_examen = ex.examen 
                            AND ex.examen = "'.$id.'" ');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

        return $donne;        
    }

    public static function afficherParticipantExamenOne($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM eleve e, examen ex, examen_eleve exe 
                            WHERE e.id_eleve = exe.eleve 
                            AND ex.id_examen = exe.examen
                            AND exe.examen = "'.$id.'"
                            ORDER BY nom');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Eleve');

        return $donne;        
    }

    public static function afficherParticipantProgram($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM eleve e, examen ex, program p, site s, agence a
                            WHERE e.id_eleve = p.eleve 
                            AND ex.id_examen = p.examen
                            AND ex.site = s.id_site
                            AND a.id_agence = e.agence
                            AND p.examen = "'.$id.'"
                            ORDER BY nom');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Eleve');

        return $donne;        
    }
     public static function afficherParticipantResultat($id)
 {
     $con = parent::getPDO();
     $ins = $con->query('SELECT nom,prenom,dob,pob,agence,type,date_examen,id_eleve,resultat,id_examen,
                                    examinateur,categorie,type_examen
                                   FROM eleve e, examen ex, examen_eleve el
                            WHERE e.id_eleve = el.eleve 
                            AND ex.id_examen = el.examen
                            AND ex.id_examen = "'.$id.'"
                            ORDER BY nom');
     $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Eleve');

     return $donne;
 }
     public static function afficherResultat($eleve,$examen)
     {
         $con = parent::getPDO();
         $ins = $con->query(' SELECT * FROM  examen_eleve 
                            WHERE eleve = "'.$eleve.'" AND examen = "'.$examen.'"  ');
         $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Eleve');

         return $donne;
     }

     public static function affichertExamenEleveCode($type_examen,$id_eleve)
     {
         $con = parent::getPDO();        
         $ins = $con->query('SELECT * FROM eleve e, examen ex, examen_eleve exe 
                             WHERE e.id_eleve = exe.eleve 
                             AND ex.id_examen = exe.examen
                             AND exe.eleve = "'.$id_eleve.'"
                             AND ex.type = "'.$type_examen.'"
                             ORDER BY ex.date_examen DESC');          
         $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Eleve');
 
         return $donne;        
     }
    public static function affichertExamenEleve($type_examen,$id_eleve)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM eleve e, examen ex, examen_eleve exe 
                            WHERE e.id_eleve = exe.eleve 
                            AND ex.id_examen = exe.examen
                            AND exe.eleve = "'.$id_eleve.'"
                            AND exe.type_examen = "'.$type_examen.'"
                            ORDER BY ex.date_examen DESC');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Eleve');

        return $donne;        
    }

    public static function supprimer($id)
    {
        $con = parent::getPDO();
        
        $sup = $con->prepare('DELETE FROM examen_eleve WHERE examen=?');
        $sup->execute(array($id));

        $sup = $con->prepare('DELETE FROM program WHERE examen=?');
        $sup->execute(array($id));

        $sup = $con->prepare('DELETE FROM examen WHERE id_examen=?');
        $sup->execute(array($id));       
        
        
    }

    public static function modifier($data = array())
    {
        $con = parent::getPDO();
        $ins = $con->prepare('UPDATE examen SET date_examen =?, examinateur=?, type=? WHERE id_examen=?');
        $ins->execute(array($data['date'],$data['examinateur'], $data['type'], $data['id_examen'] ));
    }

     public static function addResultat($data = array())
     {
         $con = parent::getPDO();
         $ins = $con->prepare('INSERT INTO examen_eleve VALUES (?,?,?,?,?)');
         $ins->execute(array(null,$data['eleve'],$data['examen'],$data['resultat'],$data['exam'] ));
     }
     public static function modifierResultat($data = array())
     {
         $con = parent::getPDO();
         $ins = $con->prepare('UPDATE examen_eleve SET resultat =?  WHERE examen=? AND eleve=?');
         $ins->execute(array($data['resultat'],$data['examen'], $data['eleve']));
     }

     public static function modifierResultatOnly($data)
     {
         $con = parent::getPDO();
         $ins = $con->prepare('UPDATE examen_eleve SET resultat =?  WHERE id_examen_eleve=?');
         $ins->execute(array($data['resultat'],$data['examen_eleve']));
     }

     public static function modifierResultatExamen($data = array())
     {
         $con = parent::getPDO();
         $ins = $con->prepare('UPDATE examen_eleve SET type_examen =?  WHERE examen=? AND eleve=?');
         $ins->execute(array($data['exam'],$data['examen'], $data['eleve']));
     }


     public static function afficherResultatUnique($examen,$eleve)
     {
         $con = parent::getPDO();
         $ins = $con->query('SELECT * FROM examen_eleve
                            WHERE examen = "'.$examen.'" 
                            AND eleve = "'.$eleve.'" ');
         $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Examen');

        return $donne;
     }

     // Convertit une date ou un timestamp en français
     public static function dateToFrench($date, $format)
     {
         $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
         $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
//         $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
//         $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
         return str_replace($english_days, $french_days, date($format, strtotime($date) ) ) ;
     }


 }