document.getElementById('annee').textContent = new Date().getFullYear();

const carousel = document.getElementById('carouselCircuit');
const textContainer = document.getElementById('carouselText');

carousel.addEventListener('slid.bs.carousel', function (event) {
    const index = event.to;
    const data = slideTexts[index];

    textContainer.innerHTML = `
        <div class="container my-4">
            <div class="d-flex flex-column flex-md-row align-items-start">

                <!-- Texte principal -->
                <div class="flex-fill me-md-3">
                    <h2><strong>${data.Nom}</strong></h2>
                    <p>${data.Description}</p>
                </div>

                <!-- Boîte d’information à droite -->
                <div class="d-flex flex-column gap-3 mt-3 mt-md-0 w-100">
                    <div class="info-box p-3 mt-3 mt-md-0">
                        <h3><strong>Taille :</strong> ${data.Taille} m</h3>
                    </div>
                    <div class="info-box p-3 mt-3 mt-md-0">
                        <h3><strong>Virages :</strong> ${data.NbVirages}</h3>
                    </div>
                    <div class="info-box p-3 mt-3 mt-md-0">
                        <h3><strong>Année :</strong> ${data.Date}</h3>
                    </div>
                </div>
            </div>
        </div>
    `;
});