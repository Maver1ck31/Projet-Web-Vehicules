<?php
//Autoload
try {
    // initilaising usertype value if user is not connected
    if (!isset($_SESSION['usertype'])) {
        $_SESSION['usertype'] = 4;
    }
    
    // lecture en base
    $dao = new menu_dao();
    $tableau_menu_items = $dao->read_accessible_menu_items(2, $_SESSION['usertype']);
} catch (Mon_exception $e) {
    echo "<p>" . $e->getMessage() . "</p>";
}
?>
            <nav>
                <img src="images/logo_main-fordracing.png" alt="Ford" id="logoFordRacing"/>
                <ul>
                    <?php
                            foreach ($tableau_menu_items as $menu_item) {
                                if ($menu_item->get_link() != "login.php" && isset($_SESSION['name'])) {
                                    echo '<li><a href="' . $menu_item->get_link() .'">' . $menu_item->get_label() . '</a></li>';
                                } else if (!isset ($_SESSION['name'])) {
                                    echo '<li><a href="' . $menu_item->get_link() .'">' . $menu_item->get_label() . '</a></li>';
                                }
                            }
                    ?>
                </ul>
            </nav>