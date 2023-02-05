<?php 

$dbconnect = mysqli_connect("localhost", "root", "", "felhasznalok");

if (!$dbconnect) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";

?>