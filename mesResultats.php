<?php
session_start();
include_once('connect.php');

if (!isset($_SESSION["pseudo"])) {
    header("location:connexion.php");
    exit();
}

$pseudo = $_SESSION["pseudo"];

// Sélectionnez les résultats associés à l'utilisateur connecté
$req = "SELECT users.pseudo, resultats.note, resultats.date 
        FROM users 
        INNER JOIN resultats ON users.idu = resultats.idu
        WHERE users.pseudo = '$pseudo'
        ORDER BY resultats.date DESC";

$res = mysqli_query($id, $req);

if (!$res) {
    echo "Erreur dans la requête SQL : " . mysqli_error($id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Résultats</title>
</head>

<body>
    <?php include('header.php'); ?>
    <h1>MES RESULTATS </h1>
    <table>
        <tr>
            <th>PSEUDO</th>
            <th>RESULTAT</th>
            <th>DATE</th>
        </tr>

        <?php
        while ($ligne = mysqli_fetch_assoc($res)) {
            $dateFormatee = date("d/m/Y H:i:s", strtotime($ligne['date']));
        ?>
            <tr>
                <td><?= $ligne['pseudo']; ?></td>
                <td><?= $ligne['note']; ?>/20</td>
                <td><?= $dateFormatee; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>