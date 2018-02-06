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

$topic_id = $_GET['id_topic'];
$topic_name = NULL;

if (isset($_GET['name'])) {
    $topic_name = $_GET['name'];
}

if (isset($_POST['submit'])) {
    include './inc/global.inc.php';
    $content = htmlspecialchars($_POST['message']);
    $user = $_SESSION['name'];
    $messageDao = new Message_dao();
    if ($topic_id != NULL) {
        $messageDao->addMessage($content, $user, $topic_id);
        header('location:message_list.php?id_topic=' . $topic_id . '&name=' . $topic_name);
    }    
}

include 'inc/entete.inc.php';

?>
<h2 id="titre">Create new Message in <i><?php echo $topic_name; ?></i> Topic</h2>
                    <p>The website is actually under maintenance<br/>Thank you for your comprehension</p>
                    <p>Welcome to the forum of the ford performance cars.</p>
                    <p>
                        <div id = "form">
                        <p>Input your new Message</p>
                        <form method="post" action="<?php echo 'create_message.php?id_topic='. $topic_id . '&name=' . $topic_name;?>">
                            <p><label>Message</label></br>
                            <textarea name="message" style="width: 500px; height: 200px;"></textarea></p>
                            <p><input type="submit" name="submit" value="Add"/></p>
			</form>
                        </div>
                    </p>
                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>