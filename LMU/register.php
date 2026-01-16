<?php
// register.php
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = trim($_POST['pseudo']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $database = new Database();
    $db = $database->getConnection();
    
    // Vérifier si existe déjà
    $checkQuery = "SELECT id FROM users WHERE username = :username OR pseudo = :pseudo";
    $stmt = $db->prepare($checkQuery);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Pseudo ou nom d\\'utilisateur déjà utilisé!'); window.location.href = 'index.php';</script>";
        exit;
    }
    
    // Hasher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insérer
    $query = "INSERT INTO users (pseudo, username, password) VALUES (:pseudo, :username, :password)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    
    if ($stmt->execute()) {
        echo "<script>alert('Inscription réussie! Connectez-vous.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Erreur lors de l\\'inscription.'); window.location.href = 'index.php';</script>";
    }
}
?>