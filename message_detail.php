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

if (isset($_GET['id_msg'])) {
    $message_id = $_GET['id_msg'];
} else {
    $message_id = $_POST['id_msg'];
}

$messageDao = new Message_dao();
$detailedMessage = $messageDao->retieveMessageById($message_id);

$topic_name = '';

if (isset($_GET['name'])) {
    $topic_name = $_GET['name'];
} else {
    $topic_name = $_POST['name'];
}

$reponseDao = new Reponse_dao();
$imageDao = new Image_dao();

if (isset($_POST['submit'])) {
    $content = htmlspecialchars($_POST['answer']);
    $user = $_SESSION['name'];
    if ($message_id != NULL) {
        $reponseDao->addAnswer($content, $user, $message_id);
    }    
}

if (isset($_GET['report'])) {
    $userToReport = $_GET['report'];
    $userDao = new User_dao();
    $userDao->reportUser($userToReport);
}

$reponses = $reponseDao->retieveAllAnswerByMessageId($message_id);
$retrievedImage = $imageDao->retrieveImageByMessageId($message_id);

?>
<h2 id="titre">Answer <i><?php echo $detailedMessage->get_id_emetteur();?></i> Message in <i><?php echo $topic_name; ?></i> Topic</h2>
                    <table class="forum messages">
                        <tr>
                            <th>Original Message</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                <?php echo $detailedMessage->get_contenu_msg(); ?></br>
                                <?php
                                // Display an image if necessary
                                if ($retrievedImage != NULL) {
                                    echo '<p><a href="' . $retrievedImage->get_link() . '" target="_blank">'
                                    . '<img class="messageImg" src="' . $retrievedImage->get_link() . '" name="' . $retrievedImage->get_name()
                                    . '" alt="' . $retrievedImage->get_name() . '"/></a></p>';
                                }
                                ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <?php           
                    // Display all answers
                    if ($reponses != NULL) {
                        echo '<table class="forum">'
                        . '<tr>'
                            . '<th>Answer(s)</th>'
                            . '<th>Author</th>'
                            . '<th>Action</th>'
                        . '</tr>';
                        foreach ($reponses as $reponse) {
                            
                            // Getting the author of the message
                            if (!isset($userDao)) {
                                $userDao = new User_dao();
                            }
                            $messageAuthor = $userDao->retrievUserByUsername($reponse->get_id_emetteur());
                                
                            // Handling actions depending on the type of user: admin can report users
                            if (($_SESSION['usertype'] == 2 || $_SESSION['usertype'] == 3) 
                                        && ($messageAuthor->get_id_usertype() != (int) 2 || $messageAuthor->get_id_usertype() != (int) 3)) {
                                $actions = '<a href="message_detail.php?id_msg=' . $message_id 
                                         . '&report=' . $reponse->get_id_emetteur() . '&name=' . $topic_name . '">'
                                         . '<button>Report</button>'
                                         . '</a>';
                            } else {
                                $actions = '';
                            }
                            
                            echo '<tr>'
                                . '<td style="text-align: left;">'. $reponse->get_contenu_rep() . '</td>'
                                . '<td>Posted by '. $reponse->get_id_emetteur(). ' on ' . $reponse->get_date_rep() . '</td>'
                                . '<td>'. $actions . '</td>'
                            . '</tr>';
                        }
                        echo '<tr>'
                                . '<form method="POST" action="message_detail.php">'
                                    . '<td><textarea name="answer" placeholder="Answer here" style="width: 100%; height: 50px;"></textarea></td>'
                                    . '<td></td>'
                                    . '<td><p><input type="submit" name="submit" value="Post"/></td>'
                                    . '<input hidden ="hidden" type="text" name="name" value="' . $topic_name . '"/>'
                                    . '<input hidden ="hidden" type="text" name="id_msg" value="' . $detailedMessage->get_id_msg() . '"/>'
                                . '</form>'
                           . '</tr>'
                           . '</table>';
                    } else {
                        echo '<table class="forum">'
                        . '<tr>'
                            . '<th>Answer(s)</th>'
                            . '<th>Action</th>'
                        . '</tr>';
                        echo '<tr>'
                                . '<form method="POST" action="message_detail.php">'
                                    . '<td><textarea name="answer" placeholder="Answer here" style="width: 500px; height: 200px;"></textarea></td>'
                                    . '<td><input type="submit" name="submit" value="Create new Answer"/></td>'
                                    . '<input hidden ="hidden" type="text" name="name" value="' . $topic_name . '"/>'
                                    . '<input hidden ="hidden" type="text" name="id_msg" value="' . $detailedMessage->get_id_msg() . '"/>'
                                . '</form>'
                           . '</tr>'
                           . '</table>';
//                        echo '<p>There is no answer for this message yet.</p>'
//                        . '<p><form method="POST" action="message_detail.php">'
//                                    . '<textarea name="answer" style="width: 500px; height: 200px;"></textarea>'
//                                    . '<p><input type="submit" name="submit" value="Create new Answer"/></p>'
//                                    . '<input hidden ="hidden" type="text" name="name" value="' . $topic_name . '"/>'
//                                    . '<input hidden ="hidden" type="text" name="id_msg" value="' . $detailedMessage->get_id_msg() . '"/>'
//                                . '</form></p>';
                    }
                    ?>
                    </p>
                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>