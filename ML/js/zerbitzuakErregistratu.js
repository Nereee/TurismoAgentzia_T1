/*AUKERATUTAKO BIDAIAREN ID*/
let bidaia = document.getElementById('bidaia');

/*OSTATUA*/
let ostatuizena = document.getElementById('ostatuizena');
let ostatuhiria = document.getElementById('ostatuhiria');
let ostatuprezioa = document.getElementById('ostatuprezioa');
let ostatusarreraeguna = document.getElementById('ostatusarreraeguna');
let ostatuirteeraeguna = document.getElementById('ostatuirteeraeguna');
let logelamota = document.getElementById('logelamota');

/*BESTE BATZUK*/
let bestebatzukizena = document.getElementById('bestebatzukizena');
let bestebatzukdata = document.getElementById('bestebatzukdata');
let bestebatzukdeskribapena = document.getElementById('bestebatzukdeskribapena');
let bestebatzukprezioa = document.getElementById('bestebatzukprezioa');

function taulaGarbitu(idTaula) {
    let tabla = document.getElementById(idTaula);
    let tbody = tabla.getElementsByTagName('tbody')[0];
    tbody.innerHTML = '';
}

document.querySelectorAll('input[name="zeinzerbitzu"]').forEach(radio => {
    radio.addEventListener('change', function () {

        function gehitu_Ostatua_Taula() {
            let O_taula = document.getElementById('ostatuarenTaula');
            let O_body = O_taula.tBodies[0]; 
            
            let O_lerroa = O_body.insertRow();
            
            let hotelarenIzena = O_lerroa.insertCell();
            hotelarenIzena.innerText = ostatuizena.value;
            
            let hiria = O_lerroa.insertCell();
            hiria.innerText = ostatuhiria.value;
            
            let prezioa = O_lerroa.insertCell();
            prezioa.innerText = ostatuprezioa.value;
            
            let sarreraEguna = O_lerroa.insertCell();
            sarreraEguna.innerText = ostatusarreraeguna.value;
            
            let irteeraEguna = O_lerroa.insertCell();
            irteeraEguna.innerText = ostatuirteeraeguna.value;
            
            let logelaMota = O_lerroa.insertCell();
            logelaMota.innerText = logelamota.value;

            let O_lerroKant = O_taula.rows.length;
            if(O_lerroKant > 0){
                O_taula.style.display = 'block';
                document.getElementById('joanekoTaula').style.display = 'none';
                document.getElementById('etorrikoTaula').style.display = 'none';
                document.getElementById('besteBatzukTaula').style.display = 'none';
            }
        }

        function gehitu_BesteBatzuk_Taula() {
            let BB_taula = document.getElementById('besteBatzukTaula');
            let BB_body = BB_taula.tBodies[0]; 
            
            let BB_lerroa = BB_body.insertRow();
            
            let izena = BB_lerroa.insertCell();
            izena.innerText = bestebatzukizena.value;
            
            let data = BB_lerroa.insertCell();
            data.innerText = bestebatzukdata.value;
            
            let deskribapena = BB_lerroa.insertCell();
            deskribapena.innerText = bestebatzukdeskribapena.value;
            
            let prezioa = BB_lerroa.insertCell();
            prezioa.innerText = bestebatzukprezioa.value;
            
            let BB_lerroKant = BB_taula.rows.length;
            if(BB_lerroKant > 0){
                BB_taula.style.display = 'block';
                document.getElementById('joanekoTaula').style.display = 'none';
                document.getElementById('etorrikoTaula').style.display = 'none';
                document.getElementById('ostatuarenTaula').style.display = 'none';
            }
        }

        document.querySelectorAll('input[name="hegaldimota"]').forEach(radio => {
            radio.checked = false;
        });

        if (this.id === 'hegaldia') {
            document.getElementById('hegaldimota').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'none';
            document.getElementById('ostatuErregistroa').style.display = 'none';
            document.getElementById('bestebatzukErregistroa').style.display = 'none';
            document.getElementById('zerbitzuagorde').style.display = 'none';

            document.getElementById('ostatuarenTaula').style.display = 'none';
            document.getElementById('besteBatzukTaula').style.display = 'none';
        }
        if (this.id === 'ostatua') {
            document.getElementById('hegaldimota').style.display = 'none';
            document.getElementById('ostatuErregistroa').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'none';
            document.getElementById('bestebatzukErregistroa').style.display = 'none';
            document.getElementById('zerbitzuagorde').style.display = 'block';

            document.getElementById('etorrikoTaula').style.display = 'none';
            document.getElementById('joanekoTaula').style.display = 'none';
            document.getElementById('besteBatzukTaula').style.display = 'none';

            document.getElementById('zerbitzuagorde').addEventListener("click", function (event) {
                event.preventDefault();
                
                if (ostatuizena.value === "" || ostatuhiria.value === "" || ostatuprezioa.value === "" || ostatusarreraeguna.value === "" || ostatuirteeraeguna.value === "" || logelamota.value === "") {
                    alert("Datuak bidaltzeko, eremu guztiak bete behar dira.");
                    return;
                }

                if(bidaia.value === ""){
                    alert("Hegaldia gehitzeko, hegaldia esleitu nahi diozun bidaia aukeratu behar duzu.");
                    return;
                }

                if(ostatuizena.value.length < 3){
                    alert('Izena motzegia da.');
                    return;
                }

                let regex = /^\d+([,.]\d{1,2})?$/;
                if(!regex.test(ostatuprezioa.value)){
                    alert("Prezioak bi hamartarreko edo zenbaki oso bateko zenbakia izan behar du.");
                    return;
                }

                let sarreraeguna = new Date(ostatusarreraeguna.value);
                let uneko_data = new Date();
                if(sarreraeguna < uneko_data){
                    alert('Sarrera eguna ezin da izan oraingo data baino txikiagoa.');
                    return;
                }

                let irteeraeguna = new Date(ostatuirteeraeguna.value);
                if(irteeraeguna < sarreraeguna){
                    alert('Irteera eguna ezin da izan sarrera eguna baino txikiagoa.');
                    return;
                }
            
                document.getElementById('zerbitzuErregistroa').submit();

                taulaGarbitu('ostatuarenTaula');

                gehitu_Ostatua_Taula();

            });

        }
        if (this.id === 'bestebatzuk') {
            document.getElementById('hegaldimota').style.display = 'none';
            document.getElementById('bestebatzukErregistroa').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'none';
            document.getElementById('ostatuErregistroa').style.display = 'none';
            document.getElementById('zerbitzuagorde').style.display = 'block';

            document.getElementById('etorrikoTaula').style.display = 'none';
            document.getElementById('joanekoTaula').style.display = 'none';
            document.getElementById('ostatuarenTaula').style.display = 'none';

            document.getElementById('zerbitzuagorde').addEventListener("click", function (event) {
                event.preventDefault();
                
                if (bestebatzukizena.value === "" || bestebatzukdata.value === "" || bestebatzukdeskribapena.value === "" || bestebatzukprezioa.value === "") {
                    alert("Datuak bidaltzeko, eremu guztiak bete behar dira.");
                    return;
                }

                if(bidaia.value === ""){
                    alert("Hegaldia gehitzeko, hegaldia esleitu nahi diozun bidaia aukeratu behar duzu.");
                    return;
                }

                if(bestebatzukizena.value.length < 3){
                    alert('Izena motzegia da.');
                    return;
                }

                let zerbeguna = new Date(bestebatzukdata.value);
                let uneko_data = new Date();
                if(zerbeguna < uneko_data){
                    alert('Zerbitzua egingo den eguna ezin da izan oraingo data baino txikiagoa.');
                    return;
                }

                if(bestebatzukdeskribapena.value.length < 5){
                    alert('Deskribapena motzegia da.');
                    return;
                }

                let regex = /^\d+([,.]\d{1,2})?$/;
                if(!regex.test(bestebatzukprezioa.value)){
                    alert("Prezioak bi hamartarreko edo zenbaki oso bateko zenbakia izan behar du.");
                    return;
                }
            

                document.getElementById('zerbitzuErregistroa').submit();

                taulaGarbitu('besteBatzukTaula');
                
                gehitu_BesteBatzuk_Taula();

            });
            
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

        function gehitu_Joaneko_Taula() {
            let J_taula = document.getElementById('joanekoTaula');
            let J_body = J_taula.tBodies[0]; 
            
            let J_lerroa = J_body.insertRow();
            
            let jatorrizkoAireportua = J_lerroa.insertCell();
            jatorrizkoAireportua.innerText = joanekojatorriaireportua.value;
            
            let helmugakoAireportua = J_lerroa.insertCell();
            helmugakoAireportua.innerText = joanekohelmugaaireportua.value;
            
            let kodea = J_lerroa.insertCell();
            kodea.innerText = joanekokodea.value;
            
            let airelinea = J_lerroa.insertCell();
            airelinea.innerText = joanekoairelinea.value;
            
            let prezioa = J_lerroa.insertCell();
            prezioa.innerText = joanekoprezioa.value;
            
            let irteeraData = J_lerroa.insertCell();
            irteeraData.innerText = joanekodata.value;
            
            let irteeraOrdua = J_lerroa.insertCell();
            irteeraOrdua.innerText = joanekoordua.value;
        
            let iraupena = J_lerroa.insertCell();
            iraupena.innerText = joanekoiraupena.value;
        
            let J_lerroKant = J_taula.rows.length;
            if(J_lerroKant > 0){
                J_taula.style.display = 'block';
                document.getElementById('etorrikoTaula').style.display = 'none';
                document.getElementById('ostatuarenTaula').style.display = 'none';
                document.getElementById('besteBatzukTaula').style.display = 'none';
            }
        }

        function gehitu_Etorriko_Taula() {
            let E_taula = document.getElementById('etorrikoTaula');
            let E_body = E_taula.tBodies[0]; 
            
            let E_lerroa = E_body.insertRow();
            
            let E_kodea = E_lerroa.insertCell();
            E_kodea.innerText = etorrikokodea.value;
            
            let E_airelinea = E_lerroa.insertCell();
            E_airelinea.innerText = etorrikoairelinea.value;
            
            let E_data = E_lerroa.insertCell();
            E_data.innerText = etorrikodata.value;
            
            let E_ordua = E_lerroa.insertCell();
            E_ordua.innerText = etorrikoordua.value;
            
            let E_iraupena = E_lerroa.insertCell();
            E_iraupena.innerText = etorrikoiraupena.value;
        
            let E_lerroKant = E_taula.rows.length;
            if(E_lerroKant > 0){
                E_taula.style.display = 'block';
                document.getElementById('ostatuarenTaula').style.display = 'none';
                document.getElementById('besteBatzukTaula').style.display = 'none';
            }
        }

        if(this.id === 'joanekoa'){
            document.getElementById('joanekoErregistroa').style.display = 'block';
            document.getElementById('etorrikoErregistroa').style.display = 'none';
            document.getElementById('zerbitzuagorde').style.display = 'block';
            document.getElementById('preziolabel').innerHTML = 'Prezioa (€)'

            document.getElementById('etorrikoTaula').style.display = 'none';
            document.getElementById('joanekoTaula').style.display = 'none';

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

                if(joanekokodea.value.length > 10){
                    alert("Joaneko hegaldiaren kodea luzegia da.");
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

                taulaGarbitu('joanekoTaula');
                taulaGarbitu('etorrikoTaula');

                gehitu_Joaneko_Taula();
                
            });
            
        }
        if(this.id === 'joanetorrikoa') {
            document.getElementById('etorrikoErregistroa').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'block';
            document.getElementById('zerbitzuagorde').style.display = 'block';
            document.getElementById('preziolabel').innerHTML = 'Prezio Totala (€)';

            document.getElementById('etorrikoTaula').style.display = 'none';
            document.getElementById('joanekoTaula').style.display = 'none';

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

                if(joanekokodea.value.length > 10){
                    alert("Joaneko hegaldiaren kodea luzegia da.");
                    return;
                }

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

                if(etorrikokodea.value.length > 10){
                    alert("Etorriko hegaldiaren kodea luzegia da.");
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
                
                taulaGarbitu('joanekoTaula');
                taulaGarbitu('etorrikoTaula');

                gehitu_Joaneko_Taula();
                gehitu_Etorriko_Taula();

            });

        }
    });
});

let atzera = document.getElementById('atzerazerb');
atzera.addEventListener("click", function(){
    window.location.href = 'menuPrintzipala.php';
});