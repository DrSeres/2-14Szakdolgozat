<?php
if (isset($_GET['id'])) {
    require("kapcsolat.php");
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM kedvenctermekek
            WHERE id = {$id}";
    mysqli_query($dbconnect, $sql);
    
    header("location:kedvenctermek.php");
}
?>