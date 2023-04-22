<?php 

require("kapcsolat.php");

$sql = "SELECT * FROM users";
$er = mysqli_query($dbconnect, $sql);



$ki = "";
while($sor = mysqli_fetch_array($er)){
    $admin = ($sor['user_type'] == 'admin') ? "color:red" : "";     
    $ki .= "
    <option value='{$sor['id']}' style='font-size:18px; $admin'>{$sor['name']} ({$sor['vezetekNev']} {$sor['keresztNev']})</option>";
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Megrendelések kezelése</title>
    <link rel="stylesheet" href="../admin/css/felhasznalok.css">
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href="kategoria.php">Főoldal</a></li>
            </ul>
        </nav>


    </header>
    <h1>Megrendelések kezelése</h1>

    <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "userFetch.php?q=" + str, true);
            xmlhttp.send(); 
        }
    </script>
    </head>

    <body>

        <form>
            <select name="users" onchange="showUser(this.value)">
            <option value=''>Felhasználónév kiválasztása:</option>
                <?php print_r($ki)  ?>
            </select>
        </form>
        <br>
        <div id="txtHint"><b></b></div>


</html>