<?php
// Inclure le modèle de connexion à la base de données
require_once __DIR__ . '/../model/connexion.php';

// Fonction pour récupérer le nombre de commandes pour un produit spécifié
function getCommandesCount($produit_id)
{
    global $pdo;

    try {
        // Requête pour compter le nombre de commandes pour le produit spécifié
        $query = "SELECT COUNT(*) AS commandes_count FROM commande WHERE produit_id = :produit_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':produit_id', $produit_id);
        $stmt->execute();

        // Récupérer le nombre de commandes
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $commandes_count = $result['commandes_count'];

        // Renvoyer le nombre de commandes en réponse
        return $commandes_count;
    } catch (PDOException $e) {
        // En cas d'erreur d'exécution de la requête, afficher le message d'erreur
        return "Erreur lors de la récupération du nombre de commandes : " . $e->getMessage();
    }
}

// Vérifier si le paramètre produit_id a été transmis
if (isset($_POST['produit_id'])) {
    $produit_id = $_POST['produit_id'];

    // Récupérer le nombre de commandes pour le produit spécifié
    $commandes_count = getCommandesCount($produit_id);

    // Spécifier le type de contenu renvoyé
    header('Content-Type: text/plain');

    // Renvoyer le nombre de commandes en réponse
    echo $commandes_count;
} else {
    // Si le paramètre produit_id n'a pas été transmis, renvoyer une erreur
    echo "Paramètre produit_id manquant.";
}
?>
