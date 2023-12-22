<?php
include("config.php");
try {
$bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
} catch (Exception $e) { // sinon
die("erreur");
// ecrire 'erreur'
}
$idimage = $_GET['id'];
$requete = 'SELECT img FROM images WHERE id_image ='. $idimage;
$statement = $bdd->prepare($requete);
$statement->execute();
$lien = $statement->fetch(PDO::FETCH_ASSOC);
$image = $lien['img'];
if (file_exists($image)) {
unlink($image);

$deleteQuery = 'DELETE FROM images WHERE id_image ='. $idimage;
        $deleteStatement = $bdd->prepare($deleteQuery);
        $deleteStatement->execute();
}
header("Location: images.php");

   
?>