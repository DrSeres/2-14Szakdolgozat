<?php

require("kapcsolat.php");

$id = (int)$_GET['id'];
$sql = "SELECT * FROM `processzor`
        WHERE id = {$id}";

$eredmeny = mysqli_query($dbconnect, $sql);


$kimenet = "";
while($sor = mysqli_fetch_assoc($eredmeny)) {

    $cim = "{$sor['marka']} {$sor['tipus']}";

    $kimenet.= "
    <div class=\"main\">
        <div class=\"grid-container\">
            <div class=\"adat\">
            <img src='img/{$sor['foto']}' class='kep'>
            </div>
            <div class=\"adat\">
            <h2 id=\"kategoria\">{$sor['marka']} {$sor['tipus']}</h2>
            
                <p>Magok száma: {$sor['magok']}</p>
                <p>Szálak száma: {$sor['szalak']}</p>
                <p>Processzor foglalat: {$sor['processzor_foglalat']}</p>
                <p>Processzor órajel (MHz): {$sor['processzor_orajel']}</p>
                <p>Processzor Turbo órajel (MHz): {$sor['processzor_turbo_orajel']}</p>
            </div>
        </div>
        
        <div class=\"leiras\">
            {$sor['leiras']}
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
    <link rel="stylesheet" href="oldal.css">
    <link rel="stylesheet" href="flexbox.css">
    <link rel="stylesheet" href="grid.css">
    <title><?php print_r($cim);?></title>
</head>

<body>
    <header>
    <nav>
            <ul>
                <li><a href="">Főoldal</a></li>
                <li><a href="">Kapcsolat</a></li>
              <li><a href="processzor.php" class='Vissza'>Vissza a Webshopra</a></li>
                
            </ul>
        </nav>
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
                    <a href="#main"><i class="fa fa-chevron-circle-down" style="font-size:36px; margin:auto"></i></a>
                </div>
            </div>
        </div>
    </header>
    <main id="main">
        <?php print_r($kimenet);?>
        <!-- <hr> -->
        <div class="vasarlas feliratkozas">
            <h2>Iratkozzon fel hírlevelünkre</h2>
            <input type="email" name="email" id="email" placeholder='Írja be E-mail címet' required >
            <button type="submit">Feliratkozás</button>
        </div>
    </main>
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
 <script src="script.js"></script>
</body>
    
</html>