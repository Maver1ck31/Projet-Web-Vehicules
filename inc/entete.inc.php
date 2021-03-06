<?php
include 'global.inc.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Ford Sports Cars Library</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/slideshow.css" />
    </head>
    <body id="top">
        <header id="entete">
            <img src="images/Logo_Ford_performance.png" style="margin-left: 0px; max-width: 90%;" alt="Ford Performance" id="logoFordPerf"/>   
        </header>
        <div id="blank50pxheight"></div>
        <div id="userInfos">
            <div id="ThreeLineMenu">
                <img src="images/ThreeLineMenu.png" alt="menu" onclick="toogleMenu();"/>
            </div>
            <?php
                if (!isset($_SESSION['name'])) {
                    echo '<span>Welcome Guest</span>';
                } else {
                    echo '<span>Welcome ' . $_SESSION['name'];
                    echo '</span>&nbsp; | &nbsp;<span><a href="logout.php">Log out</a></span>';
                }
            ?>
        </div>
        <div id="conteneur">
            <!-- entete -->
            <?php
            include 'inc/menu.inc.php';
            ?>
            <div id="contenu">
                <div style="max-width: 1000px; margin: auto;">
                    <article>