<?php

require("kapcsolat.php");

$sql = "SELECT `id`, `marka`, `tipus`, `ar`, `foto` FROM `processzor`;";

$eredmeny = mysqli_query($dbconn, $sql);


$kimenet = "";
while($sor = mysqli_fetch_assoc($eredmeny)) {
    $kimenet.= "<div class=\"flex-box hover-img\">
    <a href=\"asd\"><img src=\"img/processzor/{$sor['foto']}\" width=\"100%\"></a>
    <figcaption>
        <a href=\"processzor_adat.php?id={$sor['id']}\">
            <h3>{$sor['marka']} {$sor['tipus']}</h3>
            <p>{$sor['ar']} Ft</p>
        </a>
    </figcaption>
</div>";
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
    <link rel="stylesheet" href="css/oldal.css">
    <link rel="stylesheet" href="css/flexbox.css">
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
        <div class="main">
            <div class="flexbox-container">
                <?php print_r($kimenet);?>
            </div>



        </div>
        <!-- <hr> -->
        <div class="vasarlas">
            <h2>Tekintse meg ajánlatainkat</h2>
            <a href="webshop.php"><button type="button">Vásárlás most</button></a>
        </div>
    </main>
</body>

</html>