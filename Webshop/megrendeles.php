<?php 


require('kapcsolat.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
echo $felhasznalo = $_SESSION['name']; 
if(isset($_POST['torles'])){
  $update = "UPDATE megrendeles SET torles = '1' WHERE status != 1";
  mysqli_query($dbconnect, $update);
  $delete = "DELETE FROM megrendeles WHERE status != 1 AND torles != 0";
  mysqli_query($dbconnect, $delete);
}else if(isset($_POST['rendben'])){

  $veznev = $_POST['last-name'];
  $kernev = $_POST['first-name'];
  $kartyaszam = $_POST['card'];
  $kod = $_POST['code'];
  $telefon = $_POST['phone'];
  $cim = $_POST['cim'];
  $varos = $_POST['varos'];
  $megye = $_POST['megye']; 
//Kártyaszám hosszának ellenőrzése
if (strlen($kartyaszam) > 19){
  $hibak[] = "Túl hosszú bankkártyaszámnak!";
} elseif (strlen($kartyaszam) < 19) {
  $hibak[] = "Túl rövid bankkártyaszámnak!";
}

//telefonszám hosszának ellenőrzése
if(!$telefon){
  $hibak[] = "Nem adott meg telefonszámot!";
} else if (strlen($telefon) != 11) {
  $hibak[] = "Ez nem magyar telefonszám!";
}

//CVV kód hosszának ellenőrzése
if (strlen($kod) != 3) {
  $hibak[] = "3 számjegynek kell szerepelnie!";
}
if (isset($hibak)) {
  
  $kimenet = "<div style=\"background-color: #A50000\">";
  $kimenet.= "<h2 style=\"color: white; margin: 0px;\">HIBÁS ADATOK VANNAK MEGADVA!</h2>";
  foreach ($hibak as $hiba) {
    
      $kimenet .= "<p style=\"color: white;\"><b>X</b> {$hiba}</p>";
  }
  $kimenet.= "</div>";
} else {
  $sql = "UPDATE `users` INNER JOIN megrendeles ON megrendeles.usersId=users.id SET `keresztNev`='{$kernev}',`vezetekNev`='{$veznev}',`kartyaszam`='{$kartyaszam}',`kartyaKod`='{$kod}',`telefonszam`='{$telefon}',`kiszallitasiCim`='{$cim}',`varos`='{$varos}',`megye`='{$megye}' WHERE megrendeles.usersId=users.id";
  $eredmeny = mysqli_query($dbconnect, $sql);

  $update = "UPDATE termek INNER JOIN megrendeles ON termek.id=megrendeles.termekId SET darab=darab-megrendeles.raktaron, `status` = 1 WHERE megrendeles.termekId=termek.id AND megrendeles.status != 1";
  mysqli_query($dbconnect, $update);
  header("location:koszonjuk.php");
}
}

$select = "SELECT * FROM users WHERE mentve = 1 AND name = '{$_SESSION['name']}'";
      $query  = mysqli_query($dbconnect, $select);
      

        if(mysqli_num_rows($query) > 0){
          $sor = mysqli_fetch_assoc($query);
      $veznev = $sor['vezetekNev'];
      $kernev = $sor['keresztNev'];
      $kartyaszam = $sor['kartyaszam'];
      $kod = $sor['kartyaKod'];
      $telefon = $sor['telefonszam'];
      $cim = $sor['kiszallitasiCim'];
      $varos = $sor['varos'];
      $megye = $sor['megye'];
  $form = '
      
      
      <div class="form-box login-section">
      <?php if (isset($kimenet)) print $kimenet; ?>
      <h2 class="veglegesitesTermek">Termék(ek) megrendelésének véglegesítése</h2>
      <form class="c-form login" name="c-form" method="post">
      <details>
      <summary>Személyes adatok módosítása a véglegesítés előtt</summary>
        <div class="two-columns">
          <fieldset>
            <label class="c-form-label" for="last-name">Keresztnév<span class="c-form-required"> *</span></label>
            <input id="last-name" class="c-form-input" type="text" name="last-name" placeholder="Ön keresztneve" value = '. "{$veznev}" . '>
          </fieldset>
  
          <fieldset>
            <label class="c-form-label" for="first-name">Vezetéknév<span class="c-form-required"> *</span></label>
            <input id="first-name" class="c-form-input" type="text" name="first-name" placeholder="Ön vezetékneve" value = '. "{$kernev}" . '>
          </fieldset>
        </div>
        <div class="two-columns">
          <fieldset>
            <label class="c-form-label" for="card">Bankkártyaszám<span class="c-form-required"> *</span></label>
            <input id="card" class="c-form-input" type="text" name="card" placeholder="Ön kártyaszáma" value = '. "{$kartyaszam}" . '>
          </fieldset>
  
          <fieldset>
            <label class="c-form-label" for="code">CVV Kód<span class="c-form-required"> *</span></label>
            <input id="code" class="c-form-input" type="text" name="code" placeholder="XXX    " value = '. "{$kod}" . '>
          </fieldset>
        </div>
  
        <fieldset>
          <label class="c-form-label" for="phone">Telefonszám<span class="c-form-required"> *</span></label>
          <input id="phone" class="c-form-input" type="tel" name="phone" placeholder="0630 234 2455" value = '. "{$telefon}" . '>
        </fieldset>
        <div class="two-columns">
          <fieldset>
            <label class="c-form-label" for="cim">Kiszállítási cím<span class="c-form-required"> *</span></label>
            <input id="cim" class="c-form-input" type="text" name="cim" placeholder="Ön lakcíme" value = '. "{$cim}" . '>
          </fieldset>
  
          <fieldset>
            <label class="c-form-label" for="varos">Város<span class="c-form-required"> *</span></label>
            <input id="varos" class="c-form-input" type="text" name="varos" placeholder="City" value = '. "{$varos}" . '>
          </fieldset>
          <fieldset>
            <label class="c-form-label" for="megye">Megye<span class="c-form-required"> *</span></label>
            <input id="megye" class="c-form-input" type="text" name="megye" placeholder="Megye" value = '. "{$megye}" . '>
          </fieldset>
        </div>
        </details>
        <input type="submit" value="Rendelés véglegesítése" class="c-form-btn" id="rendben" name="rendben">
        <input type="submit" value="Megrendelés törlése" class="c-form-btn" id="torles" name="torles">
      </form>
    </div>
    
    
    ';
    if(isset($_POST['rendben'])){
      $sql = "UPDATE `users` INNER JOIN megrendeles ON megrendeles.usersId=users.id SET `keresztNev`='{$kernev}',`vezetekNev`='{$veznev}',`kartyaszam`='{$kartyaszam}',`kartyaKod`='{$kod}',`telefonszam`='{$telefon}',`kiszallitasiCim`='{$cim}',`varos`='{$varos}',`megye`='{$megye}' WHERE megrendeles.usersId=users.id";
      $eredmeny = mysqli_query($dbconnect, $sql);

      $update = "UPDATE termek INNER JOIN megrendeles ON termek.id=megrendeles.termekId SET darab=darab-megrendeles.raktaron, `status` = 1 WHERE megrendeles.termekId=termek.id AND megrendeles.status != 1";
      mysqli_query($dbconnect, $update);
      header("location:koszonjuk.php");
    }
    
  
   
        }else{
          $form = '<div class="form-box login-section">
    <?php if (isset($kimenet)) print $kimenet; ?>
    <h2 class="veglegesitesTermek">Termék(ek) megrendelésének véglegesítése</h2>
    <form class="c-form login" name="c-form" method="post">
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label" for="last-name">Keresztnév<span class="c-form-required"> *</span></label>
          <input id="last-name" class="c-form-input" type="text" name="last-name" placeholder="Ön keresztneve">
        </fieldset>

        <fieldset>
          <label class="c-form-label" for="first-name">Vezetéknév<span class="c-form-required"> *</span></label>
          <input id="first-name" class="c-form-input" type="text" name="first-name" placeholder="Ön vezetékneve" >
        </fieldset>
      </div>
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label" for="card">Bankkártyaszám<span class="c-form-required"> *</span></label>
          <input id="card" class="c-form-input" type="text" name="card" placeholder="Ön kártyaszáma" >
        </fieldset>

        <fieldset>
          <label class="c-form-label" for="code">CVV Kód<span class="c-form-required"> *</span></label>
          <input id="code" class="c-form-input" type="text" name="code" placeholder="XXX    " >
        </fieldset>
      </div>

      <fieldset>
        <label class="c-form-label" for="phone">Telefonszám<span class="c-form-required"> *</span></label>
        <input id="phone" class="c-form-input" type="tel" name="phone" placeholder="0630 234 2455" >
      </fieldset>
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label" for="cim">Kiszállítási cím<span class="c-form-required"> *</span></label>
          <input id="cim" class="c-form-input" type="text" name="cim" placeholder="Ön lakcíme" >
        </fieldset>

        <fieldset>
          <label class="c-form-label" for="varos">Város<span class="c-form-required"> *</span></label>
          <input id="varos" class="c-form-input" type="text" name="varos" placeholder="City" >
        </fieldset>
        <fieldset>
          <label class="c-form-label" for="megye">Megye<span class="c-form-required"> *</span></label>
          <input id="megye" class="c-form-input" type="text" name="megye" placeholder="Megye" >
        </fieldset>
      </div>
      <label class="adatokMarad" for="adatokMarad"><input type="checkbox" name="adatokMarad" id="adatokMarad" value="A"/> 
      Adatok elmentése</label>  
      <input type="submit" value="Rendelés véglegesítése" class="c-form-btn" id="rendben" name="rendben">
      <input type="submit" value="Megrendelés törlése" class="c-form-btn" id="torles" name="torles">
    </form>
  </div>';
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

    
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
  </head>
  <body>
    <div id="container">    
      <?php print $form ?>
    </div>
      <script src="../js/megrendeles.js"></script>
  </body>
 
</html>