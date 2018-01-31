<?php
session_start();

$message = "";

// Récupération de l'id de la question via url paramétré
if (isset($_GET['id_faq'])) {
    $_SESSION['id_faq'] = $_GET['id_faq'];
}

// Connexion à la BD
include '../inc/connexion.inc.php';

// Requête de lecture de la base pour une question en particulier
$sqlFetch = 'SELECT * FROM faq WHERE id_faq = ' . $_SESSION['id_faq'];

// Récupération des valeurs de la question
try {
    $res = $con->query($sqlFetch);
    $rows = $res->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    die("<p>Erreur lors de la requête SQL: " . $ex->getMessage() . "</p>");
}

foreach ($rows as $row) {
    $num = $row['id_faq'];
    $question = $row['question'];
    $reponse = $row['reponse'];
}

// Validation de la modification de la question
if (isset($_POST['submit'])) {
    
// Récupération des valeurs
    $question = "";
    $reponse = "";
    
    // Requête de supression de la base
    $sqlDelete = "DELETE FROM faq WHERE id_faq = " . $_SESSION['id_faq'];

    try {
        // Suppression de la question dans la base
        $update = $con->exec($sqlDelete);
        $message = '<p style="font-size: 15px; margin-left: 3.5%; color: green;"><b>La question N° ' . $_SESSION['id_faq'] . ' a bien été supprimée.</b></p>';
    } catch (Exception $ex) {
        die("<p>Erreur lors de la requête SQL: " . $ex->getMessage() . "</p>");
    }
}
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Supprimer</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script src="js/bjqs-1.3.min.js"></script>
    </head>
    <body id="top">
        <div id = 'page'>
            <!-- inclusion du titre et du menu de la page-->
            <?php include '../inc/titre.inc.php'; ?>
            <?php include '../inc/menu.inc.php'; ?>
            
            <!-- Division représentant le cadre du corps-->    
            <div id="corps">
                <h1><u>Suppression</u></h1>
                <?php
                if (!isset($_SESSION['name']) || $_SESSION['usertype'] == 1) {
                    echo 'Vous devez être administrateur pour pouvoir accéder à cette page!';
                } else {
                    echo '<div id = "form">';
                    echo "<h2>Question N° $num</h2>";
                    echo '<p>Cliquez sur le bouton supprimer pour supprimer la question de cette Foire Aux Questions</p>';
                    echo '<form method="post" action="delete.php">
                                    <p><label>Question</label></br>
                                    <textarea name="question" style="width: 500px; height: 50px;" disabled="disabled">' . $question . '</textarea></p>
                                    <p><label>Réponse</label></br>
                                    <textarea name="reponse" style="width: 500px; height: 50px;" disabled="disabled">' . $reponse . '</textarea></p>
                                    <p><input type="submit" name="submit" value="Supprimer"/></p>
                                </form>
                                </div>';
                    echo $message;
                }
                ?>
                <p style = "margin-left: 3.5%;"><a href="listeQuestions.php">
                        <img src="../images/Actions/application_view_list.png"></a>
                    Revenir à la liste des questions</p>
            </div>
        </div>
    </body>