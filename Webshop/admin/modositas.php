<?php

//Űrlap feldolgozása

session_start();
if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type'] != 'admin'){
        header("location:false.php");
    }
}




require("kapcsolat.php");
$sql = "SELECT * FROM `gyartokategoria` INNER JOIN kategoria ON gyartokategoria.kategoriaID=kategoria.kategoriaID INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId";

$eredmeny = mysqli_query($dbconnect, $sql);


$kiir = "";
while($sor = mysqli_fetch_assoc($eredmeny)){
    $kiir.= "
    <option value=\"{$sor['gyartoKategoriaId']}\">{$sor['gyartoNev']} ({$sor['kategoriaNev']})</option>";
}



if (isset($_POST['rendben'])) {
    $gyartoKategoriaId = $_POST['gyartoKategoriaId'];
    $termekNev = strip_tags(trim($_POST['termekNev']));
    $leiras = $_POST['leiras'];
    $ar = $_POST['ar'];
    $darab = $_POST['darab'];

    //változók visszaadása

    $mine = array("image/jpeg", "image/gif", "image/png");
    if (empty($termekNev)) {
        $hibak[] = "Nem adott meg modelt!";
    }
    if (empty($leiras)) {
        $hibak[] = "Nem adott meg leírást!";
    }
    if (empty($ar)) {
        $hibak[] = "Nem adott meg árat!";
    }

    $fotoQuery = "";

    if($_FILES['foto']['error'] != 4) {
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

        $foto = $kategoriaID . "_" . $termekNev . "_" . date('U') . $kit;
        $fotoQuery = "foto = '{$foto}', "; 
    
        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../img/termekekuj/{$foto}");
    }
    
    $sql = "SELECT * FROM gyartokategoria WHERE gyartoKategoriaId = {$gyartoKategoriaId}";

    $eredmeny = mysqli_query($dbconnect, $sql);

    $sor = mysqli_fetch_array($eredmeny);
    $kategoriaID = $sor['gyartoKategoriaId'];

    //Hibaüzenet összeállítása
    if (isset($hibak)) {
        $kimenet = "<ul>\n";
        foreach ($hibak as $hiba) {
            $kimenet .= "<li>{$hiba}</li>";
        }
        $kimenet .= "</ul>\n";
    } else {
        //felvitel az adatbázisba
        $id = (int)$_GET['id'];
        
        $sql = "UPDATE termek
                SET gyartoKategoriaId = '{$kategoriaID}', termekNev = '{$termekNev}', {$fotoQuery} leiras = '{$leiras}', darab = '{$darab}', ar = '{$ar}'
                WHERE id = {$id}";
        mysqli_query($dbconnect, $sql);

        header("location: kategoria.php");
    }
}
else{
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM termek INNER JOIN gyartokategoria ON gyartokategoria.gyartoKategoriaId=termek.gyartoKategoriaId INNER JOIN kategoria ON gyartokategoria.kategoriaID=kategoria.kategoriaID INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId
            WHERE id = {$id}";
    $eredmeny = mysqli_query($dbconnect, $sql);
    $sor = mysqli_fetch_assoc($eredmeny);
    $gyartoId = $sor['gyartoKategoriaId'];
    $gyartoNev = $sor['gyartoNev'];
    $kategoriaNev = $sor['kategoriaNev'];
    $termekNev = $sor['termekNev'];
    $leiras = $sor['leiras'];
    $ar = $sor['ar'];
    $darab = $sor['darab'];
    $foto = ($sor['foto']) != "nincskep.png" ? $sor['foto'] : "nincskep.png";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/felv_mod.css">
    <title><?php echo $termekNev?></title>
    <script src="ckeditor.js"></script>
    
</head>

<body>
    <div class="container">
        <h1> <?php  echo $termekNev?> módosítása</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (isset($kimenet)) print $kimenet; ?>

            <p><label for="gyartoKategoriaId">Kategória*: </label>
                    <select id="gyartoKategoriaId" name="gyartoKategoriaId">
                        <option value="<?php print $gyartoId;?>">Marad: <?php print $gyartoNev;?> (<?php print $kategoriaNev;?>)</option>
                        <?php print_r($kiir);?>
                    </select>
                    
                </select>
            </p>

            <p><label for="termekNev">Modell*: </label>
                <input type="text" name="termekNev" id="termekNev" value="<?php print $termekNev;?>">
            </p>

            <p><label for="leiras">Leírás*: </label>
            
                <textarea name="leiras" id="editor" cols="30" rows="50"><?php print $leiras;?></textarea>
                
            </p>

            <p><label for="ar">Ára (Ft)*: </label>
                <input type="number" name="ar" id="ar" value="<?php print $ar;?>">
            </p>
            
            <p><label for="darab">Darab*: </label>
                <input type="number" name="darab" id="darab" value="<?php print $darab;?>">
            </p>




            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <img src="../img/termekekuj/<?php print $foto;?>" id="termekFoto">
            <p><label for="foto">Fotó feltöltése</label>
                <input type="file" name="foto" id="foto">
            </p>




            <p>A*-gal jelölt mezők kitöltése kötelező.</p>

            <!--Elküldés és reset-->
            <input type="submit" value="Rendben" id="rendben" name="rendben">
            <p><a href="kategoria.php">Vissza az oldalra</a></p>
        </form>
        
    </div>
    <script>
    // Replace the <textarea> with a CKEditor
    CKEDITOR.replace('editor');
</script>
</body>

</html>