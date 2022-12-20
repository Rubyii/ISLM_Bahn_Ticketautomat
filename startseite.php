<?php
session_start();
if ((!empty($_SESSION['anzErwachsene']) && $_SESSION['anzErwachsene'] > 0) || (!empty($_SESSION['anzKinder']) && $_SESSION['anzKinder'] > 0) || (!empty($_SESSION['anzErmaessigt']) && $_SESSION['anzErmaessigt'] > 0) ||(!empty($_SESSION['anzSenioren']) && $_SESSION['anzSenioren'] > 0) || $_SESSION['klasse'] == "klasse1" || ((!empty($_SESSION['tarif']) && ($_SESSION['tarif']) == "Einzelticket")) || ((!empty($_SESSION['tarif']) && ($_SESSION['tarif']) == "Viererticket")) || ((!empty($_SESSION['tarif']) && ($_SESSION['tarif']) == "5erGruppenticket")) || ((!empty($_SESSION['tarif']) && ($_SESSION['tarif']) == "10erGruppenticket"))) {
    $_SESSION['showinfo'] = true;
}
else if (empty($_SESSION['anzErwachsene']) || empty($_SESSION['anzKinder']) || empty($_SESSION['anzSenioren']) || empty($_SESSION['anzErmaessigt']) || ($_SESSION['anzErwachsene'] == 0 || $_SESSION['anzErmaessigt'] == 0 || $_SESSION['anzKinder'] == 0 || $_SESSION['anzSenioren'] == 0) && $_SESSION['klasse'] == "klasse2") {
    unset($_SESSION['showinfo']);
}
var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" href="static/css/startseite.css">
    <script async defer src="static/js/pageloader.js"></script>
    <script async defer src="static/js/vorschlaege.js"></script>
</head>
<body>
<!--Page Load-->

<div class="loadingscreen" id="loader-container" >
    <div class="loadingscreen" id="loader"></div>
    <div class="loadingscreen" id="loading-text">Lädt...</div>
</div>
<!--Page Load-->

<!--Flügel links-->
<div  class="rechteck"></div>
<div  class="dreieckleft"></div>
<div  class="dreieckright"></div>

<div  class="rechteck" style="margin-top: 150px; background-color:#ed8c08"></div>
<div  class="dreieckleft" style="margin-top: 150px"></div>
<div  class="dreieckright"style="margin-top: 150px"></div>

<div  class="rechteck" style="margin-top: 300px" ></div>
<div  class="dreieckleft" style="margin-top: 300px"></div>
<div  class="dreieckright" style="margin-top: 300px"></div>

<!--Flügel rechts-->
<div  class="rechteck" style="top:125px;right:0px;"></div>
<div  class="dreieckleft"style="top:124px;right:0px;transform: scaleY(-1);"></div>
<div  class="dreieckright"style="top:124px;right:0px;transform: scaleY(-1);"></div>

<div  class="rechteck" style="margin-top: 150px; background-color:#ed8c08;top:125px;right:0px;"></div>
<div  class="dreieckleft" style="margin-top: 150px;top:124px;right:0px;transform: scaleY(-1);"></div>
<div  class="dreieckright"style="margin-top: 150px;top:124px;right:0px;transform: scaleY(-1);"></div>

<div  class="rechteck" style="margin-top: 300px;top:125px;right:0px;" ></div>
<div  class="dreieckleft" style="margin-top: 300px;top:124px;right:0px;transform: scaleY(-1);"></div>
<div  class="dreieckright" style="margin-top: 300px;top:124px;right:0px;transform: scaleY(-1);"></div>


<?php if(isset($_SESSION['showinfo'])): ?>
<div class="info">
    <span class="infotext"> &#9432; Achtung! Sie befinden sich in einem laufenden Kaufprozess!</span>
</div>
<?php endif; ?>

<div class="grid-container">
    <div class="ueberschrift">
        <img alt="ISLM-Bahn" class="logo" src="static/images/ISLM_Logo2009.png">
        <div id="uhrzeitdatum" class="uhrzeitdatum">
            <div id="uhrzeit"></div>
            <div id="datum"></div>
        </div>
    </div>
    <div class="hinweistext">
        <div class="text">
            Bitte geben Sie Ihr Ziel ein
        </div>
    </div>

    <div class="hauptfunktion">
        <div class="hauptfunktion-innen">
            <form action="static/php/startseite_handler.php" method="post">
                <label for="start" class="label">Start</label>
                <input type="text" id="start" name = "start" value="Köln Hauptbahnhof" class="input" readonly>
                <br><br>
                <label for="ziel" class="label">Ziel</label>
                <div class="autocomplete" style="width:300px;">
                    <input list="ziele" id="ziel" placeholder="Ziel..." name = "ziel" class="input-ziel" autocomplete="off"
                        <?php if (isset($_SESSION['ziel'])){echo "value=".'"'.$_SESSION['ziel'].'"';}?>
                    >
                </div>
                <?php
                if(isset($_SESSION['error'])){
                    if ($_SESSION['error']){
                        echo "<p class='errormessage'> Die Eingabe ist nicht korrekt </p>";
                    }

                }
                ?>

                <br><br>
                <input type="submit" id="weiter" class="input" value="Weiter" name="weiter">
            </form>
        </div>
    </div>

    <div class="navigation">
        <div class="navigation-innen">
            <form action="static/php/startseite_handler.php" method="post" class="button-form">
                <input type="submit" class="button-gruen" name="tarif" value="Tages Ticket">
                <input type="submit" class="button-gruen" name="tarif" value="Monats Ticket">
                <input type="submit" class="button-gruen" name="tarif" value="Jahres Ticket">
            </form>
        </div>
    </div>
</div>
</body>
<script src="static/js/zeit.js"></script>
</html>
