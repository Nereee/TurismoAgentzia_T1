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

document.querySelectorAll('input[name="hegaldimota"]').forEach(radio => {
    radio.addEventListener('change', function () {

        if(this.id === 'joanekoa'){
            document.getElementById('joanekoErregistroa').style.display = 'block';
            document.getElementById('etorrikoErregistroa').style.display = 'none';
            document.getElementById('zerbitzuagorde').style.display = 'block';
            document.getElementById('preziolabel').innerHTML = 'Prezioa (€)'

            
            
        }
        if(this.id === 'joanetorrikoa') {
            document.getElementById('etorrikoErregistroa').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'block';
            document.getElementById('zerbitzuagorde').style.display = 'block';
            document.getElementById('preziolabel').innerHTML = 'Prezio Totala (€)'
        }
    });
});

let atzera = document.getElementById('atzerazerb');
atzera.addEventListener("click", function(){
    window.location.href = 'menuPrintzipala.php';
});