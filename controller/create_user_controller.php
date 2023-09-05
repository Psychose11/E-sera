<?php
// Inclure le modèle de connexion à la base de données
require_once '../model/connexion.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
 
    $pseudo = $_POST['pseudo'];
    $motdepasse = $_POST['motdepasse'];
    $tel = $_POST['tel'];

    // Vérifier si la photo de profil a été téléchargée
    if (isset($_FILES['pdp']) && $_FILES['pdp']['error'] === UPLOAD_ERR_OK) {
        $pdp = $_FILES['pdp']['name'];
        move_uploaded_file($_FILES['pdp']['tmp_name'], '../images/pdp/' . $pdp);
    } else {
        $pdp = null;
    }

    try {
        // Préparer la requête d'insertion
        $stmt = $pdo->prepare("INSERT INTO user (pseudo, motdepasse, pdp, tel) VALUES (?, ?, ?, ?)");

        // Exécuter la requête avec les valeurs des paramètres
        $stmt->execute([$pseudo, $motdepasse, $pdp, $tel]);

        // Afficher un message de succès
        echo "L'utilisateur a été ajouté avec succès.";
        header('Location: ../view/login_view.php');


    } catch (PDOException $e) {
        // En cas d'erreur d'exécution de la requête, afficher le message d'erreur
        echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
    }
}


?>
