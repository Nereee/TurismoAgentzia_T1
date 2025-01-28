function txertatu(){
    let taula = document.querySelector('table');
    let body = taula.tBodies[0];
    let lerroa = body.insertRow();
    let gelaxka1 = lerroa.insertCell();
    gelaxka1.innerText = '1 gelaxka';
    let gelaxka2 = lerroa.insertCell();
    gelaxka2.innerText = '2 gelaxka';
    let gelaxka3 = lerroa.insertCell();
    gelaxka3.innerText = '3 gelaxka';

}

function ezabatu(){
    document.querySelector('table').tBodies[0].deleteRow(-1);
}

document.getElementById('bidaiagorde').addEventListener("click", function (event) {
    let taula = document.querySelector('table');
    let body = taula.tBodies[0];
    let lerroa = body.insertRow();
    let gelaxka1 = lerroa.insertCell();
    gelaxka1.innerText = '1 gelaxka';
    let gelaxka2 = lerroa.insertCell();
    gelaxka2.innerText = '2 gelaxka';
    let gelaxka3 = lerroa.insertCell();
    gelaxka3.innerText = '3 gelaxka';
});