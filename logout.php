<?php
   // Destruction des variables de session
   session_start();
   session_unset();
   session_destroy();
   setcookie(session_name(), '', -1, '/');  // Destruction des cookies
   header('location: index.php');
?>