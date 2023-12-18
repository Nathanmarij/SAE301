<?php
    include ("config.php");
    session_start();
    try {
        $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
    } catch (Exception $e) { // sinon
        die("erreur"); // ecrire 'erreur'
    }

    $requete = 'SELECT id_image, img, date, id_user FROM images ORDER BY id_image DESC';
    $requete = $bdd->query($requete);
    $image = $requete->fetchAll(PDO::FETCH_ASSOC);
    $requete->closeCursor(); ?>
    <a href="index.php">Home</a><?php
    if (isset($_SESSION["user"])) { // vérifie si il existe une session qui s'apelle 'user'
    ?> 
<form action="imagesTraitement.php" method="post" enctype="multipart/form-data" >
<p><label for="limage">L'image</label>
<input type="file" name="limage" />(<i> *.jpg *.png</i>)</p>
<input type="submit" name="BtnSubmit" value="Envoyer">
</form>
<?php } else { // sinon
            ?>
                <div class="seco">Vous devez &nbsp;<a href="inscription.php">vous connecter</a>&nbsp; pour poster des images</div>
                <?php
        }
        ?>
<?php
            if (isset($image)) { // vérifie si il y a des commentaires sur l'article
                foreach ($image as $val):
                    $requete = 'SELECT id_image, img, date, id_user FROM images'; //requête permettant de récupérer le nom et le prenom de la personne qui a écrit un commentaire
                    $requete = $bdd->query($requete);
                    $img = $requete->fetch(PDO::FETCH_ASSOC);
                    $requete->closeCursor();

                   $idcomentateur = $val["id_user"];
                   $requete = 'SELECT nom, prenom FROM user WHERE id_user=' . $idcomentateur; //requête permettant de récupérer le nom et le prenom de la personne qui a écrit un commentaire
                   $requete = $bdd->query($requete);
                   $commentateur = $requete->fetch(PDO::FETCH_ASSOC);
                   $requete->closeCursor();                         
                        echo $commentateur["prenom"] . " ";
                        echo $commentateur["nom"]; ?>
                        <?php
                        echo "<br>";
                        ?>
                        <img src="<?php echo $val["img"]; ?>
                        <?php
                        echo $val["date"];?>
                           </div>
                <?php 
                endforeach;

            } else {
                echo "";
            }
            ?>
