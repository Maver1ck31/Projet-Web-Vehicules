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
                            echo '<ul>';
                            foreach ($topics as $topic) {
                                echo "<li><a href='message_list.php?id_topic=". $topic->get_id_topic() .
                                        "&name=" . $topic->get_topic_name() . "'>". $topic->get_topic_name() ."</a></li>";
                            }
                            echo '</ul>';
                        }
                    ?>
                    </p>
                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>