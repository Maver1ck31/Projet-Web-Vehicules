<?php
session_start();
if (!isset($_SESSION['name'])) {
    ?>
<script type="text/javascript">
alert("To access this page you should be logged in, you will be redirected to the login page.");
document.location = 'login.php';
</script>
    <?php
}

include 'inc/entete.inc.php';

$imageDao = new Image_dao();
$topicDao = new Topic_dao();
$topics = $topicDao->retieveAllTopics();

?>
                    <h2 id="titre">Forum</h2>
                    <p>The website is actually under maintenance<br/>Thank you for your comprehension</p>
                    <p>Welcome to the forum of the ford performance cars.</p>
                    
                    <p>
                        Choose a topic to begin with, you will be able to post message 
                        and answer some of them aswell if you want.
                    <?php
                        if ($topics != NULL) {
                            echo '<table class="forum topics">';
                            foreach ($topics as $topic) {
                                // Retrieve topic icon if exists
                                $topicIcon = $imageDao->retrieveImageById($topic->get_topic_icon());
                                
                                if ($topicIcon != NULL) {
                                    
                                    $iconToShow = '<img class="iconImg" src="' . $topicIcon->get_link() 
                                            . '" name="' . $topicIcon->get_name()
                                            . '" alt="' . $topicIcon->get_name() . '"/>' . "&nbsp | &nbsp";
                                } else {
                                    $iconToShow = '';
                                }
                                
                                echo "<tr><td><a href='message_list.php?id_topic=". $topic->get_id_topic() .
                                        "&name=" . $topic->get_topic_name() . "'>" 
                                        . $iconToShow . $topic->get_topic_name() . "</a></td></tr>";
                            }
                            echo '</table>';
                        }
                    ?>
                    </p>
                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>