<?php
include_once "Model.class.php";

class Audit extends Model{

    /*
     * add a new audit
     * @param : data array
     */
    public static function register($data){

        $con= parent::getPDO();

        $insert = $con->prepare('INSERT INTO audit VALUES(?,?,?,?,?) ');
        $insert->execute(array(null,$data['desc'],$data['action'],$data['user'],date('Y-m-d')));
    }

    /*
     * add a new audit
     * @param : data array
     */
    public static function read(){

        $con= parent::getPDO();

        $select = $con->query('SELECT * FROM audit a , users u WHERE a.user=u.id_user ORDER BY date DESC ');
        $data = $select->fetchAll(PDO::FETCH_CLASS, 'Audit');

        return $data;

    }
}