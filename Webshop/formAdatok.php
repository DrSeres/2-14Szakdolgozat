<?php 

require("kapcsolat.php");
$user = $_POST['user'];
$address = $_POST['address'];

$felhasznalo = $_SESSION['name'];



$SQL = "SELECT `users`.`name`, `telepulesek`.`irsz`, `telepulesek`.`nev`, `telepulesek`.`megye`, `telepulesek`.`id` FROM `users` LEFT JOIN `telepulesek` ON `telepulesek`.`id` = `users`.`telepules` WHERE telepulesek.irsz = '{$user}'";
$mysql = mysqli_query($dbconnect, $SQL);

echo $SQL;

// $sor = mysqli_fetch_assoc($mysql);

while($sor = mysqli_fetch_assoc($mysql)){
    $telepules = $sor['nev'];
    $kiir.= "
    <option value=\"{$sor['telepulesek.id']}\"> {$sor['nev']} ({$sor['irsz']}) {$sor['name']} </option>";
}



echo $telepules;
echo $kiir;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        let asd = <?php echo $telepules ?>;
        console.log("ÁTADOTT TELEPULES");
        let adat = new FormData();
        adat.append("telepules", asd);
      fetch("megProba.php", {
        method: "POST",
        body: adat,
      })
        .then((response) => response.text())
        .then((data) => {
          console.log(data);
        })
        .catch((error) => console.log(error));
    </script>

</body>
</html>