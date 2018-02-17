<?php

include_once 'Exceptions/Mon_exception.class.php';

class Image_dao {

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
    
    // Add a new image in DB
    public function addImage($name, $link, $messageId) {
        try {
            $con = $this->con;
            $name = $con->quote($name);
            $link = $con->quote($link);
            $sql = "insert into image(name, link, id_message)"
                    . "values ($name, $link, $messageId)";
            $con->exec($sql);
        } catch (PDOException $e) {
            $message = "Erreur lor de la requête SQL : " . $e->getMessage();
            throw new Mon_exception($message);
        }
    }
    
    // Retriev image by its id
    public function retrieveImageById($imageId) {
        $image = NULL;
        
        if ($imageId == NULL) {
            return NULL;
        }
        
        try {
            $con = $this->con;
            $sql = "SELECT * "
                    . "FROM image "
                    . "WHERE id_img = " . $imageId;
            $res = $con->query($sql);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            if ($row != FALSE) {
                $image = new Image($row);
            }
            
        } catch (PDOException $e) {
            $message = "Erreur lor de la requête SQL : " . $e->getMessage();
            throw new Mon_exception($message);
        }
        
        return $image;
    }
    
    // Retrieve image linked to a message
    public function retrieveImageByMessageId($messageId) {
        $image = NULL;
        if ($messageId == NULL) {
            return NULL;
        }
        try {
            $con = $this->con;
            $sql = "SELECT * "
                    . "FROM image "
                    . "WHERE id_message = $messageId";
            $res = $con->query($sql);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            if ($row != FALSE) {
                $image = new Image($row);
            }
             
        } catch (PDOException $e) {
            $message = "Erreur lor de la requête SQL : " . $e->getMessage();
            throw new Mon_exception($message);
        }
        
        return $image;
    }
    
    // Retrieve all images in the database
    public function retrieveAllImages() {
        $imagesArray = NULL;
        try {
            $con = $this->con;
            $sql = "SELECT * FROM image";
            $res = $con->query($sql);
            
            while ($image = $res->fetch(PDO::FETCH_ASSOC)) {
                $imagesArray[] = new Image($image);
            }
            
        } catch (PDOException $e) {
            $message = "Erreur lor de la requête SQL : " . $e->getMessage();
            throw new Mon_exception($message);
        }
        
        return $imagesArray;
    }
}

