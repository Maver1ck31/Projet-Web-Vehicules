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

$topic_id = $_GET['id_topic'];
$topic_name = NULL;

if (isset($_GET['name'])) {
    $topic_name = $_GET['name'];
}

if ($topic_id != NULL) {
    $message_dao = new Message_dao();
    $messages = $message_dao->retieveMessageAccordingToTopic($topic_id);    
}

?>
<h2 id="titre">Forum - <i><?php echo $topic_name; ?></i> Message List</h2>
                    <p>The website is actually under maintenance<br/>Thank you for your comprehension</p>
                    <p>Welcome to the forum of the ford performance cars.</p>
                    <div>
                    <?php
                        if ($messages != NULL) {
                            echo '<table>'
                            . '<tr>'
                                . '<th>Message</th>'
                                . '<th>Author</th>'
                                . '<th>Answer(s)</th>'
                                . '<th>Last answer</th>'
                            . '</tr>';
                            foreach ($messages as $message) {
                                echo '<tr>'
                                    . '<td style="text-align: left;">'. $message->get_contenu_msg() . '</td>'
                                    . '<td>Posted by '. $message->get_id_emetteur(). ' on ' . $message->get_date_msg() . '</td>'
                                    . '<td></td>'
                                    . '<td></td>'
                                . '</tr>';
                            }
                            echo '</table>'
                            . '<p><a href="create_message.php?id_topic=' . $topic_id
                            . '&name=' . $topic_name . '"><button>Create new message</button></a></p>';
                        } else {
                            echo '<p>There is no message for this topic yet.</p>'
                            . '<p><a href="create_message.php?id_topic=' . $topic_id
                            . '&name=' . $topic_name . '"><button>Create new message</button></a></p>';
                        }
                    ?>
                    </div>
                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>