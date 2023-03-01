<?php

//Űrlap feldolgozása

require("../kapcsolat.php");

if (isset($_POST['rendben'])) {
    $marka = strip_tags(trim($_POST['marka']));
    $modell = strip_tags(trim($_POST['modell']));
    $tipus = strip_tags(trim($_POST['tipus']));
    $teljesitmeny = $_POST['teljesitmeny'];
    $hatasfok = $_POST['hatasfok'];
    $pfc = $_POST['pfc'];
    $leiras = $_POST['leiras'];
    $ar = $_POST['ar'];

    //változók visszaadása

    $mine = array("image/jpeg", "image/gif", "image/png");
    if (empty($marka)) {
        $hibak[] = "Nem adott meg márkát!";
    }
    if (empty($modell)) {
        $hibak[] = "Nem adott meg modelt!";
    }
    if (empty($tipus)) {
        $hibak[] = "Nem adott meg modelt!";
    }
    if (empty($teljesitmeny)) {
        $hibak[] = "Nem adott meg teljesítményt!";
    }
    if (empty($hatasfok)) {
        $hibak[] = "Nem adott meg hatásfokot!";
    }


    if ($_FILES['foto']['error'] == 0 && $_FILES['foto']['size'] > 2000000) {
        $hibak[] = "A kép mérete nagyobb mint 2 MB!";
    }
    if ($_FILES['foto']['error'] == 0 && !in_array($_FILES['foto']['type'], $mine)) {
        $hibak[] = "A kép formátuma nem megfelelő!";
    }
    //Új fájlnév elkészítése
    switch ($_FILES['foto']['type']) {
        case "image/png":
            $kit = ".png";
            break;
        case "image/gif":
            $kit = ".gif";
            break;
        default:
            $kit = ".jpg";
    }

    $foto = date('U') . $kit;
    //Hibaüzenet összeállítása
    if (isset($hibak)) {
        $kimenet = "<ul>\n";
        foreach ($hibak as $hiba) {
            $kimenet .= "<li>{$hiba}</li>";
        }
        $kimenet .= "</ul>\n";
    } else {
        $id = (int)$_GET['id'];
        $sql = "UPDATE tapegyseg
                SET marka = '{$marka}', modell = '{$modell}', tipus = '{$tipus}', teljesitmeny = '{$teljesitmeny}', hatasfok = '{$hatasfok}', pfc = '{$pfc}', leiras = '{$leiras}', ar = '{$ar}', foto = '{$foto}'
                WHERE id = {$id}";
        mysqli_query($dbconn, $sql);

        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/tapegyseg/{$foto}");
        header("location: tapegyseg.php");
    }
}
else {
    $id = (int)$_GET['id'];
    $sql = "SELECT*
            FROM tapegyseg
            WHERE id = {$id}";
    $eredmeny = mysqli_query($dbconn, $sql);
    $sor = mysqli_fetch_assoc($eredmeny);

    $marka = $sor['marka'];
    $modell = $sor['modell'];
    $tipus = $sor['tipus'];
    $teljesitmeny = $sor['teljesitmeny'];
    $hatasfok = $sor['hatasfok'];
    $pfc = $sor['pfc'];
    $leiras = $sor['leiras'];
    $ar = $sor['ar'];
    $foto = ($sor['foto']) != "nincskep.png" ? $sor['foto'] : "nincskep.png";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/felv_mod.css">
    <title><?php print $marka;?> <?php print $modell;?> módosítása</title>
</head>

<body>
    <div class="container">
        <h1><?php print $marka;?> <?php print $modell;?> módosítása</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (isset($kimenet)) print $kimenet; ?>

            <p><label for="marka">Márka*: </label>
                <input type="text" name="marka" id="marka" value="<?php print $marka;?>">
            </p>

            <p><label for="modell">Modell*: </label>
                <input type="text" name="modell" id="modell" value="<?php print $modell;?>">
            </p>

            <p><label for="tipus">Tápegység típusa*: </label>
                <input type="text" name="tipus" id="tipus" value="<?php print $tipus;?>">
            </p>

            <p><label for="teljesitmeny">Tápegység teljesítménye (W)*: </label>
                <input type="number" name="teljesitmeny" id="teljesitmeny" value="<?php print $teljesitmeny;?>">
            </p>


            <p><label for="hatasfok">Hatásfok*: </label>
                <input type="text" name="hatasfok" id="hatasfok" value="<?php print $hatasfok;?>">
            </p>
            
            <p><label for="pfc">PFC*: </label>
                <select id="pfc" name="pfc">
                    <option value="<?php print $leiras;?>">Marad: <?php print $pfc;?></option>
                    <option value="Aktív">Aktív</option>
                    <option value="Passív">Passív</option>
                </select>
            </p>

            <p><label for="leiras">Leírás*: </label>
                <input type="text" name="leiras" id="leiras" value="<?php print $leiras;?>">
            </p>

            <p><label for="ar">Ára (Ft)*: </label>
                <input type="number" name="ar" id="ar" value="<?php print $ar;?>">
            </p>




            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <img src="../../img/tapegyseg/<?php print $foto;?>">
            <p><label for="foto">Fotó feltöltése</label>
                <input type="file" name="foto" id="foto">
            </p>




            <p>A*-gal jelölt mezők kitöltése kötelező.</p>

            <!--Elküldés és reset-->
            <input type="submit" value="Módosítás" id="rendben" name="rendben">
            <p><a href="tapegyseg.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>