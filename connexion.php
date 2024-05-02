<?Php
session_start();
include_once('connect.php');
if (isset($_POST["bout"])) {
    $pseudo = $_POST["pseudo"];
    $password = $_POST["password"];
    $req = "SELECT * FROM users WHERE pseudo='$pseudo' AND password='$password'";
    $res = mysqli_query($id, $req);
    $ligne = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) > 0) {
        $_SESSION["idu"] = $ligne["idu"];
        $_SESSION["pseudo"] = $pseudo;
        $_SESSION["niveau"] = $ligne["niveau"];
        header("location:qcm.php");
    } else {
        $erreur = "Erreur de pseudo ou de mot de passe!!!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/login.css">
</head>

<body>
    <div id="container">
        <h1>Connexion</h1>
        <form action="connexion.php" method="post">
            <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            <?php if (isset($erreur)) echo "<b>$erreur</b>"; ?><br>
            <p class="forget_password"><a href="inscription.php">Mot de passe oublié</a></p>
            <input type="submit" value="CONNEXION" name="bout">
            <p>Je n'ai pas de compte? <a href="inscription.php">Crée le</a></p>
        </form>
    </div>

</body>

</html>