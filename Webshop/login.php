<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require ('kapcsolat.php');

$email = mysqli_real_escape_string($dbconnect, $_POST['email']);
var_dump($email);
$pass = sha1($_POST['password']);
var_dump($pass);

$select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass' ";
print($select);

$result = mysqli_query($dbconnect, $select);
$eredmeny = mysqli_fetch_array($result);


echo" az eredmény: <pre>";
print_r(count($eredmeny));
echo"</pre>";

if (count($eredmeny) > 0) {
    //echo "Lekérdezett sorok száma: " . mysqli_num_rows($eredmeny);
    $sor = $eredmeny;
    
    echo "A sor értéke: ";
    print_r($sor);

    if ($sor['user_type'] == 'admin') {
        echo "Admin user";
        $_SESSION['name'] = $sor['name'];
        $_SESSION['user_type'] = $sor['user_type'];
        // echo $_SESSION['admin_name'];
        header('location:index.php');
    } else if ($sor['user_type'] == 'user') {
        echo "Sima user";
        $_SESSION['name'] = $sor['name'];
        $_SESSION['user_type'] = $sor['user_type'];
        //echo $_SESSION['user_name'];
        header("location:index.php");
    }
} else {
    $hibak[] = "Nem jó felhasználónév vagy jelszó!";
    echo "Lekérdezett sorok száma: 0";
}
// header("location:index.php")

?>