let izena = document.getElementById('izena');
let mota = document.getElementsByName('bidaiamota')[0]; // Accede al primer select
let hasieradata = document.getElementById('hasieradata');
let amaieradata = document.getElementById('amaieradata');
let iraupena = document.getElementById('egunak');
let herrialdea = document.getElementsByName('herrialdea')[0]; // Accede al primer select
let deskribapena = document.getElementById('deskribapena');

document.getElementById('bidaiagorde').addEventListener("click", function (event) {
    event.preventDefault();

    if (izena.value === "" || mota.value === "" || hasieradata.value === "" || amaieradata.value === "" || herrialdea.value === "" || deskribapena.value === "") {
        alert("Datu guztiak bete behar dira");
        return;
    }

    if(izena.value.length < 3){
        alert('Izena motzegia da');
        return;
    }
    
    if(amaieradata.value < hasieradata.value){
        alert("Datak txarto daude");
       return;
    }   
   
   if(deskribapena.value.length < 5){
        alert('Deskribapena motzegia da');
        return;
    }

    document.getElementById('bidaiErregistroa').submit(); 
    
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

amaieradata.addEventListener('change', function() {
    let hasieradata = document.getElementById('hasieradata').value;
    let amaieradata = document.getElementById('amaieradata').value;
    
    hasieradata = new Date(hasieradata);
    amaieradata = new Date(amaieradata);

    let egunakKalkulatu = amaieradata - hasieradata;

    let egunak = egunakKalkulatu / (1000 * 60 * 60 * 24) + 1;

    let iraupena = document.getElementById('egunak');
    iraupena.value = egunak;
});

let atzera = document.getElementById('atzerabid');
atzera.addEventListener("click", function(){
    window.location.href = 'menuPrintzipala.php';
});