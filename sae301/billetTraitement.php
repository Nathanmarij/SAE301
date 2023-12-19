<?php 
include("config.php");
    try {
        $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
    } catch (Exception $e) { // sinon
        die("erreur");
        // ecrire 'erreur'
    }
    print_r($_POST);
$type = $_POST["type"];
$nb_places = $_POST["nb_places"];
$id_user = $_POST["id_user"];
$requete = $bdd->prepare("INSERT INTO billetterie (type_place, nb_places, id_user) VALUES(?,?,?)"); // insérer dans la table commentaire les valeurs envoyés par le formulaire
$requete->execute([$type, $nb_places, $id_user]); // executer la requete
$billet = $requete->fetch();
header("Location:index.php");
?>