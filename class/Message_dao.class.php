<?php

include 'Mon_exception.class.php';

class Message_dao {

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
    
    // Retrieve all messages correponding to a topic
    public function retieveMessageAccordingToTopic($topic) {
        $tableau = NULL;
        try {
            $con = $this->con;
            $sql = "SELECT * FROM message WHERE id_topic = $topic";
            $res = $con->query($sql);

            while ($message = $res->fetch(PDO::FETCH_ASSOC)) {
                $tableau[] = new Message($message);
            }
        } catch (PDOException $exc) {
            $message = "Erreur lor de la requête SQL : " . $exc->getMessage();
            throw new Mon_exception($message);
        }
        
        return $tableau;
    }

    // Insert a new message with correct topic and user
    public function addMessage($content, $user, $topic) {
        try {
            $con = $this->con;
            $content = $con->quote($content);
            $sql = "insert into message(contenu_msg, date_msg, id_emetteur, id_topic)"
                    . "values ($content, SYSDATE(), '$user', $topic)";
            $con->exec($sql);
        } catch (PDOException $e) {
            $message = "Erreur lor de la requête SQL : " . $e->getMessage();
            throw new Mon_exception($message);
        }
    }
}

