<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <script src="js/script.js"></script>
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
    ?>
</head>
<body>
<header>
        <div class="header">
            <div class="logo">
                <img src="image/logo.png" alt="UNICEF logo">
            </div>
            <div class="btn-nav">
                <div class="navbar">
                    <a href="#actions"><h2>Billeterie</h2></a>
                    <a href="forum.php"><h2>Forum</h2></a>
                    <a href="#interventions"><h2>Contact</h2></a>
                </div>
            </div>
            <div class="btn-nav">
                <div class="compte">
                    <a href="inscription.php"><h2>Inscription</h2></a>
                    <a href="connexion.php"><h2>Connexion</h2></a>
                </div>
            </div>
        </div>
    </header>
    <section class="billeterie">
        <article class="billet">
            <h3>Billet 1</h3>
            <h5>Prix du billet</h5>
            <p>Explication</p>
            <a href="confirmation.html" class="lien">Acheter<a>
        </article>
        <article class="billet">
            <h3>Billet 2</h3>
            <h5>Prix du billet</h5>
            <p>Explication</p>
            <a href="confirmation.html" class="lien">Acheter<a>
        </article>
        <article class="billet">
            <h3>Billet 3</h3>
            <h5>Prix du billet</h5>
            <p>Explication</p>
            <a href="confirmation.html" class="lien">Acheter<a>
        </article>
    </section>
    <footer>
        
    </footer>
</body>
</html>