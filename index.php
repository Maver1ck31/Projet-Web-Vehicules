<?php
session_start();

// Retrieve XML file with images to load
$xmlFile = "xml/slider.xml";

// Loading xml content
$xml = simplexml_load_file($xmlFile);

// Number of images
$nbOfImages = $xml->count();

include 'inc/entete.inc.php';
?>   
                        <h2 id="titre">Photos Library</h2>
                        <p>This website has the purpose to show some images and 
                            discuss about Ford Performance cars such as:
                        </p>

                        <div style="text-align: center;">
                            <!-- Slideshow container -->
                            <div class="slideshow-container">
                                
                                <!-- Full-width images with number and caption text -->
                                <?php
                                // print each image contain in xml file
                                foreach ($xml as $image) {
                                    echo 
                                    '<div class="mySlides fade">'
                                        . '<img src="' . $image->link . '">'
                                        . '<div class="text">' . $image->caption . '</div>'
                                    . '</div>';
                                }
                                ?>
                                
                                <!-- Next and previous buttons -->
                                <a class="prev" onclick="plusSlides(-1)">&nbsp;</a>
                                <a class="next" onclick="plusSlides(1)">&nbsp;</a>
                            </div>
                        </div>
                        <br>

                        <!-- The dots/circles -->
                        <div style="text-align:center">
                          <?php
                          // Display dots depending on number of image object in XML file
                          for ($i = 0; $i < $nbOfImages; $i++) {
                              echo ' <span class="dot" onclick="currentSlide(' . ($i + 1) . ')"></span> ';
                          }
                          ?>
                        </div>

                        <ul>
                            <li>Ford Focus RS</li>
                            <li>Ford Mustang</li>
                            <li>Ford Fiesta ST</li>
                            <li>Ford GT</li>
                        </ul>
                    
                        <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>