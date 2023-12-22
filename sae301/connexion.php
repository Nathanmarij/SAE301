<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/conins.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="form">
        <form method="POST" action="conecTraitement.php">
            <input type="text" placeholder="Votre Email" id="mail" name="mail" class="champ">
            <input type="password" placeholder="Votre Mot de passe" id="mdp" name="mdp" class="champ">
            <input type="submit" id="submit" name="submit" class="champ">
        </form>
        <?php
        session_start();
        if (isset($_SESSION["login_error"])) {
            echo "<p class='error' style='color: red;'>" . htmlspecialchars($_SESSION["login_error"]) . "</p>";
            unset($_SESSION["login_error"]);
        }
        ?>
        <p>Je n'ai pas de compte, <a href="inscription.php">M'inscrire</a></p>
    </div>
</body>

</html>
