<?php 
include ("config.php");
session_start();
try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
} catch (Exception $e) { // sinon
    die("erreur"); // ecrire 'erreur'
}

if (isset($_SESSION["user"])) { // vérifie si il existe une session qui s'apelle 'user'
    $iduser=$_SESSION["user"];
    ?> 
            <form action="billetTraitement.php" method="POST" class="billeterie">
            <input type="radio" name="type" id="type" value="journée"/>Pass Journée Complète
            <input type="radio" name="type" id="type" value="aprem"/>Pass Après-Midi
            <input type="radio" name="type" id="type" value="soiree"/>Pass Soirée
            <input type="number" name="nb_places" id="nb_places" value="nb_places"/>
            <input type="hidden" name="id_user" value="<?php echo $iduser?>"/>
            <input type="submit" id="submit" name="submit" value="Réserver">

            <?php } else { // sinon
            ?>
                <div class="seco">Vous devez &nbsp;<a href="inscription.php">vous connecter</a>&nbsp; pour reserver vos places</div>
                <?php
        }
?>

