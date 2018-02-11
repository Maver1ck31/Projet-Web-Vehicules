<?php
class Topic {

    private $id_topic;
    private $topic_name;
    private $topic_icon;
    
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
    
    function get_topic_icon() {
        return $this->topic_icon;
    }

    // Setters
    function set_id_topic($id_topic) {
        $this->id_topic = $id_topic;
    }

    function set_topic_name($topic_name) {
        $this->topic_name = $topic_name;
    }

    function set_topic_icon($topic_icon) {
        $this->topic_icon = $topic_icon;
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