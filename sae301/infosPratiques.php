<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/infopratique.css" type="text/css" rel="stylesheet" />

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
    <?php include("header.php"); ?>
        <!-- Contenu principal -->
        <div class="main">
        <div class="info-container">
            <h1>Informations Pratiques</h1>

            <h2>Accès au Lieu</h2>
            <p>
                Le concert se déroulera à la Place du Breuil, Le Puy-en-Velay. Pour faciliter votre arrivée, des bus et des parkings sont disponibles à proximité du lieu de l'événement.
            </p>

            <h2>Horaires</h2>
            <p>
                L'événement aura lieu de 13h à 2h du matin. La première partie de l'événement, de 13h à 17h, est dédiée à un public jeune. Ensuite, le programme évoluera pour s'adresser à un public adulte.
            </p>

            <h2>Hébergement</h2>
            <p>
                Plusieurs options d'hébergement sont disponibles à proximité. Nous vous recommandons de consulter les hôtels et auberges locaux pour votre séjour.
            </p>

            <h2>Restauration</h2>
            <p>
                Des options de restauration variées seront disponibles sur le site de l'événement. De plus, plusieurs restaurants se trouvent à proximité pour satisfaire tous les goûts.
            </p>

            <h2>Accessibilité</h2>
            <p>
                L'événement est accessible aux personnes à mobilité réduite. Des aménagements spécifiques sont prévus pour garantir un accès aisé à tous les espaces.
            </p>

            <h2>Contact</h2>
            <p>
                Pour toute question supplémentaire, n'hésitez pas à nous contacter via notre formulaire en ligne ou par téléphone au 04 71 04 14 55.
            </p>
        </div>
    </div>
    </body>

</html>