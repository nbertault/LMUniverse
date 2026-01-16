<?php
// login.php
session_start();
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT id, username, password, pseudo FROM users WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['pseudo'] = $row['pseudo'];
            
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Mot de passe incorrect!'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Utilisateur non trouvé!'); window.location.href = 'index.php';</script>";
    }
}
?>