<?php
session_start();
if ($_SESSION['usertype'] != 3) {
    ?>
<script type="text/javascript">
alert("You're not able to access this page, you will be redirected to the home page.");
document.location = 'index.php';
</script>
    <?php
}

include 'inc/entete.inc.php';

$dao = new User_dao();
$reportedUsers = $dao->retrieveReportedUser();

?>
<?php

?>
                    <h2 id="titre">Member Management</h2>
                    <p>The website is actually under maintenance<br/>Thank you for your comprehension</p>
                    <p>Welcome to the forum of the ford performance cars.</p>
                    </br>
                    <h4>Reported Users</h4>
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>Email address</th>
                            <!--<th>Actions</th>-->
                        </tr>
                        <tr>
                            <?php
                            foreach ($reportedUsers as $user) {
                                echo '<td>' . $user->get_username() . '</td>'
                                        . '<td>' . $user->get_mail() . '</td>';
                            }
                            ?>
                        </tr>
                    </table>

                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>