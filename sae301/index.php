<?php
include ("config.php");
session_start();
try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
} catch (Exception $e) { // sinon
    die("erreur"); // ecrire 'erreur'
}

if (isset($_SESSION["user"])) { // si l'utilisateur est connecté
    $iduser=$_SESSION["user"];
    ?>
    <h1>Vous êtes connecté</h1>
    <a href="deconnexion.php"><h1>deconnexion</h1></a>
    <?php 
   $requete = 'SELECT id_user, nom, prenom FROM user WHERE id_user = :id';
   $statement = $bdd->prepare($requete);
   $statement->bindParam(':id', $iduser, PDO::PARAM_INT);
   $statement->execute();
   $identite = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else { // sinon
    ?> <h1><a href="inscription.php">
        <?php echo "S'inscrire"; ?>
    </a></h1>
    <?php
}
?>
<a href="forum.php"><h2>Forum</h2></a>
<a href="images.php"><h2>Images</h2></a>
<a href="billeterie.php"><h2>Billeterie</h2></a>