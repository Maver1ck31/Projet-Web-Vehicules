<?php

/**
 * Description of Image
 *
 * @author william
 */
class Image {
    
    private $id_img;
    private $name;
    private $link;
    private $id_message;
    
    public function __construct($tableau = array()) {
        $this->hydrater($tableau);
    }
    
    // Getters
    function get_id_img() {
        return $this->id_img;
    }

    function get_name() {
        return $this->name;
    }

    function get_link() {
        return $this->link;
    }

    function get_id_message() {
        return $this->id_message;
    }
    
    // Setters
    function set_id_img($id_img) {
        $this->id_img = $id_img;
    }

    function set_name($name) {
        $this->name = $name;
    }

    function set_link($link) {
        $this->link = $link;
    }

    function set_id_message($id_message) {
        $this->id_message = $id_message;
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
