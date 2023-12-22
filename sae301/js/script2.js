// JavaScript code for 'script2.js'
function toggleMenu() {
    var menu = document.querySelector('.hamburger-menu');
    menu.classList.toggle('active');
}

document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner tous les éléments avec la classe 'billet'
    var billets = document.querySelectorAll('.billet');

    // Fonction pour ajouter la rotation 3D
    function addEffects() {
        this.style.transform = 'rotateY(30deg)';  // Angle de rotation réduit
        
    }

    // Fonction pour retirer la rotation 3D
    function removeEffects() {
        this.style.transform = 'rotateY(0deg)';
    }

    // Ajouter des écouteurs d'événements à chaque 'billet'
    billets.forEach(function(billet) {
        billet.addEventListener('mouseenter', addEffects);
        billet.addEventListener('mouseleave', removeEffects);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const burgerIcon = document.getElementById('burger-icon');
    const menuItems = document.getElementById('menu-items');

    burgerIcon.addEventListener('click', function () {
        menuItems.classList.toggle('show');
    });
});
