<?php
if (isset($_GET['id'])) {
    require("kapcsolat.php");
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM termek
            WHERE id = {$id}";
    mysqli_query($dbconn, $sql);
}
header("location: k_{$k}.php");

?>