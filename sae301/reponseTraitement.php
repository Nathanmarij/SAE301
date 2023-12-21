<?php
include("config.php");
session_start();

try {
    $bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nombase, $utilisateur, $mdp);
} catch (Exception $e) {
    die("erreur");
}

if (isset($_POST['contenu'], $_POST['id_ask']) && isset($_SESSION['user'])) {
    $contenu = $_POST['contenu'];
    $id_ask = $_POST['id_ask'];
    $id_user = $_SESSION['user']; // Supposons que 'user' contient l'ID de l'utilisateur connecté

    $requete = $bdd->prepare("INSERT INTO reponse (contenu, id_ask, id_user) VALUES (?, ?, ?)");
    $requete->execute([$contenu, $id_ask, $id_user]);

    header('Location: forum.php');
}
?>
