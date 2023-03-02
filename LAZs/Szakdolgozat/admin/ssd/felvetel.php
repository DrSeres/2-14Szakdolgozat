<?php

//Űrlap feldolgozása
if (isset($_POST['rendben'])) {
    $marka = strip_tags(trim($_POST['marka']));
    $tipus = strip_tags(trim($_POST['tipus']));
    $kapacitas = $_POST['kapacitas'];
    $max_olvas = $_POST['max_olvas'];
    $max_iras = $_POST['max_iras'];
    $csatlakozo = $_POST['csatlakozo'];
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
    if (empty($max_olvas)) {
        $hibak[] = "Nem adott meg maximális olvasási sebességet!";
    }
    if (empty($max_iras)) {
        $hibak[] = "Nem adott meg maximális írási sebességet!";
    }
    if (empty($csatlakozo)) {
        $hibak[] = "Nem adott meg csatlakozót!";
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
        $sql = "INSERT INTO ssd
                (marka, tipus, kapacitas, max_olvas, max_iras, csatlakozo, leiras, ar, foto)
                VALUES
                ('{$marka}', '{$tipus}', '{$kapacitas}', '{$max_olvas}', '{$max_iras}', '{$csatlakozo}', '{$leiras}', '{$ar}', '{$foto}')";
        mysqli_query($dbconn, $sql);

        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/ssd/{$foto}");
        header("location: ssd.php");
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
    <title>Új SSD hozzáadása</title>
</head>

<body>
    <div class="container">
        <h1>Új SSD hozzáadása</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (isset($kimenet)) print $kimenet; ?>

            <p><label for="marka">Márka*: </label>
                <input type="text" name="marka" id="marka" value="">
            </p>

            <p><label for="tipus">Modell*: </label>
                <input type="text" name="tipus" id="tipus" value="">
            </p>

            <p><label for="kapacitas">Kapacitás (GB)*: </label>
                <input type="number" name="kapacitas" id="kapacitas" value="">
            </p>

            <p><label for="max_olvas">Maximális Olvasási Sebesség (MB/s)*: </label>
                <input type="number" name="max_olvas" id="max_olvas" value="">
            </p>


            <p><label for="max_iras">Maximális Írási Sebesség (MB/s)*: </label>
                <input type="number" name="max_iras" id="max_iras" value="">
            </p>
            
            <p><label for="csatlakozo">Csatlakozó*: </label>
                <input type="text" name="csatlakozo" id="csatlakozo" value="">
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
            <p><a href="ssd.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>