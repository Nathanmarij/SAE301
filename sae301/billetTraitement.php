<?php 
include("config.php");
session_start();
    try {
        $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
    } catch (Exception $e) { // sinon
        die("erreur");
        // ecrire 'erreur'
    }
    print_r($_POST["nb_places"]);
    for ($i = 1; $i <= $_POST["nb_places"]; $i++) {
        $iduser = $_SESSION['user'];
$type = $_POST["type"];
$requete = $bdd->prepare("INSERT INTO billetterie (type_place, id_user) VALUES(?,?)"); // insérer dans la table commentaire les valeurs envoyés par le formulaire
$requete->execute([$type, $iduser]); // executer la requete
$billet = $requete->fetch();
    }
    header("Location:confirmation.html");
?>