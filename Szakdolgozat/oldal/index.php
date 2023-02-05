<?php

require("kapcsolat.php");



$sql = "SELECT * FROM proba ORDER BY id ASC";
$eredmeny = mysqli_query($dbconnect, $sql);
//print_r($eredmeny);



//szükséges adatok a számításhoz
$mennyit = 9; //ennyi kártyát akarok látni egy oldalon
$osszesen = mysqli_num_rows($eredmeny);
//print_r($osszesen);

$lapok = ceil($osszesen / $mennyit); //kerekítés
//print($lapok);

$aktualis = (isset($_GET['oldal'])) ? (int)$_GET['oldal'] : 1;

/** 
 * 0, 10 - gép számítása 0-tól 1-oltal
 * 10, 10
 * 20, 10 - 3ik oldal
*/

$honnan = ($aktualis -1) * $mennyit >= 1 ? ($aktualis -1) * $mennyit : 1;
//print_r($honnan);


//lapozó felépítése, hivatkozásoknak kell lennie
$lapozo = "<p>";
$lapozo .= ($aktualis != 1) ? "<a href=\"?oldal=1\">Első</a> |" : "Első |";

$lapozo .= ($aktualis > 1 && $aktualis <= $lapok) ? "<a href=\"?oldal=" .($aktualis-1)."\">Előző</a> | " : "Előző |";

//össszes oldalra el kell végezni a vizsgálatot, amin állsz az legyen link

for ($oldal=1; $oldal <= $lapok; $oldal++) { 
    $lapozo .= ($aktualis != $oldal) ? "<a href=\"?oldal={$oldal}\">{$oldal}</a> | " : $oldal." |";
}

$lapozo .= ($aktualis > 0 && $aktualis < $lapok) ? "<a href=\"?oldal=".($aktualis + 1)."\">Következő</a> | " : "Következő | ";

$lapozo .= ($aktualis != $lapok) ? "<a href=\"?oldal=".($lapok)."\">Utolsó</a>" : "Utolsó";

$lapozo .= "</p>";

$kifejezes = (isset($_POST["kifejezes"])) ? $_POST["kifejezes"] : "";
//print_r($kifejezes);


$sql = "SELECT * FROM proba 
    WHERE (
        id LIKE '%{$kifejezes}%' 
        OR cikkszam LIKE '%{$kifejezes}%' 
        OR Tipus LIKE '%{$kifejezes}%' 
        OR Ar LIKE '%{$kifejezes}%'
        )
        ";


$eredmeny = mysqli_query($dbconnect, $sql);

//ha valaki érvénytelen oldalt ír be, akkor írja ki, nincs találat

if((mysqli_num_rows($eredmeny)) < 1)
{
    $kimenet = "<article>
    <h2>Nincs találat a rendszerben</h2>
    </article>";
}
else
{
    $kimenet = "";


$kimenet = "";
//print_r($sor);
while ($sor = mysqli_fetch_assoc($eredmeny)) {
    $kimenet .= "<article>
    <img src=\"img/{$sor['foto']}\" alt=\"{$sor['Tipus']}\">
    <h3>{$sor['Tipus']}</h3>
    <h2>{$sor['Ar']} Ft</h2>
    <div class='kosar'>
        <button type='button' class='btn'>Kosárba</button>
    </div>
    </article>\n"; 
}}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processzor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sablon.css">
</head>
<body>
    <h1>asd</h1>
<header class="header">
        <a href="" class="logo">
            <img src="../img/sereskft.png" alt="">
        </a>
        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#about">about</a>
            <a href="#menu">menu</a>
            <a href="#home">Home</a>
            <a href="#home">Home</a>
            <a href="#home">Home</a>
            <a href="#home">Vissza a főoldalra</a>
        </nav>
        <div class="icons">
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>

        <div class="cart-items-container">
            <div class="cart-item">
                <span class="fas fa-times" id="buttonX"></span>
                <img src="../img/procHuto.jpg" alt="">
                <div class="content">
                    <h3>{{termek}}</h3>
                    <div class="price">{{termekar}}</div>
                </div>
            </div>
            <div class="cart-item">
                <span class="fas fa-times" id="buttonX"></span>
                <img src="../img/procHuto.jpg" alt="">
                <div class="content">
                    <h3>{{termek}}</h3>
                    <div class="price">{{termekar}}</div>
                    
                </div>
            </div>
            <div class="cart-item">
                <span class="fas fa-times" id="buttonX"></span>
                <img src="../img/procHuto.jpg" alt="">
                <div class="content">
                    <h3>{{termek}}</h3>
                    <div class="price">{{termekar}}</div>
                    
                </div>
            </div>
            <a href="" class="btn">Kifizetés</a>
        </div>
    </header>


    <div class="termekek">
        <?php 
            print $kimenet;
        ?>
        <!-- <p style="clear:both">Első | Előző | 1 | 2 | 3 | 4 | Következő | Utolsó</p> !-->
    </div>
    <?php print $lapozo; ?>
    <script src="../js/script.js"></script>
</body>
</html>