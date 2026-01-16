<?php
// debug_register.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<pre>";

// Test POST
echo "=== POST DATA ===\n";
print_r($_POST);

// Test DB connection
echo "\n=== DATABASE TEST ===\n";
try {
    require_once 'config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    echo "✅ DB Connection OK\n";
    
    // Test table
    $stmt = $db->query("SELECT 1 FROM users LIMIT 1");
    echo "✅ Table users exists\n";
    
    // Try to insert test data
    $test_pseudo = 'Debug_' . time();
    $test_username = 'debug_' . time();
    $test_password = password_hash('test123', PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (pseudo, username, password) VALUES (:pseudo, :username, :password)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':pseudo', $test_pseudo);
    $stmt->bindParam(':username', $test_username);
    $stmt->bindParam(':password', $test_password);
    
    if ($stmt->execute()) {
        echo "✅ Test insert successful\n";
        echo "Test user created: $test_username\n";
    } else {
        echo "❌ Test insert failed\n";
        print_r($stmt->errorInfo());
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "</pre>";