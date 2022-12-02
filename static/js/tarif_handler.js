


const radioButtons = document.querySelectorAll('input[name="tarif"]');
for(const radioButton of radioButtons){
    if (radioButton.checked){
        document.getElementById("weiter").classList.remove('button-disabled');
        document.getElementById("weiter").classList.add('weiter_btn');
        document.getElementById("weiter").disabled = false;
        //break;
    }
    radioButton.addEventListener('change', showSelected);
}

function showSelected() {
    if (this.checked) {
        document.getElementById("weiter").classList.remove('button-disabled');
        document.getElementById("weiter").classList.add('weiter_btn');
        document.getElementById("weiter").disabled = false;
    }
}

