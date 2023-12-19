<?php
include("config.php");

try {
    $bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nombase, $utilisateur, $mdp);
} catch (Exception $e) {
    die("erreur");
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST["prenom"]; 
    $nom = $_POST["nom"];
    $mail = $_POST["mail"];
    $mdp = $_POST["mdp"];
    $conf_mdp = $_POST["conf_mdp"];

    $req = $bdd->prepare("SELECT * FROM user WHERE mail = :mail");
    $req->bindParam(":mail", $mail);
    $req->execute();
    if ($req->rowCount() > 0) {
        $_SESSION["error"] = "L'adresse mail est déjà utilisée.";
        header("Location: inscription.php");
        exit();
    }

    if ($mdp != $conf_mdp) {
        $_SESSION["error"] = "Les mots de passe ne correspondent pas.";
        header("Location: inscription.php");
        exit();
    }

    $hashed_mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $requete = $bdd->prepare("INSERT INTO user (prenom, nom, mail, mdp) VALUES (:prenom, :nom, :mail, :hashed_mdp)");
    $requete->bindParam(":prenom", $prenom);
    $requete->bindParam(":nom", $nom);
    $requete->bindParam(":mail", $mail);
    $requete->bindParam(":hashed_mdp", $hashed_mdp);
    $requete->execute();

    $_SESSION["user"] = $bdd->lastInsertId();
    $_SESSION["mail"] = $mail;
    header("Location: index.php");
    exit();
}
?>

