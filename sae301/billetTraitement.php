<?php 
include("config.php");
session_start();
    try {
        $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
    } catch (Exception $e) { // sinon
        die("erreur");
        // ecrire 'erreur'
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier si le formulaire a été soumis
        $nbPlaces = $_POST['nb_places'];
        $type = $_POST['type'];
    
        if ($nbPlaces == 0) {
            // Si le nombre de places est égal à zéro, afficher un message d'erreur
            $_SESSION['data'] = "Veuillez sélectionner un billet.";
            header("Location:billetterie.php");
        } else {
            // Le nombre de places est valide, poursuivre avec le traitement du formulaire
            print_r($_SESSION);
            $type = $_POST["type"];
            $nb_places = $_POST["nb_places"];
            $id_user = $_SESSION["user"];
            $requete = $bdd->prepare("INSERT INTO billetterie (type_place, id_user) VALUES(?,?)"); // insérer dans la table commentaire les valeurs envoyés par le formulaire
            $requete->execute([$type, $id_user]); // executer la requete
            $billet = $requete->fetch();
            header("Location:confirmation.html");
            unset($_SESSION['data']);
        }
    }
    
?>