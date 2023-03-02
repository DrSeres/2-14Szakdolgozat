<?php

//Űrlap feldolgozása
if (isset($_POST['rendben'])) {
    $marka = strip_tags(trim($_POST['marka']));
    $modell = strip_tags(trim($_POST['modell']));
    $szelesseg = $_POST['szelesseg'];
    $melyseg = $_POST['melyseg'];
    $alaplap_atx = $_POST['alaplap_atx'];
    $alaplap_micro_atx = $_POST['alaplap_micro_atx'];
    $alaplap_extended_atx = $_POST['alaplap_extended_atx'];
    $alaplap_mini_itx = $_POST['alaplap_mini_itx'];
    $audio = $_POST['audio'];
    $firewire = $_POST['firewire'];
    $esata = $_POST['esata'];
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
    if (empty($szelesseg)) {
        $hibak[] = "Nem adott meg magok!";
    }
    if (empty($melyseg)) {
        $hibak[] = "Nem adott meg szalak!";
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
        $sql = "INSERT INTO gephaz
                (marka, modell, szelesseg, melyseg, alaplap_atx, alaplap_micro_atx, alaplap_extended_atx, alaplap_mini_itx, audio, firewire, esata, leiras, ar, foto)
                VALUES
                ('{$marka}', '{$modell}', '{$szelesseg}', '{$melyseg}', '{$alaplap_atx}', '{$alaplap_micro_atx}', '{$alaplap_extended_atx}', '{$alaplap_mini_itx}', '{$audio}', '{$firewire}', '{$esata}', '{$leiras}', '{$ar}', '{$foto}')";
        mysqli_query($dbconn, $sql);

        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/gephaz/{$foto}");
        header("location: gephaz.php");
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
    <title>Új gépház hozzáadása</title>
</head>

<body>
    <div class="container">
        <h1>Új gépház hozzáadása</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (isset($kimenet)) print $kimenet; ?>

            <p><label for="marka">Márka*: </label>
                <input type="text" name="marka" id="marka" value="">
            </p>

            <p><label for="modell">Modell*: </label>
                <input type="text" name="modell" id="modell" value="">
            </p>

            <p><label for="szelesseg">Szélesség*: </label>
                <input type="number" name="szelesseg" id="szelesseg" value="">
            </p>

            <p><label for="melyseg">Mélység*: </label>
                <input type="number" name="melyseg" id="melyseg" value="">
            </p>

            <p><label for="alaplap_atx">Alaplap ATX*: </label>
                <select id="alaplap_atx" name="alaplap_atx">
                    <option value="0">Nem</option>
                    <option value="1">Igen</option>
                </select>
            </p>
            <p><label for="alaplap_micro_atx">Alaplap Micro ATX*: </label>
                <select id="alaplap_micro_atx" name="alaplap_micro_atx">
                    <option value="0">Nem</option>
                    <option value="1">Igen</option>
                </select>
            </p>
            <p><label for="alaplap_extended_atx">Alaplap Extended ATX*: </label>
                <select id="alaplap_extended_atx" name="alaplap_extended_atx">
                    <option value="0">Nem</option>
                    <option value="1">Igen</option>
                </select>
            </p>
            <p><label for="alaplap_mini_itx">Alaplap Mini ITX*: </label>
                <select id="alaplap_mini_itx" name="alaplap_mini_itx">
                    <option value="0">Nem</option>
                    <option value="1">Igen</option>
                </select>
            </p>
            <p><label for="audio">Audio*: </label>
                <select id="audio" name="audio">
                    <option value="0">Nem</option>
                    <option value="1">Igen</option>
                </select>
            </p>
            <p><label for="firewire">Firewire*: </label>
                <select id="firewire" name="firewire">
                    <option value="0">Nem</option>
                    <option value="1">Igen</option>
                </select>
            </p>
            <p><label for="esata">eSATA*: </label>
                <select id="esata" name="esata">
                    <option value="0">Nem</option>
                    <option value="1">Igen</option>
                </select>
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
            <p><a href="gephaz.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>