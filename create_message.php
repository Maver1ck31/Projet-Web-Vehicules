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

$error = '';
$topic_id = $_GET['id_topic'];
$topic_name = NULL;

if (isset($_GET['name'])) {
    $topic_name = $_GET['name'];
}

if (isset($_POST['submit'])) {
    
    $folder = 'images/uploads/';
    $file = basename($_FILES['fileToUpload']['name']);
    $taille_maxi = 10485760;
    $taille = filesize($_FILES['fileToUpload']['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strrchr($_FILES['fileToUpload']['name'], '.');
    // Handling file upload first
    // Security checks...
    if (isset($_FILES['fileToUpload']['tmp_name'])) {
        if(!in_array($extension, $extensions)) { //if the extension is not allowed
            $error = 'You can only upload a file of type png, gif, jpg or jpeg';
        }
        if($taille>$taille_maxi) {   // If the file is too big
            $error = 'The file is too big...';
        }    
    }
    
    
    if ($error == '') {
        include './inc/global.inc.php';
        $content = htmlspecialchars($_POST['message']);
        $user = $_SESSION['name'];
        $messageDao = new Message_dao();
        $imageDao = new Image_dao();
        if ($topic_id != NULL) {
            $messageDao->addMessage($content, $user, $topic_id);

            if (isset($_FILES['fileToUpload']['tmp_name'])) {
                // Formating file name
                $file = strtr($file, 
                  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $file = preg_replace('/([^.a-z0-9]+)/i', '-', $file);

                // If insert in database was ok, uploading file
                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $folder . $file)) {   // If return TRUE, upload worked
                    // retrieving posted message
                    $messagePosted = $messageDao->getMessageByUserAndContent($user, $content);
                    $imageDao->addImage($file, $folder . $file, $messagePosted->get_id_msg());
                    header('location:message_list.php?id_topic=' . $topic_id . '&name=' . $topic_name);
                } else {
                    $error = 'There was an issue during upload';
                }
            } else {
                header('location:message_list.php?id_topic=' . $topic_id . '&name=' . $topic_name);
            }
        }     
    }
    
}

include 'inc/entete.inc.php';

?>
<h2 id="titre">Create new Message in <i><?php echo $topic_name; ?></i> Topic</h2>
                    <p>Input your new Message</p>
                    <form method="post" action="<?php echo 'create_message.php?id_topic='. $topic_id . '&name=' . $topic_name;?>"
                          enctype="multipart/form-data">
                        <p><label>Message</label></br>
                        <textarea name="message" style="width: 500px; height: 200px;"></textarea></p>
                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                        File: <input type="file" name="fileToUpload">
                        <p><input type="submit" name="submit" value="Add"></p>
                    </form>
                    </p>
                    <p style="color: red;"><?php echo $error; ?></p>
                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>