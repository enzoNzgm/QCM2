<?php
if ($_SESSION["niveau"] == '1') {
    $navResultats =  '<a href="admin.php" class="link">PAGE ADMIN</a>';
    $addQuestions = '<a href="addQuestions" class="link"> AJOUTER QUESTIONS</a>';
} else {
    $navResultats = null;
    $addQuestions = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/qcm2.css">
</head>

<body>
    <?php
    include_once('connect.php');
    ?>
    <div class="header">
        <a href="qcm.php"><img src="images/quiz.png" alt="Logo site quizz" class="logo_quizz"></a>
        <nav class="nav_links">
            <a href="mesResultats.php" class="link">VOIR MES RESULTATS</a>
            <?= $addQuestions ?>
            <?= $navResultats ?>
            <a href="deconnexion.php" class="link">DECONNEXION</a>
        </nav>
    </div>
</body>

</html>