<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <script src="js/script.js"></script>
    <title>Unicert 2024</title>
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
    <div class="main">
        <div class="carousel">
            <div class="carousel-images">
                <img src="image/image1.jpg" alt="img1">
                <img src="image/image2.jpg" alt="img2">
                <img src="image/image3.jpg" alt="img3">
            </div>
            <div class="carousel-dots">
                <button class="previous" onclick="previous()">previous</button>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <button class="next" onclick="next()">next</button>
            </div>
        </div>
    </div>
    <div class="histoire">
        <h1>À propos de l'Unicef</h1>
        <div class="textimg">
            <p>
                Lorem ipsum
            </p>
            <img></img>
        </div>
    </div>
    <div class="unicert">
        <h1>À propos de l'Unicert</h1>
        <div class="youtubers">
            <div class="ytbr">
                <img></img>
                <h2>aaa</h2>
            </div>
            <div class="ytbr">
                <img></img>
                <h2>aaa</h2>
            </div>
            <div class="ytbr">
                <img></img>
                <h2>aaa</h2>
            </div>
        </div>
    </div>
    <footer>
        
    </footer>
</body>
</html>