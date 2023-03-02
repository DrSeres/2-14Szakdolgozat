<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'kapcsolat.php';


$name = mysqli_real_escape_string($dbconnect, $_POST['name']);
$email = mysqli_real_escape_string($dbconnect, $_POST['email']);
$pass = md5($_POST['password']);
$cpass = md5($_POST['passwordAgain']);

$select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

$eredmeny = mysqli_query($dbconnect, $select);
if (mysqli_num_rows($eredmeny) > 0) {
    $hibak[] = 'Létezik már egy olyan felhasználó!';
} else {
    if ($pass != $cpass) {
        $hibak[] = "Nem egyezik meg a két jelszó!";
    } else {
        $insert = "INSERT INTO users(name, email, password) VALUES('$name','$email','$pass')";
        mysqli_query($dbconnect, $insert);
    }
}
header("location:foBejelentkezes.php");
?>