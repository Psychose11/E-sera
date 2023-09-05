<?php
// Inclure le modèle de connexion à la base de données

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../model/connexion.php';


// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le pseudo de l'utilisateur à partir de la variable de session
    session_start();
    $pseudo = $_SESSION['pseudo'];

    // Récupérer les valeurs du formulaire
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $type = $_POST['type'];

    // Vérifier si l'image a été téléchargée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../images/produit/' . $image);
    } else {
        $image = null;
    }

    try {
        // Rechercher l'ID de l'utilisateur à partir du pseudo
        $stmt = $pdo->prepare("SELECT id FROM user WHERE pseudo = ?");
        $stmt->execute([$pseudo]);
        $row = $stmt->fetch();
        $utilisateur_id = $row['id'];

        // Préparer la requête d'insertion
        $stmt = $pdo->prepare("INSERT INTO produit (utilisateur_id, nom, image, description, prix, type) VALUES (?, ?, ?, ?, ?, ?)");

        // Exécuter la requête avec les valeurs des paramètres
        $stmt->execute([$utilisateur_id, $nom, $image, $description, $prix, $type]);

        // Afficher un message de succès

        header('Location: ../index.php');
        exit();

    } catch (PDOException $e) {
        // En cas d'erreur d'exécution de la requête, afficher le message d'erreur
        echo "Erreur lors de l'ajout du produit : " . $e->getMessage();
    }
}
?>
