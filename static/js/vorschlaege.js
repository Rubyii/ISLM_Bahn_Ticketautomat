function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/

    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        let a, b, i, val = this.value;
        let suggestedGroupByLetter = [];
        let suggestedGroupByLetterFive = [];

        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}

        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");

        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);

        console.log(arr);

        //Speichert Alle Bahnhoefe nach Anfangsbuchstaben, wenn eine Eingabe geschieht
        for (i = 0; i < arr.length; i++) {
            arr.forEach(function(){
                    if (arr[i].substring(0, val.length).toUpperCase() === val.toUpperCase()){
                        if (!suggestedGroupByLetter.includes(arr[i])){
                            suggestedGroupByLetter.push(arr[i]);
                        }
                    }
                });
        }

        suggestedGroupByLetterFive = suggestedGroupByLetter.slice(0,5);

        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substring(0, val.length).toUpperCase() !== val.toUpperCase()) {
                continue;
            }

            console.log(suggestedGroupByLetter);
            console.log(suggestedGroupByLetterFive);

            if (suggestedGroupByLetterFive.includes(arr[i])){
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substring(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substring(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;

                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }

        }
    });

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        let x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt !== x[i] && elmnt !== inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });

}

/*Array mit allen Bahnhoefen:*/
let ziele = ["Aachen Hauptbahnhof", "Aachen RotheErde",
             "Berlin Hauptbahnhof", "Bonn Hauptbahnhof",
             "Dortmund Hauptbahnhof", "Duisburg Hauptbahnhof", "Düsseldorf Hauptbahnhof", "Düren",
             "Essen Hauptbahnhof",
             "Frankfurt am Main Hauptbahnhof",
             "Hamburg Hauptbahnhof",
             "Köln Hauptbahnhof", "Köln Ehrenfeld", "Köln Messe/Deutz", "Köln/Bonn Flughafen", "Köln-Mülheim", "Köln Süd",
             "München Hauptbahnhof"];


/*initiate the autocomplete function on the "ziel" element, and pass along the ziele array as possible autocomplete values:*/
autocomplete(document.getElementById("ziel"), ziele);

