<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link href="css/stylebillet.css" type="text/css" rel="stylesheet" />
    <script src="js/script2.js"></script>
    <link rel="icon" href="favicon.ico">
    <title>Unicert 2024 - Billeterie</title>
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
$requete = 'SELECT id_user, nom, prenom FROM user WHERE id_user = :id';
$statement = $bdd->prepare($requete);
$statement->bindParam(':id', $iduser, PDO::PARAM_INT);
$statement->execute();
$identite = $statement->fetchAll(PDO::FETCH_ASSOC);
} else { // sinon
}
?>
</head>

<body>
<?php include("header.php"); ?>
    <section class="billeterie">
        <article class="billet">
            <h3>Billet 1</h3>
            <h5>Prix du billet</h5>
            <p>Explication</p>
            <label for="quantite-billet1">Quantité:</label>
            <form method="POST" class="form" <?php echo isset($_SESSION["user"]) ? 'action="billetTraitement.php"' : 'action="inscription.php"'; ?>>
            <input type="number" name="nb_places" id="nb_places" value="0" min="0" max="100"/>
            <input type="HIDDEN" name="type" value="Apres-midi">
            <input type="submit" id="submit" name="submit" value="Réserver" class="lien"></form>
        </article>
        <article class="billet">
            <h3>Billet 2</h3>
            <h5>Prix du billet</h5>
            <p>Explication</p>
            <label for="quantite-billet1">Quantité:</label>
            <form method="POST" class="form" <?php echo isset($_SESSION["user"]) ? 'action="billetTraitement.php"' : 'action="inscription.php"'; ?>>
            <input type="number" name="nb_places" id="nb_places" value="0" min="0" max="100"/>
            <input type="HIDDEN" name="type" value="Soiree">
            <input type="submit" id="submit" name="submit" value="Réserver" class="lien"></form>
        </article>
        <article class="billet">
            <h3>Billet 3</h3>
            <h5>Prix du billet</h5>
            <p>Explication</p>
            <label for="quantite-billet1">Quantité:</label>
            <form method="POST" class="form" <?php echo isset($_SESSION["user"]) ? 'action="billetTraitement.php"' : 'action="inscription.php"'; ?>>
            <input type="number" name="nb_places" id="nb_places" value="0" min="0" max="100"/>
            <input type="HIDDEN" name="type" value="Journee">
            <input type="submit" id="submit" name="submit" value="Réserver" class="lien"></form>
        </article>
        </section>
    </div>
    <footer>

    </footer>
</body>

</html>