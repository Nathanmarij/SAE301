<?php
    include("config.php");
try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
} catch (Exception $e) { // sinon
    die("erreur"); // ecrire 'erreur'
}

session_start();

$mail = $_POST["mail"]; // assigner la valeur envoyer par le formulaire de connexion sur l'input email dans une variable $email
$mdp = $_POST["mdp"]; // assigner la valeur envoyer par le formulaire de connexion sur l'input mdp dans une variable $mdp

$requete = $bdd->prepare("SELECT * FROM user WHERE mail=:mail and mdp=:mdp"); // inscrire une requete dans la variable $requete qui selectionne dans la table 'users' la ligne de données qui a pour email -> l'email donnée par le formulaire et le mot de passe donnée par le formulaire
$requete->bindParam(":mail", $mail); // assigne la valeur que l'utilisateur envoie sur le formulaire de l'input mail pour la 'variable' :email
$requete->bindParam(":mdp", $mdp); // assigne la valeur que l'utilisateur envoie sur le formulaire de l'input mdp pour la 'variable' :mdp
$requete->execute(); // executer la requete
$donne = $requete->fetch(); // recolte et assigne le résultat de la requete dans la variable $donne
$id = $donne['id_user'];
print_r($id);
if ($donne) { // si la variable $donne contient quelque chose
    $_SESSION["user"] = $id;
    $_SESSION["mail"] = $mail; // créer une session qui a pour nom 'user' et pour valeur l'email rentré par l'utilsateur dans le formulaire  
    header("Location: index.php"); // rediriger l'utilisateur vers la page 'index.php'
} else { // si la variable $donne est vide (ça signifie que aucun utilisateur dans la base de donnée n'a l'email et le mot de passe que l'utilisateur a envoyé)
    header("Location:connexion.php"); // rediriger l'utilsateur vers la page 'connexion.php'
}

//echo $iduser;
?>