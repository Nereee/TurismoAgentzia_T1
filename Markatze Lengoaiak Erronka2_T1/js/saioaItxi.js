
let abrir_popup = document.getElementById('saioaitxi');
let overlay = document.getElementById('overlay');
let popup = document.getElementById('popup');
let cerrar_popup = document.getElementById('ezitxi');
let saioaitxi = document.getElementById('saioaitxipopup');


abrir_popup.addEventListener('click', function () {
    overlay.style.display = 'flex';
});

cerrar_popup.addEventListener('click', function(){
    overlay.style.display = 'none';
});

saioaitxi.addEventListener('click', function(){
    window.location.href = '../php/saioaItxi.php';
});