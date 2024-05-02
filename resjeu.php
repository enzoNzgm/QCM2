<?php
session_start();
include_once('connect.php');
include('header.php');
$note = 0;
foreach ($_POST as $cle => $val) {
    $req = "SELECT * FROM reponses WHERE idr = $val";
    $res = mysqli_query($id, $req);
    $ligne = mysqli_fetch_assoc($res);
    if ($ligne["verite"] == 1) {
        $note += 2;
    } else {
        $req2 = "SELECT * FROM  questions WHERE idq = $cle";
        $res2 = mysqli_query($id, $req2);
        $ligne2 = mysqli_fetch_assoc($res2);
        echo $ligne2['libelleQ'] . "<br>";
        $req3 = "SELECT * FROM  reponses WHERE idq = $cle AND verite=1";
        $res3 = mysqli_query($id, $req3);
        $ligne3 = mysqli_fetch_assoc($res3);
        echo "La bonne réponse est: " . "<b>" . $ligne3['libeller'] . "</b> " . "<br>";
    }
}
echo "Tu as eu $note/20";



//Envoi resultat dans la table resultat
$pseudo = $_SESSION['pseudo'];
$idu = $_SESSION['idu'];
$req4 = "INSERT INTO resultats (idu, note, date) VALUES ($idu , $note, now())";
mysqli_query($id, $req4);
