let slideIndex = 0;
let time;
let imgMax;

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("carousel-images")[0].getElementsByTagName("img");
    let dots = document.getElementsByClassName("dot");
    imgMax = slides.length;
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1
    }    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    time = setTimeout(showSlides, 3000);
}

function currentSlide(n) {
    slideIndex = n - 1;
    clearTimeout(time);
    showSlides();
}

function next() {
    if (slideIndex > imgMax) {
        slideIndex = 1
    }
    clearTimeout(time);
    showSlides();
}

function previous() {
    slideIndex = slideIndex - 1;
    if (slideIndex <= 0) {
        slideIndex = imgMax;
    }
    slideIndex = slideIndex - 1;
    clearTimeout(time);
    showSlides();
}

addEventListener("DOMContentLoaded", (event) => {
    showSlides(1);
});