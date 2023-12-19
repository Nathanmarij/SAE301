let slideIndex = 0;
let imgMax;
let slideInterval;

function showSlides() {
    let slides = document.getElementsByClassName("carousel-images")[0];
    imgMax = slides.children.length;

    // Calcul pour centrer l'image avec le déplacement nécessaire
    let translateValue = -slideIndex * 100; // Chaque image prend 100% de la largeur

    // Appliquer la translation pour centrer l'image active
    slides.style.transform = `translateX(${translateValue}%)`;

    // Réinitialisation des classes active pour les dots
    let dots = document.getElementsByClassName("dot");
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    if (dots[slideIndex]) {
        dots[slideIndex].className += " active";
    }

    clearInterval(slideInterval);
    slideInterval = setInterval(function() {
        moveSlides(1); // Change à la slide suivante
    }, 7000)
}

function currentSlide(n) {
    document.querySelector('.carousel-descr').style.opacity = 0;
    var textParagraphe = document.querySelector('.carousel-text');
    slideIndex = n;
    showSlides();
    setTimeout(function() {
        document.querySelector('.carousel-descr').style.opacity = 1; 
        if (n === 0) {
            textParagraphe.innerHTML = "Découvrez le concert caritatif Unicert 2024, un événement musical diversifié avec des stars de tous genres. Idéal pour tous les âges, cet événement promet des sensations uniques et mémorables !";
        }
        else if (n === 1) {
            textParagraphe.innerHTML = "Unicert 2024 offre un spectacle inoubliable avec des genres musicaux variés, chacun réalisés par des Youtubeurs, célébrant la diversité artistique dans une ambiance festive.";
        }
        else {
            textParagraphe.innerHTML = "Cet événement caritatif allie plaisir et altruisme, avec des fonds destinés à des causes humanitaires et environnementales, enrichi d'ateliers éducatifs et interactifs.";
        }
    }, 800); 
}

function moveSlides(n) {
    document.querySelector('.carousel-descr').style.opacity = 0;
    var textParagraphe = document.querySelector('.carousel-text');
        slideIndex = (slideIndex + n + imgMax) % imgMax;
        showSlides();
    setTimeout(function() {
        document.querySelector('.carousel-descr').style.opacity = 1; 
        if (slideIndex === 0) {
            textParagraphe.innerHTML = "Découvrez le concert caritatif Unicert 2024, un événement musical diversifié avec des stars de tous genres. Idéal pour tous les âges, cet événement promet des sensations uniques et mémorables !";
        }
        else if (slideIndex === 1) {
            textParagraphe.innerHTML = "Unicert 2024 offre un spectacle inoubliable avec des genres musicaux variés, chacun réalisés par des Youtubeurs, célébrant la diversité artistique dans une ambiance festive.";
        }
        else {
            textParagraphe.innerHTML = "Cet événement caritatif allie plaisir et altruisme, avec des fonds destinés à des causes humanitaires et environnementales, enrichi d'ateliers éducatifs et interactifs.";
        }
    }, 800);  
}

// Initialisation du carrousel
document.addEventListener("DOMContentLoaded", () => {
    showSlides();
});
