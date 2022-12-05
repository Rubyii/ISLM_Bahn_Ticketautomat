<?php
session_start();


foreach($_SESSION as $key => $value) {                                                 //TESTEN
    echo "<br> Session parameter '$key' has '$value' <br>";
}

var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" href="static/css/tarif.css">
    <script async defer src="static/js/tarif_handler.js"></script>
</head>
<body>

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
            Bitte wählen sie einen Tarif aus
        </div>
    </div>

    <div class="hauptfunktion">
        <div class="hauptfunktion-innen">
            <form action="static/php/tarif_handler.php" id="tarifauswahl" method="post">
                <div class="radio-btn">
                    <?php
                    if (isset($_SESSION['tarif']) && $_SESSION['tarif'] == 'Einzelticket'){
                        echo '<input type="radio" class="radio" name="tarif" id="Einzelticket" value="Einzelticket" checked>';
                    }else{
                        echo '<input type="radio" class="radio" name="tarif" id="Einzelticket" value="Einzelticket">';
                    }
                    ?>
                    <label for="Einzelticket" class="normaltarif">Einzelticket</label>

                    <?php
                    if (isset($_SESSION['tarif']) && $_SESSION['tarif'] == 'Viererticket'){
                        echo '<input type="radio" class="radio" name="tarif" id="Viererticket" value="Viererticket" checked>';
                    }else{
                        echo '<input type="radio" class="radio" name="tarif" id="Viererticket" value="Viererticket">';
                    }
                    ?>
                    <label for="Viererticket" class="normaltarif">Viererticket</label>

                    <?php
                    if (isset($_SESSION['count']) && $_SESSION['count'] == 5){
                        //Button Gruen
                        echo '<input type="radio" class="radio" name="tarif" id="_5erGruppenticket" value="5erGruppenticket"';

                        if(isset($_SESSION['tarif']) && $_SESSION['tarif'] == '5erGruppenticket'){
                            //Selected
                            echo 'checked';
                        }

                        echo      '>';
                        echo '<label for="_5erGruppenticket" class="_5ergruppenticket">5er Gruppenticket</label>';
                    }else{
                        //Button Grau
                        echo '<input type="radio" class="radio" name="tarif" id="_5erGruppenticket" value="5erGruppenticket" disabled>
                    <label for="_5erGruppenticket" id="_5erGruppenticketlabel" class="_5ergruppenticket">5er Gruppenticket</label>';
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['count']) && $_SESSION['count'] == 10){
                        //Button Gruen
                        echo '<input type="radio" class="radio" name="tarif" id="_10erGruppenticket" value="10erGruppenticket"';

                        if(isset($_SESSION['tarif']) && $_SESSION['tarif'] == '10erGruppenticket'){
                            //Selected
                            echo 'checked';
                        }

                        echo      '>';
                        echo '<label for="_10erGruppenticket" class="_10ergruppenticket">10er Gruppenticket</label>';
                    }else{
                        //Button Grau
                        echo '<input type="radio" class="radio" name="tarif" id="_10erGruppenticket" value="10erGruppenticket" disabled>
                    <label for="_10erGruppenticket" id="_10erGruppenticketlabel" class="_10ergruppenticket">10er Gruppenticket</label>';
                    }
                    ?>
                </div>
                <div class="navigation-btn">
                    <input type="submit" class="Abbrechen" name="Abbrechen" id="Abbrechen" value="Abbrechen">
                    <input type="submit" class="Zurück" name="Zurück" id="Zurück" value="Zurück">
                    <input type="submit" id="weiter" class="button-disabled" value="Weiter" disabled>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script src="static/js/zeit.js"></script>
</html>
