<?php

require("kapcsolat.php");

$kifejezes = (isset($_POST["kifejezes"])) ? $_POST["kifejezes"] : "";

$sql = "SELECT termek.id, gyarto.gyartoNev, termek.termekNev, termek.foto, termek.leiras, termek.ar, kategoria.kategoriaNev FROM `kategoria`
INNER JOIN gyarto ON kategoria.kategoriaID = gyarto.kategoriaID
INNER JOIN termek ON gyarto.gyartoId = termek.markaId
WHERE termek.termekNev LIKE '%{$kifejezes}%'
OR kategoria.kategoriaNev LIKE '%{$kifejezes}%'";

$eredmeny = mysqli_query($dbconn, $sql);



$kimenet = "<table>
<tr>
    <th>Kép</th>
    <th>Kategória</th>
    <th>Márka</th>
    <th>Modell</th>
    <th>Ár</th>
    <th></th>
</tr>";
while ($sor = mysqli_fetch_assoc($eredmeny)) {
  $kimenet .= "<tr>
    <td><img src=\"../img/termekek/{$sor['foto']}\" alt=\"pro\"></td>
    <td>{$sor['kategoriaNev']}</td>
    <td>{$sor['gyartoNev']}</td>
    <td>{$sor['termekNev']}</td>
    <td>{$sor['ar']}</td>
    <td><a href=\"torles.php?id={$sor['id']}\" class=\"gomboks\">Törlés</a> | <a href=\"modositas.php?id={$sor['id']}\" class=\"gomboks\">Módosítás</a> | <a href=\"reszletek.php?id={$sor['id']}\" class=\"gomboks\">Részletek</a></td>";
  "";
}
$kimenet .= "</table>";

$sql = "SELECT * FROM kategoria";

$eredmeny = mysqli_query($dbconn, $sql);


$kiir = "";
while($sor = mysqli_fetch_assoc($eredmeny)){
    $kiir.= "
    <option value=\"{$sor['kategoriaNev']}\">{$sor['kategoriaNev']}</option>";
}

?>





























<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="../css/oldal.css">
  <link rel="stylesheet" href="../css/flexbox.css">
  <link rel="stylesheet" href="css/gombok.css">
  <link rel="stylesheet" href="css/table.css">
  
  <title>Számítógép webshop</title>
</head>

<body>
  <header>
    <!-- <div class="topnav" id="myTopnav">

      <a href="#index.html" class="active">Főoldal</a>
      <a href="#webshop.html">Webshop</a>
      <a href="#kapcsolatFelvetel.html">Kapcsolat</a>
      <a href="#about">About</a>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
      <a href="kosar.html" style="float: right; margin-right: 30px; border: none;"><i
          class="fa fa-shopping-cart"></i></a>
      <a href="" style="float: right; margin-right: 30px; border: none;"><i class="fas fa-user-alt"
          onclick="openForm()"></i></a>

    </div> -->

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
          <h1>Üdvözöllek az admin oldalon</h1>
          <p>Termék kategóriáink megtekintése</p>
          <a href="#main"><i class="fa fa-chevron-circle-down" style="font-size:36px"></i></a>
        </div>
      </div>
      <!-- <img src="../img/gaming header Oldal.jpg" alt="gaming header" title="gaming header" width="100%"> -->




      <!-- <div class='console-container'><span id='text' style="font-weight: 900;"></span><div class='console-underscore' id='console'>&#95;</div></div> -->
    </div>


  </header>



  <!-- <div class="bg"></div>
    
    <div class="star-field">
    <div class="layer"></div>
    <div class="layer"></div>
    <div class="layer"></div> -->
  <main id="main">
    <!-- <hr> -->
    <h2 id="kategoria">Kategóriák</h2>
    <p class="gombok"><a href="felvetel.php"><button>Új gyártó hozzáadása</button></a> | <a href="felvetel_2.php"><button>Új adat hozzáadása</button></a> | <a href="felvetel.php"><button>Kijelentkezés</button></a></p>
    <form method="post">
      <input type="search" name="kifejezes" id="kifejezes" placeholder="Keresés">
    </form>
    <p><label for="markaId">Kategória kiválasztása*: </label>
                <select id="markaId" name="markaId">
                    <?php print_r($kiir);?>
                </select>
            </p>
    <div class="main">
      <div class="flexbox-container">
        <?php print_r($kimenet); ?>
      </div>
    </div>



      <script src="../js/script.js"></script>
</body>

</html>