<?php
session_start();

$message = "";
if (isset($_POST['submit'])) {
    // Retrieving password inputed by user
    $passwd = $_POST['passwd'];
    $username = $_POST['username'];
    
    // Connecting database
    include 'inc/connexion.inc.php';
    
    // Retrieving user in database
    $sql = "SELECT * "
            . "FROM users WHERE pseudo = '" . $username ."'";   
    $res = $con->query($sql);
    $row = $res->fetch(PDO::FETCH_ASSOC);
    
    
    if ($row != FALSE) {    // User is found in database
        // Comparing inputed password with database stored password
        $dbPasswd = $row['passwd'];
        
        if ($dbPasswd != sha1($passwd)) {   // Wrong password
            $message = "The password doesn't match for the user: $username";
        } else {
            // User and password match, redirecting and saving data
            $_SESSION['name'] = $row['username'];
            $_SESSION['usertype'] = $row['id_usertype'];
            header('location: photos.php');
        }
    } else {    // User doesn't exists in database
        $message = "User not found, check your credentials";
    }
}

?>

<!-- Include header and menu-->
<?php
include 'inc/global.inc.php';
include 'inc/entete.inc.php';
?>
            <div id="contenu">
                <h2 id="titre">Login</h2>
                <p>The website is actually under maintenance<br/>Thank you for your comprehension</p>

                <p>In order to access this website and view its content you should log in.</p>
                <form method="post" action="login.php">
                    <p>
                        <label for="username">Username</label><span style="color: red;">&nbsp;*</span></br>
                        <input type="text" id="username" name="username" size="25" maxlength="25" value="<?php if(isset($_POST['pseudo'])){ echo $_POST['pseudo'];}?>" required="Veuillez compléter ce champ"/>
                        </br>
                        </br>
                        <label for="passwd">Password</label><span style="color: red;">&nbsp;*</span></br>
                        <input type="password" id="passwd" name="passwd" size="25" maxlength="25" value="" required="Veuillez compléter ce champ"/>
                        </br>
                        </br>
                    </p>
                    <div style="width:190px; margin-right:auto">
                        <fieldset>
                            <legend>Actions</legend>
                            <input type="submit" name="submit" value="Envoyer"/>
                            <input type="reset" value="Réinitialiser"/>
                        </fieldset>
                    </div>
                    </br>
                    </br>
                    <span style="color: red;">&nbsp;* Mandatory fields</span>
                </form>
                <p style="color: red; font-weight: 700;"><?php echo $message; ?></p>
                
                <!-- Footer -->
                <?php
                include 'inc/bas.inc.php';
                ?>