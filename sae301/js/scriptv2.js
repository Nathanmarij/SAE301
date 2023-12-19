let slideIndex = 0;
let imgMax;

function showSlides() {
    let slides = document.getElementsByClassName("carousel-images")[0];
    imgMax = slides.children.length;

    // Calcul pour centrer l'image avec le déplacement nécessaire
    let translateValue = -slideIndex * 100; // Chaque image prend 100% de la largeur

    // Appliquer la translation pour centrer l'image active
    slides.style.transform = `translateX(${translateValue}%)`;

    // Réinitialisation des classes active pour les dots
    let dots = document.getElementsByClassName("dot");
    Array.from(dots).forEach(dot => dot.className = dot.className.replace(" active", ""));
    if (dots[slideIndex]) {
        dots[slideIndex].className += " active";
    }
}

function moveSlides(n) {
    slideIndex = (slideIndex + n + imgMax) % imgMax;
    showSlides();
}

// Initialisation du carrousel
document.addEventListener("DOMContentLoaded", () => {
    showSlides();
});
