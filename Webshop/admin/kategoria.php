<?php 

session_start();
if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type'] != 'admin'){
        header("location:false.php");
    }
}


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("kapcsolat.php");

if(isset($_POST["akcios"]))
{
  $u = "UPDATE `termek` SET akcio = 0";
  mysqli_query($dbconnect, $u);
  $sors = "UPDATE termek SET akcio = 1 ORDER BY rand() LIMIT 5";
  mysqli_query($dbconnect, $sors);

}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="../admin/admincss/oldal.css">
  <link rel="stylesheet" href="../admin/admincss/flexbox.css"> 
  <link rel="stylesheet" href="../admin/css/gombok.css">
  <link rel="stylesheet" href="../admin/css/table.css">
  
  <title>Admin oldal</title>
  
</head>

<body>
  



  
  <main id="main">
    <!-- <hr> -->
    <h1 id="kategoria">Termékek</h1>
    <p class="gombok"><a href="felvetel.php"><button>Új gyártó hozzáadása</button></a>  <a href="felvetel_2.php"><button>Új termék hozzáadása</button></a>  <a href="kedvenc.php"><button>Népszerű termékek</button>  <a href="userMegrendeles.php"><button>Megrendelések megtekintése</button>   </a> <a href="felhasznalokKezelese.php"><button>Felhasználók kezelése</button>   </a> </p>
    <form method="post">
    <!-- <p class="gombok"><a href=""><button type="submit" name="akcios" id="akcios">Vissza a webshopra</button></a></p> -->
    <p class="gombok"><a href="../../Webshop/index.php"><button type="button" name="akcios" id="akcios">Vissza a webshopra</button></a></p>
    <h3 id="return-to-top"><i class="icon-arrow-up" style="color: white;"></i></h3>
    </form>
    <form method="post">
      <div class="input-div">
        <input type="text" name="search_text" id="search_text" placeholder="Keresés">
      </div>
    </form>
    <div class="main">
      <div class="flexbox-container" id="result">

      </div>
    </div>
      <script src="js/search.js"></script>
      <script src="js/input.js"></script>
</body>

</html>