<?php
session_start();
include("config.php");
try {
$bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
} catch (Exception $e) { // sinon
die("erreur");
// ecrire 'erreur'
}
// taille autorisées (min & max -- en octets)
$file_min_size = 0;
$file_max_size = 10000000;
// On vérifie la présence d"un fichier à uploader
if (($_FILES["limage"]["size"] > $file_min_size) && ($_FILES["limage"]["size"] < $file_max_size)) :
    // dossier où sera déplacé le fichier; ce dossier doit exister
    $content_dir = "img/";
    $tmp_file = $_FILES["limage"]["tmp_name"];
    if( !is_uploaded_file($tmp_file) ){
        echo "Fichier non trouvé";
    }
    // on vérifie l"extension
    $path = $_FILES["limage"]["name"];
    $ext = pathinfo($path, PATHINFO_EXTENSION); // on récupère l"extension
    if(!strstr($ext, "jpg")&& !strstr($ext, "png")){
        echo "EXTENSION ".$ext." NON AUTORISEE";
    }
    // Si le formulaire est validé, on copie le fichier dans le dossier de destination
    if(empty($errors)){
        $name_file = md5(uniqid(rand(), true)).".".$ext; // on crée un nom unique en conservant l"extension
        if( !move_uploaded_file($tmp_file, $content_dir . $name_file) ){
            echo "Il y a des erreurs! Impossible de copier le fichier dans le dossier cible";
        }
    } 
    // On récupère l"url du fichier envoyé
    $get_the_file = $content_dir.$name_file;
    echo "image enregistrée avec chemin =".$get_the_file;
    
    elseif($_FILES["upfiles"]["size"] > $file_max_size):
        echo "le fichier dépasse la limite autorisée";
    else: 
        echo "Pas de fichier joint";
    endif;
    $user = $_SESSION["user"];
    $date_publication = date('Y-m-d H:i:s');
    $requete = $bdd->prepare("INSERT INTO images (img, date, id_user) VALUES(?,?,?)"); // insérer dans la table commentaire les valeurs envoyés par le formulaire
    $requete->execute([$get_the_file, $date_publication, $user]); // executer la requete
    $image = $requete->fetch();
header("Location:images.php");
    ?>