<?php

ini_set('display_errors', '1');
ini_set('html_errors', '1');

if (!isset($_SESSION)) {
    session_start();
}

// Autoload
//try {
//
//    function my_autoloader($classe) {
//        include 'class/' . $classe . '.class.php';
//    }
//
//    spl_autoload_register('my_autoloader');
//} catch (Mon_exception $e) {
//    echo "<p>" . $e->getMessage() . "</p>";
//}
?>