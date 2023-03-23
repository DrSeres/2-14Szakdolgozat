<?php 


if(isset($_POST['rendben'])){

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
    print_r($update);
    echo "<pre>";
    print_r($update);
    echo "</pre>";

  } 
}

?>