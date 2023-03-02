<?php

require("../kapcsolat.php");

$sql = "SELECT termek.id, gyarto.gyartoNev, termek.termekNev, termek.foto, termek.leiras, termek.ar FROM `kategoria`
        INNER JOIN gyarto ON kategoria.kategoriaID = gyarto.kategoriaID
        INNER JOIN termek ON gyarto.gyartoId = termek.markaId
        WHERE kategoria.kategoriaNev = 'processzor'
        ORDER BY termek.id ASC;";

$eredmeny = mysqli_query($dbconn, $sql);


$kimenet = "<table>
<tr>
    <th>Kép</th>
    <th>Márka</th>
    <th>Modell</th>
    <th>Ár</th>
    <th></th>
</tr>";
while($sor = mysqli_fetch_assoc($eredmeny)) {
    $kimenet.= "<tr>
    <td><img src=\"../../img/processzor/{$sor['foto']}\" alt=\"pro\"></td>
    <td>{$sor['gyartoNev']}</td>
    <td>{$sor['termekNev']}</td>
    <td>{$sor['ar']}</td>
    <td><a href=\"../torles.php?id={$sor['id']}\">Törlés</a> | <a href=\"../modositas.php?id={$sor['id']}\">Módosítás</a> | <a href=\"modositas.php?id={$sor['id']}\">Részletek</a></td>";
    "";
}
$kimenet.="</table>";






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/oldal.css">
    <link rel="stylesheet" href="../../css/flexbox.css">
    <link rel="stylesheet" href="../css/table.css">
    <title>Processzor</title>
</head>

<body>
    <header>
        <div class="oldalLogo">
            <div class="area">
                <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <div class="centered">
                    <h1>Processzor</h1>
                    <p>Processzorok megtekintése</p>
                    <a href="#main"><i class="fa fa-chevron-circle-down" style="font-size:36px"></i></a>
                </div>
            </div>
        </div>
    </header>
    <main id="main">
        <h2 id="kategoria">Processzorok széles választékban</h2>
        <p><a href="../felvetel.php">Új adat hozzáadása</a> | <a href="../kategoria.html">Vissza a főoldalra</a></p>
        <div class="main">
            <div class="flexbox-container">
                <?php print_r($kimenet);?>
            </div>



        </div>
    </main>
</body>

</html>