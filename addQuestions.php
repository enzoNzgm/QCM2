<?php
session_start();
include_once('connect.php');
if ($_SESSION["niveau"] !== '1') {
    header("location: qcm.php");
    exit();
};

if (isset($_POST["bout"])) {
    $question = trim($_POST["question"]);
    $reponseVrai = trim($_POST['reponseVrai']);
    $reponseFausse1 = trim($_POST['reponseFausse1']);
    $reponseFausse2 = trim($_POST['reponseFausse2']);
    $reponseFausse3 = trim($_POST['reponseFausse3']);

    if (!empty($question) && !empty($reponseVrai) && !empty($reponseFausse1) && !empty($reponseFausse2) && !empty($reponseFausse3)) {
        $req = "INSERT INTO `question`(`libelleQ`, `niveau`) VALUES ('$question', '0')";
        mysqli_query($id, $req);
    } else {
        $error = "Tous les champs ne sont pas complété!";
    }
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Ajouter des questions</h1>
    <form action="addQuestions.php" method="post">
        <label for="question">Ajoute la question :</label>
        <input type="text" name="question" id="question"><br><br>

        <label for="reponseVrai">Ajoute la vrai réponse :</label>
        <input type="text" name="reponseVrai" id="reponseVrai"><br>

        <label for="reponseFausse1">Ajoute la fausse reponse 1 :</label>
        <input type="text" name="reponseFausse1" id="reponseFausse1"><br>

        <label for="reponseFausse2">Ajoute la fausse reponse 2 :</label>
        <input type="text" name="reponseFausse2" id="reponseFausse2"><br>

        <label for="reponseFausse3">Ajoute la fausse reponse 3 :</label>
        <input type="text" name="reponseFausse3" id="reponseFausse3"><br>

        <input type="submit" value="ENVOYER" name="bout">
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</body>

</html>