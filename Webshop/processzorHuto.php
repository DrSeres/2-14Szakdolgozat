<?php
require("kapcsolat.php");
session_start();
$sql = "SELECT * FROM kategoria INNER JOIN gyarto ON kategoria.kategoriaID=gyarto.kategoriaID INNER JOIN termek ON gyarto.gyartoId=termek.markaId WHERE kategoria.kategoriaID = 5;";
$eredmeny = mysqli_query($dbconnect, $sql);

$osszes   = mysqli_num_rows($eredmeny);
$mennyit  = 9;
$lapok    = ceil($osszes / $mennyit); 
$aktualis = (isset($_GET['oldal'])) ? (int)$_GET['oldal'] : 1;
$honnan   = ($aktualis-1)*$mennyit; 

$kifejezes = (isset($_GET['kifejezes'])) ? $_GET['kifejezes'] : "";

// $sql = "SELECT *
//              FROM processzor_huto
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
    <a href=processzorHuto_adat.php?id={$sor['termekId']}">
    <img src="../img/procHuto/{$sor['foto']}" alt="{$sor['foto']} "></a>
    
    </div>
    <div class="itemInfo">
    
        <h2>{$sor['gyartoNev']} {$sor['termekNev']}</h2>
        <hr>
        <p class='price'>{$sor['ar']}<span>Ft</span></p>
        <div class='appear' id='show'>
        <input type="number" name="quantity" id="quantity" min="1" max="9" value="1">
        
        <button type="button" class="kosarhoz"><img src="../img/cartICON.png" alt="Logo" class='cartImage'>Kosárba</button>
        </div>
        
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
    <title>Processzor hűtő</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sablon.css">
    <link rel="stylesheet" href="../css/oldal.css">
</head>
<body>
    
        
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Főoldal</a></li>
                <li><a href="">Üzleteink</a></li>
                <li><a href="">Kapcsolat</a></li>
            </ul>
        </nav>
            
        <?php 
        
        if(isset($_SESSION['user_type'])){
            if($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin'){
                echo  '<div class="kosaricon">
                    <p>0</p> <i class="fa fa-shopping-cart"></i>
                </div>';
            }
        }
        
        ?>
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
        <h1>Processzor hűtő</h1>
        <!-- <a href="#main"><i class="fa fa-chevron-circle-down" style="font-size:36px;"></i></a> -->
      </div>

      
</div >
       <!-- <img src="../img/gaming header Oldal.jpg" alt="gaming header" title="gaming header" width="100%"> -->
      
        


      <!-- <div class='console-container'><span id='text' style="font-weight: 900;"></span><div class='console-underscore' id='console'>&#95;</div></div> -->
    </div>
        <main>
        <div class="termekek">
        
                <?php print $kimenet; 
                
                if(isset($_SESSION['user_type'])){
                    if($_SESSION['user_type'] == "user"){
                        //echo '<script>document.getElementById("show").classList.remove("hidden");</script>';
                        
                    }
                }
                else
                {
                    echo '<script>
                    
                    const divek = document.getElementsByClassName("appear");
                    console.log(divek);
                    for(div of divek){
                        div.classList.add("hidden");   
                    }

                    </script>';
                    //echo '<script>let div = document.getElementById("show"); console.log("ez"); console.log(div)</script>';
                
                    //echo '<script>alert("Szia")</script>';
                }
                
                
                ?>
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
    


    <!-- <table class='tulajdonsagok'>
        <tr>
        <th colspan="2"><img src='../img/notes.png' alt="">Tulajdonságok</th>
       
        </tr>
        <tr>
       <td>Processzor sorozat: <b> AMD Ryzen 5</b></td>
        <td> Foglalat: <b> Socket AM4</b></td>
        
        </tr>
        <tr>
        <td>Mikroarchitektúra: <b> Zen 3 </b> </td>
        <td>Processzor kódnév:  <b> Vermeer</b></td>
        
        </tr>
        <tr>
        <td>Hűtés típusa: <b> Wraith Stealth</b></td>
        <td>Processzormagok száma: <b> 6 ×</b></td>
        
        </tr>
        <tr>
        <td>Szálak száma: <b> 12 ×</b></td>
        <td>Processzor frekvencia: <b> 3,7 GHz (3,7 GHz)</b></td>
        
        </tr>
        <tr>
            <td>Támogatott memóriatípus: <b> DDR4</b></td>
            <td>Integrált videókártya típusa: <b> Beépített grafikus chip nélkül</b></td>
        </tr>
      </table> -->




    <script src="../js/script.js"></script>
</body>
</html>