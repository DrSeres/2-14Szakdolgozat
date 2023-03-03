<?php

require("kapcsolat.php");
session_start();
$id = (int)$_GET['id'];
$sql = "SELECT * FROM kategoria INNER JOIN gyarto ON kategoria.kategoriaID=gyarto.kategoriaID INNER JOIN termek ON gyarto.gyartoId=termek.markaId WHERE termek.termekId = {$id};";

$eredmeny = mysqli_query($dbconnect, $sql);


$kimenet = "";
while($sor = mysqli_fetch_assoc($eredmeny)) {

    $cim = "{$sor['gyartoNev']} {$sor['termekNev']}";

    $kimenet.= "
    <div class=\"main\">
        <div class=\"grid-container\">
            <div class=\"adat\">
            <img src='../img/gephaz/{$sor['foto']}' class='kep'>
            </div>
            <div class=\"adat\">
            <h2 id=\"kategoria\">{$sor['gyartoNev']} {$sor['termekNev']}</h2>
            <p>1</p>
            <p>1</p>
            <p>1</p>
            <p>1</p>
            <p>1</p>
                
                
                </div>
        </div>
        
        <div class=\"leiras\">
            {$sor['leiras']}
        </div>

        <div class=\"kosar\">
            <form action=\"\" method=\"post\">
                <h3>Ár: {$sor['ar']} Ft</h3>
            </form>
        </div>
    </div>";

    $adat = "{$sor['gyartoNev']} {$sor['termekNev']}";
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
    <!-- <link rel="stylesheet" href="flexbox.css"> -->
    <link rel="stylesheet" href="../css/grid.css">
    <title><?php print_r($cim);?></title>
</head>

<body>
    <header>
    <nav>
            <ul>
                <li><a href="index.php">Főoldal</a></li>
                <li><a href="">Kapcsolat</a></li>
                <li><a href="gephaz.php" class='Vissza'>Vissza a Webshopra</a></li>
              <!-- <p>Magok száma: {$sor['szelesseg']}</p>
                <p>Szálak száma: {$sor['melyseg']}</p>
                <p>Processzor foglalat: {$sor['alaplap_atx']}</p>
                <p>Processzor foglalat: {$sor['alaplap_atx']}</p>
                <p>Processzor foglalat: {$sor['alaplap_atx']}</p> -->
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
                    <h1> <?php print($adat) ?> </h1>
                </div>
            </div>
        </div>
    
    <main id="main">
        <?php print_r($kimenet);?>
        <!-- <hr> -->
        <div class="vasarlas feliratkozas">
            <h2>Iratkozzon fel hírlevelünkre</h2>
            <input type="email" name="email" id="email" placeholder='Írja be E-mail címet' required >
            <button type="submit">Feliratkozás</button>
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
    <footer class="footer">
    <div class="container">
      <div class="sor">
        <div class="footer-col">
          <h4>company</h4>
          <ul>
            <li><a href="#">about us</a></li>
            <li><a href="#">our services</a></li>
            <li><a href="#">privacy policy</a></li>
            <li><a href="#">affiliate program</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>get help</h4>
          <ul>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">shipping</a></li>
            <li><a href="#">returns</a></li>
            <li><a href="#">order status</a></li>
            <li><a href="#">payment options</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>online shop</h4>
          <ul>
            <li><a href="#">watch</a></li>
            <li><a href="#">bag</a></li>
            <li><a href="#">shoes</a></li>
            <li><a href="#">dress</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>follow us</h4>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
    </div>
 </footer>

 <script src="../js/script.js"></script>
</body>
    
</html>