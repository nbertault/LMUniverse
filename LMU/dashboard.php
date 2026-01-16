<?php
// dashboard.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - LM Universe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top, #0d0053, #000);
            min-height: 100vh;
            color: white;
        }
        .text-gold { color: #C49447; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card bg-dark text-white p-4" style="max-width: 600px; margin: 0 auto;">
            <h1 class="text-gold">🚀 Bienvenue, <?php echo htmlspecialchars($_SESSION['pseudo']); ?>!</h1>
            <p>Vous êtes connecté en tant que <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
            
            <div class="mt-4">
                <h4 class="text-warning">Informations du pilote :</h4>
                <p>ID : <?php echo $_SESSION['user_id']; ?></p>
                <p>Pseudo : <?php echo htmlspecialchars($_SESSION['pseudo']); ?></p>
                <p>Session active</p>
            </div>
            
            <div class="mt-4">
                <a href="logout.php" class="btn btn-danger">Déconnexion</a>
                <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
            </div>
        </div>
    </div>
</body>
</html>