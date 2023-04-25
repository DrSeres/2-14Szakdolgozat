<?php




require('kapcsolat.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$felhasznalo = $_SESSION['name'];

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";




// $telepulesek = "SELECT `users`.`name`, `telepulesek`.`irsz`, `telepulesek`.`nev`, `telepulesek`.`megye` FROM `users` LEFT JOIN `telepulesek` ON `telepulesek`.`id` = `users`.`telepules` WHERE users.telepules = telepulesek.id";
// mysqli_query($dbconnect, $telepulesek);







// $irszam = "SELECT telepulesek.id, telepulesek.irsz, telepulesek.nev FROM telepulesek";
// $eredmeny = mysqli_query($dbconnect, $irszam);




// while ($sor = mysqli_fetch_assoc($eredmeny)) {
//   $kiir .= "
//   <option value=\"{$sor['id']}\"> {$sor['nev']} ({$sor['irsz']})</option>";
// }

$kiir = "";

$select = "SELECT * FROM users WHERE mentve = 1 AND name = '{$felhasznalo}'";
$query  = mysqli_query($dbconnect, $select);

if (mysqli_num_rows($query) > 0) {
  $sor = mysqli_fetch_assoc($query);
  $veznev = $sor['vezetekNev'];
  $kernev = $sor['keresztNev'];
  $kartyaszam = $sor['kartyaszam'];
  $kod = $sor['kartyaKod'];
  $telefon = $sor['telefonszam'];


  $szallitasiCimSql = "
  SELECT m.telepules, m.utcaNev, m.hazszam FROM megrendeles as m INNER JOIN users as u ON m.usersId = u.id  WHERE u.name = '{$felhasznalo}' AND m.status = 1 AND m.szamlazva = 1
";

  $szamlazasiCimQuery = mysqli_query($dbconnect, $szallitasiCimSql);
  $szamlazasiCim = mysqli_fetch_assoc($szamlazasiCimQuery);

  if (mysqli_num_rows($szamlazasiCimQuery) > 0) {
    echo $utca = $szamlazasiCim["utcaNev"];
    echo $hazszam = $szamlazasiCim["hazszam"];
    echo $iranyitoszam = $szamlazasiCim["telepules"];




    // $irszam = "SELECT telepulesek.id, telepulesek.irsz, telepulesek.nev FROM telepulesek INNER JOIN users ON users.telepules = telepulesek.id WHERE users.name = '{$felhasznalo}'";
    // $eredmeny = mysqli_query($dbconnect, $irszam);

    $osszesTelepulesSql = "SELECT * FROM telepulesek";
    $osszesTelepulesQuery = mysqli_query($dbconnect, $osszesTelepulesSql);

    $kiir = "";
    while ($sor = mysqli_fetch_assoc($osszesTelepulesQuery)) {

      $selected = "";

      if ($iranyitoszam == $sor['id']) {
        $selected = "selected";
      } else {
        $selected = "";
      }

      $kiir .= "
      <option value=\"{$sor['id']}\" {$selected} > {$sor['nev']} ({$sor['irsz']})</option>";
    }


    $form = '
     
     
      <div class="form-box login-section">
      <h2 class="veglegesitesTermek">Termék(ek) megrendelésének véglegesítése</h2>
      <form class="c-form login" name="c-form" method="post">
      <details>
      <summary>Személyes adatok módosítása a véglegesítés előtt</summary>
        <div class="two-columns">
          <fieldset>
            <label class="c-form-label" for="last-name">Keresztnév<span class="c-form-required"> *</span></label>
            <input id="last-name" class="c-form-input" type="text" name="last-name" placeholder="Ön keresztneve" value = ' . "{$veznev}" . '>
          </fieldset>
 
          <fieldset>
            <label class="c-form-label" for="first-name">Vezetéknév<span class="c-form-required"> *</span></label>
            <input id="first-name" class="c-form-input" type="text" name="first-name" placeholder="Ön vezetékneve" value = ' . "{$kernev}" . '>
          </fieldset>
        </div>
        <div class="two-columns">
          <fieldset>
            <label class="c-form-label" for="card">Bankkártyaszám<span class="c-form-required"> *</span></label>
            <input id="card" class="c-form-input" type="text" name="card" placeholder="Ön kártyaszáma" value = ' . "{$kartyaszam}" . '>
          </fieldset>
 
          <fieldset>
            <label class="c-form-label" for="code">CVV Kód<span class="c-form-required"> *</span></label>
            <input id="code" class="c-form-input" type="text" name="code" placeholder="XXX    " value = ' . "{$kod}" . '>
          </fieldset>
        </div>
 
        <fieldset>
          <label class="c-form-label" for="phone">Telefonszám<span class="c-form-required"> *</span></label>
          <input id="phone" class="c-form-input" type="tel" name="phone" placeholder="0630 234 2455" value = ' . "{$telefon}" . '>
        </fieldset>
        <fieldset>
        
        <label class="c-form-label" for="address">Irányítószám:<span class="c-form-required"> *</span></label>
        <select name="iranyitoszam" id="iranyitoszam">
        ' . $kiir . '
        </select>
  
        </fieldset>
        <div class="two-columns">
        <fieldset>
        <label class="c-form-label" for="utca">Utca név:<span class="c-form-required"> *</span></label>
        <input id="utca" class="c-form-input" type="text" name="utca" placeholder="Utca név" value= ' . "{$utca}" . '>
      </fieldset>
      <fieldset>
        <label class="c-form-label" for="hazszam">Házszám:<span class="c-form-required"> *</span></label>
        <input id="hazszam" class="c-form-input" type="text" name="hazszam" placeholder="Házszám" value= ' . "{$hazszam}" . '>
      </fieldset>
        </div> 
        </details>
         
        <input type="submit" value="Rendelés véglegesítése" class="c-form-btn" id="rendben" name="rendben">
        <input type="submit" value="Megrendelés törlése" class="c-form-btn" id="torles" name="torles">

        
      </form>
    </div>
   
   
    ';
  }


  if (isset($_POST['torles'])) {
    $update = "UPDATE megrendeles SET torles = '1' WHERE status != 1";
    mysqli_query($dbconnect, $update);
    $delete = "DELETE FROM megrendeles WHERE status != 1 AND torles != 0";
    mysqli_query($dbconnect, $delete);
    header("Location:index.php");
  }
  if (isset($_POST['rendben'])) {

    $vezetekNev = $_POST['last-name'];
    $keresztNev = $_POST['first-name'];
    $kartyaszamNev = $_POST['card'];
    $kodNev = $_POST['code'];
    $telefonNev = $_POST['phone'];
    $utca = $_POST['utca'];
    $hazszam = $_POST['hazszam'];
    $idopont = date('Y-m-d');
    $iranyitoszam = $_POST["iranyitoszam"];
    $sql = "UPDATE `users` INNER JOIN megrendeles ON megrendeles.usersId=users.id SET `keresztNev`='{$keresztNev}',`vezetekNev`='{$vezetekNev}',`kartyaszam`='{$kartyaszamNev}',`kartyaKod`='{$kodNev}',`telefonszam`='{$telefonNev}',`utcaNev`='{$utca}', `hazszam` = '{$hazszam}', `telepules`='{$iranyitoszam}', `idopont`= '{$idopont}' WHERE users.name = '{$felhasznalo}' AND megrendeles.status = 0 AND megrendeles.szamlazva = 0";
    $eredmeny = mysqli_query($dbconnect, $sql);
    $update = "UPDATE termek INNER JOIN megrendeles ON termek.id=megrendeles.termekId SET darab=darab-megrendeles.raktaron, `status` = 1 WHERE megrendeles.termekId=termek.id AND megrendeles.status != 1";
    mysqli_query($dbconnect, $update);
    header("location:koszonjuk.php");

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
  }
} else {


  $irszam = "SELECT telepulesek.id, telepulesek.irsz, telepulesek.nev FROM telepulesek";
  $eredmenyQuery = mysqli_query($dbconnect, $irszam);

  $kiir = "";
  while ($sor = mysqli_fetch_assoc($eredmenyQuery)) {


    $kiir .= "
  <option value=\"{$sor['id']}\"> {$sor['nev']} ({$sor['irsz']})</option>";
  }

  $form = '<div class="form-box login-section">
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
        <input id="phone" class="c-form-input" type="tel" name="phone" placeholder="06302342455" >
      </fieldset>
      <fieldset>
        
        <label class="c-form-label" for="address">Irányítószám:<span class="c-form-required"> *</span></label>
        <select name="iranyitoszam" id="iranyitoszam">
        ' . $kiir . '
        </select> 
      </fieldset>
      <fieldset>
      

          </fieldset>
      <div class="two-columns">
        <fieldset>
          <label class="c-form-label" for="utca">Utca név:<span class="c-form-required"> *</span></label>
          <input id="utca" class="c-form-input" type="text" name="utca" placeholder="Utca név">          
        </fieldset>
        <fieldset>
          <label class="c-form-label" for="hazszam">Házszám:<span class="c-form-required"> *</span></label>
          <input id="hazszam" class="c-form-input" type="text" name="hazszam" placeholder="Házszám" >
        </fieldset>
      </div>
      <div>
      <label class="adatokMaradNew" for="adatokMaradNew" style="color:white; font-family:900"><input type="checkbox" name="adatokMaradNew" id="adatokMaradNew" value="A"/>
      Adatok elmentése</label ><span class="showTooltip">(?)</span><div class="tooltip">Az adatok elmentésére rákattintva el tudja menteni az adatait ez által nem kell kitöltenie az újbóli vásárlása során!</div>  
      <input type="submit" value="Rendelés véglegesítése" class="c-form-btn" id="rendbennew" name="rendbennew">
      <input type="submit" value="Megrendelés törlése" class="c-form-btn" id="torles" name="torles">
    </form>
  </div>';

  if (isset($_POST['adatokMaradNew'])) {
    $update = "UPDATE `users` SET `mentve`='1' WHERE mentve = 0 AND name = '{$felhasznalo}'";
    $eredmeny = mysqli_query($dbconnect, $update);
  }

  if (isset($_POST['rendbennew'])) {

    $veznev = $_POST['last-name'];

    $kernev = $_POST['first-name'];

    $kartyaszam = $_POST['card'];

    $kod = $_POST['code'];
    $telefon = $_POST['phone'];



    $irsz = $_POST['iranyitoszam'];

    $idopontok = date('Y-m-d');

    $utcak = $_POST['utca'];
    $hazszamok = $_POST['hazszam'];
    //Név ellenőrzése


    if (empty($veznev)) {
      $hibak[] = "Nem adott meg vezetéknevet!";
    }
    if (empty($kernev)) {
      $hibak[] = "Nem adott meg keresztnevet!";
    }

    //Kártyaszám hosszának ellenőrzése
    if (empty($kartyaszam)) {
      $hibak[] = "Nem adott meg bankkártyaszámot!";
    } elseif (strlen($kartyaszam) > 19) {
      $hibak[] = "Túl hosszú bankkártyaszámnak!";
    } elseif (strlen($kartyaszam) < 19) {
      $hibak[] = "Túl rövid bankkártyaszámnak!";
    }


    //telefonszám hosszának ellenőrzése
    if (!$telefon) {
      $hibak[] = "Nem adott meg telefonszámot!";
    } else if (strlen($telefon) != 11) {
      $hibak[] = "Ez nem magyar telefonszám!";
    }


    //CVV kód hosszának ellenőrzése
    if (empty($kod)) {
      $hibak[] = "Nem adott meg ellenőrző kódot!";
    } elseif (strlen($kod) != 3) {
      $hibak[] = "3 számjegynek kell szerepelnie!";
    }

    // //Kiszállítási cím ellenőrzése
    // if (empty($utcak)) {
    //   $hibak[] = "Nem adott meg utca nevet!";
    // }
    // if(empty($hazszamok)){
    //   $hibak[] = "Nem adott meg házszámot!";
    // }
    if (isset($hibak)) {
      $kimenet = "<div style=\"background-color: #A50000; width: 100%; max-width: 600px; margin: auto; text-align: center\">";
      $kimenet .= "<h2 style=\"color: white; margin: 0px;\">HIBÁS / HIÁNYOS ADATOK!</h2>";
      foreach ($hibak as $hiba) {

        $kimenet .= "<p style=\"color: white; padding: 3px\"><b>X</b> {$hiba}</p>";
      }
      $kimenet .= "</div>";
      print $kimenet;
    } else {

      $sqlUpdate = "UPDATE `users` INNER JOIN megrendeles ON megrendeles.usersId=users.id SET `keresztNev`='{$kernev}',`vezetekNev`='{$veznev}',`kartyaszam`='{$kartyaszam}',`kartyaKod`='{$kod}',`telefonszam`='{$telefon}',`utcaNev`='{$utcak}', `hazszam` = '{$hazszamok}',`telepules` = '{$irsz}', `idopont`='{$idopontok}' WHERE users.name = '{$felhasznalo}' AND megrendeles.status = 0 AND megrendeles.szamlazva = 0 ";
      mysqli_query($dbconnect, $sqlUpdate);
      echo  "AZ SQL: " . $sqlUpdate;

      $update = "UPDATE termek INNER JOIN megrendeles ON termek.id=megrendeles.termekId SET darab=darab-megrendeles.raktaron, `status` = 1 WHERE megrendeles.termekId=termek.id AND megrendeles.status != 1";
      mysqli_query($dbconnect, $update);
      header("location:koszonjuk.php");
    }
  }

  if (isset($_POST['torles'])) {
    $update = "UPDATE megrendeles SET torles = '1' WHERE status != 1";
    mysqli_query($dbconnect, $update);
    $delete = "DELETE FROM megrendeles WHERE status != 1 AND torles != 0";
    mysqli_query($dbconnect, $delete);
    header("Location:index.php");
  }
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

  <link rel="stylesheet" type="text/css" href="css/order.css">
  <link rel="stylesheet" href="sweetalert2.min.css">
  <script src="sweetalert2.all.min.js"></script>
  <script src="sweetalert2.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link href='https://unpkg.com/css.gg@2.0.0/icons/css/info.css' rel='stylesheet'>
  <script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(() => {
      $('#iranyitoszam').select2();

      $(".showTooltip").on("click", function() {
        $(".tooltip").toggle();
      });
      // $("#rendbennew").on("click", function(){
      //   alert("cs");
      // });
    });
  </script>

</head>

<body>
  <div id="container">
    <?php print $form; ?>
  </div>
</body>


</html>