



function decrement(value) {

    var anzErwachsene = parseInt(document.getElementById('anz_Erwachsene').value);
    var anzSenioren = parseInt(document.getElementById('anz_senioren').value);
    var anzErmaessigt = parseInt(document.getElementById('anz_ermaessigt').value);
    var anzKinder = parseInt(document.getElementById('anz_kinder').value);

    if (value.id === "minus_erwachsene" && anzErwachsene > 0 && value.disabled === false) {
        anzErwachsene--;
        const z = Array.from(document.getElementsByClassName('button-gruen'));
        z.forEach( element => {
                element.disabled = false;
            }

        )
        document.getElementById('plus_erwachsene').disabled = false;
        document.getElementById('anz_Erwachsene').value = anzErwachsene;
        if (anzErwachsene === 0) {
            value.disabled = true;
        }

    }
    else if (value.id === "minus_senioren" && anzSenioren > 0 && value.disabled === false) {
        anzSenioren--;
        const z = Array.from(document.getElementsByClassName('button-gruen'));
        z.forEach( element => {
                element.disabled = false;
            }

        )
        document.getElementById('plus_senioren').disabled = false;
        document.getElementById('anz_senioren').value = anzSenioren;
        if (anzSenioren === 0) {
            value.disabled = true;
        }

    }
    else if (value.id === "minus_ermaessigt" && anzErmaessigt > 0 && value.disabled === false) {
        anzErmaessigt--;
        const z = Array.from(document.getElementsByClassName('button-gruen'));
        z.forEach( element => {
                element.disabled = false;
            }

        )
        document.getElementById('plus_ermaessigt').disabled = false;
        document.getElementById('anz_ermaessigt').value = anzErmaessigt;
        if (anzErmaessigt === 0) {
            value.disabled = true;
        }

    }
    else if (value.id === "minus_kinder" && anzKinder > 0 && value.disabled === false) {
        anzKinder--;
        const z = Array.from(document.getElementsByClassName('button-gruen'));
        z.forEach( element => {
                element.disabled = false;
            }

        )
        document.getElementById('plus_kinder').disabled = false;
        document.getElementById('anz_kinder').value = anzKinder;
        if (anzKinder === 0) {
            value.disabled = true;
        }

    }

    const z = Array.from(document.getElementsByClassName('button-orange'));
    let activate = false;
    z.forEach( element => {
            if (element.disabled !== true) {
                activate = true;
            }
        }

    )
    if (activate && (document.getElementById('klasse1').checked === true ||document.getElementById('klasse2').checked === true)) {
        document.getElementById('weiter').disabled = false;
    }
    else {
        document.getElementById('weiter').disabled = true;
    }

}

function increment(value) {
    var anzErwachsene = parseInt(document.getElementById('anz_Erwachsene').value);
    var anzSenioren = parseInt(document.getElementById('anz_senioren').value);
    var anzErmaessigt = parseInt(document.getElementById('anz_ermaessigt').value);
    var anzKinder = parseInt(document.getElementById('anz_kinder').value);

    if (value.id === 'plus_erwachsene' && anzErwachsene < 10 && value.disabled === false) {
        anzErwachsene++;
        document.getElementById('minus_erwachsene').disabled = false;
        document.getElementById('anz_Erwachsene').value = anzErwachsene;
        if (anzErwachsene + anzKinder + anzSenioren + anzErmaessigt === 10) {
            const z = Array.from(document.getElementsByClassName('button-gruen'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )

        }

    }
    else if (value.id === 'plus_senioren' && anzSenioren < 10 && value.disabled === false) {
        anzSenioren++;
        document.getElementById('minus_senioren').disabled = false;
        document.getElementById('anz_senioren').value = anzSenioren;
        if (anzErwachsene + anzKinder + anzSenioren + anzErmaessigt === 10) {
            const z = Array.from(document.getElementsByClassName('button-gruen'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )

        }

    }
    else if (value.id === 'plus_ermaessigt' && anzErmaessigt < 10 && value.disabled === false) {
        anzErmaessigt++;
        document.getElementById('minus_ermaessigt').disabled = false;
        document.getElementById('anz_ermaessigt').value = anzErmaessigt;
        if (anzErwachsene + anzKinder + anzSenioren + anzErmaessigt === 10) {
            const z = Array.from(document.getElementsByClassName('button-gruen'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )

        }

    }
    else if (value.id === 'plus_kinder' && anzKinder < 10 && value.disabled === false) {
        anzKinder++;
        document.getElementById('minus_kinder').disabled = false;
        document.getElementById('anz_kinder').value = anzKinder;
        if (anzErwachsene + anzKinder + anzSenioren + anzErmaessigt === 10) {
            const z = Array.from(document.getElementsByClassName('button-gruen'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )

        }

    }
    const z = Array.from(document.getElementsByClassName('button-orange'));
    let activate = false;
    z.forEach( element => {
            if (element.disabled !== true) {
                activate = true;
            }
        }

    )
    if (activate && (document.getElementById('klasse1').checked === true ||document.getElementById('klasse2').checked === true)) {
        document.getElementById('weiter').disabled = false;
    }
    else {
        document.getElementById('weiter').disabled = true;
    }

}


function klasse(value) {
    console.log("TEst");
    if (value.id === 'klasse1') {
        document.getElementById('klasse1').checked = true;
        document.getElementById('klasse2').checked = false;
    }
    else {
        document.getElementById('klasse2').checked = true;
        document.getElementById('klasse1').checked = false;
    }

}



