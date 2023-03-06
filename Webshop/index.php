<?php

require('kapcsolat.php');

session_start();

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
  <link rel="stylesheet" href="../css/sablon.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>Számítógép webshop</title>
</head>

<body>
  <header>
    <nav>
      <ul>
        <li><a href="index.php">Főoldal</a></li>
        <li><a href="">Üzleteink</a></li>
        <li><a href="kapcsolat.html">Kapcsolat</a></li>
  
        <?php 
        
        if(isset($_SESSION['user_type'])){
          if($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin'){
            
          }
        }
        else
        {
          echo '<li><a href="foBejelentkezes.php">Bejelentkezés</a></li>';
        }
        ?>
 
        
        <li><a> <?= (isset($_SESSION['user_type']) ? ($_SESSION['user_type'] == 'user' ? "<span style='color:blue'> Üdvözöllek </span>" . $_SESSION['name'] : "<span style='color:red'> Üdvözöllek Admin </span>" . $_SESSION['name']) : "") ; ?> </a></li>
        
        <?php 
        
        if(isset($_SESSION['user_type'])){
          if($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin'){
            echo '<li><a href="Kijelentkezes.php" class="logout">Kijelentkezés</a></li>';
        }
      }
        ?>
      </ul>

    </nav>"
  </header>
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
        <h1>Üdvözöllek az oldalon</h1>
        <p>Termék kategóriáink megtekintése</p>
        <a href="#main"><i class="fa fa-chevron-circle-down" style="font-size:36px"></i></a>
      </div>
    </div>
    <!-- <img src="../img/gaming header Oldal.jpg" alt="gaming header" title="gaming header" width="100%"> -->




    <!-- <div class='console-container'><span id='text' style="font-weight: 900;"></span><div class='console-underscore' id='console'>&#95;</div></div> -->
  </div>






  <!-- <div class="bg"></div>
    
    <div class="star-field">
    <div class="layer"></div>
    <div class="layer"></div>
    <div class="layer"></div> -->
  <main id="main">
    <!-- <hr> -->
    <h2 id="kategoria">Kategóriák</h2>
    <div class="main">
      <div class="grid-container">
        <div class="oszlop1 hover-img">
          <a href="asd"><img src="img/processzorok-1920x960.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="processzor.php">
              <h3>Processzor</h3>
            </a>
          </figcaption>
        </div>
        <div class="oszlop2 hover-img">
          <a href="asd"><img src="img/procHuto.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="processzorHuto.php">
              <h3>Processzorhűtő</h3>
            </a>
          </figcaption>
        </div>
        <div class="oszlop3 hover-img">
          <a href="asd"><img src="img/alaplap.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="alaplap.php">
              <h3>Alaplap</h3>
            </a>
          </figcaption>
        </div>
      
      
        <div class="oszlop4 hover-img">
          <a href="asd"><img src="img/videokartya.jpg" alt="" width="100%"></a>
          <figcaption>

            <a href="videokartya.php">
              <h3>Videókártya</h3>
            </a>
          </figcaption>
        </div>
        <div class="oszlop5 hover-img">
          <a href="asd"><img src="img/memoria.jpg" alt="" width="100%" style="background: transparent;"></a>
          <figcaption>

            <a href="ram.php">
              <h3>Memória</h3>
            </a>
          </figcaption>
        </div>
        <div class="oszlop6 hover-img">
          <a href="asd"><img src="img/rendszerhuto.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="rendszerHuto.php">
              <h3>Rendszerhűtő</h3>
            </a>
          </figcaption>
        </div>
      
      
        <div class="oszlop7 hover-img ">
          <a href="asd"><img src="img/ssd.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="ssd.php">
              <h3>SSD</h3>
            </a>
          </figcaption>
        </div>
        <div class="oszlop8 hover-img">
          <img src="img/tapegyseg.jpg" alt="" width="100%">
          <figcaption>
            <a href="tapegyseg.php">
              <h3>Tápegység</h3>
            </a>

          </figcaption>
        </div>
        <div class="oszlop9 hover-img">
          <a href="asd"><img src="img/gephaz.jpg" alt="" width="100%"></a>
          <figcaption>
            <a href="gephaz.php">
              <h3>Számítógépház</h3>
            </a>
          </figcaption>
        </div>
      


        </div>
    </div>
    <!-- <hr> -->
    <div class="vasarlas">
      <h2>Tekintse meg ajánlatainkat</h2>
      <a href="webshop.php"><button type="button">Vásárlás most</button></a>
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





































  <script src="../js/script.js"></script>
</body>

</html>