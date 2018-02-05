<?php
class Topic {

    private $id_topic;
    private $topic_name;
    
    function __construct($tableau = array()) {
        $this->hydrater($tableau);
    }
    
    // Getters
    function get_id_topic() {
        return $this->id_topic;
    }

    function get_topic_name() {
        return $this->topic_name;
    }
    
    // Setters
    function set_id_topic($id_topic) {
        $this->id_topic = $id_topic;
    }

    function set_topic_name($topic_name) {
        $this->topic_name = $topic_name;
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