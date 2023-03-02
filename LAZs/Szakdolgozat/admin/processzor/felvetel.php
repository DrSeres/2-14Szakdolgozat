<?php

//Űrlap feldolgozása
if (isset($_POST['rendben'])) {
    $marka = strip_tags(trim($_POST['marka']));
    $tipus = strip_tags(trim($_POST['tipus']));
    $magok = $_POST['magok'];
    $szalak = $_POST['szalak'];
    $processzor_foglalat = strip_tags(trim($_POST['processzor_foglalat']));
    $processzor_orajel = $_POST['processzor_orajel'];
    $processzor_turbo_orajel = $_POST['processzor_turbo_orajel'];
    $integralt_grafikai_processzor = $_POST['integralt_grafikai_processzor'];
    $leiras = $_POST['leiras'];
    $ar = $_POST['ar'];

    //változók visszaadása

    $mine = array("image/jpeg", "image/gif", "image/png");
    if (empty($marka)) {
        $hibak[] = "Nem adott meg márkát!";
    }
    if (empty($tipus)) {
        $hibak[] = "Nem adott meg modelt!";
    }
    if (empty($magok)) {
        $hibak[] = "Nem adott meg magok!";
    }
    if (empty($szalak)) {
        $hibak[] = "Nem adott meg szalak!";
    }
    if (empty($processzor_foglalat)) {
        $hibak[] = "Nem adott meg processzor_foglalat!";
    }
    if (empty($processzor_orajel)) {
        $hibak[] = "Nem adott meg processzor_orajel!";
    }
    if (empty($processzor_turbo_orajel)) {
        $hibak[] = "Nem adott meg processzor_turbo_orajel!";
    }
    if (empty($leiras)) {
        $hibak[] = "Nem adott meg leiras!";
    }
    if (empty($ar)) {
        $hibak[] = "Nem adott meg ar!";
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
        //felvitel az adatbázisba
        require("../kapcsolat.php");
        $sql = "INSERT INTO processzor
                (marka, tipus, magok, szalak, processzor_foglalat, processzor_orajel, processzor_turbo_orajel, integralt_grafikai_processzor, leiras, ar, foto)
                VALUES
                ('{$marka}', '{$tipus}', '{$magok}', '{$szalak}', '{$processzor_foglalat}', '{$processzor_orajel}', '{$processzor_turbo_orajel}', '{$integralt_grafikai_processzor}', '{$leiras}', '{$ar}', '{$foto}')";
        mysqli_query($dbconn, $sql);

        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/processzor/{$foto}");
        header("location: processzor.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/felv_mod.css">
    <title>Új processzor hozzáadása</title>
</head>

<body>
    <div class="container">
        <h1>Új processzor hozzáadása</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (isset($kimenet)) print $kimenet; ?>

            <p><label for="memoria_tipus">Kategória kiválasztása*: </label>
                <select id="memoria_tipus" name="memoria_tipus">
                    <option value="alaplap">Alaplap</option>
                    <option value="gépház">Gépház</option>
                    <option value="memória">Memória</option>
                    <option value="DDR4">DDR4</option>
                    <option value="DDR5">DDR5</option>
                    <option value="SDRAM">SDRAM</option>
                </select>
            </p>

            <p><label for="marka">Márka*: </label>
                <input type="text" name="marka" id="marka" value="">
            </p>

            <p><label for="tipus">Modell*: </label>
                <input type="text" name="tipus" id="tipus" value="">
            </p>

            <p><label for="magok">Magok száma*: </label>
                <input type="number" name="magok" id="magok" value="">
            </p>

            <p><label for="szalak">Szálak száma*: </label>
                <input type="number" name="szalak" id="szalak" value="">
            </p>

            <p><label for="processzor_foglalat">Processzor foglalat*: </label>
                <input type="text" name="processzor_foglalat" id="processzor_foglalat" value="">
            </p>

            <p><label for="processzor_orajel">Processzor órajel*: </label>
                <input type="number" name="processzor_orajel" id="processzor_orajel" value="">
            </p>

            <p><label for="processzor_turbo_orajel">Processzor Turbó órajel*: </label>
                <input type="number" name="processzor_turbo_orajel" id="processzor_turbo_orajel" value="">
            </p>

            <p><label for="integralt_grafikai_processzor">Integrált Grafikai Processzor: </label>
                <input type="text" name="integralt_grafikai_processzor" id="integralt_grafikai_processzor" value="">
            </p>

            <p><label for="leiras">Leírás*: </label>
                <input type="textarea" name="leiras" id="leiras" value="">
            </p>

            <p><label for="ar">Ára (Ft)*: </label>
                <input type="number" name="ar" id="ar" value="">
            </p>




            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <p><label for="foto">Fotó feltöltése</label>
                <input type="file" name="foto" id="foto">
            </p>




            <p>A*-gal jelölt mezők kitöltése kötelező.</p>

            <!--Elküldés és reset-->
            <input type="submit" value="Rendben" id="rendben" name="rendben">
            <p><a href="processzor.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>