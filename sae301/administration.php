<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <script src="js/script.js"></script>
    <title>Unicert 2024 - Administration</title>
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
    <section>
        <article>
            <h3>Ajouter un festival</h3>
            <form action="festival.php" method="POST">
                <li>
                <label for="nom">Nom<label>
                <input type="text" id="nom" name="nom">
                </li>
                <li>
                <label for="date">Date<label>
                <input type="datetime" id="date" name="date">
                </li>
                
                <li>
                <label for="nbplace">Nombre de places disponibles<label>
                <input type="number" id="nbplace" name="nbplace">
                </li>
                <li>
                <label for="lieu">Lieu<label>
                <input type="text" id="lieu" name="lieu">
                </li>
                <li>
                <label for="artiste">Artiste 1<label>
                <input type="text" id="artiste" name="artiste">
                </li>
                <li>
                <label for="artiste">Artiste 2<label>
                <input type="text" id="artiste" name="artiste">
                </li>
                <li>
                <label for="artiste">Artiste 3<label>
                <input type="text" id="artiste" name="artiste">
                </li>
                <li>
                <label for="artiste">Artiste 4<label>
                <input type="text" id="artiste" name="artiste">
                </li>
                <li>
                <label for="artiste">Artiste 5<label>
                <input type="text" id="artiste" name="artiste">
                </li>
                <button type="submit">Valider</button>
                <button type="reset">Réinitialiser</button>
            </form>
        </article>
    </section>
    <footer>
        
    </footer>
</body>
</html>