<?php

class Language {
    
    private $id = 0;
    private $label = '';
    
    /* Getter */
    function get_id() {
        return $this->id;
    }
    
    function get_label() {
        return $this->label;
    }

    /* Setter */
    function set_id($value) {
        $this->id = (int) $value;
    }
    
    function set_label($value) {
        $this->label = $value;
    }
    
    /* Hydrateur */
    function hydrater(array $tableau) {
        foreach ($tableau as $cle => $valeur) {
            $methode = 'set_' . $cle;
            if (method_exists($this, $methode)) {
                $this->$methode($valeur);
            }
        }
    }
    
}

