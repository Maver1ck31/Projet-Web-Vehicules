<?php

include 'Mon_exception.class.php';

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
        $passwd = 'root';
        $host = 'localhost';
        $base = 'photoLibrary';
        $dsn = 'mysql:host=' . $host . ';dbname=' . $base;

        try {
            $con = new PDO($dsn, $user, $passwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->con = $con; // Enregistre la connexion
        } catch (PDOException $e) {
            $message = "Erreur lors de la connexion : " . $e->getMessage();
            throw new Mon_exception($message);
        }
    }
    
    public function addUser($username, $mail, $passwd) {
        try {
            $con = $this->con;
            $cryptPasswd = md5($passwd);
            $sql = "insert into user(username, mail, passwd, id_usertype, isReported)"
                    . "values ('$username', '$mail', '$cryptPasswd', 1, 0)";
            $con->exec($sql);
        } catch (PDOException $e) {
            $message = "Erreur lor de la requête SQL : " . $e->getMessage();
            throw new Mon_exception($message);
        }
    }
    
    public function removeUser($p_username) {
        try {
            $con = $this->con;
            $sql = "DELETE FROM user WHERE username = '$p_username'";
            $con->exec($sql);
        } catch (PDOException $ex) {
            $message = "Erreur lor de la requête SQL : " . $ex->getMessage();
            throw new Mon_exception($message);
        }
    }
    
    public function unreportUser($p_username) {
        try {
            $con = $this->con;
            $sql = "UPDATE user SET isReported = 0 WHERE username = '$p_username'";
            $con->exec($sql);
        } catch (PDOException $ex) {
            $message = "Erreur lor de la requête SQL : " . $ex->getMessage();
            throw new Mon_exception($message);
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
        }
    }
    
    public function retrieveReportedUser() {
        $tableau = NULL;
        try {
            $con = $this->con;
            $sql = "SELECT * FROM user WHERE isReported = 1";
            $res = $con->query($sql);

            while ($user = $res->fetch(PDO::FETCH_ASSOC)) {
                $tableau[] = new User($user);
            }
        } catch (PDOException $exc) {
            $message = "Erreur lor de la requête SQL : " . $exc->getMessage();
            throw new Mon_exception($message);
        }
        
        return $tableau;
    }

}

