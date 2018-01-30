<?php
$dsn = 'mysql:host=localhost;dbname=photoLibrary';
$con = new PDO($dsn, 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>