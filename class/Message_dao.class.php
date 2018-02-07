<?php

include_once 'Exceptions/Mon_exception.class.php';

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
    
    // Retrieving message using its id
    public function retieveMessageById($messageId) {
        try {
            $con = $this->con;
            $sql = "SELECT * FROM message WHERE id_msg = $messageId";
            $res = $con->query($sql);

            $row = $res->fetch(PDO::FETCH_ASSOC);
            $message = new Message($row);
            
        } catch (PDOException $exc) {
            $message = "Erreur lor de la requête SQL : " . $exc->getMessage();
            throw new Mon_exception($message);
        }
        
        return $message;
    }

    // Insert a new message with correct topic and user
    public function addMessage($content, $user, $topic) {
        try {
            $con = $this->con;
            $content = $con->quote($content);
            error_log('message to add:' . $content);
            $sql = "insert into message(contenu_msg, date_msg, id_emetteur, id_topic)"
                    . "values ($content, SYSDATE(), '$user', $topic)";
            $con->exec($sql);
        } catch (PDOException $e) {
            $message = "Erreur lor de la requête SQL : " . $e->getMessage();
            throw new Mon_exception($message);
        }
    }
    
    // Return the nulber of answer for the message with id passed in param
    public function getNbOfAnswerForSpecificMessage($messageId) {
        try {
            $con = $this->con;
            $sql = "SELECT COUNT(id_rep) as nbMsg
                    FROM reponse
                    WHERE id_message =  $messageId";
            $res = $con->query($sql);

            $row = $res->fetch(PDO::FETCH_ASSOC);
            $nbMessage = $row['nbMsg'];
            
        } catch (PDOException $exc) {
            $message = "Erreur lor de la requête SQL : " . $exc->getMessage();
            throw new Mon_exception($message);
        }
        
        return $nbMessage;
    }
    
    // Return an array of the last person to answer (id_emetteur) and date (date_rep)
    public function getLastAnswer($messageId) {
        try {
            $con = $this->con;
            $sql = "SELECT reponse.id_emetteur, reponse.date_rep
                    FROM reponse
                    WHERE reponse.id_message = $messageId
                    AND date_rep = (SELECT MAX(date_rep) FROM reponse WHERE reponse.id_message = $messageId)";
            $res = $con->query($sql);

            $row = $res->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $exc) {
            $message = "Erreur lor de la requête SQL : " . $exc->getMessage();
            throw new Mon_exception($message);
        }
        
        return $row;
    }
    
    // Retrieve Message using emetteur and content
    public function getMessageByUserAndContent($user, $content) {
        try {
            $con = $this->con;
            $content = $con->quote($content);
            $user = $con->quote($user);
            $sql = "SELECT *
                    FROM message
                    WHERE contenu_msg = $content
                    AND id_emetteur = $user ";
            $res = $con->query($sql);
            error_log('SQL Request getMessageByUserAndContent: ' . $sql);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            if ($row != FALSE) {
                $message = new Message($row);
            }
            
        } catch (PDOException $exc) {
            $message = "Erreur lor de la requête SQL : " . $exc->getMessage();
            throw new Mon_exception($message);
        }
        
        return $message;
    }
}

