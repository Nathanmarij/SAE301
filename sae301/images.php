<?php
include("config.php");
session_start();
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.UTF-8', 'French_France.1252');
try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase, $utilisateur, $mdp);
} catch (Exception $e) {
    die("erreur");
}?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/header.css" type="text/css" rel="stylesheet" />
    <link href="css/image.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <script src="js/forum.js"></script>
    <title>images</title>
</head>
<body>
<?php include("header.php"); ?>
    <div class="nav-tabs">
        <a href="forum.php" class="tab">Forum</a>
        <span class="separator">|</span>
        <a href="images.php" class="tab active">Images</a>
    </div> 
    <div class="container">
<?php
function getImages($bdd) {
    $requete = 'SELECT id_image, img, date, id_user FROM images ORDER BY id_image DESC';
    $statement = $bdd->prepare($requete);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

$img = getImages($bdd);

if (isset($_SESSION["user"])) { ?>

<form action="imagesTraitement.php" method="post" enctype="multipart/form-data" >
<p><label for="limage">L'image</label>
<input type="file" name="limage" />(<i> *.jpg *.png</i>)</p>
<input type="submit" name="BtnSubmit" value="Envoyer" id="envoie">
</form>
<?php }
else {?>
            <div class="seco">Vous devez &nbsp;<a href="connexion.php">vous connecter</a>&nbsp; pour poster des images</div>
            <?php
}

$months = [
    "January" => "Janvier", "February" => "Février", "March" => "Mars",
    "April" => "Avril", "May" => "Mai", "June" => "Juin",
    "July" => "Juillet", "August" => "Août", "September" => "Septembre",
    "October" => "Octobre", "November" => "Novembre", "December" => "Décembre"
];

foreach ($img as $val) {
    $requete = 'SELECT nom, prenom, isAdmin FROM user WHERE id_user = :id_user';
    $statement = $bdd->prepare($requete);
    $statement->bindValue(':id_user', $val["id_user"], PDO::PARAM_INT);
    $statement->execute();
    $commentateur = $statement->fetch(PDO::FETCH_ASSOC);

    echo '<fieldset class="image-fieldset"><legend><b>';
    echo htmlspecialchars($commentateur["prenom"]) . " " . htmlspecialchars($commentateur["nom"]);
    // Afficher le badge si l'utilisateur est un administrateur
    if ($commentateur["isAdmin"] == 1) {
        echo ' <img src="image/badge.png" width="20px" style="vertical-align: middle;">';
    }
    echo "</b></legend>";?>
    <img src="<?php echo $val["img"];?>" id="photo"><?php
    echo "<br>";

    $date = new DateTime($val["date"]);
    $formattedDate = $date->format('d F Y à H\hi');
    $month = $date->format('F');
    $formattedDate = str_replace($month, $months[$month], $formattedDate);

    echo "<i>Posté le " . $formattedDate . "</i><br>";

    if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1 || (isset($_SESSION["user"]) && $_SESSION["user"] == $val["id_user"])) {?>
        <a href="supImage.php?id=<?php echo $val["id_image"]; ?>">
        <button class="delete-btn" onclick="deleteImage('<?php $val['id_image']?> ')"><img src="image/poubelle.png" alt="Supprimer"></button></a><?php
    }
    ?> </fieldset>
    <?php
}
?>
</div>
</body>
</html>