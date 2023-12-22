<?php
include("config.php");
session_start();
// Vérifiez si l'utilisateur est un administrateur
if (!isset($_SESSION['user']) || $_SESSION['isAdmin'] != 1) {
    die("Accès refusé.");
}
try {
    $bdd = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$nombase , $utilisateur , $mdp);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
// Si l'utilisateur est un administrateur, affichez le formulaire
?>
<form action="promouvoirAdmin.php" method="post">
    <input type="email" name="email" placeholder="Entrez l'email de l'utilisateur">
    <input type="submit" value="Promouvoir comme Admin">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Vérifier si l'email existe dans la base de données
    $stmt = $bdd->prepare("SELECT id_user FROM user WHERE mail = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        // Si l'utilisateur existe, mettez à jour son statut d'administrateur
        $updateStmt = $bdd->prepare("UPDATE user SET isAdmin = 1 WHERE id_user = :id_user");
        $updateStmt->bindParam(':id_user', $user['id_user']);
        $updateStmt->execute();

        echo "L'utilisateur a été promu administrateur.";
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }
}
?>