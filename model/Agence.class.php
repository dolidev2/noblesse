<?php
include_once "Model.class.php";

class Agence extends Model{

    public static function register($data)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO agence VALUES(?,?,?,?)');
        $ins->execute(array(null, $data['nom'], $data['position'], $data['contact']));
    }

    public static function afficherEleveByAgence($agence)
    {
        $con = parent::getPDO();
        $ins = $con->query('SELECT * FROM eleve e, agence a WHERE e.agence = a.id_agence AND a.id_agence ="'.$agence.'"  ORDER BY nom,prenom');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Agence');

        return $donne;
    }
    public static function afficherEleve()
    {
        $con = parent::getPDO();
        $ins = $con->query('SELECT eleve FROM  agence ' );
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Agence');

        return $donne;
    }
    public static function updateEleve($eleve)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('UPDATE agence SET eleve =? ');
        $ins->execute(array($eleve));
    }

    public static function afficherAgence()
    {
        $con = parent::getPDO();
        $ins = $con->query('SELECT * FROM  agence ORDER BY nom_agence');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Agence');

        return $donne;
    }

    public static function afficherAgenceOne($agence)
    {
        $con = parent::getPDO();
        $ins = $con->query('SELECT * FROM  agence WHERE id_agence="'.$agence.'" ');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Agence');

        return $donne;
    }  

    public static function afficherAgenceDiff($agence)
    {
        $con = parent::getPDO();
        $ins = $con->query('SELECT * FROM  agence WHERE id_agence != "'.$agence.'" ');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Agence');

        return $donne;
    }  

    public static function afficherOneByAgenceSiege($agence)
    {
        $con = parent::getPDO();
        $ins = $con->query('SELECT * FROM  agence WHERE nom_agence="'.$agence.'" ');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Agence');

        return $donne;
    }

    public static function afficherCaisseByAgence($agence)
    {
        $con = parent::getPDO();
        $ins = $con->query('SELECT * FROM eleve e, agence a, caisse c WHERE e.agence = a.id_agence AND c.eleve=e.id_eleve AND a.id_agence ="'.$agence.'"  ');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Agence');

        return $donne;
    }
}