<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link href="css/header.css" type="text/css" rel="stylesheet" />
    <link href="css/stylebillet.css" type="text/css" rel="stylesheet" />
    <script src="js/script2.js"></script>
    <title>Unicert 2024 - Billeterie</title>
    <?php
    include("config.php");
    session_start();
    try {
        $bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nombase, $utilisateur, $mdp);
    } catch (Exception $e) { // sinon
        die("erreur"); // ecrire 'erreur'
    }

    if (isset($_SESSION["user"])) { // si l'utilisateur est connecté
        $iduser = $_SESSION["user"];
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
                    <a href="infosPratiques.php">
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
                    echo '<a href="profil.php"><h2>Profil</h2></a>';
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

    <section class="billeterie">
        <article class="billet">
            <h3>AM</h3>
            <h5>20€</h5>
            <p>Tout les concerts de 13h à 17h</p>
            <label for="quantite-billet1">Quantité:</label>
            <form method="POST" class="form" <?php echo isset($_SESSION["user"]) ? 'action="billetTraitement.php"' : 'action="inscription.php"'; ?>>
                <input type="number" name="nb_places" id="nb_places" value="0" min="0" max="100" />
                <input type="HIDDEN" name="type" value="Apres-midi">
                <input type="submit" id="submit" name="submit" value="Réserver" class="lien">
            </form>
        </article>
        <article class="billet">
            <h3>Soirée</h3>
            <h5>20€</h5>
            <p>Tout les concerts de 17h à 1h</p>
            <label for="quantite-billet1">Quantité:</label>
            <form method="POST" class="form" <?php echo isset($_SESSION["user"]) ? 'action="billetTraitement.php"' : 'action="inscription.php"'; ?>>
                <input type="number" name="nb_places" id="nb_places" value="0" min="0" max="100" />
                <input type="HIDDEN" name="type" value="Soiree">
                <input type="submit" id="submit" name="submit" value="Réserver" class="lien">
            </form>
        </article>
        <article class="billet">
            <h3>Journée</h3>
            <h5>35€</h5>
            <p>Tout les concerts de 13h à 1h</p>
            <label for="quantite-billet1">Quantité:</label>
            <form method="POST" class="form" <?php echo isset($_SESSION["user"]) ? 'action="billetTraitement.php"' : 'action="inscription.php"'; ?>>
                <input type="number" name="nb_places" id="nb_places" value="0" min="0" max="100" />
                <input type="HIDDEN" name="type" value="Journee">
                <input type="submit" id="submit" name="submit" value="Réserver" class="lien">
            </form>
        </article>
    </section>
    <footer>

    </footer>
</body>

</html>