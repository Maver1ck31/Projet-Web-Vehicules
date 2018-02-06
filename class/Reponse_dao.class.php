<?php

//include 'Mon_exception.class.php';

class Reponse_dao {

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
    
    // Retrieve all answers correponding to a message
    public function retieveAllAnswerByMessageId($messgeId) {
        $tableau = NULL;
        try {
            $con = $this->con;
            $sql = "SELECT * FROM reponse WHERE id_message = $messgeId";
            $res = $con->query($sql);

            while ($reponse = $res->fetch(PDO::FETCH_ASSOC)) {
                $tableau[] = new Reponse($reponse);
            }
        } catch (PDOException $exc) {
            $message = "Erreur lor de la requête SQL : " . $exc->getMessage();
            throw new Mon_exception($message);
        }
        
        return $tableau;
    }

    // Insert a new answer with correct message and user
    public function addAnswer($content, $user, $message) {
        try {
            $con = $this->con;
            $content = $con->quote($content);
            $sql = "insert into reponse(contenu_rep, date_rep, id_emetteur, id_message)"
                    . "values ($content, SYSDATE(), '$user', $message)";
            $con->exec($sql);
        } catch (PDOException $e) {
            $message = "Erreur lor de la requête SQL : " . $e->getMessage();
            throw new Mon_exception($message);
        }
    }
}

