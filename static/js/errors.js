


function testProzent(thisElement) {
    if (parseFloat(thisElement.value.replace('%','')) < -100 || parseFloat(thisElement.value.replace('%','')) > 100 || isNaN(thisElement.value.replace('%','')) ||  !Number.isFinite(parseFloat(thisElement.value.replace('%','')))) {
        document.getElementById('bestätigen').disabled = true;
        document.getElementById('bestätigen').style.background = '#FF0000';

        const form = document.getElementById('configuration');
        const formElemets = Array.from(form.getElementsByTagName('input'));

        formElemets.forEach(input => {if (input.id !=  thisElement.id) {input.disabled = true}})



        formElemets.forEach(input => {
            if (input.value == thisElement.value && (input.id == "erwachsene" || input.id == 'kinder' || input.id == 'senioren' || input.id == 'ermaessigt'))
            {
                document.getElementById('status-kunde').innerHTML = "Bitte geben Sie Werte zwischen -100% und 100% an";
            }
            else if(input.value == thisElement.value && (input.id == 'kurz' || input.id == 'mittel' || input.id == 'lang')) {
                document.getElementById('dauer').innerHTML = "Bitte geben Sie Werte zwischen -100% und 100% an";
            }
            else if (input.value == thisElement.value && (input.id == 'klasse1' ||input.id == 'klasse2')) {
                document.getElementById('klasse').innerHTML = "Bitte geben Sie Werte zwischen -100% und 100% an";
            }
        })



    }
    else if ((parseFloat(thisElement.value.replace('%','')) >= -100 && parseFloat(thisElement.value.replace('%','')) <= 100) && Number.isFinite(parseFloat(thisElement.value.replace('%',''))) && !isNaN(thisElement.value.replace('%',''))) {

        const form = document.getElementById('configuration');
        const formElemets = Array.from(form.getElementsByTagName('input'));
        formElemets.forEach(input => {if (input.id !=  thisElement.id) {input.disabled = false}})

        document.getElementById('status-kunde').innerHTML = "";
        document.getElementById('dauer').innerHTML = "";
        document.getElementById('klasse').innerHTML = "";

        document.getElementById('bestätigen').disabled = false;
        document.getElementById('bestätigen').style.background = '#008000FF';



    }



}

function testEuro(thisElement) {
    if (parseFloat(thisElement.value.replace('€','')) < 0 || parseFloat(thisElement.value.replace('€','')) > 99999 || isNaN(thisElement.value.replace('€','')) || !Number.isFinite(parseFloat(thisElement.value.replace('€','')))) {
        document.getElementById('bestätigen').disabled = true;
        document.getElementById('bestätigen').style.background = '#FF0000';

        const form = document.getElementById('configuration');
        const formElemets = Array.from(form.getElementsByTagName('input'));
        formElemets.forEach(input => {if (input.id !=  thisElement.id) {input.disabled = true}})

        formElemets.forEach(input => {
            if (input.value == thisElement.value && (input.id == "einzelticket"))
            {
                document.getElementById('einzelticketP').innerHTML = "Bitte geben Sie nur positive Werte und Werte kleiner 100.000€ ein";
            }
            else if (input.value == thisElement.value && (input.id == "viererticket"))
            {
                document.getElementById('viererticketP').innerHTML = "Bitte geben Sie nur positive Werte und Werte kleiner 100.000€ ein";
            }
            else if (input.value == thisElement.value && (input.id == "gruppenticket5"))
            {
                document.getElementById('gruppenticket5P').innerHTML = "Bitte geben Sie nur positive Werte und Werte kleiner 100.000€ ein";
            }
            else if (input.value == thisElement.value && (input.id == "gruppenticket10"))
            {
                document.getElementById('gruppenticket10P').innerHTML = "Bitte geben Sie nur positive Werte und Werte kleiner 100.000€ ein";
            }
            else if (input.value == thisElement.value && (input.id == "tagesticket"))
            {
                document.getElementById('tagesticketP').innerHTML = "Bitte geben Sie nur positive Werte und Werte kleiner 100.000€ ein";
            }
            else if (input.value == thisElement.value && (input.id == "monatsticket"))
            {
                document.getElementById('monatsticketP').innerHTML = "Bitte geben Sie nur positive Werte und Werte kleiner 100.000€ ein";
            }
            else if (input.value == thisElement.value && (input.id == "jahresticket"))
            {
                document.getElementById('jahresticketP').innerHTML = "Bitte geben Sie nur positive Werte und Werte kleiner 100.000€ ein";
            }

        })




    }
    else if ((parseFloat(thisElement.value.replace('€','')) >= 0 ) && (parseFloat(thisElement.value.replace('€','')) <= 99999 ) && Number.isFinite(parseFloat(thisElement.value.replace('€',''))) && !isNaN(thisElement.value.replace('€',''))) {
        document.getElementById('bestätigen').disabled = false;
        document.getElementById('bestätigen').style.background = '#008000FF';

        const form = document.getElementById('configuration');
        const formElemets = Array.from(form.getElementsByTagName('input'));
        formElemets.forEach(input => {if (input.id !=  thisElement.id) {input.disabled = false}})

        document.getElementById('einzelticketP').innerHTML = "";
        document.getElementById('viererticketP').innerHTML = "";
        document.getElementById('gruppenticket5P').innerHTML = "";
        document.getElementById('gruppenticket10P').innerHTML = "";
        document.getElementById('tagesticketP').innerHTML = "";
        document.getElementById('monatsticketP').innerHTML = "";
        document.getElementById('jahresticketP').innerHTML = "";

    }

}