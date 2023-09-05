<?php
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $pseudo = $_POST['pseudo'];
    $motdepasse = $_POST['password'];

    // Connexion à la base de données
    require_once '../model/connexion.php';

    try {
        // Préparer la requête pour vérifier les informations de connexion
        $stmt = $pdo->prepare("SELECT * FROM user WHERE pseudo = ? AND motdepasse = ?");
        $stmt->execute([$pseudo, $motdepasse]);

        // Vérifier si les informations de connexion sont valides
        if ($stmt->rowCount() > 0) {
            // Les informations de connexion sont valides

            // Définir le pseudo dans la variable de session
            $_SESSION['pseudo'] = $pseudo;

            // Rediriger vers la fenêtre principale
            header('Location: ../index.php');
            exit(); // Terminer le script pour éviter toute exécution supplémentaire
        } else {
            // Les informations de connexion sont invalides
            echo "Identifiants incorrects. Veuillez réessayer.";
            $_SESSION['message'] = "User or password not found. Please create an account.";
            header('Location: ../view/login_view.php');
        }
    } catch (PDOException $e) {
        // En cas d'erreur de requête, afficher le message d'erreur
        echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
        $_SESSION['message'] = "Erreur de Base de Donné.";
    }
}
?>
