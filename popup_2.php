<?php
session_start();

if (!empty($_POST['abbrechen'])) {
    session_unset();
    session_destroy();
    session_regenerate_id();
    echo '<script type="text/javascript">'.
    'parent.window.location = "startseite.php";',
    '</script>';

}
if (!empty($_POST['zurück'])) {

    echo '<script type="text/javascript">'.
        'parent.window.location = "uebersicht.php";',
    '</script>';
}
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bezahlen</title>
    <link rel="stylesheet" href="static/css/popup_2.css">
    <script async defer src="static/js/keinRechtsclick.js"></script>
    <script async defer src="static/js/keinZurueck.js"></script>
</head>
<body>
<div class="top-text">
    <span><?php echo $_SESSION['language']['bezabgebrochen']?></span> <br>
    <span><?php echo $_SESSION['language']['rückgeld']?></span>
    <span id="rückgeld"><?php echo $_SESSION['language']['ruckgeld']?></span>


</div>

</body>
<script src="static/js/zahlungsabwicklung.js"></script>

<div class="main-grid">
    <div>
        <span id="1centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">1 Cent</button>
    </div>
    <div>
        <span id="2centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">2 Cent</button>
    </div>
    <div>
        <span id="5centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">5 Cent</button>
    </div>
    <div>
        <span id="10centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">10 Cent</button>
    </div>
    <div>
        <span id="20centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">20 Cent</button>
    </div>
    <div>
        <span id="50centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">50 Cent</button>
    </div>
    <div>
        <span id="1euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">1€</button>
    </div>
    <div>
        <span id="2euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">2€</button>
    </div>
    <div>
        <span id="5euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">5€</button>
    </div>
    <div>
        <span id="10euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">10€</button>
    </div>
    <div>
        <span id="20euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">20€</button>
    </div>
    <div>
        <span id="50euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">50€</button>
    </div>
    <div>
        <span id="100euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">100€</button>
    </div>
    <input type="hidden" id="zurück" value="0">
</div>

<form method="post" >
    <button class="button-orange" type="submit" name="abbrechen" value="abbrechen" id="entnommen"><?php echo $_SESSION['language']['rückgeldentnommen']?></button>
</form>
</html>
