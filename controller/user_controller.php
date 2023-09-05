<?php
session_start();

// Vérifier si la variable de session existe
if (isset($_SESSION['pseudo'])) {
    // Utiliser la valeur du pseudo
    $pseudo = $_SESSION['pseudo'];
  

    // Connexion à la base de données
    require_once '../model/connexion.php';

    try {
        // Préparer la requête pour récupérer les informations de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM user WHERE pseudo = ?");
        $stmt->execute([$pseudo]);

        // Vérifier si l'utilisateur existe dans la base de données
        if ($stmt->rowCount() > 0) {
            // Récupérer les données de l'utilisateur
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $pdp = $user['pdp'];
            $nom = $user['nom'];
            $prenom = $user['prenom'];
            $tel = $user['tel'];


            // Afficher la photo de profil de l'utilisateur
            require_once '../view/user_view.php';

        } else {
            echo "Utilisateur introuvable.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur de requête, afficher le message d'erreur
        echo "Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage();
    }
} else {
   
    header('Location: ../view/login_view.php');
    exit();

}
?>





