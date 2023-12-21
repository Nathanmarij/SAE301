<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link href="css/stylebillet.css" type="text/css" rel="stylesheet" />
    <script src="js/script2.js"></script>
    <title>Unicert 2024 - Billeterie</title>
    <?php /*
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
}
*/?>
</head>

<body>
    <header>
            <nav class="navigation">
                <div class="burger-menu">
                    <div class="burger-icon" id="burger-icon">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                    <ul class="menu-items" id="menu-items">
                        <ol class="logo">
                            <!-- Logo -->
                            <img src="image/logouni.png" alt="UNICEF logo">
                        </ol>
                        <ol class="boutonnav">
                            <!-- Boutons de navigation -->
                            <a href="#actions"><h2>Billetterie</h2></a>
                            <a href="forum.php"><h2>Forum</h2></a>
                            <a href="#interventions"><h2>Infos partiques</h2></a>
                        </ol>
                        <ol>
                            <!-- Boutons d'inscription et de connexion -->
                            <a href="inscription.php"><h2>Inscription</h2></a>
                            <a href="connexion.php"><h2>Connexion</h2></a>
                        </ol>
                    </ul>
                </div>
                <ol class="logo">
                    <!-- Logo -->
                    <img src="image/logouni.png" alt="UNICEF logo">
                </ol>
                <ol class="boutonnav">
                    <!-- Boutons de navigation -->
                    <a href="#actions"><h2>Billetterie</h2></a>
                    <a href="forum.php"><h2>Forum</h2></a>
                    <a href="#interventions"><h2>Infos partiques</h2></a>
                </ol>
                
                <ol>
                    <!-- Boutons d'inscription et de connexion -->
                    <a href="inscription.php"><h2>Inscription</h2></a>
                    <a href="connexion.php"><h2>Connexion</h2></a>
                </ol>
            </nav>
    </header>
    <section class="billeterie">
        <article class="billet">
            <h3>Billet 1</h3>
            <h5>Prix du billet</h5>
            <p>Explication</p>
            <label for="quantite-billet1">Quantité:</label>
            <select id="quantite-billet1" name="quantite-billet1">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <a href="confirmation.html" class="lien">Acheter<a>
        </article>
        <article class="billet">
            <h3>Billet 2</h3>
            <h5>Prix du billet</h5>
            <p>Explication</p>
            <label for="quantite-billet1">Quantité:</label>
            <select id="quantite-billet1" name="quantite-billet1">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <a href="confirmation.html" class="lien">Acheter<a>
        </article>
        <article class="billet">
            <h3>Billet 3</h3>
            <h5>Prix du billet</h5>
            <p>Explication</p>
            <label for="quantite-billet1">Quantité:</label>
            <select id="quantite-billet1" name="quantite-billet1">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <a href="confirmation.html" class="lien">Acheter<a>
        </article>
    </section>
    <footer>

    </footer>
</body>

</html>