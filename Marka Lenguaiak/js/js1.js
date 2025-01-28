 // script.js
 const images = [
    '../img/bidaiakReg1.jpg',
    '../img/bidaiakReg2.jpg',
    '../img/bidaiakReg3.jpg',
    '../img/bidaiakReg4.jpg'
    
];
const img1 = '../img/vuelo1.jpg';


let currentIndex = 0;

const carouselSlide = document.querySelector('.carousel-slide');

// Función para cambiar el fondo
function changeBackground1() {
    currentIndex = (currentIndex + 1) % images.length;
    carouselSlide.style.backgroundImage = `url('${images[currentIndex]}')`;
}


// Cambiar fondo cada 5 segundos
setInterval(changeBackground1, 5000);

 // script.js
 const images2 = [
    '../img/bidaiakReg1.jpg',
    '../img/bidaiakReg2.jpg',
    '../img/bidaiakReg3.jpg',
    '../img/bidaiakReg4.jpg'
    
];
const img2 = '../img/vuelo1.jpg';


let currentIndex2 = 0;

const carouselSlide2 = document.querySelector('.carousel-slide');

// Función para cambiar el fondo
function changeBackground1() {
    currentIndex = (currentIndex2 + 1) % images2.length;
    carouselSlide2.style.backgroundImage = `url('${images[currentIndex]}')`;
}


// Cambiar fondo cada 5 segundos
setInterval(changeBackground1, 5000);
