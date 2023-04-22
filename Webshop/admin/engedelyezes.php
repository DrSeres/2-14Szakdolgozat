<?php 

require("kapcsolat.php");

$id = $_POST['id'];



$update = "UPDATE `users` SET `engedelyezes`='1' WHERE id = $id";
$er = mysqli_query($dbconnect, $update);
?>