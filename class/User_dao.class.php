<?php

include './Mon_exception.class.php';

class User_dao {

    // Objet PDO de connection à la BD
    private $con;

    // Constructeur
    public function __construct() {
        $this->connecter();
    }

    // Fonction de connection à la base de donnée (lancée par le constructeur)
    public function connecter() {
        $user = 'root';
        $passwd = 'stssio!';
        $host = 'localhost:8890';
        $base = 'fordPerfLibrary_db';
        $dsn = 'mysql:host=' . $host . ';dbname=' . $base;

        try {
            $con = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->con = $con; // Enregistre la connexion
        } catch (PDOException $e) {
            $message = "Erreur lors de la connexion : " . $e->getMessage();
            throw new Mon_exception($message);
            return;
        }
    }
    
    public function addUser($username, $mail, $passwd) {
        try {
            $con = $this->con;
            $cryptPasswd = md5($passwd);
            $sql = "insert into user(username, mail, passwd)"
                    . "values ('$username', '$mail', '$cryptPasswd')";
            $con->exec($sql);
        } catch (PDOException $e) {
            $message = "Erreur lor de la requête SQL : " . $e->getMessage();
            throw new Mon_exception($message);
            return;
        }
    }
    
    public function retrieveUser($username, $passwd) {
        try {
            $con = $this->con;
            $cryptPasswd = md5($passwd);
            $sql = "select * from user where username = '$username' "
                    . "and passwd = '$cryptPasswd'";
            $res = $con->exec($sql);
            $user = $res->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            $message = "Erreur lor de la requête SQL : " . $e->getMessage();
            throw new Mon_exception($message);
            return;
        }
    }

}

