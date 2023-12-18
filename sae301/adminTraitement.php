<?php 
include("config.php");
    try {
        $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
    } catch (Exception $e) { // sinon
        die("erreur");
        // ecrire 'erreur'
    }
    print_r($_POST);
$rep = $_POST["reponse"];
$id_ask = $_POST["comm"];
$requete = $bdd->prepare("INSERT INTO reponse (contenu, id_ask) VALUES(?,?)"); // insérer dans la table commentaire les valeurs envoyés par le formulaire
$requete->execute([$rep, $id_ask]); // executer la requete
$reponse = $requete->fetch();
header("Location:forum.php");
?>