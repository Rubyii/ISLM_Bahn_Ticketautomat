


function testProzent(value) {
    if (value < -100 || value > 100 || !Number.isFinite(parseInt(value.replace('%','')))) {
        document.getElementById('bestätigen').disabled = true;
        document.getElementById('bestätigen').style.background = '#FF0000';

        const form = document.getElementById('configuration');
        const formElemets = Array.from(form.getElementsByTagName('input'));

        formElemets.forEach(input => {if (input.value !=  value) {input.disabled = true}})



        formElemets.forEach(input => {
            if (input.value == value && (input.id == "erwachsene" || input.id == 'kinder' || input.id == 'senioren' || input.id == 'ermaessigt'))
            {
                document.getElementById('status-kunde').innerHTML = "Bitte geben Sie Werte zwischen -100% und 100% an";
            }
            else if(input.value == value && (input.id == 'kurz' || input.id == 'mittel' || input.id == 'lang')) {
                document.getElementById('dauer').innerHTML = "Bitte geben Sie Werte zwischen -100% und 100% an";
            }
            else if (input.value == value && (input.id == 'klasse1' ||input.id == 'klasse2')) {
                document.getElementById('klasse').innerHTML = "Bitte geben Sie Werte zwischen -100% und 100% an";
            }
        })
        formElemets.forEach(input => {console.log(input)})

        console.log("disabled "+value);
    }
    else if ((value >= -100 || value <= 100) && Number.isFinite(parseInt(value.replace('%','')))) {

        const form = document.getElementById('configuration');
        const formElemets = Array.from(form.getElementsByTagName('input'));
        formElemets.forEach(input => {if (input.value !=  value) {input.disabled = false}})

        document.getElementById('status-kunde').innerHTML = "";
        document.getElementById('dauer').innerHTML = "";
        document.getElementById('klasse').innerHTML = "";

        document.getElementById('bestätigen').disabled = false;
        document.getElementById('bestätigen').style.background = '#008000FF';


        console.log("enabled "+value);
    }



}

function testEuro(value) {
    if (value < 0 || !Number.isFinite(parseInt(value.replace('€','')))) {
        document.getElementById('bestätigen').disabled = true;
        document.getElementById('bestätigen').style.background = '#FF0000';

        const form = document.getElementById('configuration');
        const formElemets = Array.from(form.getElementsByTagName('input'));
        formElemets.forEach(input => {if (input.value !=  value) {input.disabled = true}})

        formElemets.forEach(input => {
            if (input.value == value && (input.id == "einzelticket"))
            {
                document.getElementById('einzelticketP').innerHTML = "Bitte geben Sie nur positive Werte ein";
            }
            else if (input.value == value && (input.id == "viererticket"))
            {
                document.getElementById('viererticketP').innerHTML = "Bitte geben Sie nur positive Werte ein";
            }
            else if (input.value == value && (input.id == "gruppenticket5"))
            {
                document.getElementById('gruppenticket5P').innerHTML = "Bitte geben Sie nur positive Werte ein";
            }
            else if (input.value == value && (input.id == "gruppenticket10"))
            {
                document.getElementById('gruppenticket10P').innerHTML = "Bitte geben Sie nur positive Werte ein";
            }
            else if (input.value == value && (input.id == "tagesticket"))
            {
                document.getElementById('tagesticketP').innerHTML = "Bitte geben Sie nur positive Werte ein";
            }
            else if (input.value == value && (input.id == "monatsticket"))
            {
                document.getElementById('monatsticketP').innerHTML = "Bitte geben Sie nur positive Werte ein";
            }
            else if (input.value == value && (input.id == "jahresticket"))
            {
                document.getElementById('jahresticketP').innerHTML = "Bitte geben Sie nur positive Werte ein";
            }

        })



        console.log("disabled "+value);
    }
    else if ((value >= 0 ) && Number.isFinite(parseInt(value.replace('€','')))) {
        document.getElementById('bestätigen').disabled = false;
        document.getElementById('bestätigen').style.background = '#008000FF';

        const form = document.getElementById('configuration');
        const formElemets = Array.from(form.getElementsByTagName('input'));
        formElemets.forEach(input => {if (input.value !=  value) {input.disabled = false}})

        document.getElementById('einzelticketP').innerHTML = "";
        document.getElementById('viererticketP').innerHTML = "";
        document.getElementById('gruppenticket5P').innerHTML = "";
        document.getElementById('gruppenticket10P').innerHTML = "";
        document.getElementById('tagesticketP').innerHTML = "";
        document.getElementById('monatsticketP').innerHTML = "";
        document.getElementById('jahresticketP').innerHTML = "";

        console.log("enabled "+value);
    }

}