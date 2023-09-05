<?php
// Inclure le modèle de connexion à la base de données
require_once '../model/connexion.php';

try {
    // Requête pour récupérer tous les produits et leurs informations d'utilisateur associées
    $query = "SELECT p.*, u.pseudo, u.pdp, u.tel FROM produit p JOIN user u ON p.utilisateur_id = u.id";
    $stmt = $pdo->query($query);

    // Vérifier s'il y a des résultats
    if ($stmt->rowCount() > 0) {
        // Parcourir les résultats
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Récupérer les informations du produit
            $produit_id = $row['id'];
            $nom = $row['nom'];
            $image = $row['image'];
            $description = $row['description'];
            $prix = $row['prix'];
            $type = $row['type'];

            // Récupérer les informations de l'utilisateur
            $pseudo = $row['pseudo'];
            $pdp = $row['pdp'];
            $tel = $row['tel'];

            // Récupérer la date de publication et calculer le décalage
            $date_publication = new DateTime($row['date_publication']);
            $maintenant = new DateTime();
            $diff = $date_publication->diff($maintenant);
            $decalage = "";

            // Afficher le décalage de la date de publication
            if ($diff->y > 0) {
                $decalage = $diff->format('%y an(s) ');
            } elseif ($diff->m > 0) {
                $decalage = $diff->format('%m mois ');
            } elseif ($diff->d > 0) {
                $decalage = $diff->format('%d jour(s) ');
            } elseif ($diff->h > 0) {
                $decalage = $diff->format('%h heure(s) ');
            } elseif ($diff->i > 0) {
                $decalage = $diff->format('%i minute(s) ');
            } else {
                $decalage = "à l'instant";
            }

            // Afficher les informations du produit et de l'utilisateur
            echo "<div>";
            echo "<h3>$nom</h3>";
            echo "<img src='../images/produit/$image' alt='$nom'>";
            echo "<p>$description</p>";
            echo "<p>Prix : $prix</p>";
            echo "<p>Type : $type</p>";
            echo "<p>Publié par : $pseudo</p>";
            echo "<p>Téléphone : $tel</p>";
            echo "<p>Publié il y a : $decalage</p>";
            echo "<img src='../images/pdp/$pdp' alt='Photo de profil de $pseudo'>";
            echo "</div>";
        }
    } else {
        echo "Aucun produit trouvé.";
    }
} catch (PDOException $e) {
    // En cas d'erreur d'exécution de la requête, afficher le message d'erreur
    echo "Erreur lors de la récupération des produits : " . $e->getMessage();
}
?>
