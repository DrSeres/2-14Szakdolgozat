<?php

require('kapcsolat.php');

session_start();

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
      <div class="card kedvenc">
        <div>
          <a href=processzor_adat.php?id={$sor['id']}">
          <h2>{$sor['termekNev']}</h2>
          <img src="../LAZs/Szakdolgozat/img/termekekuj/{$sor['foto']}" alt="{$sor['foto']} "></a>
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
  <link rel="stylesheet" href="../LAZs/Szakdolgozat/css/oldal.css">
  <link rel="stylesheet" href="../LAZs/Szakdolgozat/css/flexbox.css">
  <link rel="stylesheet" href="../LAZs/Szakdolgozat/css/sablon.css">
  <link rel="stylesheet" href="../LAZs/Szakdolgozat/css/oldal.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/feliratkozas.css">
  <link rel="stylesheet" href="../css/cookie.css">
  <link rel="stylesheet" href="../css/animation.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <script src="sweetalert2.all.min.js"></script>
  <script src="sweetalert2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Számítógép webshop</title>
</head>

<body>
  <header>
    <nav>
      <ul>
        <li><a href="index.php">Főoldal</a></li>
        <li><a href="kapcsolat.html">Kapcsolat</a></li>

        <?php

        if (isset($_SESSION['user_type'])) {
          if ($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin') {
          }
        } else {
          echo '<li><a href="foBejelentkezes.php">Bejelentkezés</a></li>';
        }
        ?>


        <li><a> <?= (isset($_SESSION['user_type']) ? ($_SESSION['user_type'] == 'user' ? "<span style='color:blue'> Üdvözöllek </span>" . $_SESSION['name'] : "<span style='color:red; padding-right:10px;'  class='fas fa-address-book'> </span>" . $_SESSION['name'] . "<li><a href = ../LAZs/Szakdolgozat/admin/kategoria.php style='color:red'>Admin oldal</a></li>") : ""); ?> </a></li>

        <?php

        if (isset($_SESSION['user_type'])) {
          if ($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin') {
            echo '<li style="float:right"><a href="Kijelentkezes.php" class="logout">Kijelentkezés</a></li> ';
          }
        }
        ?>
      </ul>

    </nav>"

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
        <h1>Üdvözöllek az oldalon</h1>
        <p class="udvozloP">Termék kategóriáink megtekintése</p>
        <a href="#main"><i class="fa fa-chevron-circle-down" style="font-size:36px"></i></a>
      </div>
    </div>
  </div>

        

</div>
  <a href="../LAZs/Szakdolgozat/admin/kategoria.php"></a>
  <main id="main">
    <!-- <hr> -->
    <h2 id="kategoria">Kategóriák</h2>
    <div class="main">
      <div class="grid-container">
        <div class="hover-img oszlop1">
          <a href="asd"><img src="../img/processzorok-1920x960.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="processzor.php">
              <h3>Processzor</h3>
            </a>
          </figcaption>
        </div>
        <div class="hover-img oszlop2">
          <a href="asd"><img src="../img/procHuto.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="processzorHuto.php">
              <h3>Processzorhűtő</h3>
            </a>
          </figcaption>
        </div>
        <div class="hover-img oszlop3">
          <a href="asd"><img src="../img/alaplap.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="alaplap.php">
              <h3>Alaplap</h3>
            </a>
          </figcaption>
        </div>
        <div class="hover-img oszlop4">
          <a href="asd"><img src="../img/videokartya.jpg" alt="" width="100%"></a>
          <figcaption>

            <a href="videokartya.php">
              <h3>Videókártya</h3>
            </a>
          </figcaption>
        </div>
        <div class="hover-img oszlop5">
          <a href="asd"><img src="../img/memoria.jpg" alt="" width="100%" style="background: transparent;"></a>
          <figcaption>

            <a href="ram.php">Memória</h3></a>
          </figcaption>
        </div>
        <div class="hover-img oszlop6">
          <a href="asd"><img src="../img/rendszerhuto.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="rendszerHuto.php">
              <h3>Rendszerhűtő</h3>
            </a>
          </figcaption>
        </div>
        <div class="hover-img oszlop7">
          <a href="asd"><img src="../img/ssd.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="ssd.php">
              <h3>SSD</h3>
            </a>
          </figcaption>
        </div>
        <div class="hover-img oszlop8">
          <img src="../img/tapegyseg.jpg" alt="" width="100%">
          <figcaption>
            <a href="tapegyseg.php">
              <h3>Tápegység</h3>
            </a>

          </figcaption>
        </div>
        <div class="hover-img oszlop9">
          <a href="gephaz.php"><img src="../img/gephaz.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="gephaz.php">
              <h3>Számítógépház</h3>
            </a>
          </figcaption>
        </div>
      </div>

    </div>
    </div>
    <div class="kedvencScroll">
      <h1 class="kedvencH1">Legkedveltebb termékek</h1>
      <?php print_r($kimenet) ?>
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



  <div id="cookiePopup" class="hide">
    <img src="../img/cookie.png" />
    <p>
      Ez a webhely a Google-tól származó cookie-kat használ szolgáltatásai biztosításához és a forgalom elemzéséhez.
    </p>
    <button id="acceptCookie">Elfogadom</button>
  </div>






























  <script src="../js/kijelentkezes.js"></script>
  <script src="../js/script.js"></script>
  <script src="../js/index.js"></script>
  <!-- <script src="../js/script.js"></script> -->
</body>

</html>