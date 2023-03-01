<?php

require("kapcsolat.php");

$id = (int)$_GET['id'];
$sql = "SELECT * FROM `processzor`
        WHERE id = {$id}";

$eredmeny = mysqli_query($dbconn, $sql);


$kimenet = "";
while($sor = mysqli_fetch_assoc($eredmeny)) {

    $cim = "{$sor['marka']} {$sor['tipus']}";

    $kimenet.= "<h2 id=\"kategoria\">{$sor['marka']} {$sor['tipus']}</h2>
    <div class=\"main\">
        <div class=\"grid-container\">
            <div class=\"adat\">
                <img src=\"img/processzor/{$sor['foto']}\" alt=\"pro\" class=\"kep\">
            </div>
            <div class=\"adat\">
                <p>Magok száma: {$sor['magok']}</p>
                <p>Szálak száma: {$sor['szalak']}</p>
                <p>Processzor foglalat: {$sor['processzor_foglalat']}</p>
                <p>Processzor órajel (MHz): {$sor['processzor_orajel']}</p>
                <p>Processzor Turbo órajel (MHz): {$sor['processzor_turbo_orajel']}</p>
            </div>
        </div>
        
        <div class=\"leiras\">
            <h2>Leírás:</h2>
            <p>{$sor['leiras']}</p>
        </div>
        <div class=\"kosar\">
            <form action=\"\" method=\"post\">
                <h3>Ár: {$sor['ar']} Ft</h3>
                <input type=\"button\" value=\"Kosárba\" class=\"kosarba\">
            </form>
        </div>
    </div>";
}






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
    <link rel="stylesheet" href="css/grid.css">
    <title><?php print_r($cim);?></title>
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
        <?php print_r($kimenet);?>
        <!-- <hr> -->
        <div class="vasarlas">
            <h2>Tekintse meg ajánlatainkat</h2>
            <a href="webshop.php"><button type="button">Vásárlás most</button></a>
        </div>
    </main>
</body>

</html>