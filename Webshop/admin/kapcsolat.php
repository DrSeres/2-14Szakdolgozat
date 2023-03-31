<?php

header("Content-Type: text/html; charset=utf-8");

define("DBHOST", "localhost");
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'webshopv3');

$dbconn = @mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME) or die("Hiba az adatbázis csatlakozáskor");

mysqli_query($dbconn, "SET NAMES utf8");

?>