<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/infopratique.css" type="text/css" rel="stylesheet" />
    <link href="css/header.css" type="text/css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico">
    <title>Infos Pratiques - Unicert 2024</title>
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

    <!-- Contenu principal -->
    <div class="main">
        <div class="info-container">
            <h1>Mentions Légales</h1>

            <h2>Éditeur du Site</h2>
            <p><strong>Nom de l'entreprise:</strong> Unicert Event Organisation</p>
            <p><strong>Siège social:</strong> IUT Le Puy-en-Velay, 43000 Le Puy-en-Velay, France</p>
            <p><strong>Représentant légal:</strong> Jules Zanivan</p>
            <p><strong>Numéro de téléphone:</strong> 04 71 04 14 55</p>
            <p><strong>Email:</strong> contact@unicert-events.fr</p>
            <p><strong>SIRET:</strong> 123 456 789 01234</p>

            <h2>Propriété Intellectuelle</h2>
            <p>Tous les éléments du site Unicert, y compris les textes, images, graphismes, logo, icônes, sons,
                logiciels, sont la propriété exclusive de la société Unicert Event Organisation à l'exception des
                marques, logos ou contenus appartenant à d'autres sociétés partenaires ou auteurs.</p>

            <h2>Hébergement</h2>
            <p><strong>Hébergeur:</strong> Créa Pro</p>

            <h2>Conditions d'utilisation</h2>
            <p>Le site accessible par les url suivants : www.unicert-2024.mmi-lepuy.fr est exploité dans le respect de
                la législation française. L'utilisation de ce site est régie par les présentes conditions générales. En
                utilisant le site, vous reconnaissez avoir pris connaissance de ces conditions et les avoir acceptées.
            </p>

            <h2>Limitation de responsabilité</h2>
            <p>Les informations contenues sur ce site sont aussi précises que possible et le site est périodiquement
                remis à jour, mais peut toutefois contenir des inexactitudes, des omissions ou des lacunes. Si vous
                constatez une lacune, erreur ou ce qui paraît être un dysfonctionnement, merci de le signaler par email
                en décrivant le problème de la manière la plus précise possible.</p>
        </div>
    </div>
</body>

</html>