<?php 

require("kapcsolat.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$sql = "SELECT * FROM termek LIMIT 7";

$eredmeny = mysqli_query($dbconnect, $sql);
$ki = '<div class="container">
<div class="row">
    <div class="main_drag roomy-50">
        <div class="col-md-12">
            <div class="swiper-container">
                <div class="swiper-wrapper">';

while($sor = mysqli_fetch_assoc($eredmeny)){
$foto = $sor['foto'];

$ki .= 

<<<URLAP
<div class="swiper-slide">
<div class="card">
    <img class="card-img-top" src="../Webshop/img/termekekuj/{$foto}" alt="Tetőlemezek">
    <div class="card-body">
        <h3 class="card-title">{$sor['termekNev']}<br>
          
        </h3>
        <a href="lemezek.html" class="btn btn-primary">Bővebben</a>
    </div>
</div>
</div>
URLAP;


}

$ki .= ' </div>
</div>
</div>
</div>';







?>
<!DOCTYPE html>
<html class="no-js" lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS-ek-->
    <link rel="stylesheet" href="css/swiper.min.css">
    <link rel="stylesheet" href="css/animate.css">


    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style1.css"> -->
   <link rel="shortcut icon" href="pics/logo.jpg" type="image/x-icon">
    <Title>Low-power Kft.</Title>

</head>

<body>

    <?php print($ki)?>




   
    <!--Javascriptek-->
    
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>

</body>

</html>