<?php
session_start();
    include("config.php");
try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
} catch (Exception $e) { // sinon
    die("erreur");
    // ecrire 'erreur'
}



$user = $_SESSION["user"];
var_dump(isset($user));
$forum = $_POST["content"];
$date_publication = date('Y-m-d H:i:s');
$requete = $bdd->prepare("INSERT INTO forum (id_user, content, date) VALUES(?,?,?)"); // insérer dans la table commentaire les valeurs envoyés par le formulaire
$requete->execute([$user, $forum, $date_publication]); // executer la requete
$commentaire = $requete->fetch();
header("Location:forum.php");

?>