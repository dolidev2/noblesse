<?php

include_once "Model.class.php";

/**
 * Classe  User. 
 *
 * @version 1.0
 * @author zcorp & edotensei
 */

 class User extends Model
 {


    public static function login($username, $password)
    {
        $con = parent::getPDO();
        
        $us = $con->prepare('SELECT * FROM users 
                              WHERE username=? AND password=?'); 
        $us->execute(array($username, $password));                                
        $data = $us->fetchAll(PDO::FETCH_CLASS, 'User');
        if (!empty($data)) 
        {
            return $data;
        }
        else
        {
            return 'NO';
        }       
        
    }

    public static function logout()
    {
        session_destroy();
        header('location:../index.php');

    }

    public static function register($data)
    {
        $con = parent::getPDO();
        $ins = $con->prepare('INSERT INTO users VALUES(?,?,?,?,?,?)');
        $ins->execute(array(null, $data['nom_user'], $data['prenom_user'], 
            $data['username'], $data['password'], $data['fonction']));

    }

    public static function afficher()
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM users');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'User');

        return $donne;        
    }

    public static function afficherOne($id)
    {
        $con = parent::getPDO();        
        $ins = $con->query('SELECT * FROM users WHERE id_user="'.$id.'"');          
        $donne = $ins->fetchAll(PDO::FETCH_CLASS, 'User');

        return $donne;        
    }

    /*
     * Fonction static Modification
     * @param array, $_POST
     */
    public static function modifier($data = array())
    {
        $con = parent::getPDO();
        $ins = $con->prepare('UPDATE users SET nom_user=?, prenom_user=?, username=?, fonction=?,
                              password=? WHERE id_user=?');
        $ins->execute(array($data['nom_user'], $data['prenom_user'], $data['username'],
                            $data['fonction'], $data['password'], $data['id_user'] ));
    }

    /*
     * Fonction static Supprimer
     * @param array, $_POST
     */
    public static function supprimer($id)
    {
        $con = parent::getPDO();
        
        $sup = $con->prepare('DELETE FROM users WHERE id_user=?');
        $sup->execute(array($id));
        
        
    }

   


 }