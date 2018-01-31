<?php
session_start();

$message = "";

if (isset($_GET['id_faq'])) {
    // Récupération de l'id via url paramétré
    $_SESSION['id_faq'] = $_GET['id_faq'];
}

// Connexion à la BD
include '../inc/connexion.inc.php';

$sqlFetch = 'SELECT * FROM faq WHERE id_faq = ' . $_SESSION['id_faq'];

// Lecture de la BD
try {
    $res = $con->query($sqlFetch);
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    die("<p>Erreur lors de la requête SQL: " . $ex->getMessage() . "</p>");
}

foreach ($rows as $row) {
    // Récupérations des valeurs de la BD
    $num = $row['id_faq'];
    $question = $row['question'];
    $reponse = $row['reponse'];
}

// Validation de la modification de la question
if (isset($_POST['submit'])) {
    // Mise entre quote de la question et de la réponse
    // $question = $con->quote($_POST['question']);
    $reponse = $con->quote($_POST['reponse']);

    // Requête SQL de MAJ de la question
    $sqlUpdate = "UPDATE faq SET reponse=$reponse, dat_reponse=SYSDATE() WHERE id_faq = " . $_SESSION['id_faq'];

    try {
        // MAJ dans la BD
        $update = $con->exec($sqlUpdate);
        $message = "Modification de la question réussie";
    } catch (Exception $ex) {
        die("<p>Erreur lors de la requête SQL: " . $ex->getMessage() . "</p>");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editer</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div id = 'page'>
            <!-- Inclusion de l'entete et du menu -->
            <?php include '../inc/menu.inc.php'; ?>
            <?php include '../inc/titre.inc.php'; ?>
            
            <!-- Corps de la page: Formulaire de MAJ -->
            <div id = 'corps'>
                <h1><u>Modification</u></h1>
                <?php
                if (!isset($_SESSION['name']) || $_SESSION['usertype'] == 1) {
                    echo 'Vous devez être administrateur pour pouvoir accéder à cette page!';
                } else {
                    echo '<div id = "form">';
                    echo "<h2>Question N° $num</h2>";
                    echo '<p>Veuillez saisir les modifications de cette Foire Aux Questions</p>';
                    echo '<form method="post" action="edit.php">
                                    <p><label>Question</label></br>
                                    <textarea name="question" style="width: 500px; height: 50px;" disabled="disabled">' . $question . '</textarea></p>
                                    <p><label>Réponse</label></br>
                                    <textarea name="reponse" style="width: 500px; height: 50px;">' . $reponse . '</textarea></p>
                                    <p><input type="submit" name="submit" value="Enregister"/></p>
                                </form>
                                </div>';
                }
                ?>
                <p style = "margin-left: 3.5%; color: green;"><b><?php echo $message; ?></b></p>
                <p style = "margin-left: 3.5%;"><a href="listeQuestions.php">
                        <img src="../images/Actions/application_view_list.png"></a>
                    Revenir à la liste des questions</p>
            </div>
        </div>
    </body>
</html>
