<?php
session_start();
include 'inc/entete.inc.php';

$imageDao = new Image_dao();
$messageDao = new Message_dao();

// Search depending on search value if it's set
if (isset($_POST['search'])) {
    $images = $imageDao->retrieveSpecificImages($_POST['search']);
} else {
    $images = $imageDao->retrieveAllImages();
}

// To handle table show by 3 columns
$nbCaseTab = 0;
?>
                    <h2 id="titre">Images</h2>
                    <p>This page gather all images from the website and forum. You d'ont need to have an 
                        account to access this webpage content.
                    </p>
                    <p>
                        <form method="post" action="photos.php">
                            <p style="display: inline-block;">
                                <label>Search in image gallery: </label></br>
                                <input type="text" name="search" style="float: left;"/>
                                <input type="image" value="submit" src="images/actions/loupe2.png" width="19px" height="19px" style="float: left; margin: 2px 0px 0px 10px;"/>
                            </p>
                        </form>
                    <p>

                    <table class="photos">
                        <?php
                        if ($images != NULL) {
                            for ($i = 0; $i < count($images); $i++) {
                                if ($nbCaseTab % 3 == 0) {
                                    echo '<tr>';
                                }
                                
                                if (($i < count($images)) && $images[$i] != NULL) {
                                    $imageToShow = $images[$i];
                                    $messageImage = $messageDao->retieveMessageById($imageToShow->get_id_message());

                                    $type = substr($imageToShow->get_link(), 7, 7);

                                    if ($type != "icones/") {
                                        echo '<td><a href="' . $imageToShow->get_link() . '" target="_blank">'
                                            . '<p><img class="photo" src="' . $imageToShow->get_link() . '"'
                                            . 'alt="' . $imageToShow->get_name() . '"'
                                            . 'name="' . $imageToShow->get_name() .'"/></a>';
                                        
                                        $nbCaseTab++;
                                    }

                                    if ($messageImage != NULL) {
                                        echo '</br> Posted by: ' . $messageImage->get_id_emetteur()
                                           . '</p></td>';
                                    } else {
                                        echo '</p></td>';
                                    }
                                    
                                }
                                
                                if ($nbCaseTab%3 == 0) {
                                    echo '</tr>';
                                }
                            }
                            
                        } else {
                            echo '<p>No images</p>';
                        }
                        ?>
                    </table>
                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>