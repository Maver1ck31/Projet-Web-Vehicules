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

// Unreport or delete user
if (isset($_POST['unreport'])) {
    $dao->unreportUser($_POST['unreport']);
} else if (isset ($_POST['delete'])) {
    $dao->removeUser($_POST['delete']);
}

$reportedUsers = $dao->retrieveReportedUser();

?>
                    <h2 id="titre">Member Management</h2>
                    </br>
                    <h4>Reported Users</h4>
                            <?php
                            if ($reportedUsers != NULL) {
                                echo '<table>'
                                        . '<tr>
                                            <th>Username</th>
                                            <th>Email address</th>
                                            <th>Actions</th>
                                           </tr>';
                                foreach ($reportedUsers as $user) {
                                    echo '<tr>';
                                    echo '<td>' . $user->get_username() . '</td>'
                                            . '<td>' . $user->get_mail() . '</td>'
                                            . '<td><form action="member_management.php" method="POST">'
                                            . '<button name="unreport" value="'. $user->get_username() .'">Unreport</button>'
                                            . '<button name="delete" value="'. $user->get_username() .'">Delete</button>'
                                            . '</form></td>';
                                    echo '</tr>';
                                }
                                echo '</tr>
                                </table>';
                            } else {
                                echo '<p>There is no reported user.</p>';
                            }
                            ?>
                        </tr>
                    </table>

                    <!-- Footer -->
                    <?php
                    include 'inc/bas.inc.php';
                    ?>