<?php
session_start();
include "connect.php";

if (isset($_POST["bout"])) {
    $pseudo = trim($_POST["pseudo"]);
    $password = trim($_POST["password"]);
    $password2 = trim($_POST["password2"]);

    if (!empty($pseudo) && !empty($password) && !empty($password2)) {
        if ($password == $password2) {
            $req = "INSERT INTO `users`(`pseudo`,`password`) VALUES ('$pseudo', '$password')";
            mysqli_query($id, $req);
            echo mysqli_error($id);
            header('location: connexion.php');
        } else {
            $erreur = "Les mots de passe ne sont pas similaires!";
        }
    } else {
        $erreur = "Les champs ne peuvent pas être vides!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription QCM</title>
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/inscription.css">
</head>

<body>
    <div id="container">
        <form action="inscription.php" method="post">
            <h1>Inscription au QCM</h1>
            <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre Pseudo" required>
            <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>
            <input type="password" name="password2" id="password2" placeholder="Confirmer votre mot de passe" required>
            <?php if (isset($erreur)) echo "<b>$erreur</b>"; ?><br>
            <input type="submit" value="INSCRIT-TOI" name="bout">
            <p>J'ai une compte? <a href="connexion.php">Connecte toi !</a></p>
        </form>
    </div>
</body>

</html>