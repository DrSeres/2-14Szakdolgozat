<?php

require('kapcsolat.php');

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("url.php");

if (isset($_SESSION['user_type'])) {
  if ($_SESSION['user_type'] == 'user') {
    $kitiltas = "SELECT * FROM users WHERE engedelyezes = 0 AND name = '{$_SESSION['name']}'";
    $eredmeny = mysqli_query($dbconnect, $kitiltas);
    if (mysqli_num_rows($eredmeny) > 0) {
      header("location: kitiltottOldal.php");
    }
  }
}

$sql = "SELECT termek.id, termek.termekNev, termek.foto, termek.darab, termek.ar, COUNT(termek.termekNev) AS 'kedveles' FROM `kedvenctermekek` INNER JOIN termek ON kedvenctermekek.termekId=termek.id GROUP BY termek.termekNev ORDER BY kedveles DESC LIMIT 15;";
$eredmeny = mysqli_query($dbconnect, $sql);

if ((mysqli_num_rows($eredmeny)) < 1) {
  $kimenet = "<article>
    <h2>Nincs kedvelt termékek</h2>
    </article>";
} else {
  $kimenet = "";
  while ($sor = mysqli_fetch_assoc($eredmeny)) {
    $kedvenc = $sor['kedveles'];
    if ($kedvenc >= 1) {
      $kimenet .=
        <<<URLAP
      <div class=" kedvenc">
        <div>
          <a href=adat.php?id={$sor['id']}">
          <h2 style="word-wrap: normal;">{$sor['termekNev']}</h2>
          <img src="img/termekekuj/{$sor['foto']}" alt="{$sor['foto']} "></a>
      </div>
        
    
    
    URLAP;
    
    }
  }
}


 





?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

  <meta name="description" content="Itt található az összes kategória"> <!--Keresőmotor optimalizáláshoz kellenek ezen kódsorok -->
  <meta name="keywords" content="PC Webshop, Számítógép Webshop, Számítógépes Webshop, Számítógép szaküzlet, Processzor, Videókártya, Gépház, Processzor hűtő, Rendszerhűtő, Tápegység, Memória, RAM, SSD, Alaplap">
  <meta name="author" content="Laczka Adrián Zsolt, Seres Szabolcs">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <link rel="stylesheet" href="admin/admincss/flexbox.css">
  <link rel="stylesheet" href="admin/admincss/sablon.css">
  <link rel="stylesheet" href="admin/admincss/oldal.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/feliratkozas.css">
  <link rel="stylesheet" href="css/cookie.css">
  <link rel="stylesheet" href="css/animation.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <link rel="stylesheet" href="css/navbar.css">
  <script src="sweetalert2.all.min.js"></script>
  <script src="sweetalert2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Számítógép webshop</title>
</head>

<body>
  

<header>
    <nav class="navbar">
    <div class="brand">
        <span>Seres és Társa.Kft</span>
      </div>
      <button aria-label="toggle menu" id="responsiveToggleButton">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="openIcon"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
          />
        </svg>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="closeIcon"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>

      </button>
      <div class="navbar-links">
      <ul class="menu">
    <li class="item button"><a href="index.php" id="foOldalButton" class="borderStyle">Főoldal</a></li>
    <li class="item button"><a href="kapcsolat.html" class="borderStyle">Kapcsolat</a></li>

    <?php

        if (isset($_SESSION['user_type'])) {
          if ($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin') {
          }
        } else {
          echo '<li class="item button"><a href="foBejelentkezes.php" class="borderStyle">Bejelentkezés</a></li>';
        }
        ?>

<li><a> <?= (isset($_SESSION['user_type']) ? ($_SESSION['user_type'] == 'user' ? "<li class='item button'><span style='color:blue; padding-right:10px;'  class='fas fa-address-book borderStyle'> </span>" . $_SESSION['name'] . "</li>" : "<li class='borderStyle2'><span style='color:red; padding-right:10px;'  class='fas fa-address-book'> </span>" . $_SESSION['name'] . "</li>" . "<li class='item button'><a href = admin/kategoria.php class='borderStyle' style='color:red'>Admin oldal</a></li>") : ""); ?> </a></li>

<?php

        if (isset($_SESSION['user_type'])) {
          if ($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin') {
            echo '<li class="item button secondary"><a href="Kijelentkezes.php" class="logout borderStyle">Kijelentkezés</a></li> ';
          }
        }
        ?>

    </li>
    
  </ul>
      </div>
    </nav>
  </header>
  
  <div class="udvozlo">
    <h1 class='udvozles'>Akciós termékek a kínálatunkban</h1>
  </div>
  <div class="akcioIdoDiv">
    <h3 style="color:white; padding:5px">Akció lejáratáig </h3>
    <div id="divCounter" style="color:red; display:flex; justify-content:center; align-items:center"></div>
    <h3 style="color:white; padding:5px"> van hátra</h3>
  </div>
  

  <div id="countdown" style="color:red"></div>
  

  <?php require("animationHeader.php") ?>
  


<?php 
  
?>
  <a href="/Webshop/admin/kategoria.php"></a>
  <main id="main">
    <!-- <hr> -->
    <h1 id="kategoria">Számítógép alkatrész kategória</h1>
    <div>
      <div class="grid-container">
      <div class="hover-img oszlop1"><a href="processzor.php">
          <img src="img/processzorok-1920x960.jpg" alt="" width="100%">
          <figcaption>
            
              <h3>Processzor</h3>
            
          </figcaption>
        </div></a>
        <div class="hover-img oszlop2">
          <a href="processzorHuto.php"><img src="img/procHuto.jpg" alt="" width="100%">
          <figcaption>
              <h3>Processzorhűtő</h3>
            
          </figcaption>
        </div></a>
        <div class="hover-img oszlop3">
          <a href="alaplap.php"><img src="img/alaplap.jpg" alt="" width="100%">
          <figcaption>
            
              <h3>Alaplap</h3>
            
          </figcaption>
        </div></a>
        <div class="hover-img oszlop4">
          <a href="videokartya.php"><img src="img/videokartya.jpg" alt="" width="100%">
          <figcaption>

            
              <h3>Videókártya</h3>
            
          </figcaption>
        </div></a>
        <div class="hover-img oszlop5">
          <a href="ram.php"><img src="img/memoria.jpg" alt="" width="100%" style="background: transparent;">
          <figcaption>

            Memória</h3>
          </figcaption>
        </div></a>
        <div class="hover-img oszlop6">
          <a href="rendszerHuto.php"><img src="img/rendszerhuto.jpg" alt="" width="100%">
          <figcaption>
              <h3>Rendszerhűtő</h3>
          </figcaption>
        </div></a>
        <div class="hover-img oszlop7">
          <a href="ssd.php"><img src="img/ssd.jpg" alt="" width="100%">
          <figcaption>
            
              <h3>SSD</h3>
          </figcaption>
        </div></a>
        <div class="hover-img oszlop8">
        <a href="tapegyseg.php"><img src="img/tapegyseg.jpg" alt="" width="100%">
          <figcaption>
            
              <h3>Tápegység</h3>
            

          </figcaption>
        </div></a>
        <div class="hover-img oszlop9">
          <a href="gephaz.php"><img src="img/gephaz.jpg" alt="" width="100%">
          <figcaption>
            
              <h3>Számítógépház</h3>
            
          </figcaption>
        </div></a>
      </div>

    </div>
    </div>
    <div class="kedvencScroll">
      <h1 class="kedvencH1">Népszerű termékek</h1>
      <?php print_r($kimenet) ?>
    </div>
  </main>


  <footer class="footer">
    <div class="container">
      <div class="sor">
        <div class="footer-col">
          <h4>Információk</h4>
          <ul>
            <li><a href="#">Rólunk</a></li>
            <li><a href="#">Szerződési feltételek</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Oldaltérkép</h4>
          <ul>
            <li><a href="#">Főoldal</a></li>
            <li><a href="#">Bejelentkezés</a></li>
            <li><a href="#">Kapcsolat</a></li>
            <li><a href="#">Népszerű termékek</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Webshop</h4>
          <ul>
            <li><a href="#">Processzor</a></li>
            <li><a href="#">Processzorhűtő</a></li>
            <li><a href="#">Alaplap</a></li>
            <li><a href="#">Videókártya</a></li>
            <li><a href="#">Memória</a></li>
            <li><a href="#">Rendszerhűtő</a></li>
            <li><a href="#">SSD</a></li>
            <li><a href="#">Tápegység</a></li>
            <li><a href="#">Számítógépház</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Kapcsolat</h4>
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



  <div id="cookiePopup">
    <img src="img/cookie.png" />
    <p>
      Ez a webhely a Google-tól származó cookie-kat használ szolgáltatásai biztosításához és a forgalom elemzéséhez.
    </p>
    <button id="acceptCookie">Elfogadom</button>
  </div>

  

  <script src="js/script.js"></script>
  <script src="js/index.js"></script>
  <!-- <script src="../js/script.js"></script> -->
  <script src="js/navbar.js"></script>
</body>

</html>