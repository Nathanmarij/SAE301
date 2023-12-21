<?php
include("config.php");
session_start();

try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase, $utilisateur, $mdp);
} catch (Exception $e) {
    die("erreur");
}

if (isset($_GET['id']) && isset($_SESSION["user"])) {
    $responseId = $_GET['id'];

    // Vérifier si l'utilisateur est l'auteur de la réponse
    $requete = 'SELECT id_user FROM reponse WHERE id_reponse = :id_reponse';
    $statement = $bdd->prepare($requete);
    $statement->bindValue(':id_reponse', $responseId, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['id_user'] == $_SESSION["user"]) {
        // Supprimer la réponse
        $deleteQuery = 'DELETE FROM reponse WHERE id_reponse = :id_reponse';
        $deleteStatement = $bdd->prepare($deleteQuery);
        $deleteStatement->bindValue(':id_reponse', $responseId, PDO::PARAM_INT);
        $deleteStatement->execute();
    }
}

header('Location: forum.php');
exit();
?>
