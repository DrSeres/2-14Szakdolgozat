<?php

require("kapcsolat.php");
session_start();
$id = (int)$_GET['id'];
$sql = "SELECT * FROM termek INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId WHERE id   = {$id};";

$eredmeny = mysqli_query($dbconnect, $sql);

require("url.php");

$kimenet = "";
while ($sor = mysqli_fetch_assoc($eredmeny)) {

  $cim = "{$sor['gyartoNev']} {$sor['termekNev']}";

  $dealPriceText = "<h3 >Ár: " . number_format($sor['ar'], 0, ',', ' ') . " Ft</h3>";

  if (isset($_GET["deal"]) && $_GET["deal"] == 1) {
    $dealPriceText = "<h3 class='strikeThrough '>Eredeti ár: " . number_format($sor['ar'], 0, ',', ' ') . " Ft</h3>";
    $dealPriceText .= "<h3>Új ár: " . number_format(($sor['ar'] * 0.8), 0, ',', ' ') . " Ft</h3>";
  }

  $kimenet .= "
    <div class=\"main\">
        <div class=\"grid-container\">
            
        </div>
        
        <div class=\"leiras\">
            {$sor['leiras']}
        </div>

        <div class=\"kosar\">
            <form action=\"\" method=\"post\">
              {$dealPriceText}
            </form>
        </div>
    </div>";

  $adat = "{$sor['gyartoNev']} {$sor['termekNev']}";
}

$url = htmlspecialchars($_SERVER['HTTP_REFERER']);



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="css/oldal.css">
  <link rel="stylesheet" href="css/grid.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/navbar.css">

  <link rel="stylesheet" href="sweetalert2.min.css">
  <script src="sweetalert2.all.min.js"></script>
  <script src="sweetalert2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title><?php print_r($cim); ?></title>
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
        <?php
        if (isset($_SESSION['user_type'])) {
          if ($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin') {
            echo  '<div class="kosaricon">
                    <p>0</p> <i class="fa fa-shopping-cart"></i>
                </div>';
          }
        }
        ?>
        <ul class="list-item">
          <li class="item button "><a href="index.php" class="borderStyle">Főoldal</a></li>
          <?php
          if (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin') {
              echo '<li class="item button"><a href="kedvenctermek.php" class="borderStyle">Kedvenc termékek</a></li>';
            }
          }
          ?>
          <li class="item button"><a href="kapcsolat.html" class="borderStyle">Kapcsolat</a></li>

          <?php

          if (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin') {
            }
          } else {
            echo '<li class="item button"><a href="foBejelentkezes.php" class="borderStyle">Bejelentkezés</a></li>';
          }
          ?>

          <li><a> <?= (isset($_SESSION['user_type']) ? ($_SESSION['user_type'] == 'user' ? "<li class='borderStyle2'><span style='color:blue; padding-right:10px;'  class='fas fa-address-book'> </span>" . $_SESSION['name'] . "</li>" : "<li class='borderStyle2'><span style='color:red; padding-right:10px;'  class='fas fa-address-book'> </span>" . $_SESSION['name'] . "</li>" . "<li class='item button'><a href = admin/kategoria.php class='borderStyle' style='color:red'>Admin oldal</a></li>") : ""); ?> </a></li>

          <?php

          if (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin') {
              echo '<li class="item button secondary"><a href="Kijelentkezes.php" class="logout borderStyle">Kijelentkezés</a></li> ';
              echo '<div id="divCounter" style="color:Red; display:flex; justify-content:center; align-items:center"></div>';
            }
          }
          ?>


          </li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="oldalLogo">
    <div class="detailsArea">
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
    <?php print_r($kimenet); ?>
    <!-- <hr> -->
    <div class="vasarlas feliratkozas">
      <h2>Iratkozzon fel hírlevelünkre</h2>
      <input type="email" name="email" id="email" placeholder='Írja be E-mail címet' required>
      <button type="submit">Feliratkozás</button>
    </div>
  </main>
  <!--Kosár tartalma-->
  <div class="cartBox">
    <div class="cart">
      <!--A gomb, mivel majd bezárjuk-->
      <i class="fa fa-close">X</i>
      <h1>Kosár tartalma</h1>
      <!--Táblázat, ahol a termékek kerülnek-->
      <div style="overflow-y:auto; height:350px; overflow-x:hidden;" class="tableScrollBar">
        <table></table>
      </div>
    </div>
  </div>
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
            <li><a href="index.php">Főoldal</a></li>
            <li><a href="foBejelentkezes.php">Bejelentkezés</a></li>
            <li><a href="kapcsolat.html">Kapcsolat</a></li>
            <li><a href="kedvenctermek.php">Népszerű termékek</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Webshop</h4>
          <ul>
            <li><a href="processzor.php">Processzor</a></li>
            <li><a href="processzorHuto.php">Processzorhűtő</a></li>
            <li><a href="alaplap.php">Alaplap</a></li>
            <li><a href="videokartya.php">Videókártya</a></li>
            <li><a href="ram.php">Memória</a></li>
            <li><a href="rendszerHuto.php">Rendszerhűtő</a></li>
            <li><a href="ssd.php">SSD</a></li>
            <li><a href="tapegyseg.php">Tápegység</a></li>
            <li><a href="gephaz.php">Számítógépház</a></li>
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

  <script src="js/script.js"></script>
  <script src="js/index.js"></script>
  <script src="js/navbar.js"></script>

</body>

</html>