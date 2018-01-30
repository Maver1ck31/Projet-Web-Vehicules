<?php

class menu {

    private $id = 0;
    private $label = '';
    private $link = '';
    private $language_id = 0;

    function __construct($tableau = array()) {
        $this->hydrater($tableau);
    }

    /*
     * Getters
     */

    function get_id() {
        return $this->id;
    }

    function get_label() {
        return $this->label;
    }

    function get_link() {
        return $this->link;
    }

    function get_language_id() {
        return $this->language_id;
    }

    /*
     * Setters
     */

    function set_id($value) {
        $this->id = (int) $value;
    }

    function set_label($value) {
        $this->label = $value;
    }

    function set_link($value) {
        $this->link = $value;
    }

    function set_language_id($value) {
        $this->language_id = (int) $value;
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
