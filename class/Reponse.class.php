<?php
class Reponse {
    
    private $id_rep;
    private $contenu_rep;
    private $date_rep;
    private $id_emetteur;
    private $id_message;

    function __construct($tableau = array()) {
        $this->hydrater($tableau);
    }
    
    // Getters
    function get_id_rep() {
        return $this->id_rep;
    }

    function get_contenu_rep() {
        return $this->contenu_rep;
    }

    function get_date_rep() {
        return $this->date_rep;
    }

    function get_id_emetteur() {
        return $this->id_emetteur;
    }

    function get_id_message() {
        return $this->id_message;
    }
    
    // Setters
    function set_id_rep($id_rep) {
        $this->id_rep = $id_rep;
    }

    function set_contenu_rep($contenu_rep) {
        $this->contenu_rep = $contenu_rep;
    }

    function set_date_rep($date_rep) {
        $this->date_rep = $date_rep;
    }

    function set_id_emetteur($id_emetteur) {
        $this->id_emetteur = $id_emetteur;
    }

    function set_id_topic($id_message) {
        $this->id_topic = $id_message;
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