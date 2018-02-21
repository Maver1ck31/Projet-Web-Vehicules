<?php
session_start();
$message = "";

// Include header and menu
include 'inc/entete.inc.php';

if (isset($_POST['submit'])) {
    // Retrieving username and password inputed by user
    $passwd = $_POST['passwd'];
    $username = strtolower($_POST['username']);
    
    $userDao = new User_dao();
    $user = $userDao->retrievUserByUsername($username);
    
    if ($user!= NULL) {
        if ($user->get_passwd() != md5($passwd)) {  // Wrong password
            $message = "The password doesn't match for the user: $username";
        } else {
            // User and password match, redirecting and saving data
            $_SESSION['name'] = $user->get_username();
            $_SESSION['usertype'] = $user->get_id_usertype();
            
            if ($user->get_id_usertype() == 3) {    // If user is admin
              header('location: ./member_management.php');  
            } else {
                header('location: ./forum_home.php');
            }
        }
    } else {
        // User doesn't exists in database
        $message = "User not found, check your credentials";
    }
}

?>
                <h2 id="titre">Login</h2>
                <p>In order to access this website and view its content you should log in.
                    </br> If you don't have an account you can <a href="register.php" style="text-decoration: underline;">register</a>.</p>
                <form method="post" action="login.php">
                    <p>
                        <label for="username">Username</label><span style="color: red;">&nbsp;*</span></br>
                        <input type="text" id="username" name="username" size="25" maxlength="25" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];}?>" required="Veuillez compléter ce champ"/>
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
                            <input type="submit" name="submit" value="Connect"/>
                            <input type="reset" value="Reset"/>
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