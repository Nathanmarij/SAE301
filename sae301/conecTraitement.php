<?php
include("config.php");

try {
    $bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nombase, $utilisateur, $mdp);
} catch (Exception $e) {
    die("erreur");
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST["mail"]; 
    $mdp = $_POST["mdp"]; 

    $requete = $bdd->prepare("SELECT * FROM user WHERE mail = :mail"); 
    $requete->bindParam(":mail", $mail); 
    $requete->execute();
    $donne = $requete->fetch(); 

    if ($donne && password_verify($mdp, $donne['mdp'])) { 
        $_SESSION["user"] = $donne['id_user'];
        $_SESSION["mail"] = $mail; 
        $_SESSION["isAdmin"] = $donne['isAdmin']; // Stockez ici la valeur isAdmin dans la session
        header("Location: index.php"); 
        exit();
    } else {
        $_SESSION["login_error"] = "Identifiants invalides.";
        header("Location: connexion.php");
        exit();
    }
}
?>
