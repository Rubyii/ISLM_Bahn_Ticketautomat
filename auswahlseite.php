<?php

session_start();

if (!$_SESSION['login']) {
    header('Location: login.php');
    exit();
}

if (!empty($_POST['abmelden'])) {
    $_SESSION['login'] = false;
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Auswahlseite</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/css/auswahlseite.css">
</head>
<body>
<div class="top-navigation">
    <div>
        <img src="static/img/ISLM_Logo2009%20(2).png">
    </div>


    <form method="post" class="abmeldenArea">
        <input type="submit" value="abmelden" name="abmelden" id="abmelden">
    </form>

</div>

<div class="main-grid">
    <div>
        <div class="selectItem">
            <form method="post" action="konfiguration.php">
                <input type="submit" value="Konfiguration" name="konfiguration" class="items">
            </form>
        </div>
    </div>
    <div>
        <div class="selectItem">
            <form method="post" action="statistik.php">
                <input type="submit" value="Statistiken" name="statistiken" class="items">
            </form>
        </div>
    </div>

</div>



</body>
</html>
