<?php
    include ("config.php");
    session_start();
    try {
        $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
    } catch (Exception $e) { // sinon
        die("erreur"); // ecrire 'erreur'
    }

    $requete = 'SELECT id_ask, id_user, content, date FROM forum ORDER BY id_ask DESC';
    $statement = $bdd->prepare($requete);
    $statement->execute();
    $forum = $statement->fetchAll(PDO::FETCH_ASSOC);?>
    <a href="index.php">Home</a><?php
    if (isset($_SESSION["user"])) { // vérifie si il existe une session qui s'apelle 'user'
    ?> 
            <form action="forTraitement.php" method="POST" class="commentaire">
                <input type="text" placeholder="Posez une question" id="content" name="content" class="ecrir">
                <input type="submit" id="submit" name="submit" value="Commenter">
            <?php } else { // sinon
            ?>
                <div class="seco">Vous devez &nbsp;<a href="inscription.php">vous connecter</a>&nbsp; pour poser des questions</div>
                <?php
        }
        ?>
        
            <?php
            if (isset($forum)) { // vérifie si il y a des commentaires sur l'article
                foreach ($forum as $val):

                    ?>
                    <p class="ask">
                        <?php
                        $idcomentateur = $val["id_user"];
                        $requete = 'SELECT nom, prenom FROM user WHERE id_user=' . $idcomentateur; //requête permettant de récupérer le nom et le prenom de la personne qui a écrit un commentaire
                        $requete = $bdd->query($requete);
                        $commentateur = $requete->fetch(PDO::FETCH_ASSOC);
                        $requete->closeCursor(); ?>
                            <?php echo $commentateur["prenom"] . " ";
                            echo $commentateur["nom"]; ?>
                        <?php
                        echo "<br>";
                        ?>
                    <div class="commentaire">
                        <p><?php
                        echo $val["content"];?></p>
                        <?php
                        echo $val["date"];
                    
                endforeach;

            } else {
                echo "";
            }
            ?>
    </div>