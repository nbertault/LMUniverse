<?php
// install_xampp.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Installation XAMPP - LM Universe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top, #0d0053, #000);
            min-height: 100vh;
            padding: 50px 0;
            color: white;
            font-family: 'Ubuntu', sans-serif;
        }
        .xampp-box {
            background: rgba(0,0,0,0.85);
            border-radius: 16px;
            box-shadow: 0 0 40px rgba(196,148,71,0.5);
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
        }
        .text-gold { color: #C49447; }
        .terminal {
            background: #1a1a1a;
            color: #0f0;
            font-family: 'Monospace', 'Courier New', monospace;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
        .xampp-tip {
            background: linear-gradient(135deg, #fb7ba2, #fce043);
            color: #000;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            font-weight: bold;
        }
        .command {
            background: #333;
            color: #0f0;
            padding: 5px 10px;
            border-radius: 4px;
            font-family: monospace;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="xampp-box">
        <h2 class="text-gold text-center mb-4">
            <img src="https://www.apachefriends.org/images/xampp-logo.svg" height="40" alt="XAMPP" style="margin-right: 10px;">
            Installation LM Universe avec XAMPP
        </h2>
        
        <div class="xampp-tip">
            💡 <strong>XAMPP Ubuntu :</strong> Vos fichiers doivent être dans <code>/opt/lampp/htdocs/</code>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-warning">⚙️ Étape 1 : Commandes XAMPP</h5>
                <div class="terminal mb-3">
# Démarrer XAMPP<br>
sudo /opt/lampp/lampp start<br><br>
# Arrêter XAMPP<br>
sudo /opt/lampp/lampp stop<br><br>
# Vérifier le statut<br>
sudo /opt/lampp/lampp status<br><br>
# Redémarrer<br>
sudo /opt/lampp/lampp restart
                </div>
                
                <h5 class="text-warning">📁 Étape 2 : Placer les fichiers</h5>
                <div class="terminal mb-3">
# Copier votre projet dans htdocs<br>
sudo cp -r ~/lm_universe /opt/lampp/htdocs/<br><br>
# Donner les permissions<br>
sudo chown -R $USER:www-data /opt/lampp/htdocs/lm_universe/<br>
sudo chmod -R 775 /opt/lampp/htdocs/lm_universe/
                </div>
            </div>
            
            <div class="col-md-6">
                <h5 class="text-warning">🗄️ Étape 3 : Base de données</h5>
                <div class="terminal mb-3">
# Se connecter à MySQL XAMPP<br>
/opt/lampp/bin/mysql -u root<br><br>
-- Dans MySQL :<br>
CREATE DATABASE IF NOT EXISTS lm_universe;<br>
USE lm_universe;<br><br>
CREATE TABLE users (<br>
    id INT AUTO_INCREMENT PRIMARY KEY,<br>
    pseudo VARCHAR(50) UNIQUE NOT NULL,<br>
    username VARCHAR(50) UNIQUE NOT NULL,<br>
    password VARCHAR(255) NOT NULL,<br>
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP<br>
);
                </div>
                
                <h5 class="text-warning">🔗 Étape 4 : Accès</h5>
                <div class="terminal mb-3">
# Interface web :<br>
• <a href="http://localhost/phpmyadmin" style="color: #0f0;">phpMyAdmin</a><br>
• <a href="http://localhost/lm_universe/" style="color: #0f0;">Votre application</a><br><br>
# Ports XAMPP :<br>
• Apache : 80<br>
• MySQL : 3306<br>
• phpMyAdmin : 80
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <h5 class="text-warning">🚀 Test rapide</h5>
            <button onclick="testXampp()" class="btn btn-warning mb-3">Tester la configuration XAMPP</button>
            <div id="xamppTest" class="terminal"></div>
        </div>
        
        <div class="mt-4">
            <h5 class="text-warning">📝 Script de configuration rapide</h5>
            <p>Créez ce script <code>setup_xampp.sh</code> :</p>
            <div class="terminal">
#!/bin/bash<br>
echo "🚀 Démarrage XAMPP..."<br>
sudo /opt/lampp/lampp start<br><br>
echo "📁 Configuration permissions..."<br>
sudo chmod 777 /opt/lampp/htdocs/<br>
sudo chown -R $USER:www-data /opt/lampp/htdocs/lm_universe<br><br>
echo "🗄️ Création base de données..."<br>
/opt/lampp/bin/mysql -u root &lt;&lt;SQL<br>
CREATE DATABASE IF NOT EXISTS lm_universe;<br>
USE lm_universe;<br>
CREATE TABLE IF NOT EXISTS users (<br>
    id INT AUTO_INCREMENT PRIMARY KEY,<br>
    pseudo VARCHAR(50) UNIQUE NOT NULL,<br>
    username VARCHAR(50) UNIQUE NOT NULL,<br>
    password VARCHAR(255) NOT NULL,<br>
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP<br>
);<br>
INSERT IGNORE INTO users (pseudo, username, password) VALUES <br>
('SkyPilot', 'pilote1', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),<br>
('SpaceRacer', 'pilote2', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');<br>
SQL<br><br>
echo "✅ Terminé! Accédez à: http://localhost/lm_universe/"
            </div>
        </div>
        
        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-success btn-lg">Accéder à l'application</a>
            <a href="http://localhost/phpmyadmin" target="_blank" class="btn btn-primary btn-lg">Ouvrir phpMyAdmin</a>
        </div>
    </div>

    <script>
    function testXampp() {
        fetch('test_xampp.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('xamppTest').innerHTML = data;
            })
            .catch(error => {
                document.getElementById('xamppTest').innerHTML = '❌ Erreur: ' + error;
            });
    }
    </script>
</body>
</html>