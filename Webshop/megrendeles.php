<?php 


require('kapcsolat.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if(isset($_POST['rendben'])){
    $veznev = $_POST['last-name'];
    $kernev = $_POST['first-name'];
    $kartyaszam = $_POST['card'];
    $kod = $_POST['code'];
    $telefon = $_POST['phone'];
    $cim = $_POST['cim'];
    $varos = $_POST['varos'];
    $megye = $_POST['megye'];
  

  $sql = "UPDATE `users` INNER JOIN megrendeles ON megrendeles.usersId=users.id SET `keresztNev`='{$kernev}',`vezetekNev`='{$veznev}',`kartyaszam`='{$kartyaszam}',`kartyaKod`='{$kod}',`telefonszam`='{$telefon}',`kiszallitasiCim`='{$cim}',`varos`='{$varos}',`megye`='{$megye}' WHERE megrendeles.usersId=users.id";
  $sql;
  $eredmeny = mysqli_query($dbconnect, $sql);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Rendelés részletei</title>
    <link rel="stylesheet" type="text/css" href="https://demo.plantpot.works/assets/css/normalize.css">
    <link rel="stylesheet" href="https://use.typekit.net/opg3wle.css">
    <link rel="stylesheet" type="text/css" href="../css/order.css">
  </head>
  <body>
    <div id="container">    
    
      <div class="form-box login-section">
        
        <form class="c-form login" name="c-form" method="post">
          <div class="two-columns">
            <fieldset>
              <label class="c-form-label" for="last-name">Keresztnév<span class="c-form-required"> *</span></label>
              <input id="last-name" class="c-form-input" type="text" name="last-name" placeholder="Ön keresztneve" required>
            </fieldset>

            <fieldset>
              <label class="c-form-label" for="first-name">Vezetéknév<span class="c-form-required"> *</span></label>
              <input id="first-name" class="c-form-input" type="text" name="first-name" placeholder="Ön vezetékneve" required>
            </fieldset>
          </div>
          <div class="two-columns">
            <fieldset>
              <label class="c-form-label" for="card">Bankkártyaszám<span class="c-form-required"> *</span></label>
              <input id="card" class="c-form-input" type="text" name="card" placeholder="Ön kártyaszáma" required>
            </fieldset>

            <fieldset>
              <label class="c-form-label" for="code">CVV Kód<span class="c-form-required"> *</span></label>
              <input id="code" class="c-form-input" type="text" name="code" placeholder="XXX    " required>
            </fieldset>
          </div>

          <fieldset>
            <label class="c-form-label" for="phone">Telefonszám<span class="c-form-required"> *</span></label>
            <input id="phone" class="c-form-input" type="tel" name="phone" placeholder="0630 234 2455" required>
          </fieldset>
          <div class="two-columns">
            <fieldset>
              <label class="c-form-label" for="cim">Kiszállítási cím<span class="c-form-required"> *</span></label>
              <input id="cim" class="c-form-input" type="text" name="cim" placeholder="Ön lakcíme" required>
            </fieldset>

            <fieldset>
              <label class="c-form-label" for="varos">Város<span class="c-form-required"> *</span></label>
              <input id="varos" class="c-form-input" type="text" name="varos" placeholder="City" required>
            </fieldset>
            <fieldset>
              <label class="c-form-label" for="megye">Megye<span class="c-form-required"> *</span></label>
              <input id="megye" class="c-form-input" type="text" name="megye" placeholder="Megye" required>
            </fieldset>
          </div>
          <input type="submit" value="Rendelés véglegesítése" class="c-form-btn" id="rendben" name="rendben" >
        </form>
      </div>
    </div>
    <script src="../js/order.js"></script>
  </body>
</html>