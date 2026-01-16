<?php
// test_connection.php - Test le plus basique possible
echo "<h1>Test de connexion MySQL</h1>";

// Essai 1: PDO direct
echo "<h3>Essai avec PDO:</h3>";
try {
    $pdo = new PDO('mysql:host=localhost;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Connexion PDO réussie<br>";
    
    // Vérifier les bases de données
    $stmt = $pdo->query("SHOW DATABASES");
    $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Bases de données disponibles:<br>";
    foreach ($databases as $db) {
        echo "- $db<br>";
    }
    
} catch (PDOException $e) {
    echo "❌ Erreur PDO: " . $e->getMessage() . "<br>";
}

// Essai 2: mysqli
echo "<h3>Essai avec mysqli:</h3>";
$mysqli = @new mysqli('localhost', 'root', '');
if ($mysqli->connect_error) {
    echo "❌ Erreur mysqli: " . $mysqli->connect_error . "<br>";
} else {
    echo "✅ Connexion mysqli réussie<br>";
    
    // Lister les bases
    $result = $mysqli->query("SHOW DATABASES");
    echo "Bases de données:<br>";
    while ($row = $result->fetch_array()) {
        echo "- " . $row[0] . "<br>";
    }
    $mysqli->close();
}

// Essai 3: socket MySQL
echo "<h3>Test de socket:</h3>";
if (file_exists('/opt/lampp/var/mysql/mysql.sock')) {
    echo "✅ Socket MySQL trouvé: /opt/lampp/var/mysql/mysql.sock<br>";
} else {
    echo "⚠️ Socket MySQL non trouvé<br>";
}

// Essai 4: phpinfo
echo "<h3>Informations PHP:</h3>";
echo "<a href='phpinfo.php'>Voir phpinfo()</a>";
?>