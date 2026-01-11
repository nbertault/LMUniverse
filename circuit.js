const carousel = document.getElementById('carouselCircuit');
const title = document.getElementById('nomCircuit');
const description = document.getElementById('descCircuit');

// Initialisation
title.textContent = data[0].nomCircuit;
description.textContent = data[0].descCircuit;

document.getElementById('annee').textContent = new Date().getFullYear();

carousel.addEventListener('slid.bs.carousel', function (event) {
    const index = event.to; // index du slide actif (Bootstrap 5)
    title.textContent = data[index].nomCircuit;
    description.textContent = data[index].descCircuit;
});