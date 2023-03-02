<?php
require("kapcsolat.php");
session_start();
$sql = "SELECT * FROM kategoria INNER JOIN gyarto ON kategoria.kategoriaID=gyarto.kategoriaID INNER JOIN termek ON gyarto.gyartoId=termek.markaId WHERE kategoria.kategoriaID = 2;";
$eredmeny = mysqli_query($dbconnect, $sql);

$osszes   = mysqli_num_rows($eredmeny);
$mennyit  = 9;
$lapok    = ceil($osszes / $mennyit); 
$aktualis = (isset($_GET['oldal'])) ? (int)$_GET['oldal'] : 1;
$honnan   = ($aktualis-1)*$mennyit; 

$kifejezes = (isset($_GET['kifejezes'])) ? $_GET['kifejezes'] : "";

// $sql = "SELECT *
//              FROM alaplap
//             WHERE (
// 			tipus LIKE '%{$kifejezes}%' 
// 		)
//             ORDER BY ar ASC
//             LIMIT {$honnan}, {$mennyit}";       
// $eredmeny = mysqli_query($dbconnect, $sql);

$kimenet = "";
while ($sor = mysqli_fetch_assoc($eredmeny)) {
    $kimenet .=
<<<URLAP
    <article>
    <div class="border">
    <a href=alaplap_adat.php?id={$sor['termekId']}">
    <img src="../img/alaplap/{$sor['foto']}" alt="{$sor['foto']} "></a>
    
    </div>
    <div class="itemInfo">
    
        <h2>{$sor['gyartoNev']} {$sor['termekNev']}</h2>
        <hr>
        <p class='price'>{$sor['ar']}<span>Ft</span></p>
        <input type="number" name="quantity" id="quantity" min="1" max="9" value="1">
        
        <button type="button" class="kosarhoz"><img src="../img/cartICON.png" alt="Logo" class='cartImage'>Kosárba</button>
        
    </div>

</article>
URLAP;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alaplapok</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sablon.css">
    <link rel="stylesheet" href="../css/oldal.css">
</head>
<body>

        
    <header>
        <nav>
            <ul>
                <li><a href="../index.html">Főoldal</a></li>
                <li><a href="">Üzleteink</a></li>
                <li><a href="">Kapcsolat</a></li>
            </ul>
        </nav>
            
        <div class="kosaricon">
            <p>0</p> <i class="fa fa-shopping-cart"></i>
        </div>
    </header>
    <div class="oldalLogo">
    <div class="area" >
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
        <h1>Alaplapok</h1>
        <!-- <a href="#main"><i class="fa fa-chevron-circle-down" style="font-size:36px;"></i></a> -->
      </div>

      
</div >
       <!-- <img src="../img/gaming header Oldal.jpg" alt="gaming header" title="gaming header" width="100%"> -->
      
        


      <!-- <div class='console-container'><span id='text' style="font-weight: 900;"></span><div class='console-underscore' id='console'>&#95;</div></div> -->
    </div>
        <main>
        <div class="termekek">
        
                <?php print $kimenet ?>
                </div>
        </main>
    
    <!--Kosár tartalma-->
    <div class="cartBox">
        <div class="cart">
            <!--A gomb, mivel majd bezárjuk-->
            <i class="fa fa-close"></i>
            <h1>Kosár tartalma</h1>
            <!--Táblázat, ahol a termékek kerülnek-->
            <table></table>
        </div>
    </div>
    


    <table class='tulajdonsagok'>
        <tr>
        <th colspan="2"><img src='../img/notes.png' alt="">Tulajdonságok</th>
       
        </tr>
        <tr>
       <td>Processzor sorozat: <b> Intel Core i5</b></td>
        <td> Processzormagok száma: <b> 6 ×</b></td>
        
        </tr>
        <tr>
        <td>Szálak száma: <b> 12 ×</b> </td>
        <td>Túlhajható:  <b> Igen</b></td>
        
        </tr>
        <tr>
        <td>Hőmérséklet: <b> Max 95°C hőmérséklet</b></td>
        <td>Mikroarchitektúra: <b> Golden Cove</b></td>
        
        </tr>
        <tr>
        <td>Modellmegjelölés: <b> Intel Core i5-12400F</b></td>
        <td>Támogatott memóriatípus: <b> DDR4 </b></td>
        
        </tr>
           <td>Támogaott memóriatípus     <b>  DDR4, DDR5</b></td>
           <td>Felhasználási terület: <b> Asztali PC </b></td>
        </tr>
      </table>




    <script src="../js/script.js"></script>
</body>
</html>
        <tr>
            <td>Támogatott memóriatípus: <b> DDR4</b></td>
            <td>Integrált videókártya típ