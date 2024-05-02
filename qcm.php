<?php
session_start();
if (!isset($_SESSION["pseudo"])) {
    header("location:connexion.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Questions</title>
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/qcm2.css">
</head>

<body>
    <?php
    include_once('connect.php');
    include('header.php');
    ?>

    <section>
        <p>Bonjour, <?= $_SESSION['pseudo'] ?></p>
        <form action="resjeu.php" method="post" class="formulaire">
            <h1 class="title">LE QCM DES SEGPAS</h1>
            <?php

            $req = 'SELECT * FROM questions ORDER BY rand() limit 10';
            $res = mysqli_query($id, $req);
            echo "<ol>";
            while ($ligne = mysqli_fetch_assoc($res)) {
                echo "<h3 class='questions'>" . $ligne['libelleQ'] . "</h3>";
                $idq = $ligne["idq"];
                $req2 = "SELECT * FROM reponses WHERE idq = $idq";
                $res2 = mysqli_query($id, $req2);
                while ($ligne2 = mysqli_fetch_assoc($res2)) {
                    $idr = $ligne2["idr"];
                    echo "<label class = 'reponses'><input type ='radio' name ='$idq' value='$idr'>" . $ligne2["libeller"] . "</label><br>";
                }
                echo "<br>";
            }
            ?>
            <input type="submit" value="Envoyer" class="bouton">
        </form>
    </section>

    <script src="./scripts/qcm.js"></script>
</body>

</html>