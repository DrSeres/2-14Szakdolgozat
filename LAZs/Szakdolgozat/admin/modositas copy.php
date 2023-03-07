<?php

//Űrlap feldolgozása

require("kapcsolat.php");

if (isset($_POST['rendben'])) {
    $markaId = $_POST['markaId'];
    $termekNev = strip_tags(trim($_POST['termekNev']));
    $leiras = $_POST['leiras'];
    $ar = $_POST['ar'];
    $darab = $_POST['darab'];

    //változók visszaadása

    $mine = array("image/jpeg", "image/gif", "image/png");
    if (empty($termekNev)) {
        $hibak[] = "Nem adott meg márkát!";
    }
    if (empty($leiras)) {
        $hibak[] = "Nem adott meg modelt!";
    }
    if (empty($ar)) {
        $hibak[] = "Nem adott meg magok!";
    }
    if (empty($darab)) {
        $hibak[] = "Nem adott meg szalak!";
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
        $sql = "UPDATE processzor
                SET marka = '{$marka}', tipus = '{$tipus}', magok = '{$magok}', szalak = '{$szalak}', processzor_foglalat = '{$processzor_foglalat}', processzor_orajel = '{$processzor_orajel}', processzor_turbo_orajel = '{$processzor_turbo_orajel}', integralt_grafikai_processzor = '{$integralt_grafikai_processzor}', leiras = '{$leiras}', ar = '{$ar}', foto = '{$foto}'
                WHERE id = {$id}";
        mysqli_query($dbconn, $sql);

        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/processzor/{$foto}");
        header("location: processzor.php");
    }
}
else {
    $id = (int)$_GET['id'];
    $sql = "SELECT*
            FROM processzor
            WHERE id = {$id}";
    $eredmeny = mysqli_query($dbconn, $sql);
    $sor = mysqli_fetch_assoc($eredmeny);

    $marka = $sor['marka'];
    $tipus = $sor['tipus'];
    $magok = $sor['magok'];
    $szalak = $sor['szalak'];
    $processzor_foglalat = $sor['processzor_foglalat'];
    $processzor_orajel = $sor['processzor_orajel'];
    $processzor_turbo_orajel = $sor['processzor_turbo_orajel'];
    $integralt_grafikai_processzor = $sor['integralt_grafikai_processzor'];
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
    <title><?php print $marka;?> <?php print $tipus;?> módosítása</title>
</head>

<body>
    <div class="container">
        <h1><?php print $marka;?> <?php print $tipus;?> módosítása</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (isset($kimenet)) print $kimenet; ?>

            <p><label for="marka">Márka*: </label>
                <input type="text" name="marka" id="marka" value="<?php print $marka;?>">
            </p>

            <p><label for="tipus">Modell*: </label>
                <input type="text" name="tipus" id="tipus" value="<?php print $tipus;?>">
            </p>

            <p><label for="magok">Magok száma*: </label>
                <input type="number" name="magok" id="magok" value="<?php print $magok;?>">
            </p>

            <p><label for="szalak">Szálak száma*: </label>
                <input type="number" name="szalak" id="szalak" value="<?php print $szalak;?>">
            </p>

            <p><label for="processzor_foglalat">Processzor foglalat*: </label>
                <input type="text" name="processzor_foglalat" id="processzor_foglalat" value="<?php print $processzor_foglalat;?>">
            </p>

            <p><label for="processzor_orajel">Processzor órajel*: </label>
                <input type="number" name="processzor_orajel" id="processzor_orajel" value="<?php print $processzor_orajel;?>">
            </p>

            <p><label for="processzor_turbo_orajel">Processzor Turbó órajel*: </label>
                <input type="number" name="processzor_turbo_orajel" id="processzor_turbo_orajel" value="<?php print $processzor_turbo_orajel;?>">
            </p>

            <p><label for="integralt_grafikai_processzor">Integrált Grafikai Processzor: </label>
                <input type="text" name="integralt_grafikai_processzor" id="integralt_grafikai_processzor" value="<?php print $integralt_grafikai_processzor;?>">
            </p>

            <p><label for="leiras">Leírás*: </label>
                <input type="textarea" name="leiras" id="leiras" value="<?php print $leiras;?>">
            </p>

            <p><label for="ar">Ára (Ft)*: </label>
                <input type="number" name="ar" id="ar" value="<?php print $ar;?>">
            </p>




            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <img src="../../img/processzor/<?php print $foto;?>">
            <p><label for="foto">Fotó feltöltése</label>
                <input type="file" name="foto" id="foto">
            </p>




            <p>A*-gal jelölt mezők kitöltése kötelező.</p>

            <!--Elküldés és reset-->
            <input type="submit" value="Módosítás" id="rendben" name="rendben">
            <p><a href="processzor.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>