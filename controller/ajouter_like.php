<?php
session_start();
// Inclure le modèle de connexion à la base de données
require_once '../model/connexion.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['pseudo'])) {
    // Vérifier si le paramètre produit_id et utilisateur_id ont été transmis
    if (isset($_GET['produit_id']) && isset($_GET['utilisateur_id'])) {
        $produit_id = $_GET['produit_id'];
        $utilisateur_id = $_GET['utilisateur_id'];

        try {
            // Vérifier si l'utilisateur a déjà aimé ce produit
            $query = "SELECT COUNT(*) AS liked_count FROM likes WHERE produit_id = :produit_id AND utilisateur_id = :utilisateur_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':produit_id', $produit_id);
            $stmt->bindParam(':utilisateur_id', $utilisateur_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $liked_count = $result['liked_count'];

            // Si l'utilisateur n'a pas encore aimé le produit, ajouter le like
            if ($liked_count == 0) {
                // Insérer le like dans la table likes
                $insertQuery = "INSERT INTO likes (produit_id, utilisateur_id) VALUES (:produit_id, :utilisateur_id)";
                $insertStmt = $pdo->prepare($insertQuery);
                $insertStmt->bindParam(':produit_id', $produit_id);
                $insertStmt->bindParam(':utilisateur_id', $utilisateur_id);
                $insertStmt->execute();
            }
        } catch (PDOException $e) {
            // En cas d'erreur d'exécution de la requête, afficher le message d'erreur
            echo "Erreur lors de l'ajout du like : " . $e->getMessage();
        }
    }
}

// Rediriger l'utilisateur vers la page précédente
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
