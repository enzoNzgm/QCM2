<?php
session_start();
include_once('connect.php');

if ($_SESSION["niveau"] !== '1') {
    header("location: qcm.php");
    exit();
}

// Récupérez tous les résultats
$reqTous = "SELECT users.pseudo, resultats.note, resultats.date 
            FROM users 
            INNER JOIN resultats ON users.idu = resultats.idu";

// Paramètres de tri
$triNote = isset($_GET['triNote']) ? $_GET['triNote'] : 'desc';
$triDate = isset($_GET['triDate']) ? $_GET['triDate'] : 'desc';

$reqTous .= " ORDER BY resultats.note $triNote, resultats.date $triDate";

$resTous = mysqli_query($id, $reqTous);

// Vérifiez si la requête a réussi avant de continuer
if (!$resTous) {
    echo "Erreur dans la requête SQL pour les résultats : " . mysqli_error($id);
}

// Filtrer les résultats si un utilisateur est sélectionné
$pseudoFiltre = isset($_GET['pseudo']) ? $_GET['pseudo'] : null;

if ($pseudoFiltre) {
    $resultatsFiltres = [];
    while ($ligne = mysqli_fetch_assoc($resTous)) {
        if ($ligne['pseudo'] == $pseudoFiltre) {
            $resultatsFiltres[] = $ligne;
        }
    }
} else {
    // Aucun filtre, utilisez tous les résultats
    $resultatsFiltres = $resTous;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <?php include('header.php'); ?>
    <h1>PAGE ADMINISTRATEUR</h1>

    <!-- Filtre pour les utilisateurs -->
    <section class="container">
        <form action="" method="get" class="filtre_container">
            <label for="pseudo">Filtrer par pseudo : </label>
            <select name="pseudo" id="pseudo">
                <option value="">Tous les utilisateurs</option>
                <?php
                // Afficher les options de filtre pour chaque utilisateur
                $resUtilisateurs = mysqli_query($id, "SELECT DISTINCT pseudo FROM users");
                while ($ligneUtilisateur = mysqli_fetch_assoc($resUtilisateurs)) {
                    $pseudoSelectionne = ($pseudoFiltre == $ligneUtilisateur['pseudo']) ? 'selected' : '';
                    echo "<option value='" . $ligneUtilisateur['pseudo'] . "' $pseudoSelectionne>" . $ligneUtilisateur['pseudo'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Filtrer">
            <!-- Boutons de tri -->
            <button type="submit" name="triNote" value="asc">Trier par note croissante</button>
            <button type="submit" name="triNote" value="desc">Trier par note décroissante</button>
            <button type="submit" name="triDate" value="asc">Trier par date croissante</button>
            <button type="submit" name="triDate" value="desc">Trier par date décroissante</button>
        </form>
        <!-- Affichage des résultats -->
        <table>
            <tr>
                <th>PSEUDO</th>
                <th>RESULTAT</th>
                <th>DATE</th>
            </tr>
            <?php
            foreach ($resultatsFiltres as $ligne) {
                $dateFormatee = date("d/m/Y H:i:s", strtotime($ligne['date']));
                echo "<tr>";
                echo "<td>" . $ligne['pseudo'] . "</td>";
                echo "<td>" . $ligne['note'] . "/20</td>";
                echo "<td>" . $dateFormatee . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </section>

</body>

</html>