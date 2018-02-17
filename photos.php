<?php
session_start();
include 'inc/entete.inc.php';

$imageDao = new Image_dao();
$messageDao = new Message_dao();

$images = $imageDao->retrieveAllImages();
?>
                    <h2 id="titre">Images</h2>
                    <p>The page is actually under maintenance<br/>Thank you for your comprehension</p>

                    <table class="photos">
                        <?php
                        if ($images != NULL) {
                            for ($i = 0; $i < count($images); $i+=3) {
                                echo '<tr>';
                                if (($i < count($images)) && ($images[$i] != NULL)) {
                                    $image1 = $images[$i];
                                    $messageImage = $messageDao->retieveMessageById($image1->get_id_message());
                                    echo '<td><a href="' . $image1->get_link() . '" target="_blank">'
                                            . '<p><img src="' . $image1->get_link() . '"'
                                            . 'alt="' . $image1->get_name() . '"'
                                            . 'name="' . $image1->get_name() .'"/></a>';
                                    if ($messageImage != NULL) {
                                        echo '</br> Posted by: ' . $messageImage->get_id_emetteur()
                                           . '</p></td>';
                                    } else {
                                        echo '</p></td>';
                                    }
                                }
                                if ((($i+1) < count($images)) && ($images[$i+1] != NULL)) {
                                    $image2 = $images[$i+1];
                                    $messageImage = $messageDao->retieveMessageById($image2->get_id_message());
                                    echo '<td><a href="' . $image2->get_link() . '" target="_blank">'
                                            . '<p><img src="' . $image2->get_link() . '"'
                                            . 'alt="' . $image2->get_name() . '"'
                                            . 'name="' . $image2->get_name() .'"/></a>';
                                    if ($messageImage != NULL) {
                                        echo '</br> Posted by: ' . $messageImage->get_id_emetteur()
                                           . '</p></td>';
                                    } else {
                                        echo '</p></td>';
                                    }
                                }
                                if ((($i+2) < count($images)) && ($images[$i+2] != NULL)) {
                                    $image3 = $images[$i+2];
                                    $messageImage = $messageDao->retieveMessageById($image3->get_id_message());
                                    echo '<td><a href="' . $image3->get_link() . '" target="_blank">'
                                            . '<p><img src="' . $image3->get_link() . '"'
                                            . 'alt="' . $image3->get_name() . '"'
                                            . 'name="' . $image3->get_name() .'"/></a>';
                                    if ($messageImage != NULL) {
                                        echo '</br> Posted by: ' . $messageImage->get_id_emetteur()
                                           . '</p></td>';
                                    } else {
                                        echo '</p></td>';
                                    }
                                }
                                echo '</tr>';
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