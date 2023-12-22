<head>
    <link href="css/header.css" type="text/css" rel="stylesheet" />
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
</body>