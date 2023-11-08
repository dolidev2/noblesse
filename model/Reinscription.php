<?php
include_once "Model.class.php";

class Reinscription extends Model
{

    public static function register($data)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO reinscription VALUES(?,?,?,?,?,?)');
        $ins->execute(array(null, $data['eleve'], $data['date'], $data['duree'],$data['solde'],$data['datetmp']));
    }

    public static function afficheOne($id){

        $con = parent::getPDO();
        $ins = $con->query('SELECT * FROM reinscription WHERE eleve="'.$id.'" ORDER BY createdAt DESC LIMIT 0,1');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Reinscription');

        return $donne;
    }
    public static function afficher()
    {
        $con = parent::getPDO();
        $ins = $con->query('SELECT * FROM reinscription r, eleve e WHERE e.id_eleve=r.eleve  ORDER BY createdAt DESC ');
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'Reinscription');

        return $donne;
    }
}