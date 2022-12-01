<?php

$benutzername = 'admin'; // AUSLESEN
$passwortHash = NULL; // HASHWERT AUSLESEN

$errMsg = NULL;

if (!empty($_POST['submit'])) {
    if (empty($_POST['passwort']) || empty($_POST['benutzername']) || $_POST['benutzername'] != $benutzername /* || !password_verify($_POST['passwort'],$passwortHash) */) {
        $errMsg = "Falsches Passwort oder Benutzername!";
    }
    else {
        header('Location: auswahlseite.php');
        exit();
    }

}


?>


<!DOCTYPE html>
<html lang="de">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/css/login.css">
</head>
<body>
<div class="top-navigation">
    <img src="static/img/ISLM_Logo2009%20(2).png">
</div>

<div class="main-grid">
    <div></div>
    <div>
        <form method="post" action="login.php">
            <div>
            <label for="benutzername">Benutzername: </label>
            </div>

            <div>
            <input type="text" name="benutzername" id="benutzername" class="fields" required> <br>
            </div>

            <div>
            <label for="passwort">Passwort: </label>
            </div>

            <div>
            <input type="password" name="passwort" id="passwort" class="fields" required>
            </div>
            <div>

            </div>
            <div class="errMsg">
                <?php if ($errMsg) echo $errMsg ?>
            </div>
            <div class="buttons">
                <input type="submit" value="Log In" name="submit" id="button">
            </div>


        </form>

    </div>
    <div></div>

</div>

</body>
</html>
