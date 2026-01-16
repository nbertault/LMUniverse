<?php
// index.php
session_start();

// Si déjà connecté, redirige vers le dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion - LM Universe</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    min-height: 100vh;
    background: radial-gradient(circle at top, #0d0053, #000);
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-card {
    background: rgba(0,0,0,0.85);
    border-radius: 16px;
    box-shadow: 0 0 40px rgba(196,148,71,0.5);
    animation: fadeUp 0.8s ease;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.text-gold {
    color: #C49447;
}

.register-card {
    display: none;
}
</style>
</head>

<body>

<!-- Formulaire de CONNEXION -->
<div class="card login-card p-4 text-center text-light" style="width: 22rem;" id="loginForm">
    <h2 class="text-gold fw-bold">LM Universe</h2>
    <p class="text-secondary">Entrez dans le cockpit</p>

    <form action="login.php" method="POST">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" required>
            <label>Nom d'utilisateur</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            <label>Mot de passe</label>
        </div>

        <button type="submit" class="btn btn-warning w-100 fw-bold mb-2">
            DÉMARRER LE MOTEUR
        </button>
    </form>

    <button class="btn btn-outline-warning w-100 fw-bold" onclick="showRegister()">
        CRÉER UN COMPTE
    </button>
</div>

<!-- Formulaire d'INSCRIPTION -->
<div class="card login-card p-4 text-center text-light" style="width: 22rem;" id="registerForm">
    <h2 class="text-gold fw-bold">Inscription</h2>
    <p class="text-secondary">Devenez pilote</p>

    <form action="register.php" method="POST">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="register_pseudo" name="pseudo" placeholder="Pseudo de pilote" required>
            <label>Pseudo de pilote</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="register_username" name="username" placeholder="Nom d'utilisateur" required>
            <label>Nom d'utilisateur</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="register_password" name="password" placeholder="Mot de passe" required>
            <label>Mot de passe</label>
        </div>

        <button type="submit" class="btn btn-warning w-100 fw-bold mb-2">
            S'INSCRIRE
        </button>
    </form>

    <button class="btn btn-outline-light w-100 fw-bold" onclick="showLogin()">
        RETOUR
    </button>
</div>

<script>
function showRegister() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('registerForm').style.display = 'block';
}

function showLogin() {
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('loginForm').style.display = 'block';
}
</script>

</body>
</html>