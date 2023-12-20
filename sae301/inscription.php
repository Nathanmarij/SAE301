<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/conins.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="form">
        <form method="POST" action="inscriTraitement.php">
            <input type="text" placeholder="Votre Prénom" id="prenom" name="prenom" class="champ" required>
            <input type="text" placeholder="Votre Nom" id="nom" name="nom" class="champ" required>
            <input type="text" placeholder="Votre Email" id="mail" name="mail" class="champ" required>
            <input type="password" placeholder="Votre Mot de passe" id="mdp" name="mdp" class="champ" required>
            <input type="password" placeholder="Confirmez votre mot de passe" id="conf_mdp" name="conf_mdp" class="champ" required>
            <input type="submit" id="submit" name="submit" class="champ">
        </form>
        <p>J'ai déjà un compte, <a href="connexion.php">Me connecter</a></p>
    </div>
</body>

</html>