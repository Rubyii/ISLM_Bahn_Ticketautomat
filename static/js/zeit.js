let time = document.getElementById("uhrzeit");
let datum = document.getElementById("datum");
let d = new Date();

datum.innerHTML = d.toLocaleDateString();

setInterval(() =>{
    let d = new Date();
    let options = {hour: '2-digit', minute: '2-digit'}

    time.innerHTML = d.toLocaleTimeString([], options);

},1000)