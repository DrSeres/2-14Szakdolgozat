<?php 

require("kapcsolat.php");
session_start();
$felhasznalo = $_SESSION['name'];

$utolsoSor = "SELECT * FROM megrendeles INNER JOIN users ON megrendeles.usersId=users.id WHERE users.name = '{$felhasznalo}' ORDER BY sorszam DESC LIMIT 1";
    $utolsoSorQuery = mysqli_query($dbconnect, $utolsoSor);
    $legnagyobbIdSor = mysqli_fetch_assoc($utolsoSorQuery);
    $legnagyobbSorszam = $legnagyobbIdSor['sorszam'];
    if(mysqli_num_rows($utolsoSorQuery) > 0){
        $update = "UPDATE `megrendeles` INNER JOIN users ON users.id = megrendeles.usersId SET `szamlazva`='2' WHERE szamlazva = 1 AND users.name = '{$felhasznalo}' AND megrendeles.sorszam = '{$legnagyobbSorszam}'";
        $eredmeny = mysqli_query($dbconnect, $update);
        echo "<script>localStorage.removeItem('termekek')</script>";
    }


?>