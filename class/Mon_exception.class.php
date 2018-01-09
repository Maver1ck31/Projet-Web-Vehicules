<?php

// Classe Mon_exception
class Mon_exception extends Exception {

    public function __construct($message) {
        $message = '<b>Message : ' . $message . '</b><br />Fichier : ' . $this->getFile() . '<br />Ligne : ' . $this->getLine();
        parent::__construct($message, 255);
    }

}

// Class Mon_exception
?>