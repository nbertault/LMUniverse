<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $database = new Database();
    $db = $database->getConnection();
    
    if ($action == 'disable') {
        // Supprimer le token de la base
        $query = "UPDATE users SET remember_token = NULL WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->execute();
        
        // Supprimer les cookies
        setcookie('user_id', '', time() - 3600, '/');
        setcookie('remember_token', '', time() - 3600, '/');
        
        $_SESSION['message'] = "Connexion persistante désactivée";
        
    } elseif ($action == 'enable') {
        // Générer un nouveau token
        $cookie_token = bin2hex(random_bytes(32));
        $cookie_expiry = time() + (30 * 24 * 60 * 60);
        
        // Mettre à jour la base
        $query = "UPDATE users SET remember_token = :token WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':token', $cookie_token);
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->execute();
        
        // Créer les cookies
        setcookie('user_id', $_SESSION['user_id'], $cookie_expiry, '/', '', false, true);
        setcookie('remember_token', $cookie_token, $cookie_expiry, '/', '', false, true);
        
        $_SESSION['message'] = "Connexion persistante activée pour 30 jours";
    }
    
    header("Location: dashboard.php");
    exit;
}
?>