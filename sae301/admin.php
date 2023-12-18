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
    <form action="adminTraitement.php" method="POST" class="commentaire">
                <?php
                if (isset($forum)) { // vérifie si il y a des commentaires sur l'article
                    foreach ($forum as $val):
                $requete = 'SELECT id_reponse, contenu FROM reponse WHERE id_ask=' . $val["id_ask"]; //requête permettant de récupérer le nom et le prenom de la personne qui a écrit un commentaire
                $requete = $bdd->query($requete);
                $rep = $requete->fetch(PDO::FETCH_ASSOC);
                $requete->closeCursor();
                if (empty($rep)) {?>
                <input type="radio" name="comm" id="comm" value="<?php echo $val["id_ask"];?>" checked /><?php 
                $idcomm = $val["id_ask"];
                $requete = 'SELECT id_ask, content FROM forum WHERE id_ask=' . $idcomm; //requête permettant de récupérer le nom et le prenom de la personne qui a écrit un commentaire
                $requete = $bdd->query($requete);
                $comm = $requete->fetch(PDO::FETCH_ASSOC);
                $requete->closeCursor(); ?>
                    <?php echo $comm["content"];
                
                } else {
                    echo '';
                }
                
                endforeach;}?>
                <input type="text" placeholder="Répondre à la question" id="reponse" name="reponse" class="ecrir">
                <input type="submit" id="submit" name="submit" value="Répondre">
