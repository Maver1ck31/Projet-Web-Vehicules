<?php
session_start();
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
                                <div class="mySlides fade">
                                  <img src="images/2016-ford-focus-rs.jpg">
                                  <div class="text">Focus RS MK3</div>
                                </div>

                                <div class="mySlides fade">
                                    <img src="images/2015-Ford-Mustang.jpg" >
                                  <div class="text">Ford Mustang GT</div>
                                </div>

                                <div class="mySlides fade">
                                    <img src="images/2017-ford-fiesta-st.jpg" >
                                  <div class="text">Ford Fiesta ST MK7</div>
                                </div>

                                <div class="mySlides fade">
                                    <img src="images/2017-ford-GT-Grey.jpg" >
                                  <div class="text">Ford GT (2017)</div>
                                </div>

                                <!-- Next and previous buttons -->
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                            </div>
                        </div>
                        <br>

                        <!-- The dots/circles -->
                        <div style="text-align:center">
                          <span class="dot" onclick="currentSlide(1)"></span> 
                          <span class="dot" onclick="currentSlide(2)"></span>
                          <span class="dot" onclick="currentSlide(3)"></span>
                          <span class="dot" onclick="currentSlide(4)"></span>
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