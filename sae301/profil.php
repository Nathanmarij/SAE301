<?php
include("config.php");
session_start();

try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
} catch (Exception $e) {
    die("erreur");
}

if (!isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit();
}

$iduser = $_SESSION["user"];
$message = "";

try {
    $requete = $bdd->prepare("SELECT nom, prenom, mail, isAdmin FROM user WHERE id_user = :id_user");
    $requete->bindParam(':id_user', $iduser, PDO::PARAM_INT);
    $requete->execute();
    $user = $requete->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verifier_mdp'])) {
    $ancien_mdp = $_POST["ancien_mdp"];
    $requete = $bdd->prepare("SELECT mdp FROM user WHERE id_user = :id_user");
    $requete->bindParam(':id_user', $iduser, PDO::PARAM_INT);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);

    if (password_verify($ancien_mdp, $resultat['mdp'])) {
        $message = "";
        echo "<script>document.addEventListener('DOMContentLoaded', function() { document.getElementById('change-password-section').style.display = 'block'; });</script>";
    } else {
        $message = "L'ancien mot de passe est incorrect.";
    }
} 

elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mise à jour des autres informations
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $mail = $_POST["mail"];
    $nouveau_mdp = password_hash($_POST["nouveau_mdp"], PASSWORD_DEFAULT);

    if (!empty($_POST['nom'])) {
        $requete = $bdd->prepare("UPDATE user SET nom = :nom WHERE id_user = :id_user");
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':id_user', $iduser, PDO::PARAM_INT);
        $requete->execute();
        echo "Votre nom a bien été mis à jour.";
    }
    
    if (!empty($_POST['prenom'])) {
        $requete = $bdd->prepare("UPDATE user SET prenom = :prenom WHERE id_user = :id_user");
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':id_user', $iduser, PDO::PARAM_INT);
        $requete->execute();
        echo "Votre prénom a bien été mis à jour.";
    }
    
    if (!empty($_POST['mail'])) {
        $requete = $bdd->prepare("UPDATE user SET mail = :mail WHERE id_user = :id_user");
        $requete->bindParam(':mail', $mail);
        $requete->bindParam(':id_user', $iduser, PDO::PARAM_INT);
        $requete->execute();
        echo "Votre adresse email a bien été mise à jour.";
    }
    
    if (!empty($_POST['nouveau_mdp']) && !empty($_POST['confirmer_mdp']) && $_POST['nouveau_mdp'] === $_POST['confirmer_mdp']) {
        $requete = $bdd->prepare("UPDATE user SET mdp = :mdp WHERE id_user = :id_user");
        $requete->bindParam(':mdp', $nouveau_mdp);
        $requete->bindParam(':id_user', $iduser, PDO::PARAM_INT);
        $requete->execute();
        echo "Votre mot de passe a bien été mis à jour.";
    }
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="css/header.css" type="text/css" rel="stylesheet" />
    <link href="css/profil.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <script src="js/profil.js"></script>
    <title>Profil</title>
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
                    echo '<a href="index.php"><h2>Home</h2></a>';
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
    <h1>Modifier votre profil</h1>
    <?php if ($message != "") echo "<p>$message</p>"; ?>
    <form method="post" action="profil.php">
        <div class="form-group">
            Nom: (<b><span style="color: #0b7cff;"><?php echo $user['nom']; ?></span></b>)
            <button type="button" onclick="toggleInput('nom')">Modifier</button>
            <input type="text" id="nom" name="nom" placeholder="Entrez votre nouveau Nom" style="display: none;"><br>
        </div>

        <div class="form-group">
            Prénom: (<b><span style="color: #0b7cff;"><?php echo $user['prenom']; ?></span></b>)
            <button type="button" onclick="toggleInput('prenom')">Modifier</button>
            <input type="text" id="prenom" name="prenom" placeholder="Entrez votre nouveau Prénom" style="display: none;"><br>
        </div>

        <div class="form-group">
            Email: (<b><span style="color: #0b7cff;"><?php echo $user['mail']; ?></span></b>)
            <button type="button" onclick="toggleInput('mail')">Modifier</button>
            <input type="email" id="mail" name="mail" placeholder="Entrez votre nouveau Mail" style="display: none;"><br>
        </div>

        <div class="form-group" id="password-verified">
            Changer de mot de passe: 
            <button type="button" onclick="toggleInput('mdpact')">Modifier</button>
            <div id="mdpact" style="display: none;">
                <input type="password" id="ancien_mdp" name="ancien_mdp" placeholder="Entrez votre ancien Mot de Passe">
                <button type="submit" name="verifier_mdp">Vérifier</button>
            </div>
        </div>

        <div class="form-group" id="change-password-section" style="display: none;">
            Nouveau mot de passe: 
            <input type="password" id="nouveau_mdp" name="nouveau_mdp" placeholder="Entrez votre nouveau Mot de Passe">
            Confirmer le nouveau mot de passe: 
            <input type="password" id="confirmer_mdp" name="confirmer_mdp" placeholder="Répétez votre nouveau Mot de passe"><br>
        </div>

        <input id="maj" type="submit" value="Mettre à jour">
    </form>
    <div class="decsupp">
        <a href="deconnexion.php" class="btn-deconnexion">Déconnexion</a>
        <form method="post" action="suppCompte.php">
            <input type="hidden" name="id_user" value="<?php echo $iduser; ?>">
            <button type="submit" class="btn-supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">Supprimer mon compte</button>
        </form>
    </div><br>
    <?php
    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
        ?><a href="administration.php" class="btn-admin">Droits Admin</a><?php
    }
    ?>
</body>
</html>
