<?php 

$page = $_SERVER['REQUEST_URI'];
//echo $page;

$Data = "<script>localStorage.setItem('oldal', '$page');</script>";
print_r($Data);

?>