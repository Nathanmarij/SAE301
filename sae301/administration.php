<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style2.css" type="text/css" rel="stylesheet" />
    <script src="js/script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico">
    <title>Unicert 2024 - Administration</title>
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
        ?>
        <h1>Vous êtes connecté</h1>
        <a href="deconnexion.php">
            <h1>deconnexion</h1>
        </a>
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
            <div class="btn-nav navbar">
                <!-- Boutons de navigation -->
                <a href="#actions">
                    <h2>Billetterie</h2>
                </a>
                <a href="forum.php">
                    <h2>Forum</h2>
                </a>
                <a href="#interventions">
                    <h2>Contact</h2>
                </a>
            </div>
            <div class="logo">
                <!-- Logo -->
                <img src="image/logouni.png" alt="UNICEF logo">
            </div>
            <div class="btn-nav compte">
                <!-- Boutons d'inscription et de connexion -->
                <a href="inscription.php">
                    <h2>Inscription</h2>
                </a>
                <a href="connexion.php">
                    <h2>Connexion</h2>
                </a>
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
            <?php 
include ("config.php");
try {
        $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
    } catch (Exception $e) { // sinon
        die("erreur"); // ecrire 'erreur'
    }

    $requete = 'SELECT id_ask, id_user, content, date FROM forum ORDER BY id_ask DESC';
    $statement = $bdd->prepare($requete);
    $statement->execute();
    $forum = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <form action="adminTraitement.php" method="POST" class="commentaire">
                <?php
                if (isset($forum)) { // vérifie si il y a des commentaires sur l'article
                    foreach ($forum as $val):
                $requete = 'SELECT id_reponse, contenu FROM reponse WHERE id_ask=' . $val["id_ask"]; //requête permettant de récupérer le nom et le prenom de la personne qui a écrit un commentaire
                $requete = $bdd->query($requete);
                $rep = $requete->fetch(PDO::FETCH_ASSOC);
                $requete->closeCursor();
                if (empty($rep)) {?>
                <input type="radio" name="comm" id="comm" value="<?php echo $val["id_ask"];?>" checked /><?php 
                $idcomm = $val["id_ask"];
                $requete = 'SELECT id_ask, content FROM forum WHERE id_ask=' . $idcomm; //requête permettant de récupérer le nom et le prenom de la personne qui a écrit un commentaire
                $requete = $bdd->query($requete);
                $comm = $requete->fetch(PDO::FETCH_ASSOC);
                $requete->closeCursor(); ?>
                    <?php echo $comm["content"];
                
                } else {
                    echo '';
                }
                
                endforeach;}?>
                <input type="text" placeholder="Répondre à la question" id="reponse" name="reponse" class="ecrir">
                <input type="submit" id="submit" name="submit" value="Répondre">

        </article>
        <article class="suppfestival">
            <h3>Supprimer un festival<h3>
            <form method="POST">
            <li>
            <label for="nom">Choisir le nom du festival</label>
            <input>
            <li>
            <a href="">Supprimer le Festival</a>
            <a href="">Supprimer le nom</a>
            <a href="">Supprimer la date</a>
            <a href="">Supprimer le nombre de place</a>
            <a href="">Supprimer le lieu</a>
            <a href="">Supprimer le premier artiste</a>
            <a href="">Supprimer le second artiste</a>
            <a href="">Supprimer le troisième artiste</a>
            <a href="">Supprimer le quatrième artiste</a>
            <a href="">Supprimer le cinqième artiste</a>
            </form>
        </article>
    </section>

    <footer>

    </footer>
</body>

</html>