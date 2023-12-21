<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link href="css/header.css" type="text/css" rel="stylesheet" />
    <link href="css/carousel.css" type="text/css" rel="stylesheet" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
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
    ?>
</head>
<body>
<header>
        <div class="header">
            <div class="logo">
            <a href="index.php">
            <!-- Logo -->
            <img src="image/logo.png" alt="UNICEF logo">
            </a>
            </div>
            <div class="nav-container">
            <div class="btn-nav">
                <!-- Boutons de navigation -->
                <a href="billetterie.php">
                    <h2>Billetterie</h2>
                </a>
                <a href="forum.php">
                    <h2>Forum</h2>
                </a>
                <a href="Infos Pratiques.php">
                    <h2>Infos Pratiques</h2>
                </a>
            </div>
            </div>


            <div class="btn-compte">
                <!-- Boutons d'inscription et de connexion -->
                <?php
                if (isset($_SESSION["user"])) { // si l'utilisateur est connecté
                    $requete = 'SELECT id_user, nom, prenom FROM user WHERE id_user = :id';
                    $statement = $bdd->prepare($requete);
                    $statement->bindParam(':id', $iduser, PDO::PARAM_INT);
                    $statement->execute();
                    $identite = $statement->fetchAll(PDO::FETCH_ASSOC);
                    $iduser = $_SESSION["user"];
                    echo '<a href="deconnexion.php"><h2>Déconnexion</h2></a>';
                } else { ?>
                    <a href="inscription.php">
                        <h2>Inscription</h2>
                    </a>
                    <a href="connexion.php">
                        <h2>Connexion</h2>
                    </a>
                    <?php
                } ?>


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
            <img src="image/imagehistoire.png"></img>
        </div>
    </div>
    <div class="unicert">
        <h1>Voici tout les <strong> ARTISTES </strong> présents sur scène.</h1>
        <div class="youtubers">
            <div class="ytbr inox">
                <img></img>
                <h2>INOXTAG</h2>
            </div>
            <div class="ytbr michou">
                <img></img>
                <h2>MICHOU</h2>
            </div>
            <div class="ytbr pidi">
                <img></img>
                <h2>PIDI</h2>
            </div>
            <div class="ytbr valouzz">
                <img></img>
                <h2>VALOUZZ</h2>
            </div>
            <div class="ytbr lebouseuh">
                <img></img>
                <h2>LEBOUSEUH</h2>
            </div>
            <div class="ytbr apo">
                <img></img>
                <h2>APO</h2>
            </div>
            <div class="ytbr joyca">
                <img></img>
                <h2>JOYCA</h2>
            </div>
            <div class="ytbr mastu">
                <img></img>
                <h2>MASTU</h2>
            </div>
        </div>
    </div>

    <div class="reserv"> 
        <h1> N'hésitez plus ! </h1>
        <a href="billetterie.php" class="btn-reserv">Billetterie</a>
    </div>

    <footer>
        
        <img src="image/illustration.png" class="illus"/>

        <div>
            <div class="liens">
                <div>
                    <h2> LE CONCERT </h2>
                    <a href="billetterie.php"> Billeterie </a> <br>
                    <a href="forum.php"> Communautée </a> <br>
                    <a href="Infos Pratiques.php"> Infos Pratiques </a> <br>
                </div>

                <div class="margeheuu">
                    <h2> A PROPOS </h2>
                    <a href="https://www.unicef.fr/qui-sommes-nous/"> Qui sommes nous ? </a> <br>
                    <a href="https://www.unicef.fr/convention-droits-enfants/"> Droits de l’enfant (CIDE) </a> <br>
                    <a href="https://www.unicef.fr/qui-sommes-nous/decouvrir-l-unicef/"> Notre histoire </a> <br>
                    <a href="https://www.unicef.fr/qui-sommes-nous/transparence-financiere-de-lunicef-france/"> Transparence financière </a> <br>
                </div>
            </div>

            <div class="liens">
                <div>
                    <h2> LIENS UTILES </h2>
                    <a href="https://www.unicef.fr/se-connecter/"> Espace donnateur </a> <br>
                    <a href="https://www.unicef.fr/faire-un-don/la-reduction-dimpot-associee-a-votre-don/"> Déduction et reçu fiscal </a> <br>
                    <a href="https://don.unicef.fr/don-ponctuel/~mon-don"> Faire un don </a> <br>
                    <a href="https://www.unicef.fr/vous-avez-des-questions/"> FAQ </a> <br>
                    <a href="https://www.unicef.fr/contact/#1"> Nous contacter </a> <br>
                    <a href="https://www.unicef.fr/actualites/communique-de-presse/"> Espace presse </a> <br>
                </div>

                <div class="margeheuu">
                    <h2> NOUS RETROUVER </h2>
                    <div class="reseaux">
                        <a class="img" href="https://www.instagram.com/unicef_france/"><img src="image/instagram.png" alt=""/></a>
                        <a class="img" href="https://www.facebook.com/UNICEF.France/"><img src="image/facebook.png" alt=""/></a>
                    </div>

                    <div class="reseaux">
                        <a class="img" href="https://www.tiktok.com/@unicef_france"><img src="image/tiktok.png" alt=""/></a>
                        <a class="img" href="https://www.linkedin.com/company/unicef-france?originalSubdomain=fr" ><img src="image/internet.png" alt=""/></a>
                    </div>
                </div>
            </div>
            <p> © 2024 Unicert.fr Tous droits réservés.<p>
    </footer>
</body>
</html>
