<?php

include_once 'Exceptions/Mon_exception.class.php';

class menu_dao {

    // Objet PDO de connection à la BD
    private $con;

    // Constructeur
    public function __construct() {
        $this->connecter();
    }

    // Fonction de connection à la base de donnée (lancée par le constructeur)
    public function connecter() {
        $config = parse_ini_file('config.ini');
        $user = $config['user'];
        $passwd = $config['passwd'];
        $host = $config['host'];
        $base = $config['dbname'];
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

    // Fonction qui renvoi les items du menu
    public function lire_menu_items($language_id) {
        try {
            $con = $this->con;
            $sql = "SELECT * "
                    . "FROM menu_items "
                    . "WHERE language_id = $language_id";
            $res = $con->query($sql);
            $tableau = array();
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $tableau[] = new menu($row);
            }
        } catch (PDOException $ex) {
            $message = "Erreur lor de la requête SQL : " . $ex->getMessage();
            throw new Mon_exception($message);
            return;
        }
        
        return $tableau;
    }
    
    // Return menu items depending on the type of connected users and language
    public function read_accessible_menu_items($language_id, $usertype) {
        try {
            $con = $this->con;
            $sql = "SELECT mi.id, mi.label, mi.link, mi.language_id"
                    . " FROM menu_items mi"
                    . " JOIN menu_access ma ON mi.id = ma.id_menu"
                    . " WHERE mi.language_id = $language_id"
                    . " AND ma.id_usertype = $usertype";
            $res = $con->query($sql);
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $tableau[] = new menu($row);
            }
        } catch (PDOException $exc) {
            $message = "Erreur lor de la requête SQL : " . $exc->getMessage();
            throw new Mon_exception($message);
            return;
        }
        
        return $tableau;
    }

}
