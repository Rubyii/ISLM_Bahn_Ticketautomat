<?php
session_start();

if(isset($_POST['tarif'])){
    $_SESSION['tarif'] = $_POST['tarif'];
}


if (isset($_POST['Abbrechen'])) {
    session_unset();
    session_destroy();
    //header('Location: abbrechen.php');
} elseif(isset($_POST['Zurück'])){
    $_SESSION['Zurück'] = $_POST['Zurück'];
    //header('Location: abbrechen.php');
}

foreach ($_POST as $key => $value) {
    echo "The POSTkey is ".$key." and value ". $value;
    echo "<br>";
}

foreach ($_SESSION as $key => $value) {
    echo "The SESSIONTkey is ".$key." and value ". $value;
    echo "<br>";
}


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>TEST</title>
</head>
<body>
    <button onclick="window.location.href='index.php';">
    Click Here
</button>
</body>
</html>