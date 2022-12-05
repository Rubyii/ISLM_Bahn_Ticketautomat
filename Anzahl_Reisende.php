<?php
session_start();

foreach($_SESSION as $key => $value) {                                                 //TESTEN
    echo "<br> Session parameter '$key' has '$value' <br>";
}

if (!empty($_POST['navi-abbrechen'])) {
    session_unset();
    session_destroy();
    session_regenerate_id();
    header('Location: startseite.php'); // ZUR STARTSEITE HIER LEITEN
    exit();
}


if (isset($_SESSION['anzErwachsene']) && isset($_SESSION['anzSenioren']) && isset($_SESSION['anzErmaessigt']) && isset($_SESSION['anzKinder']))
{
    $count = $_SESSION['anzErwachsene'] + $_SESSION['anzSenioren'] + $_SESSION['anzErmaessigt'] + $_SESSION['anzKinder'];
    $_SESSION['count'] = $count;
}else {
    $_SESSION['anzErwachsene'] = 0;
    $_SESSION['anzSenioren'] = 0;
    $_SESSION['anzErmaessigt'] = 0;
    $_SESSION['anzKinder'] = 0;
    $_SESSION['klasse'] = "klasse2";
    $count = 0;
    $_SESSION['count'] = $count;
}


if (!empty($_POST['navi-zurück'])) {
    $_SESSION['anzErwachsene'] = (int) $_POST['anz_erwachsene'];
    $_SESSION['anzSenioren'] = (int) $_POST['anz_senioren'];
    $_SESSION['anzErmaessigt'] = (int) $_POST['anz_ermaessigt'];
    $_SESSION['anzKinder'] = (int) $_POST['anz_kinder'];
    $_SESSION['zurück'] = true;
    $_SESSION['klasse'] = $_POST['klasse'];

    if (isset($_SESSION['tarif'])){
        unset($_SESSION['start']);
        unset($_SESSION['ziel']);
    }elseif(isset($_SESSION['start']) && isset($_SESSION['ziel'])){
        unset($_SESSION['tarif']);
    }

    header('Location: startseite.php'); // ZUR VORHERIGEN SEITE HIER LEITEN
    exit();
}

if (!empty($_POST['navi-weiter'])) {
    $_SESSION['anzErwachsene'] = (int) $_POST['anz_erwachsene'];
    $_SESSION['anzSenioren'] = (int) $_POST['anz_senioren'];
    $_SESSION['anzErmaessigt'] = (int) $_POST['anz_ermaessigt'];
    $_SESSION['anzKinder'] = (int) $_POST['anz_kinder'];
    $_SESSION['zurück'] = true;
    $_SESSION['klasse'] = $_POST['klasse'];

    if (isset($_SESSION['ziel']))
    {
        header('Location: tarif.php'); // ZUR NACHFOLGENDEN SEITE HIER LEITEN
    }else{
        header('Location: uebersicht.php'); // ZUR NACHFOLGENDEN SEITE HIER LEITEN
    }

    exit();
}

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Anzahl Reisende</title>
    <link rel="stylesheet" href="static/css/index.css">
    <script src="static/js/anzReisende.js"></script>
</head>
<body>

<form method="post" action="Anzahl_Reisende.php">
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

    <div  class="rechteck" style="top:125px;right:0px;"></div>
    <div  class="dreieckleft"style="top:124px;right:0px;transform: scaleY(-1);"></div>
    <div  class="dreieckright"style="top:124px;right:0px;transform: scaleY(-1);"></div>

    <!--Flügel rechts-->
    <div  class="rechteck" style="margin-top: 150px; background-color:#ed8c08;top:125px;right:0px;"></div>
    <div  class="dreieckleft" style="margin-top: 150px;top:124px;right:0px;transform: scaleY(-1);"></div>
    <div  class="dreieckright"style="margin-top: 150px;top:124px;right:0px;transform: scaleY(-1);"></div>

    <div  class="rechteck" style="margin-top: 300px;top:125px;right:0px;" ></div>
    <div  class="dreieckleft" style="margin-top: 300px;top:124px;right:0px;transform: scaleY(-1);"></div>
    <div  class="dreieckright" style="margin-top: 300px;top:124px;right:0px;transform: scaleY(-1);"></div>


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
                Bitte geben Sie die Anzahl der Reisenden an
            </div>
        </div>

        <div class="hauptfunktion">
            <div class="hauptfunktion-innen">

                <div class="main-grid">
                    <div>
                        <label >Erwachsene</label>
                    </div>
                    <div>
                        <input type="button" <?php
                        if($_SESSION['anzErwachsene'] == 0)  {echo 'disabled';} ?> id="minus_erwachsene" class="button-orange" value="-" onclick="decrement(this)">
                    </div>
                    <div>
                        <input type="number" name="anz_erwachsene" id="anz_Erwachsene" value= <?php if (!empty($_SESSION['anzErwachsene'])) {echo $_SESSION['anzErwachsene'];} else {echo 0;} ?> style="pointer-events: none">
                    </div>
                    <div>
                        <input type="button" <?php if($count == 10) {echo 'disabled';} ?> id="plus_erwachsene" class="button-gruen" value="+" onclick="increment(this)">
                    </div>


                    <div>
                        <label >Senioren</label>
                    </div>
                    <div>
                        <input type="button" <?php if($_SESSION['anzSenioren'] == 0) {echo 'disabled ';} ?> id="minus_senioren" class="button-orange" value="-" onclick="decrement(this)">
                    </div>
                    <div>
                        <input type="number" name="anz_senioren" id="anz_senioren" value= <?php if (!empty($_SESSION['anzSenioren'])) {echo $_SESSION['anzSenioren'];} else {echo 0;} ?> style="pointer-events: none">
                    </div>
                    <div>
                        <input type="button" <?php if($count == 10) {echo 'disabled';} ?> id="plus_senioren" class="button-gruen" value="+" onclick="increment(this)">
                    </div>

                    <div>
                        <label>Ermäßigt</label>
                    </div>
                    <div>
                        <input type="button" <?php if($_SESSION['anzErmaessigt'] == 0) {echo 'disabled ';} ?> id="minus_ermaessigt" class="button-orange" value="-" onclick="decrement(this)">
                    </div>
                    <div>
                        <input type="number" name="anz_ermaessigt" id="anz_ermaessigt" value= <?php if (!empty($_SESSION['anzErmaessigt'])) {echo $_SESSION['anzErmaessigt'];} else {echo 0;} ?> style="pointer-events: none">

                    </div>
                    <div>
                        <input type="button" <?php if($count == 10) {echo 'disabled';} ?> id="plus_ermaessigt" class="button-gruen" value="+" onclick="increment(this)">
                    </div>

                    <div>
                        <label>Kinder</label>
                    </div>
                    <div>
                        <input type="button" <?php if($_SESSION['anzKinder'] == 0) {echo 'disabled ';} ?> id="minus_kinder" class="button-orange" value="-" onclick="decrement(this)">
                    </div>
                    <div>
                        <input type="number" name="anz_kinder" id="anz_kinder" value= <?php if (!empty($_SESSION['anzKinder'])) {echo $_SESSION['anzKinder'];} else {echo 0;} ?> style="pointer-events: none">
                    </div>
                    <div>
                        <input type="button" <?php if($count == 10) {echo 'disabled';} ?> id="plus_kinder" class="button-gruen" value="+" onclick="increment(this)">
                    </div>




                    <div>

                        <input type="radio"  name = "klasse" class="radio-btn " value="klasse2" id="klasse2" onclick="klasse(this)" <?php if($_SESSION['klasse'] == 'klasse2') {echo 'checked';} else if (empty($_SESSION['klasse'])) {echo 'checked';} ?>>
                        <label for="klasse2" class="wagenklasse" id="klassen">2.Klasse</label>

                        <input type="radio"  name = "klasse" class="radio-btn " value="klasse1" id="klasse1" onclick="klasse(this)" <?php if($_SESSION['klasse'] == 'klasse1') {echo 'checked';} ?>>
                        <label for="klasse1" class="wagenklasse2" id="klassen">1.Klasse</label>

                    </div>

                </div>

            </div>
        </div>

        <div class="navigation">
            <div class="navigation-innen">
                <div class="button-form">
                    <div class="empty-space"> </div>
                    <input type="submit" class="button-orangeN navi-abbrechen" name="navi-abbrechen" value="Abbrechen">
                    <input type="submit" class="button-orangeN navi-schritt" name="navi-zurück" value="Zurück">
                    <input type="submit" class="button-gruenW navi-schritt" name="navi-weiter" value="Weiter" id="weiter" <?php if($count == 0) {echo 'disabled';} ?>>
                </div>
            </div>
        </div>


    </div>


</form>
</body>
<script src="static/js/zeit.js"></script>
</html>