<?php
class Database {
    // XAMPP par défaut
    private $host = "localhost";
    private $port = "3306";
    private $db_name = "lm_universe";
    private $username = "root";
    private $password = ""; // Vide par défaut dans XAMPP
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            // Connexion standard pour XAMPP
            $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ]);
            
        } catch(PDOException $exception) {
            echo "<div style='background: #ff6b6b; color: white; padding: 20px; border-radius: 10px; margin: 20px; font-family: Ubuntu, sans-serif;'>";
            echo "<h3>🚨 Erreur XAMPP sur Ubuntu</h3>";
            echo "<p><strong>Message :</strong> " . htmlspecialchars($exception->getMessage()) . "</p>";
            echo "<p><strong>Solutions XAMPP :</strong></p>";
            echo "<ol>";
            echo "<li><strong>Démarrer XAMPP :</strong><br>";
            echo "<code>sudo /opt/lampp/lampp start</code></li>";
            echo "<li><strong>Vérifier les services :</strong><br>";
            echo "<code>sudo /opt/lampp/lampp status</code></li>";
            echo "<li><strong>Accéder à phpMyAdmin :</strong><br>";
            echo "<a href='http://localhost/phpmyadmin'>http://localhost/phpmyadmin</a></li>";
            echo "<li><strong>Créer la base via terminal :</strong><br>";
            echo "<code>/opt/lampp/bin/mysql -u root</code></li>";
            echo "</ol>";
            echo "</div>";
            exit;
        }
        return $this->conn;
    }
}
?>