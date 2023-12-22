<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/admin.css" type="text/css" rel="stylesheet" />
    <script src="js/script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico">
    <title>Unicert 2024 - Administration</title>
    <?php
    include("config.php");
    session_start();

    if (!isset($_SESSION['user']) || $_SESSION['isAdmin'] != 1) {
        die("Accès refusé.");
    }

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
    <?php include("header.php"); ?>
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
    
        </article>
        <article class="suppfestival">
            <h1>Supprimer un festival</h1>
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
        <form action="promouvoirAdmin.php" method="post">
        <h1>Promouvoir quelqu'un Admin</h1>
            <input type="email" name="email" placeholder="Entrez l'email de l'utilisateur">
            <input type="submit" value="Promouvoir comme Admin">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            // Vérifier si l'email existe dans la base de données
            $stmt = $bdd->prepare("SELECT id_user FROM user WHERE mail = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user) {
                // Si l'utilisateur existe, mettez à jour son statut d'administrateur
                $updateStmt = $bdd->prepare("UPDATE user SET isAdmin = 1 WHERE id_user = :id_user");
                $updateStmt->bindParam(':id_user', $user['id_user']);
                $updateStmt->execute();

                echo "L'utilisateur a été promu administrateur.";
            } else {
                echo "Aucun utilisateur trouvé avec cet email.";
            }
        }
        ?>
    </section>
</body>

</html>