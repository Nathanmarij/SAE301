<?php
session_start();
include("config.php");

try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
} catch (Exception $e) {
    die("erreur");
}

$file_min_size = 0;
$file_max_size = 10000000;
$errors = [];

if (isset($_FILES["limage"]) && ($_FILES["limage"]["size"] > $file_min_size) && ($_FILES["limage"]["size"] < $file_max_size)) {
    $content_dir = "img/";
    $tmp_file = $_FILES["limage"]["tmp_name"];

    if (!is_uploaded_file($tmp_file)) {
        echo "Fichier non trouvé";
        exit;
    }

    $path = $_FILES["limage"]["name"];
    $ext = pathinfo($path, PATHINFO_EXTENSION);

    if (!in_array($ext, ['jpg', 'png'])) {
        echo "EXTENSION " . $ext . " NON AUTORISEE";
        exit;
    }

    if (empty($errors)) {
        $name_file = md5(uniqid(rand(), true)) . "." . $ext;
        if (!move_uploaded_file($tmp_file, $content_dir . $name_file)) {
            echo "Impossible de copier le fichier dans le dossier cible";
            exit;
        }
    }

    $get_the_file = $content_dir . $name_file;
    echo "image enregistrée avec chemin = " . $get_the_file;

    $user = $_SESSION["user"];
    $date_publication = date('Y-m-d H:i:s');
    $requete = $bdd->prepare("INSERT INTO images (img, date, id_user) VALUES (?, ?, ?)");
    $requete->execute([$get_the_file, $date_publication, $user]);
    $image = $requete->fetch();

    header("Location: images.php");
    exit;
} elseif ($_FILES["limage"]["size"] > $file_max_size) {
    echo "le fichier dépasse la limite autorisée";
    exit;
} else {
    echo "Pas de fichier joint";
    exit;
}
?>
