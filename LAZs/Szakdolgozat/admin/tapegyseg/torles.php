<?php

if (isset($_GET['id'])) {
    require("../kapcsolat.php");
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM tapegyseg
            WHERE id = {$id}";
    mysqli_query($dbconn, $sql);
}
header("location: tapegyseg.php");

?>