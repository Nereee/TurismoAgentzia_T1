let izena = document.getElementById('izena');
let mota = document.getElementsByName('bidaiamota')[0];
let hasieradata = document.getElementById('hasieradata');
let amaieradata = document.getElementById('amaieradata');
let iraupena = document.getElementById('egunak');
let herrialdea = document.getElementsByName('herrialdea')[0];
let deskribapena = document.getElementById('deskribapena');


document.getElementById('bidaiagorde').addEventListener("click", function (event) {
    event.preventDefault();
    
    if (izena.value === "" || mota.value === "" || hasieradata.value === "" || amaieradata.value === "" || herrialdea.value === "" || deskribapena.value === "") {
        alert("Datuak bidaltzeko, eremu guztiak bete behar dira, kanpoan geratzen diren zerbitzuak izan ezik, halakorik ez badago.");
        return;
    }
    
    if(izena.value.length < 3){
        alert('Izena motzegia da.');
        return;
    }
    
    let datahautatuta = new Date(hasieradata.value);
    let uneko_data = new Date();
    if(datahautatuta < uneko_data){
        alert('Hasiera data ezin da izan oraingo data baino txikiagoa.');
        return;
    }

    if(amaieradata.value < hasieradata.value){
        alert("Amaiera data ezin da hasiera data baino txikiagoa.");
        return;
    }
    
    if(deskribapena.value.length < 5){
        alert('Deskribapena motzegia da.');
        return;
    }

    document.getElementById('bidaiErregistroa').submit(); 
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

    if (isNaN(hasieradata.getTime()) || isNaN(amaieradata.getTime())) {
        iraupena.value = "";
    }
});

hasieradata.addEventListener('change', function() {
    let hasieradata = document.getElementById('hasieradata').value;
    let amaieradata = document.getElementById('amaieradata').value;
    
    hasieradata = new Date(hasieradata);
    amaieradata = new Date(amaieradata);

    let egunakKalkulatu = amaieradata - hasieradata;

    let egunak = egunakKalkulatu / (1000 * 60 * 60 * 24) + 1;

    let iraupena = document.getElementById('egunak');
    iraupena.value = egunak;

    if (isNaN(hasieradata.getTime()) || isNaN(amaieradata.getTime())) {
        iraupena.value = "";
    }
});

let atzera = document.getElementById('atzerabid');
atzera.addEventListener("click", function(){
    window.location.href = 'menuPrintzipala.php';
});