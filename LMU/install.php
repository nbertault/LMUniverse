<?php
// install.php - Script d'installation
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Installation - LM Universe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top, #0d0053, #000);
            min-height: 100vh;
            padding: 50px 0;
            color: white;
        }
        .install-box {
            background: rgba(0,0,0,0.85);
            border-radius: 16px;
            box-shadow: 0 0 40px rgba(196,148,71,0.5);
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
        }
        .text-gold { color: #C49447; }
    </style>
</head>
<body>
    <div class="install-box">
        <h2 class="text-gold text-center mb-4">🛠 Installation de LM Universe</h2>
        
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-warning">Étape 1 : Créer la base de données</h5>
                <ol>
                    <li>Ouvrez phpMyAdmin : <a href="http://localhost/phpmyadmin" target="_blank">http://localhost/phpmyadmin</a></li>
                    <li>Cliquez sur "Nouvelle base de données"</li>
                    <li>Nom : <code>lm_universe</code></li>
                    <li>Encodage : <code>utf8mb4_general_ci</code></li>
                    <li>Cliquez sur "Créer"</li>
                </ol>
            </div>
            
            <div class="col-md-6">
                <h5 class="text-warning">Étape 2 : Importer la structure</h5>
                <p>Copiez-collez ce SQL dans l'onglet SQL :</p>
                <textarea class="form-control bg-dark text-white" rows="10" readonly>
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Optionnel : utilisateur de test
INSERT INTO users (pseudo, username, password) VALUES 
('SkyPilot', 'pilote1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'), -- mot de passe : "password"
('SpaceRacer', 'pilote2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
                </textarea>
            </div>
        </div>
        
        <div class="mt-4">
            <h5 class="text-warning">Étape 3 : Tester la connexion</h5>
            <button onclick="testConnection()" class="btn btn-warning">Tester la connexion</button>
            <div id="testResult" class="mt-3"></div>
        </div>
        
        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-success">Accéder au site</a>
        </div>
    </div>

    <script>
    function testConnection() {
        fetch('test_connection.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('testResult').innerHTML = data;
            })
            .catch(error => {
                document.getElementById('testResult').innerHTML = 
                    '<div class="alert alert-danger">Erreur : ' + error + '</div>';
            });
    }
    </script>
</body>
</html>