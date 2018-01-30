<?php

class User {

    private $username = '';
    private $passwd = '';
    private $mail = '';
    private $idUsertype = 0;
    private $isReported = 0;

    function __construct($tableau = array()) {
        $this->hydrater($tableau);
    }

    
    /*
     * Getters
     */

    function get_username() {
        return $this->username;
    }

    function get_passwd() {
        return $this->passwd;
    }

    function get_mail() {
        return $this->mail;
    }

    function get_idUsertype() {
        return $this->idUsertype;
    }

    function get_isReported() {
        return $this->isReported;
    }

    
    /*
     * Setters
     */

    function set_username($username) {
        $this->username = $username;
    }

    function set_passwd($passwd) {
        $this->passwd = $passwd;
    }

    function set_mail($mail) {
        $this->mail = $mail;
    }

    function set_idusertype($idUsertype) {
        $this->idUsertype = $idUsertype;
    }

    function set_isReported($isReported) {
        $this->isReported = $isReported;
    }

// hydratation de l'objet
    function hydrater(array $tableau) {
        foreach ($tableau as $cle => $valeur) {
            $methode = 'set_' . $cle;
            if (method_exists($this, $methode)) {
                $this->$methode($valeur);
            }
        }
    }

}
