<?php
$config = parse_ini_file('class/config.ini');
$dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'];
$con = new PDO($dsn, $config['user'], $config['passwd'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>