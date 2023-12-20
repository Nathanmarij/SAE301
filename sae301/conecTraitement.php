<?php
include("config.php");

try {
    $bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nombase, $utilisateur, $mdp);
} catch (Exception $e) {
    die("erreur"); // Write 'error'
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST["mail"]; // Retrieve the email value sent by the login form
    $mdp = $_POST["mdp"]; // Retrieve the password value sent by the login form

    $requete = $bdd->prepare("SELECT * FROM user WHERE mail = :mail"); // Prepare a query to select user data based on email
    $requete->bindParam(":mail", $mail); // Bind the email value
    $requete->execute();
    $donne = $requete->fetch(); // Fetch the result

    if ($donne && password_verify($mdp, $donne['mdp'])) { // Check if the user exists and the password is correct
        $_SESSION["user"] = $donne['id_user'];
        $_SESSION["mail"] = $mail; // Create a session with the user's email
        header("Location: index.php"); // Redirect to the home page
        exit();
    } else {
        // Redirect to the login page with an error message if credentials are invalid
        $_SESSION["login_error"] = "Identifiants invalides.";
        header("Location: connexion.php");
        exit();
    }
}
?>
