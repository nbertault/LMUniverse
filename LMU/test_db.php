<?php
// test_db.php - Pour diagnostiquer
echo "<pre style='background: black; color: white; padding: 20px;'>";

echo "=== TEST BASE DE DONNÉES ===\n\n";

// Test connexion
try {
    require_once 'config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    
    echo "✅ Connexion réussie\n";
    
    // Test table users
    $stmt = $db->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Table 'users' existe\n";
        
        // Afficher la structure
        echo "\n=== STRUCTURE TABLE users ===\n";
        $stmt = $db->query("DESCRIBE users");
        $columns = $stmt->fetchAll();
        
        foreach ($columns as $col) {
            echo "{$col['Field']} - {$col['Type']} - {$col['Null']} - {$col['Key']}\n";
        }
        
        // Compter les utilisateurs
        $stmt = $db->query("SELECT COUNT(*) as count FROM users");
        $count = $stmt->fetch();
        echo "\n👥 Nombre d'utilisateurs: " . $count['count'] . "\n";
        
        // Afficher les utilisateurs
        $stmt = $db->query("SELECT id, pseudo, username, created_at FROM users");
        $users = $stmt->fetchAll();
        
        if (count($users) > 0) {
            echo "\n=== UTILISATEURS ===\n";
            foreach ($users as $user) {
                echo "ID: {$user['id']} | Pseudo: {$user['pseudo']} | Username: {$user['username']} | Créé: {$user['created_at']}\n";
            }
        }
        
    } else {
        echo "❌ Table 'users' n'existe pas\n";
        echo "\n=== CRÉATION DE LA TABLE ===\n";
        echo "Exécute ce SQL dans phpMyAdmin:\n\n";
        
        $sql = "CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(64) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        
        echo htmlspecialchars($sql);
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

echo "</pre>";
?>