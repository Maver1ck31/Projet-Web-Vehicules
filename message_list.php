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

if (isset($_GET['report'])) {
    $userToReport = $_GET['report'];
    $userDao->reportUser($userToReport);
}

?>
<h2 id="titre">Forum - <i><?php echo $topic_name; ?></i> Message List</h2>
                    <?php
                        if ($messages != NULL) {
                            echo '<p><a href="create_message.php?id_topic=' . $topic_id
                            . '&name=' . $topic_name . '"><button>Create new message</button></a></p>';
                            echo '<table class="forum messages">'
                            . '<tr>'
                                . '<th>Message</th>'
                                . '<th>Author</th>'
                                . '<th>Answer(s)</th>'
                                //. '<th>Last answer</th>'
                                . '<th>Action</th>'
                            . '</tr>';
                            foreach ($messages as $message) {
                                
                                // Getting the author of the message
                                if (!isset($userDao)) {
                                    $userDao = new User_dao();
                                }
                                $messageAuthor = $userDao->retrievUserByUsername($message->get_id_emetteur());
                                
                                // Handling actions depending on the type of user: admin can report users
                                // but cannot report admin
                                if (($_SESSION['usertype'] == 2 || $_SESSION['usertype'] == 3) 
                                        && ($messageAuthor->get_id_usertype() != (int) 3 || $messageAuthor->get_id_usertype() != (int) 2)) {
                                    $actions = '<a class="button" href="message_list.php?id_topic=' . $topic_id 
                                            . '&report=' . $message->get_id_emetteur() . '&name=' . $topic_name . '">'
                                                . 'Report'
                                            . '</a>'
                                            . '</br>'
                                            . '<a class="button" href="message_detail.php?id_msg=' . $message->get_id_msg()
                                            . '&name=' . $topic_name .'">'
                                                . 'Reply'
                                            . '</a>';
                                } else {
                                    $actions = '<a class="button" href="message_detail.php?id_msg=' . $message->get_id_msg()
                                            . '&name=' . $topic_name .'">'
                                                . 'Reply'
                                            . '</a>';
                                }
                                
                                // Getting last person and date to answser the message
                                $lastAnswer = $message_dao->getLastAnswer($message->get_id_msg());
                                
                                // Getting image related to message if any exists
                                $imageDao = new Image_dao();
                                $retrievedImage = $imageDao->retrieveImageByMessageId($message->get_id_msg());
                                
                                echo '<tr>'
                                    . '<td style="text-align: left;"><p>'. $message->get_contenu_msg() . '</br>';
                                        if ($retrievedImage != NULL) {
                                            echo '<a class="messageLink" href="' . $retrievedImage->get_link() . '" target="_blank">'
                                            . '<img class="messageImg" src="' . $retrievedImage->get_link() . '" name="' . $retrievedImage->get_name()
                                                    . '" alt="' . $retrievedImage->get_name() . '"/></a></p>';
                                        }
                                    echo '</td>'
                                    . '<td>Posted by '. $message->get_id_emetteur(). ' on ' . $message->get_date_msg() . '</td>'
                                    . '<td style="text-align: center;">'; 
                                        if ($message_dao->getNbOfAnswerForSpecificMessage($message->get_id_msg()) > 0) {
                                            echo $message_dao->getNbOfAnswerForSpecificMessage($message->get_id_msg())
                                            . '</td>'; //. '<td>By ' . $lastAnswer['id_emetteur'] . ' on ' . $lastAnswer['date_rep'] . '</td>';
                                        } else {
                                            echo 'No answer yet</td>';
                                            //. '<td></td>';
                                        }
                                    echo '<td>'. $actions .'</td>'
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
                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>