<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="../css/oldal.css">
  <link rel="stylesheet" href="../css/flexbox.css">
  <link rel="stylesheet" href="css/gombok.css">
  <link rel="stylesheet" href="css/table.css">
  
  <title>Admin oldal</title>
  <script src="/js/input.js"></script>
</head>

<body>
  <header>

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
    <h2 id="kategoria">Táblák</h2>
    <p class="gombok"><a href="felvetel.php"><button>Új gyártó hozzáadása</button></a> | <a href="felvetel_2.php"><button>Új adat hozzáadása</button></a> | <a href="felvetel.php"><button>Kijelentkezés</button></a></p>
    <form method="post">
      <input type="text" name="search_text" id="search_text" placeholder="Keresés">
    </form>
    <div class="main">
      <div class="flexbox-container" id="result">

      </div>
    </div>


    
      <script src="../js/script.js"></script>
      <script src="js/search.js"></script>
      
</body>

</html>