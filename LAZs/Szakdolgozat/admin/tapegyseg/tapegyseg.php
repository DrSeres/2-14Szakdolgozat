<?php

require("../kapcsolat.php");

$sql = "SELECT * FROM `tapegyseg`;";

$eredmeny = mysqli_query($dbconn, $sql);


$kimenet = "<table>
<tr>
    <th>Kép</th>
    <th>Márka</th>
    <th>Modell</th>
    <th>Tápegység típusa</th>
    <th>Tápegység teljesítménye (W)</th>
    <th>Hatásfok</th>
    <th>PFC</th>
    <th>Leírás</th>
    <th>Ár</th>
    <th></th>
</tr>";
while($sor = mysqli_fetch_assoc($eredmeny)) {
    $kimenet.= "<tr>
    <td><img src=\"../../img/tapegyseg/{$sor['foto']}\" alt=\"pro\"></td>
    <td>{$sor['marka']}</td>
    <td>{$sor['modell']}</td>
    <td>{$sor['tipus']}</td>
    <td>{$sor['teljesitmeny']}</td>
    <td>{$sor['hatasfok']}</td>
    <td>{$sor['pfc']}</td>
    <td>{$sor['leiras']}</td>
    <td>{$sor['ar']}</td>
    <td><a href=\"torles.php?id={$sor['id']}\">Törlés</a> | <a href=\"modositas.php?id={$sor['id']}\">Módosítás</a></td>";
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
    <title>Tápegység</title>
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
                    <h1>Tápegység</h1>
                    <p>Tápegység megtekintése</p>
                    <a href="#main"><i class="fa fa-chevron-circle-down" style="font-size:36px"></i></a>
                </div>
            </div>
        </div>
    </header>
    <main id="main">
        <h2 id="kategoria">Tápegységek széles választékban</h2>
        <p><a href="felvetel.php">Új tápegységek hozzáadása</a> | <a href="../kategoria.html">Vissza a főoldalra</a></p>
        <div class="main">
            <div class="flexbox-container">
                <?php print_r($kimenet);?>
            </div>



        </div>
    </main>
</body>

</html>