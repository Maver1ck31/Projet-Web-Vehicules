<?php
// Autoload
//try {
//    // lecture en base
//    $dao = new menu_dao();
//    $tableau_menu_items = $dao->lire_menu_items(1);
//} catch (Mon_exception $e) {
//    echo "<p>" . $e->getMessage() . "</p>";
//}
//?>

<!-- <div id="banner_image">
    <img src="images/fordPerformanceLogo.jpg" width="673" height="300" style="margin-left: 0px;" alt="Ford Performance"/>
</div> -->

<div id="topbanner">
    <ul>
        <?php
//        foreach ($tableau_menu_items as $menu_item) {
//            echo '<li><a href="' . $menu_item->get_link() .'">' . $menu_item->get_label() . '</a></li>';
//        }
        ?>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="photos.php">Photos</a></li>
        <li><a href="connexion.php">Connexion</a></li>
    </ul>
</div>