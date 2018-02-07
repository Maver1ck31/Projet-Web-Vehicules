<?php
session_start();
$inscrit = "";
$userExists = FALSE;
$mailExists = FALSE;

// Si l'on appuie sur le bouton s'inscrire
if (isset($_POST['submit'])) {
    // Récupération des valeurs
    $username = $_POST['username'];
    $password = $_POST['passwd'];
    $mail = $_POST['email'];

    // Connexion à la BD
    include 'inc/connexion.inc.php';

    // Hashage du password
    // $password = password_hash($con->quote($password), PASSWORD_DEFAULT);
    $password = sha1($password);

    // Requete SQL de selection des pseudo
    $sqlSelect = "SELECT username, mail FROM user";

    // Requête SQL d'insertion
    $sql = "INSERT INTO user(username, passwd, mail, id_usertype) VALUES"
            . "('$username', '$password', '$mail', 1)";

    try {
        // Load de la BD
        $result = $con->query($sqlSelect);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        // Vérification existance utilisateur
        foreach ($rows as $row) {
            if ($row['username'] == $username) {
                $userExists = TRUE;
                break;
            } else if ($row['mail'] == $mail) {
                $mailExists = TRUE;
                break;
            }
        }

        // Affichage ou ajout en fonction de la valeur de userExits et mailExists
        if ($userExists || $mailExists) {
            if ($userExists) {
                $inscrit = "<p style='color: red;'>Error the username already exists!</p>";
                $_POST['username'] = "";
                ?>

<!--            <script type="text/javascript">
                alert(<?php echo 'The username: ' . $username . ' already exists'; ?>);
            </script>-->

            <?php
            } else if ($mailExists) {
                $inscrit = "<p style='color: red;'>Error the email adress is already linked to an account!</p>";
                $_POST['email'] = "";
            }
        } else {
            // Ajout à la BD
            $res = $con->exec($sql);
            $inscrit = "<p style='color: green;'>Registration successful, you're now able to log in.</p>";           
        }
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
}
?>

<!-- Include header and menu-->
<?php
include 'inc/entete.inc.php';
?>
                    <h2 id="titre">Register</h2>
                    <p>The website is actually under maintenance<br/>Thank you for your comprehension</p>

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