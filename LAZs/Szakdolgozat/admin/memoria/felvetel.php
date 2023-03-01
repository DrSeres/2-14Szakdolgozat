<?php

//Űrlap feldolgozása
if (isset($_POST['rendben'])) {
    $marka = strip_tags(trim($_POST['marka']));
    $tipus = strip_tags(trim($_POST['tipus']));
    $kapacitas = $_POST['kapacitas'];
    $kiszereles = $_POST['kiszereles'];
    $memoria_tipus = $_POST['memoria_tipus'];
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
    if (empty($kapacitas)) {
        $hibak[] = "Nem adott meg kapacitást!";
    }
    if (empty($kiszereles)) {
        $hibak[] = "Nem adott meg kiszerelést!";
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
        $sql = "INSERT INTO ram
                (marka, tipus, kapacitas, kiszereles, memoria_tipus, leiras, ar, foto)
                VALUES
                ('{$marka}', '{$tipus}', '{$kapacitas}', '{$kiszereles}', '{$memoria_tipus}', '{$leiras}', '{$ar}', '{$foto}')";
        mysqli_query($dbconn, $sql);

        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/memoria/{$foto}");
        header("location: memoria.php");
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
    <title>Új memória (RAM) hozzáadása</title>
</head>

<body>
    <div class="container">
        <h1>Új memória (RAM) hozzáadása</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (isset($kimenet)) print $kimenet; ?>

            <p><label for="marka">Márka*: </label>
                <input type="text" name="marka" id="marka" value="">
            </p>

            <p><label for="tipus">Modell*: </label>
                <input type="text" name="tipus" id="tipus" value="">
            </p>

            <p><label for="kapacitas">Kapacitás*: </label>
                <input type="number" name="kapacitas" id="kapacitas" value="">
            </p>

            <p><label for="kiszereles">Kiszerelés*: </label>
                <input type="text" name="kiszereles" id="kiszereles" value="">
            </p>
            
            <p><label for="memoria_tipus">Memória Típusa*: </label>
                <select id="memoria_tipus" name="memoria_tipus">
                    <option value="DDR">DDR</option>
                    <option value="DDR2">DDR2</option>
                    <option value="DDR3">DDR3</option>
                    <option value="DDR4">DDR4</option>
                    <option value="DDR5">DDR5</option>
                    <option value="SDRAM">SDRAM</option>
                </select>
            </p>

            <p><label for="leiras">Leírás*: </label>
                <input type="text" name="leiras" id="leiras" value="">
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
            <p><a href="memoria.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>