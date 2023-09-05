<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'esera';
$username = 'root';
$password = '';

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Définir le mode d'erreur PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher le message d'erreur
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    // Arrêter l'exécution du script
    exit();
}
?>