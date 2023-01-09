<?php
session_start();

$gesamtpreis = $_SESSION['preisGesamt']; // AUSLESEN

$preisGesamtKomma = number_format(str_replace(',','',$gesamtpreis),2, ",",".");

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <title>Bezahlen</title>
    <link rel="stylesheet" href="static/css/zahlung.css">
    <script async defer src="static/js/pageloader.js"></script>
    <script async defer src="static/js/keinRechtsclick.js"></script>
    <script async defer src="static/js/keinZurueck.js"></script>
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


<div class="grid-container" id="grid-container">
    <div class="ueberschrift">
        <img alt="ISLM-Bahn" class="logo" src="static/images/ISLM_Logo2009.png">
        <div id="uhrzeitdatum" class="uhrzeitdatum">
            <div id="uhrzeit"></div>
            <div id="datum"></div>
        </div>
    </div>
    <div class="hinweistext">
        <div class="hinweistext-innen">
            <div>
                <h3><?php echo $_SESSION['language']['bittezahlen']?></h3>
            </div>

            <div>
                <span> <?php echo $_SESSION['language']['keine100Scheine']?></span>

            </div>

        </div>
    </div>

    <div class="hauptfunktion">
        <div class="münzen-grid">
            <div>
                <span ><?php echo $_SESSION['language']['münzen']?></span>
            </div>
            <div>
                <input type="text" class="number" id="1cent" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="1cent"  onclick="buttonClicked(this)">1 Cent</button>
            </div>
            <div>
                <input type="text" class="number" id="2cent" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="2cent"  onclick="buttonClicked(this)">2 Cent</button>
            </div>
            <div>
                <input type="text" class="number" id="5cent" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="5cent"  onclick="buttonClicked(this)">5 Cent</button>
            </div>
            <div>
                <input type="text" class="number" id="10cent" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="10cent"  onclick="buttonClicked(this)">10 Cent</button>
            </div>
            <div>

            </div>
            <div>
                <input type="text" class="number" id="20cent" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="20cent"  onclick="buttonClicked(this)">20 Cent</button>
            </div>
            <div>
                <input type="text" class="number" id="50cent" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="50cent"  onclick="buttonClicked(this)">50 Cent</button>
            </div>
            <div>
                <input type="text" class="number" id="1euro" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="1euro"  onclick="buttonClicked(this)">1€</button>
            </div>
            <div>
                <input type="text" class="number" id="2euro" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="2euro"  onclick="buttonClicked(this)">2€</button>
            </div>
        </div>
        <div class="banknoten-grid">
            <div>
                <span ><?php echo $_SESSION['language']['schein']?></span>
            </div>
            <div>
                <input type="text" class="number" id="5euro" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="5euro"  onclick="buttonClicked(this)">5€</button>
            </div>
            <div>
                <input type="text" class="number" id="10euro" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="10euro"  onclick="buttonClicked(this)">10€</button>
            </div>
            <div>
                <input type="text" class="number" id="20euro" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="20euro"  onclick="buttonClicked(this)">20€</button>
            </div>
            <div>
                <input style="visibility: hidden" value="0" name="gesamtpreis" id="gesamtpreis"></input>
            </div>
            <div>
                <input style="visibility: hidden" value="0" name="rest" id="rest" type="text"></input>
                <input style="visibility: hidden" value="<?php echo $gesamtpreis; ?>" name="gesamt" id="gesamt" type="text"></input>

            </div>
            <div>
                <input type="text" class="number" id="50euro" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="50euro"  onclick="buttonClicked(this)">50€</button>
            </div>
            <div>
                <input type="text" class="number" id="100euro" value="x0" style="pointer-events: none">
                <button class="button-gruen" name="100euro"  onclick="buttonClicked(this)">100€</button>
            </div>
            <div style="text-align: right">
                <span><?php echo $_SESSION['language']['restbetrag']?> </span>
            </div>
            <div>

                <input type="text" class="number" style="pointer-events: none; width: 200px" name="restbetrag" id="restbetrag" value=" <?php echo $preisGesamtKomma ?>€">
            </div>
        </div>


    </div>



    <div class="navigation">
        <div class="navigation-innen">
            <form method="post">
                <input type="submit" class="button-orange" value="<?php echo $_SESSION['language']['abbrechen']?>" id="abbrechen" onclick="abbrechenVorgang(this)">
                <input type="submit" class="button-orange" name="zurück" value="<?php echo $_SESSION['language']['zurück']?>" onclick="abbrechenVorgang(this)">
            </form>

        </div>
    </div>
</div>

<div class="abbruch" id="abbruch">
    <iframe src="popup_1.php" width="1400px" height="700px" id="popup_1"></iframe>
</div>

<div class="abbruch2" id="abbruch2">
    <iframe src="popup_2.php" width="1400px" height="700px" id="popup_2"></iframe>
</div>

<div class="abbruch3" id="abbruch3">
    <iframe src="popup_3.php" width="1400px" height="700px" id="popup_3"></iframe>
</div>

<!--Page Load-->


<div class="loadingscreen" id="loader-container" >
    <div class="loadingscreen" id="loader"></div>
    <div class="loadingscreen" id="loading-text"><?php echo $_SESSION['language']['laedt']?></div>
</div>
<!--Page Load-->

</body>
<script src="static/js/zeit.js"></script>
<script src="static/js/zahlungsabwicklung.js"></script>
</html>
