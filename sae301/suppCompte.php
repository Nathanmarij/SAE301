<?php
include("config.php");
session_start();

try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
} catch (Exception $e) {
    die("erreur");
}

if (isset($_POST['id_user'])) {
    $iduser = $_POST['id_user'];

    // Vérifiez si l'utilisateur connecté est celui qui demande la suppression
    if ($_SESSION["user"] == $iduser) {
        // Supprimer toutes les réponses postées par l'utilisateur
        $requeteReponses = $bdd->prepare("DELETE FROM reponse WHERE id_user = :id_user");
        $requeteReponses->bindParam(':id_user', $iduser, PDO::PARAM_INT);
        $requeteReponses->execute();

        // Supprimer tous les commentaires postés par l'utilisateur
        $requeteCommentaires = $bdd->prepare("DELETE FROM forum WHERE id_user = :id_user");
        $requeteCommentaires->bindParam(':id_user', $iduser, PDO::PARAM_INT);
        $requeteCommentaires->execute();

        // Enfin, supprimer le compte utilisateur
        $requete = $bdd->prepare("DELETE FROM user WHERE id_user = :id_user");
        $requete->bindParam(':id_user', $iduser, PDO::PARAM_INT);
        $requete->execute();

        // Déconnexion après la suppression du compte
        session_destroy();
        header("Location: connexion.php");
        exit();
    } else {
        echo "Erreur : Vous n'avez pas l'autorisation de supprimer ce compte.";
    }
}

?>
