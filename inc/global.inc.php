<?php
//include_once './../class/Exceptions/Mon_exception.class.php';

// Autoload
try {

    function my_autoloader($classe) {
        include 'class/' . $classe . '.class.php';
    }
    
    spl_autoload_register('my_autoloader');
    
} catch (Mon_exception $e) {
    echo "<p>" . $e->getMessage() . "</p>";
}
?>