<?php 
echo '<script type="text/javascript">
localStorage.clear();
</script>';
session_start();

session_unset();
session_destroy();

header("location:foBejelentkezes.php");
?>