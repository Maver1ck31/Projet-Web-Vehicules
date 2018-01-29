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

            <nav>
                <img src="images/logo_main-fordracing.png" alt="Ford" id="logoFordRacing"/>
                <ul>
                    <?php
                    //        foreach ($tableau_menu_items as $menu_item) {
                    //            echo '<li><a href="' . $menu_item->get_link() .'">' . $menu_item->get_label() . '</a></li>';
                    //        }
                    ?>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="photos.php">Photos</a></li>
                    <li><a href="login.php">Connexion</a></li>
                </ul>
            </nav>