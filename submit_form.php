<?php
// 1. Paramètres de connexion à la base de données
$host = 'localhost'; // Hôte (souvent localhost pour les serveurs locaux)
$dbname = 'garage_auto'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur pour MySQL
$password = ''; // Mot de passe pour MySQL (souvent vide en local)

// 2. Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Gestion des erreurs
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// 3. Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // 4. Préparation de la requête d'insertion
    $query = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
    $stmt = $pdo->prepare($query);

    // 5. Exécution de la requête
    try {
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message
        ]);
        echo "Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'envoi du message : " . $e->getMessage();
    }
}
?>
