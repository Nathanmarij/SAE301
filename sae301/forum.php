<?php
include("config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/header.css" type="text/css" rel="stylesheet" />
    <link href="css/forum.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <script src="js/forum.js"></script>
    <title>forum</title>
</head>
<body>
    <header>
        <div class="header">
            <div class="btn-nav navbar">
                <!-- Boutons de navigation -->
                <a href="billeterie.php"><h2>Billetterie</h2></a>
                <a href="forum.php"><h2>Forum</h2></a>
                <a href="#interventions"><h2>Contact</h2></a>
            </div>
            <div class="logo">
                <!-- Logo -->
                <img src="image/logo.png" alt="UNICEF logo">
            </div>
            <div class="btn-nav compte">
            <?php
            if (isset($_SESSION["user"])) { // si l'utilisateur est connecté
                echo '<a href="profil.php"><h2>Profil</h2></a>';
            } else { ?>
                <a href="inscription.php"><h2>Inscription</h2></a>
                <a href="connexion.php"><h2>Connexion</h2></a><?php
            }?>
            </div>
        </div>
    </header>
    <div class="container">
    <?php
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.UTF-8', 'French_France.1252');

    try {
        $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase, $utilisateur, $mdp);
    } catch (Exception $e) {
        die("erreur");
    }

    function getForumComments($bdd) {
        $requete = 'SELECT id_ask, id_user, content, date_posted FROM forum ORDER BY id_ask DESC';
        $statement = $bdd->prepare($requete);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    $forum = getForumComments($bdd);

    if (isset($_SESSION["user"])) { ?>

        <form action="forTraitement.php" method="POST" class="commentaire">
            <input type="text" placeholder="Posez une question" id="content" name="content" class="ecrir" required>
            <input type="submit" id="submit" name="submit" value="Commenter">
        </form>

    <?php }

    $months = [
        "January" => "Janvier", 
        "February" => "Février", 
        "March" => "Mars",
        "April" => "Avril", 
        "May" => "Mai", 
        "June" => "Juin",
        "July" => "Juillet", 
        "August" => "Août", 
        "September" => "Septembre",
        "October" => "Octobre", 
        "November" => "Novembre", 
        "December" => "Décembre"
    ];

    foreach ($forum as $val) {
        $requete = 'SELECT nom, prenom FROM user WHERE id_user = :id_user';
        $statement = $bdd->prepare($requete);
        $statement->bindValue(':id_user', $val["id_user"], PDO::PARAM_INT);
        $statement->execute();
        $commentateur = $statement->fetch(PDO::FETCH_ASSOC);

        echo '<fieldset class="comment-fieldset"><legend><b>';
        echo htmlspecialchars($commentateur["prenom"]) . " " . htmlspecialchars($commentateur["nom"]);
        echo "</b></legend>";
        echo htmlspecialchars($val["content"]);
        echo "<br>";

        $date = new DateTime($val["date_posted"]);
        $formattedDate = $date->format('d F Y à H\hi');
        $month = $date->format('F');
        $formattedDate = str_replace($month, $months[$month], $formattedDate);

        echo "<i>Posté le " . $formattedDate . "</i><br>";

        if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1 || (isset($_SESSION["user"]) && $_SESSION["user"] == $val["id_user"])) {
            echo '<button class="delete-btn" onclick="deleteComment(' . $val['id_ask'] . ')"><img src="image/poubelle.png" alt="Supprimer"></button>';
        }

        if (isset($_SESSION["user"])) {
            echo '<button onclick="toggleReplyForm(' . $val['id_ask'] . ')" id="reply-btn-' . $val['id_ask'] . '">Répondre</button>';
            echo '<form id="reply-form-' . $val['id_ask'] . '" action="reponseTraitement.php" method="POST" style="display:none;">';
            echo '<input type="hidden" name="id_ask" value="' . $val['id_ask'] . '">';
            echo '<input type="text" name="contenu" placeholder="Votre réponse">';
            echo '<input type="submit" value="Envoyer">';
            echo '</form>';
        }
        
        $requete = 'SELECT r.id_reponse, r.contenu, r.date_posted, r.id_user, u.nom, u.prenom FROM reponse r JOIN user u ON r.id_user = u.id_user WHERE r.id_ask = ' . $val['id_ask'];
        $reponses = $bdd->query($requete)->fetchAll(PDO::FETCH_ASSOC);

        if (count($reponses) > 0) {
            echo '<button class="toggle-reply" onclick="toggleReplies(' . $val['id_ask'] . ')">Voir Réponses</button>';
            echo '<div class="replies-container" id="replies-' . $val['id_ask'] . '" style="display: none;">';

            foreach ($reponses as $reponse) {
                echo '<fieldset style="margin-left: 20px;">';
                echo '<legend>Réponse de <b>' . htmlspecialchars($reponse['prenom']) . ' ' . htmlspecialchars($reponse['nom']) . '</b></legend>';
                echo htmlspecialchars($reponse['contenu']);

                $dateReponse = new DateTime($reponse["date_posted"]);
                $formattedDateReponse = $dateReponse->format('d F Y à H\hi');
                $monthReponse = $dateReponse->format('F');
                $formattedDateReponse = str_replace($monthReponse, $months[$monthReponse], $formattedDateReponse);

                echo "<i><br>Posté le " . $formattedDateReponse . "</i><br>";

            if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1 || (isset($_SESSION["user"]) && $_SESSION["user"] == $reponse["id_user"])) {
                echo '<button class="delete-btn" onclick="deleteResponse(' . $reponse['id_reponse'] . ')"><img src="image/poubelle.png" alt="Supprimer"></button>';
            }
                echo '</fieldset>';
            }
            echo '</div>'; // Fin du conteneur des réponses
        }

        echo '</fieldset>';
    }
    ?>
    </div>
</body>
</html>