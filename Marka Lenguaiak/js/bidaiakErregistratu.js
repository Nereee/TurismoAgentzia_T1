let izena = document.getElementById('izena');
let mota = document.getElementsByName('bidaiamota')[0]; // Accede al primer select
let hasieradata = document.getElementById('hasieradata');
let amaieradata = document.getElementById('amaieradata');
let iraupena = document.getElementById('egunak');
let herrialdea = document.getElementsByName('herrialdea')[0]; // Accede al primer select
let deskribapena = document.getElementById('deskribapena');

document.getElementById('bidaiagorde').addEventListener("click", function (event) {
    event.preventDefault();
    
    let egunakValue = parseInt(iraupena.value);
    if (egunakValue <= 0) {
        alert("bidaiaren iraupenak egun batekoa izan behar du gutxienez");
        return;
    }
    
    // Obtener la referencia a la tabla y su cuerpo
    let taula = document.querySelector('table');
    let body = taula.tBodies[0]; 

    // Insertar una nueva fila en la tabla
    let lerroa = body.insertRow();
    
    // Insertar las celdas con los valores de los inputs
    let bidaia = lerroa.insertCell();
    bidaia.innerText = izena.value;

    let bidaiamota = lerroa.insertCell();
    bidaiamota.innerText = mota.value;

    let hasiera = lerroa.insertCell();
    hasiera.innerText = hasieradata.value;

    let amaiera = lerroa.insertCell();
    amaiera.innerText = amaieradata.value;

    let egunak = lerroa.insertCell();
    egunak.innerText = iraupena.value;

    let herrialde = lerroa.insertCell();
    herrialde.innerText = herrialdea.value;

    let deskribapen = lerroa.insertCell();
    deskribapen.innerText = deskribapena.value;
});
