<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link href="css/header.css" type="text/css" rel="stylesheet" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <title>Infos Pratiques - Unicert 2024</title>
    <!-- Ajoutez ici votre PHP et autres éléments de la balise head comme dans votre page d'accueil -->
</head>

<body>
    <?php
    include("config.php");
    session_start();
    try {
        $bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nombase, $utilisateur, $mdp);
    } catch (Exception $e) { // sinon
        die("erreur"); // ecrire 'erreur'
    }
    ?>
    </head>

    <body>
        <header>
            <div class="header">
                <div class="btn-nav navbar">
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
                <div class="logo">
                    <!-- Logo -->
                    <a href="index.php">
                        <img src="image/logo.png" alt="UNICEF logo">
                    </a>
                </div>
                <div class="btn-nav compte">
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

        <!-- Contenu principal -->
        <div class="main">
            <div class="info-container">
                <h1>Informations Pratiques</h1>

                <h2>Accès au Lieu</h2>
                <p>Détails sur l'emplacement, les options de transport, les parkings, etc.</p>

                <h2>Horaires</h2>
                <p>Heures d'ouverture, programme des événements, etc.</p>

                <h2>Hébergement</h2>
                <p>Liste des hôtels à proximité, options d'hébergement, etc.</p>

                <h2>Restauration</h2>
                <p>Options de restauration sur place, recommandations de restaurants à proximité, etc.</p>

                <h2>Accessibilité</h2>
                <p>Informations sur l'accessibilité pour les personnes à mobilité réduite, etc.</p>

                <h2>Contact</h2>
                <p>Informations de contact pour des questions supplémentaires.</p>
            </div>
        </div>

        <!-- Pied de page (Footer) -->
        <!-- Ajoutez ici le code de votre pied de page (footer) comme dans votre page d'accueil -->

    </body>

</html>