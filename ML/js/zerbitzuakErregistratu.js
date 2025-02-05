let bidaia = document.getElementById('bidaia');

document.querySelectorAll('input[name="zeinzerbitzu"]').forEach(radio => {
    radio.addEventListener('change', function () {

        document.querySelectorAll('input[name="hegaldimota"]').forEach(radio => {
            radio.checked = false;
        });

        if (this.id === 'hegaldia') {
            document.getElementById('hegaldimota').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'none';
            document.getElementById('ostatuErregistroa').style.display = 'none';
            document.getElementById('bestebatzukErregistroa').style.display = 'none';
            document.getElementById('zerbitzuagorde').style.display = 'none';
        }
        if (this.id === 'ostatua') {
            document.getElementById('hegaldimota').style.display = 'none';
            document.getElementById('ostatuErregistroa').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'none';
            document.getElementById('bestebatzukErregistroa').style.display = 'none';
            document.getElementById('zerbitzuagorde').style.display = 'block';
        }
        if (this.id === 'bestebatzuk') {
            document.getElementById('hegaldimota').style.display = 'none';
            document.getElementById('bestebatzukErregistroa').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'none';
            document.getElementById('ostatuErregistroa').style.display = 'none';
            document.getElementById('zerbitzuagorde').style.display = 'block';
        }
    });
});


/*JOANEKO HEGALDIA*/
let joanekojatorriaireportua = document.getElementById('joanekojatorriaireportua');
let joanekohelmugaaireportua = document.getElementById('joanekohelmugaaireportua');
let joanekokodea = document.getElementById('joanekokodea');
let joanekoairelinea = document.getElementById('joanekoairelinea');
let joanekoprezioa = document.getElementById('joanekoprezioa');
let joanekodata = document.getElementById('joanekodata');
let joanekoordua = document.getElementById('joanekoordua');
let joanekoiraupena = document.getElementById('joanekoiraupena');

/*ETORRIKO HEGALDIA*/
let etorrikokodea = document.getElementById('etorrikokodea');
let etorrikoairelinea = document.getElementById('etorrikoairelinea');
let etorrikodata = document.getElementById('etorrikodata');
let etorrikoordua = document.getElementById('etorrikoordua');
let etorrikoiraupena = document.getElementById('etorrikoiraupena');

document.querySelectorAll('input[name="hegaldimota"]').forEach(radio => {
    radio.addEventListener('change', function () {

        if(this.id === 'joanekoa'){
            document.getElementById('joanekoErregistroa').style.display = 'block';
            document.getElementById('etorrikoErregistroa').style.display = 'none';
            document.getElementById('zerbitzuagorde').style.display = 'block';
            document.getElementById('preziolabel').innerHTML = 'Prezioa (€)'

            document.getElementById('zerbitzuagorde').addEventListener("click", function (event) {
                event.preventDefault();
                
                if (joanekojatorriaireportua.value === "" || joanekohelmugaaireportua.value === "" || joanekokodea.value === "" || joanekoairelinea.value === "" || joanekoprezioa.value === "" || joanekodata.value === "" || joanekoordua.value === "" || joanekoiraupena.value === "") {
                    alert("Datuak bidaltzeko, eremu guztiak bete behar dira.");
                    return;
                }

                if(bidaia.value === ""){
                    alert("Hegaldia gehitzeko, hegaldia esleitu nahi diozun bidaia aukeratu behar duzu.");
                    return;
                }
                
                if(joanekojatorriaireportua.value === joanekohelmugaaireportua.value){
                    alert('Jatorrizko aireportua eta helmugako aireportua ezin dira berdinak izan.');
                    return;
                }
            
                if(joanekokodea.value.length < 4){
                    alert("Hegaldiaren kodea motzegia da.");
                    return;
                }

                let regex = /^\d+([,.]\d{1,2})?$/;
                if(!regex.test(joanekoprezioa.value)){
                    alert("Prezioak bi hamartarreko edo zenbaki oso bateko zenbakia izan behar du.");
                    return;
                }

                let datahautatuta = new Date(joanekodata.value);
                let uneko_data = new Date();
                if(datahautatuta < uneko_data){
                    alert('Joaneko data ezin da izan oraingo data baino txikiagoa.');
                    return;
                }
            
                document.getElementById('zerbitzuErregistroa').submit(); 
            });
            
        }
        if(this.id === 'joanetorrikoa') {
            document.getElementById('etorrikoErregistroa').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'block';
            document.getElementById('zerbitzuagorde').style.display = 'block';
            document.getElementById('preziolabel').innerHTML = 'Prezio Totala (€)'

            document.getElementById('zerbitzuagorde').addEventListener("click", function (event) {
                event.preventDefault();
                
                if (joanekojatorriaireportua.value === "" || joanekohelmugaaireportua.value === "" || joanekokodea.value === "" || joanekoairelinea.value === "" || joanekoprezioa.value === "" || joanekodata.value === "" || joanekoordua.value === "" || joanekoiraupena.value === "" ||
                     etorrikokodea.value === "" || etorrikoairelinea.value === "" || etorrikodata.value === "" || etorrikoordua.value === "" || etorrikoiraupena.value === "") {
                    alert("Datuak bidaltzeko, eremu guztiak bete behar dira.");
                    return;
                }
                
                /*JOANEKO HEGALDIA*/
                if(bidaia.value === ""){
                    alert("Hegaldia gehitzeko, hegaldia esleitu nahi diozun bidaia aukeratu behar duzu.");
                    return;
                }
                
                if(joanekojatorriaireportua.value === joanekohelmugaaireportua.value){
                    alert('Jatorrizko aireportua eta helmugako aireportua ezin dira berdinak izan.');
                    return;
                }
            
                if(joanekokodea.value.length < 4){
                    alert("Joaneko hegaldiaren kodea motzegia da.");
                    return;
                }

                let joanekokodeaValue = document.getElementById('joanekokodea').value;
                // Realizar la solicitud AJAX al servidor para verificar si el código de vuelo ya está registrado
                fetch('hegaldi_kodea_egiaztatu.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ joanekokodeaValue: joanekokodeaValue }) // Enviar el código de vuelo como JSON
                })
                .then(response => response.json())
                .then(data => {
                    if (data.errepikatuta) {
                        alert('Joaneko hegaldiaren kodea datu basean jada erregistratuta dago.');
                        return;
                    }
                })
                .catch(error => {
                    //console.error('Error al verificar el código de vuelo:', error);
                    alert('Errorea hegaldi-kodea egiaztatzean:', error);
                });



                let regex = /^\d+([,.]\d{1,2})?$/;
                if(!regex.test(joanekoprezioa.value)){
                    alert("Prezioak bi hamartarreko edo zenbaki oso bateko zenbakia izan behar du.");
                    return;
                }

                let joanekodatahautatuta = new Date(joanekodata.value);
                let uneko_data = new Date();
                if(joanekodatahautatuta < uneko_data){
                    alert('Joaneko data ezin da izan oraingo data baino txikiagoa.');
                    return;
                }


                /*ETORRIKO HEGALDIA*/
                if(etorrikokodea.value.length < 4){
                    alert("Etorriko hegaldiaren kodea motzegia da.");
                    return;
                }

                let etorrikodatahautatuta = new Date(etorrikodata.value);
                if(etorrikodatahautatuta < joanekodatahautatuta){
                    alert('Etorriko data ezin da izan joaneko data baino txikiagoa.');
                    return;
                }

                if(joanekokodea.value === etorrikokodea.value){
                    alert("Joaneko hegaldiaren kodea eta etorriko hegaldiaren kodea ezin dira berdinak izan.");
                    return;
                }

            
                document.getElementById('zerbitzuErregistroa').submit(); 
            });

        }
    });
});

let atzera = document.getElementById('atzerazerb');
atzera.addEventListener("click", function(){
    window.location.href = 'menuPrintzipala.php';
});