<?php

//Űrlap feldolgozása

require("kapcsolat.php");
// $sql = "SELECT * FROM kategoria
//         INNER JOIN gyarto ON kategoria.kategoriaID = gyarto.kategoriaID";



$id = (int)$_GET['id'];
$sql = "SELECT*
        FROM termek
        INNER JOIN gyarto ON gyarto.gyartoId = termek.markaId
        WHERE id = {$id}";
$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_assoc($eredmeny);

$gyartoNev = $sor['gyartoNev'];
$termekNev = $sor['termekNev'];
$leiras = $sor['leiras'];
$ar = $sor['ar'];
$darab = $sor['darab'];
$foto = ($sor['foto']) != "nincskep.png" ? $sor['foto'] : "nincskep.png";

$cim = $sor['gyartoNev'] . " " . $sor['termekNev'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/felv_mod.css">
    <link rel="stylesheet" href="css/table.css">
    <title> <?php print $cim ?></title>
</head>

<body>
    <div class="container">
        <h1><?php print $gyartoNev ?> <?php print $termekNev ?></h1>
        <form method="post" enctype="multipart/form-data">

            <?php print $leiras; ?>
            <p><a href="kategoria.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>