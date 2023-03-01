<?php

//Űrlap feldolgozása

require("../kapcsolat.php");

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
        $sql = "UPDATE ssd
                SET marka = '{$marka}', tipus = '{$tipus}', kapacitas = '{$kapacitas}', max_olvas = '{$max_olvas}', max_iras = '{$max_iras}', csatlakozo = '{$csatlakozo}', leiras = '{$leiras}', ar = '{$ar}', foto = '{$foto}'
                WHERE id = {$id}";
        mysqli_query($dbconn, $sql);

        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/ssd/{$foto}");
        header("location: ssd.php");
    }
}
else {
    $id = (int)$_GET['id'];
    $sql = "SELECT*
            FROM ssd
            WHERE id = {$id}";
    $eredmeny = mysqli_query($dbconn, $sql);
    $sor = mysqli_fetch_assoc($eredmeny);

    $marka = $sor['marka'];
    $tipus = $sor['tipus'];
    $kapacitas = $sor['kapacitas'];
    $max_olvas = $sor['max_olvas'];
    $max_iras = $sor['max_iras'];
    $csatlakozo = $sor['csatlakozo'];
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

            
            <p><label for="kapacitas">Kapacitás (GB)*: </label>
                <input type="number" name="kapacitas" id="kapacitas" value="<?php print $kapacitas;?>">
            </p>

            <p><label for="max_olvas">Maximális Olvasási Sebesség (MB/s)*: </label>
                <input type="number" name="max_olvas" id="max_olvas" value="<?php print $max_olvas;?>">
            </p>


            <p><label for="max_iras">Maximális Írási Sebesség (MB/s)*: </label>
                <input type="number" name="max_iras" id="max_iras" value="<?php print $max_iras;?>">
            </p>
            
            <p><label for="csatlakozo">Csatlakozó*: </label>
                <input type="text" name="csatlakozo" id="csatlakozo" value="<?php print $csatlakozo;?>">
            </p>


            <p><label for="leiras">Leírás*: </label>
                <input type="text" name="leiras" id="leiras" value="<?php print $leiras;?>">
            </p>

            <p><label for="ar">Ára (Ft)*: </label>
                <input type="number" name="ar" id="ar" value="<?php print $ar;?>">
            </p>




            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <img src="../../img/ssd/<?php print $foto;?>">
            <p><label for="foto">Fotó feltöltése</label>
                <input type="file" name="foto" id="foto">
            </p>




            <p>A*-gal jelölt mezők kitöltése kötelező.</p>

            <!--Elküldés és reset-->
            <input type="submit" value="Módosítás" id="rendben" name="rendben">
            <p><a href="ssd.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>