<?php
include("config.php");
session_start();

try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase, $utilisateur, $mdp);
} catch (Exception $e) {
    die("erreur");
}

if (isset($_GET['id']) && isset($_SESSION["user"])) {
    $commentId = $_GET['id'];

    // Récupérer l'id de l'utilisateur qui a publié le commentaire
    $requete = 'SELECT id_user FROM forum WHERE id_ask = :id_ask';
    $statement = $bdd->prepare($requete);
    $statement->bindValue(':id_ask', $commentId, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $authorId = $result['id_user'];
        $currentUserId = $_SESSION["user"];

        // Vérifier si l'utilisateur connecté est l'auteur ou a des droits d'administration
        if ($currentUserId == $authorId || (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"])) {
            // Supprimer d'abord toutes les réponses associées au commentaire
            $deleteReponses = 'DELETE FROM reponse WHERE id_ask = :id_ask';
            $deleteReponsesStatement = $bdd->prepare($deleteReponses);
            $deleteReponsesStatement->bindValue(':id_ask', $commentId, PDO::PARAM_INT);
            $deleteReponsesStatement->execute();

            // Supprimer ensuite le commentaire
            $deleteQuery = 'DELETE FROM forum WHERE id_ask = :id_ask';
            $deleteStatement = $bdd->prepare($deleteQuery);
            $deleteStatement->bindValue(':id_ask', $commentId, PDO::PARAM_INT);
            $deleteStatement->execute();
        }
    }
}

header('Location: forum.php');
exit();
?>