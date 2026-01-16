<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "lmuniverse";
$user = "root";
$pass = "";

$pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
    $user,
    $pass
);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="Page de base pour un projet (circuit.html)" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css" />

    <title>Circuit</title>
</head>

<body>
    <!-- Barre de navigation -->
    <ul class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="accueil.html"><img src="img/LogoLMU.png" alt="Logo" style="width: 25px;"></a>
        <div class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="voitures.html"
                    role="button">Voitures</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="voitures.html#hypercar">HyperCars</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="voitures.html#lmp2">LMP2</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="voitures.html#lmp3">LMP3</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="voitures.html#lmgt3">LMGT3</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="circuit.html">Circuits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="records.html">Records</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.html">Connexion</a>
            </li>
        </div>
    </ul>

    <h1>Circuits</h1>

    <!-- Carousel Boostrap -->

    <main>
        <div id="carouselCircuit" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselCircuitIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselCircuitIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselCircuitIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselCircuitIndicators" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                </div>
                <div class="carousel-item active"> <video controls width="100%">
                        <source src="VideoLeMans.mp4" type="video/webm" />

                        <source src="VideoLeMans.mp4" type="video/mp4" />

                        Télécharger la vidéo
                        <a href="VideoLeMans.mp4">WEBM</a>
                        ou
                        <a href="VideoLeMans.mp4">MP4</a>
                        .
                    </video>
                </div>

                <div class="carousel-item">
                    <img src="img/Circuits/Imola.png" class="d-block w-100" alt="Imola">
                </div>

                <div class="carousel-item">
                    <img src="img/Circuits/Spa.png" class="d-block w-100" alt="Spa">
                </div>
                <div class="carousel-item">
                    <img src="img/Circuits/Portimao.png" class="d-block w-100" alt="Portimao">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCircuit" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselCircuit" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <?php
        // Récupère toutes les informations des circuits depuis la base de données
        $stmt = $pdo->query("SELECT * FROM circuit ORDER BY Indice ASC");
        $slide_texts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- Affichage de base au lancement de la page -->
        <div id="carouselText">
            <div class="container my-4">
                <div class="d-flex flex-column flex-md-row align-items-start">

                    <!-- Texte principal -->
                    <div class="flex-fill me-md-3">
                        <h2><strong><?php echo $slide_texts[0]['Nom']; ?></strong></h2>

                        <p><?php echo $slide_texts[0]['Description']; ?></p>
                    </div>

                    <!-- Boîte d’information à droite -->
                    <div class="d-flex flex-column gap mt-3 mt-md-0 w-100">
                        <div class="info-box p-3 mt-3 mt-md-0">
                            <h3><strong>Taille :</strong> <?php echo $slide_texts[0]['Taille']; ?> m</h3>
                        </div>
                        <div class="info-box p-3 mt-3 mt-md-0">
                            <h3><strong>Virages :</strong> <?php echo $slide_texts[0]['NbVirages']; ?></h3>
                        </div>
                        <div class="info-box p-3 mt-3 mt-md-0">
                            <h3><strong>Année :</strong> <?php echo $slide_texts[0]['Date']; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Pied de page -->
    <footer>
        <p>&copy; <span id="annee"></span> LM Universe <a href="#">Nous Contacter</a> <a
                href="https://www.instagram.com/lemansultimate/">Instagram</a> <a href="https://discord.gg/lemansultimate">Communauté</a></p>
    </footer>
    <script>
        const slideTexts = <?php echo json_encode($slide_texts); ?>;
    </script>
    <script src="circuit.js"></script>
</body>

</html>