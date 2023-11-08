<?php
include_once "Model.class.php";
include_once "Caisse.class.php";

class Versement extends Model {

    /*
     * add a new versement
     * @param : data array
     */
    public  static function register($data){

        $con = parent::getPDO();
        $insert = $con->prepare('INSERT INTO versement VALUES(?,?,?,?,?,?)');
        $insert->execute(array(null,$data['somme'],$data['compte'],$data['date'],$data['mode'],$data['desc']));

        //Prepare data to insert to Caisse
        $data_caisse = array(
            "type" => "sortie",
            "somme" => $data['somme'],
            "desc" => $data['desc'],
            "compte" => $data['compte'],
            "mode" => $data['mode'],
            "date" => $data['date'],
            "eleve" =>0
        );
        //Insert data to Caisse
        Caisse::register($data_caisse);


    }
    /*
    * update a versement
    * @param : data array
    */
    public static function update($data){

        $con = parent::getPDO();
        $update = $con->prepare('UPDATE versement SET somme=?, banque=?, date=?, mode=?,desc_ver=? WHERE id_ver=? ');
        $update->execute(array($data['somme'],$data['compte'],$data['date'],$data['mode'],$data['desc'],$data['ver']));

    }
    /*
   * read all versement
   */
    public static function read(){

        $con = parent::getPDO();
        $select = $con->query('SELECT * FROM versement ORDER BY date DESC ');
        $data = $select->fetchAll(PDO::FETCH_CLASS,'Versement');

        return $data;

    }
    /*
    * read a single versement
    */
    public static function read_single($id){

        $con = parent::getPDO();
        $select = $con->query('SELECT * FROM versement WHERE id_ver="'.$id.'" ');
        $data = $select->fetchAll(PDO::FETCH_CLASS,'Versement');

        return $data;

    }

    /*
    * delete a versement
    */
    public static function delete($id){

        $con = parent::getPDO();
        $delete = $con->query('DELETE  FROM versement WHERE id_ver="'.$id.'" ');

    }

    /*
    * read a single versement
     * @param date date
  */
    public static function readMonth($day){

        $con = parent::getPDO();

        $mydate =explode('-',$day);
        $month = $mydate[1];
        $year  = $mydate[0];
        $m1 = $year.'-'.$month.'-'.'01';
        $m2 = $year.'-'.$month.'-'.'31';
        $select = $con->prepare('SELECT * FROM versement WHERE date BETWEEN ? AND ? ');
        $select->execute(array($m1,$m2));
        $data = $select->fetchAll(PDO::FETCH_CLASS,'Versement');

        return $data;

    }


}