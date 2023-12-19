<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link href="css/header.css" type="text/css" rel="stylesheet" />
    <link href="css/carousel.css" type="text/css" rel="stylesheet" />
    <link href="css/apropos.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="js/carousel.js"></script>
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
}
    ?>
</head>
<body>
    <header>
        <div class="header">
            <div class="btn-nav navbar">
                <!-- Boutons de navigation -->
                <a href="#actions"><h2>Billetterie</h2></a>
                <a href="forum.php"><h2>Forum</h2></a>
                <a href="#interventions"><h2>Contact</h2></a>
            </div>
            <div class="logo">
                <!-- Logo -->
                <img src="image/logo.png" alt="UNICEF logo">
            </div>
            <div class="btn-nav compte">
                <!-- Boutons d'inscription et de connexion -->
                <a href="inscription.php"><h2>Inscription</h2></a>
                <a href="connexion.php"><h2>Connexion</h2></a>
            </div>
        </div>
    </header>
    <div class="main">
        <div class="carousel">
            <div class="carousel-descr">
                <h1 class="carousel-title">UNICERT 2024</h1>
                <p class="carousel-text">
                Découvrez le concert caritatif Unicert 2024, un événement musical diversifié avec des stars de tous genres. 
                Idéal pour tous les âges, cet événement promet des sensations uniques et mémorables !
                </p>
                <a href="forum.php" class="carousel-button">EN SAVOIR PLUS</a>
            </div>
            <div class="carousel-images">
                <img src="image/image1.jpg" alt="img1">
                <img src="image/image2.jpg" alt="img2">
                <img src="image/image3.jpg" alt="img3">
            </div>
            <button class="previous" onclick="moveSlides(-1)"><i class="fa fa-chevron-left"></i></button>
            <div class="carousel-dots">
                <span class="dot" onclick="currentSlide(0)"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
            </div>
            <button class="next" onclick="moveSlides(1)"><i class="fa fa-chevron-right"></i></button>
        </div>
    </div>
    <div class="histoire">
        <h1 id="tapropos">À PROPOS DE L'UNICEF</h1>
        <div class="textimg">
            <p>
                L’UNICEF – pour Fonds des Nations unies pour l’enfance – est une agence des Nations unies, créée en 1946, dont le siège est à New York, aux États-Unis. 
                Elle est chargée, dans le monde entier, de défendre les droits des enfants, de répondre à leurs besoins essentiels et de favoriser leur plein épanouissement.
                <br><br>La priorité est donnée aux enfants les plus vulnérables, notamment victimes de la guerre, de catastrophes naturelles, de la pauvreté extrême et de toute forme de violence ou d’exploitation dans les pays les plus démunis. 
                Elle intervient également en cas d’urgence en coordination avec les organismes des Nations unies, les principales organisations humanitaires, et les gouvernements.
            </p>
            <img src="image/imagehistoire.jpg"></img>
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
