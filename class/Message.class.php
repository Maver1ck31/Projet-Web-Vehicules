<?php
class Message {
    
    private $id_msg;
    private $contenu_msg;
    private $date_msg;
    private $id_emetteur;
    private $id_topic;

    function __construct($tableau = array()) {
        $this->hydrater($tableau);
    }
    
    // Getters
    function get_id_msg() {
        return $this->id_msg;
    }

    function get_contenu_msg() {
        return $this->contenu_msg;
    }

    function get_date_msg() {
        return $this->date_msg;
    }

    function get_id_emetteur() {
        return $this->id_emetteur;
    }

    function get_id_topic() {
        return $this->id_topic;
    }
    
    // Setters
    function set_id_msg($id_msg) {
        $this->id_msg = $id_msg;
    }

    function set_contenu_msg($contenu_msg) {
        $this->contenu_msg = $contenu_msg;
    }

    function set_date_msg($date_msg) {
        $this->date_msg = $date_msg;
    }

    function set_id_emetteur($id_emetteur) {
        $this->id_emetteur = $id_emetteur;
    }

    function set_id_topic($id_topic) {
        $this->id_topic = $id_topic;
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
?>