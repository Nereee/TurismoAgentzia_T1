document.querySelectorAll('input[name="zeinzerbitzu"]').forEach(radio => {
    radio.addEventListener('change', function () {

        // Mostrar el div correspondiente según la opción seleccionada
        if (this.id === 'hegaldia') {
            document.getElementById('joanekoErregistroa').style.display = 'block';
            document.getElementById('ostatuErregistroa').style.display = 'none';
            document.getElementById('bestebatzukErregistroa').style.display = 'none';
        }
        if (this.id === 'ostatua') {
            document.getElementById('ostatuErregistroa').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'none';
            document.getElementById('bestebatzukErregistroa').style.display = 'none';
        }
        if (this.id === 'bestebatzuk') {
            document.getElementById('bestebatzukErregistroa').style.display = 'block';
            document.getElementById('joanekoErregistroa').style.display = 'none';
            document.getElementById('ostatuErregistroa').style.display = 'none';
        }
    });
});

document.querySelectorAll('input[name="hegaldimota"]').forEach(radio => {
    radio.addEventListener('change', function () {

        if(this.id === 'joanetorrikoa') {
            document.getElementById('joanetorrikoErregistroa').style.display = 'block';
        }
        if(this.id === 'joanekoa'){
            document.getElementById('joanetorrikoErregistroa').style.display = 'none';
        }
    });
});