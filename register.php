<?php
session_start();
$inscrit = "";
$userExists = FALSE;
$mailExists = FALSE;

//Include header and menu
include 'inc/entete.inc.php';

if (isset($_POST['submit'])) {
    
    // retrieving input data
    $username = strtolower($_POST['username']);
    $password = $_POST['passwd'];
    $password2 = $_POST['passwd2'];
    $mail = strtolower($_POST['email']);
    
    error_log('passwd: ' . $password . ' | passwd2: ' . $password2);
    
    // if passwords doesn't match show error
    if ($password != $password2) {
        $inscrit = "<p style='color: red;'>Error the password and confirmation password does not match</p>";
        $_POST['passwd'] = "";
        $_POST['passwd2'] = "";
    } else {    // else handle registration
        $userDao = new User_dao();
    
        $users = $userDao->retrieveAllUsers();
        foreach ($users as $user) {
            if ($user->get_username() == $username) {
                $userExists = TRUE;
                break;
            } else if ($user->get_mail() == $mail) {
                $mailExists = TRUE;
                break;
            }
        }
        
        if ($userExists) {  // Stop register 
            $inscrit = "<p style='color: red;'>Error the username already exists, choose another one</p>";
            $_POST['username'] = "";
        } else if ($mailExists) {   // Stop register
            $inscrit = "<p style='color: red;'>Error the email adress is already linked to an account!</p>";
            $_POST['email'] = "";
        } else {    // Register user
            $userDao->addUser($username, $mail, $password);
            ?>
            <script type="text/javascript">
                alert("Registration successful, you're now able to log in.\nYou will be redirected to login page...");
                document.location = 'login.php';
            </script>
            <?php
            //$inscrit = "<p style='color: green;'>Registration successful, you're now able to log in.</p>";
        }
    
    }    
}
?>
                    <h2 id="titre">Register</h2>
                    <p>Create your account to be able to log into the photo library and discuss with other members.
                        </br> All provide informations will not be shared with anyone. </br>
                            Please fill in all necessary informations.
                    </p>
                    <form method="post" action="register.php">
                        <p>
                            <label for="username"><b>Username</b></label><span style="color: red;">&nbsp;*</span><br/>
                                <input type="text" id="username" name="username"
                                       size="25" maxlength="25" value="<?php
                                       if (isset($_POST['username'])) {
                                           echo $_POST['username'];
                                       }
                                       ?>" required />
                                <br/>
                                <br/>
                                <label for="passwd"><b>Password</b></label><span style="color: red;">&nbsp;*</span><br/>
                                <input type="password" id="passwd" name="passwd"
                                       size="25" maxlength="25" value="" required />
                                <br/>
                                <br/>
                                <label for="passwd"><b>Password confirmation</b></label><span style="color: red;">&nbsp;*</span><br/>
                                <input type="password" id="passwd2" name="passwd2"
                                       size="25" maxlength="25" value="" required />
                                <br/>
                                <br/>
                                <label for="email"><b>E-mail address</b></label><span style="color: red;">&nbsp;*</span><br/>
                                <input type="email" name="email" size="40"
                                       maxlength="40" value="<?php
                                       if (isset($_POST['email'])) {
                                           echo $_POST['email'];
                                       }
                                       ?>" required />
                                <br/>
                                <br/>
                        </p>
                        <div style="width:190px; margin-right:auto">
                            <fieldset>
                                <legend>Actions</legend>
                                <input type="submit" name="submit" value="Register"/>
                            </fieldset>
                        </div>
                        </br>
                        </br>
                        <span style="color: red;">&nbsp;* Mandatory fields</span>
                    </form>

                    <!-- Affiche du message de confirmation si inscription reussi -->
                    <p style="font-weight: 700;"><?php echo $inscrit; ?></p>

                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>