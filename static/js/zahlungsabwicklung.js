
function abbrechenVorgang(thisElement) {
    document.getElementById('grid-container').style = "filter: blur(3px)";
    document.getElementById('abbruch2').style.visibility = 'unset';
    const iframes = document.querySelectorAll('iframe');

    let rückgeld = parseFloat(document.getElementById('gesamt').value.replace(',','')) - parseFloat(document.getElementById('restbetrag').value.replace('€','').replace('.','').replace(',','.'));
    iframes[1].contentDocument.getElementById('rückgeld').innerHTML =  (rückgeld.toFixed(2) + '€').replace('.',',');
    const z = Array.from(document.getElementsByClassName('button-orange'));
    z.forEach( element => {
            element.disabled = true;
        }

    )

    if (thisElement.value === "Zurück") {
        iframes[1].contentDocument.getElementById('entnommen').name = "zurück";
    }

    let _100euroR = 0;
    let _50euroR = 0;
    let _20euroR = 0;
    let _10euroR = 0;
    let _5euroR = 0;
    let _2euroR = 0;
    let _1euroR = 0;
    let _50centR = 0;
    let _20centR = 0;
    let _10centR = 0;
    let _5centR = 0;
    let _2centR = 0;
    let _1centR = 0;

    while (rückgeld.toFixed(2) >= 0.01) {

        if (rückgeld.toFixed(2) >= 100) {
            _100euroR++;
            iframes[1].contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
            rückgeld -= 100;
            continue;
        }
        if (rückgeld.toFixed(2) >= 50) {
            _50euroR++;
            iframes[1].contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
            rückgeld -= 50;
            continue;
        }
        if (rückgeld.toFixed(2) >= 20) {
            _20euroR++;
            iframes[1].contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
            rückgeld -= 20;
            continue;
        }
        if (rückgeld.toFixed(2) >= 10) {
            _10euroR++;
            iframes[1].contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
            rückgeld -= 10;
            continue;
        }
        if (rückgeld.toFixed(2) >= 5) {
            _5euroR++;
            iframes[1].contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
            rückgeld -= 5;
            continue;
        }
        if (rückgeld.toFixed(2) >= 2) {
            _2euroR++;
            iframes[1].contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
            rückgeld -= 2;
            continue;
        }
        if (rückgeld.toFixed(2) >= 1) {
            _1euroR++;
            iframes[1].contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
            rückgeld -= 1;
            continue;
        }
        if (rückgeld.toFixed(2) >= 0.5) {
            _50centR++;
            iframes[1].contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
            rückgeld -= 0.5;
            continue;
        }
        if (rückgeld.toFixed(2) >= 0.2) {
            _20centR++;
            iframes[1].contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
            rückgeld -= 0.2;
            continue;
        }
        if (rückgeld.toFixed(2) >= 0.1) {
            _10centR++;
            iframes[1].contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
            rückgeld -= 0.1;
            continue;
        }
        if (rückgeld.toFixed(2) >= 0.05) {
            _5centR++;
            iframes[1].contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
            rückgeld -= 0.05;
            continue;
        }
        if (rückgeld.toFixed(2) >= 0.02) {
            _2centR++;
            iframes[1].contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
            rückgeld -= 0.02;
            continue;
        }
        if (rückgeld.toFixed(2) >= 0.01) {

            _1centR++;
            iframes[1].contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
            rückgeld -= 0.01;
            continue;
        }

    }



}

function getBack() {
    parent.window.location = "startseite.php";
    console.log("ADSADAS");
}




function buttonClicked(value){
    let restbetrag = parseFloat((document.getElementById('restbetrag').value).replace('€','').replace('.','').replace(',','.'));
    let inputCounter = parseInt((document.getElementById(value.name).value).replace('x',''));
    inputCounter++;
    document.getElementById(value.name).value = 'x'+inputCounter;

    let rest = 0;
    let isNegative = false;

    const iframes = document.querySelectorAll('iframe');



    var request = new XMLHttpRequest();
    request.open("GET", 'static/json/bestand.json', false);
    request.send(null)
    var my_JSON_object = JSON.parse(request.responseText);

    let bestand = my_JSON_object.bestand;


    if(value.name === "1cent") {
        if (restbetrag - 0.01 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 0.01;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            (document.getElementById('rest').value) = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ((rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }

            return;
        }
        restbetrag -= 0.01;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "2cent") {
        if (restbetrag - 0.02 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 0.02;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 0.02;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "5cent") {
        if (restbetrag - 0.05 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 0.05;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 0.05;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "10cent") {
        if (restbetrag - 0.1 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 0.1;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ((rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 0.10;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "20cent") {
        if (restbetrag - 0.2 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 0.2;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 0.20;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "50cent") {
        if (restbetrag - 0.5 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 0.5;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 0.50;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "1euro") {
        if (restbetrag - 1 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 1;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 1;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "2euro") {
        if (restbetrag - 2 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 2;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 2;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "5euro") {
        if (restbetrag - 5 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 5;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 5;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "10euro") {
        if (restbetrag - 10 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 10;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 10;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "20euro") {
        if (restbetrag - 20 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 20;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 20;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "50euro") {
        if (restbetrag - 50 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 50;

            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;
            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {
                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }
            return;
        }
        restbetrag -= 50;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    else  if(value.name === "100euro") {
        if (restbetrag - 100 <= 0) {
            document.getElementById('restbetrag').value = 0 + '€';
            isNegative = true;
            rest = restbetrag - 100;



            if (bestand + rest < 0) {
                document.getElementById('grid-container').style = "filter: blur(3px)";
                document.getElementById('abbruch3').style.visibility = 'unset';
                return;
            }
            bestand += rest;
            bestand += parseFloat(document.getElementById('gesamt').value.replace(',','')) + (rest * -1);

            iframes[0].contentDocument.getElementById('bestand').value = bestand;





            document.getElementById('grid-container').style = "filter: blur(3px)";
            document.getElementById('abbruch').style.visibility = 'unset';
            document.getElementById('rest').value = rest;
            document.querySelector('iframe').contentDocument.getElementById('wechselgeld').innerHTML = ( (rest * -1).toFixed(2) + '€').replace('.',',');
            const z = Array.from(document.getElementsByClassName('button-orange'));
            z.forEach( element => {
                    element.disabled = true;
                }

            )
            let _100euroR = 0;
            let _50euroR = 0;
            let _20euroR = 0;
            let _10euroR = 0;
            let _5euroR = 0;
            let _2euroR = 0;
            let _1euroR = 0;
            let _50centR = 0;
            let _20centR = 0;
            let _10centR = 0;
            let _5centR = 0;
            let _2centR = 0;
            let _1centR = 0;

            rest *= -1;
            while (rest.toFixed(2) > 0.001) {

                if (rest.toFixed(2) >= 100) {
                    _100euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('100euroR').innerHTML = "x" + _100euroR;
                    rest -= 100;
                    continue;
                }
                if (rest.toFixed(2) >= 50) {
                    _50euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('50euroR').innerHTML = "x" + _50euroR;
                    rest -= 50;
                    continue;
                }
                if (rest.toFixed(2) >= 20) {
                    _20euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('20euroR').innerHTML = "x" + _20euroR;
                    rest -= 20;
                    continue;
                }
                if (rest.toFixed(2) >= 10) {
                    _10euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('10euroR').innerHTML = "x" + _10euroR;
                    rest -= 10;
                    continue;
                }
                if (rest.toFixed(2) >= 5) {
                    _5euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('5euroR').innerHTML = "x" + _5euroR;
                    rest -= 5;
                    continue;
                }
                if (rest.toFixed(2) >= 2) {
                    _2euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('2euroR').innerHTML = "x" + _2euroR;
                    rest -= 2;
                    continue;
                }
                if (rest.toFixed(2) >= 1) {
                    _1euroR++;
                    document.querySelector('iframe').contentDocument.getElementById('1euroR').innerHTML = "x" + _1euroR;
                    rest -= 1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.5) {
                    _50centR++;
                    document.querySelector('iframe').contentDocument.getElementById('50centR').innerHTML = "x" + _50centR;
                    rest -= 0.5;
                    continue;
                }
                if (rest.toFixed(2) >= 0.2) {
                    _20centR++;
                    document.querySelector('iframe').contentDocument.getElementById('20centR').innerHTML = "x" + _20centR;
                    rest -= 0.2;
                    continue;
                }
                if (rest.toFixed(2) >= 0.1) {
                    _10centR++;
                    document.querySelector('iframe').contentDocument.getElementById('10centR').innerHTML = "x" + _10centR;
                    rest -= 0.1;
                    continue;
                }
                if (rest.toFixed(2) >= 0.05) {
                    _5centR++;
                    document.querySelector('iframe').contentDocument.getElementById('5centR').innerHTML = "x" + _5centR;
                    rest -= 0.05;
                    continue;
                }
                if (rest.toFixed(2) >= 0.02) {
                    _2centR++;
                    document.querySelector('iframe').contentDocument.getElementById('2centR').innerHTML = "x" + _2centR;
                    rest -= 0.02;
                    continue;
                }
                if (rest.toFixed(2) >= 0.01) {
                    _1centR++;
                    document.querySelector('iframe').contentDocument.getElementById('1centR').innerHTML = "x" + _1centR;
                    rest -= 0.01;
                    continue;
                }

            }

            return;
        }
        restbetrag -= 100;
        document.getElementById('restbetrag').value = ((restbetrag.toFixed(2) + '€').replace('.',',')).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

}

function wechselgeld() {
    console.log(document.getElementById('rest'))
}