<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['pseudo'])) {
        // Récupérer le pseudo de l'utilisateur à partir de la session
        $pseudo = $_SESSION['pseudo'];

        // Connexion à la base de données
        require_once '../model/connexion.php';

        // Récupérer l'identifiant de l'utilisateur à partir de la base de données en utilisant le pseudo
        $query = "SELECT id FROM user WHERE pseudo = :pseudo";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $userId = $user['id'];
            // Récupérer les données de la commande
            $produitId = $_POST['produit_id'];

            // Vérifier si l'utilisateur a déjà commandé ce produit
            $query = "SELECT COUNT(*) AS count, `like` FROM commande WHERE user_id = :userId AND produit_id = :produitId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':produitId', $produitId);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && $result['count'] > 0) {
                // L'utilisateur a déjà commandé ce produit
                // Répondre avec un statut d'erreur ou un message indiquant qu'il a déjà commandé le produit
                http_response_code(400);
                echo json_encode(['error' => 'Vous avez déjà commandé ce produit.']);
            } else {
                // Insérer la commande dans la base de données avec le "like" initialisé à 0
                $query = "INSERT INTO commande (user_id, produit_id, date_commande, `like`) VALUES (:userId, :produitId, NOW(), 0)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':userId', $userId);
                $stmt->bindParam(':produitId', $produitId);
                $stmt->execute();

                // Répondre avec un statut de réussite ou un message indiquant que la commande a été enregistrée
                http_response_code(200);
                echo json_encode(['message' => 'Commande enregistrée avec succès.']);
            }
        } else {
            // L'utilisateur n'existe pas dans la base de données
            // Répondre avec un statut d'erreur ou un message indiquant de se connecter
            http_response_code(401);
            echo json_encode(['error' => 'Utilisateur non valide.']);
        }
    } else {
        // L'utilisateur n'est pas connecté
        // Répondre avec un statut d'erreur ou un message indiquant de se connecter
        http_response_code(401);
        echo json_encode(['error' => 'Veuillez vous connecter pour commander ce produit.']);
    }
} else {
    // La requête n'est pas de type POST
    // Répondre avec un statut d'erreur ou un message indiquant une mauvaise requête
    http_response_code(400);
    echo json_encode(['error' => 'Mauvaise requête.']);
}
?>
