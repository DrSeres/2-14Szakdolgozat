











<?php 

require("kapcsolat.php");
// $sql = "SELECT * FROM termek ORDER BY RAND() LIMIT 5";
$sql = "SELECT * FROM termek WHERE akcio = 1";
$eredmenyek = mysqli_query($dbconnect, $sql);

$ki = '<div class="slider">
<input type="radio" name="testimonial" id="t-1">
<input type="radio" name="testimonial" id="t-2">
<input type="radio" name="testimonial" id="t-3" checked>
<input type="radio" name="testimonial" id="t-4">
<input type="radio" name="testimonial" id="t-5">
<div class="testimonials">
';

$i = 1;
$_SESSION["deal"] = array();
while($sor = mysqli_fetch_assoc($eredmenyek)){   
    $_SESSION["deal"][] = $sor["id"];
    $termekNev = $sor['termekNev'];
    $foto = $sor['foto'];
    
    $ki .= "
        <label class='item' for='t-{$i}'>
        <h3 style='color:red; font-size:20px; text-align:right; padding:4px'>20% akció</h3>
        <img src='../Webshop/img/termekekuj/{$foto}' alt='picture'>
        
        <h2 style='font-size:10px'>{$termekNev}</h2>
        
        <a href='adat.php?id={$sor['id']}&deal=1'><button type='button' class='btn'>Részletek</button></a>
        </label>
    ";
    $i++;
}


$ki .= '</div>
<div class="dots">
    <label for="t-1"></label>
    <label for="t-2"></label>
    <label for="t-3"></label>
    <label for="t-4"></label>
    <label for="t-5"></label>
</div>
</div>';
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.slider {
	width: 100% !important;
}
h2{
color:white !important;
}
.slider input {
	display: none !important;
}
.btn{
	padding: 10px !important;
	margin: 10px !important;
	color:white !important;
	background:#003554!important;
	border:1px solid white !important;
	cursor:pointer !important;
}
.testimonials {
	display: flex !important;
	align-items: center !important;
	justify-content: center !important;
	position: relative !important;
	min-height: 500px !important;
	perspective: 1000px !important;
	overflow: hidden  !important;
	
}
.testimonials .item {
	width: 300px !important;
	border-radius: 5px !important;
	background: #051923 !important;
	position: absolute !important;
	top: 0 !important;
	box-sizing: border-box !important;
	text-align: center !important;
	transition: transform 0.4s !important;
	box-shadow: 0 0 10px rgba(0,0,0,0.3) !important;
	user-select: none !important;
	cursor: pointer !important;
	border: 3px solid white !important;
}
.testimonials .item img {
	width: 100% !important;
	height: 200px !important;
}
.testimonials .item p {
	color: #ddd !important;
	font-size: 10px !important;
}
.testimonials .item h2 {
	font-size: 2rem !important;
	margin-top: 60px !important;
	color:red;
	
}
.dots {
	display: flex !important;
	justify-content: center !important; 
	align-items: center !important;
}
.dots label {
	height: 5px !important;
	width: 5px !important;
	border-radius: 50% !important;
	cursor: pointer !important;
	background: #051923 !important;
	margin: 7px !important;
	transition-duration: 0.2s !important;
}

#t-1:checked ~ .dots label[for="t-1"],
#t-2:checked ~ .dots label[for="t-2"],
#t-3:checked ~ .dots label[for="t-3"],
#t-4:checked ~ .dots label[for="t-4"],
#t-5:checked ~ .dots label[for="t-5"] {
	transform: scale(2);
	background-color: #fff;
}
#t-1:checked ~ .dots label[for="t-2"],
#t-2:checked ~ .dots label[for="t-1"],
#t-2:checked ~ .dots label[for="t-3"],
#t-3:checked ~ .dots label[for="t-2"],
#t-3:checked ~ .dots label[for="t-4"],
#t-4:checked ~ .dots label[for="t-3"],
#t-4:checked ~ .dots label[for="t-5"],
#t-5:checked ~ .dots label[for="t-4"] {
	transform: scale(1.5);
}
#t-1:checked ~ .testimonials label[for="t-3"],
#t-2:checked ~ .testimonials label[for="t-4"],
#t-3:checked ~ .testimonials label[for="t-5"],
#t-4:checked ~ .testimonials label[for="t-1"],
#t-5:checked ~ .testimonials label[for="t-2"] {
	transform: translate3d(600px, 0, -180px) rotateY(-25deg);
	z-index: 2;
}
#t-1:checked ~ .testimonials label[for="t-2"],
#t-2:checked ~ .testimonials label[for="t-3"],
#t-3:checked ~ .testimonials label[for="t-4"],
#t-4:checked ~ .testimonials label[for="t-5"],
#t-5:checked ~ .testimonials label[for="t-1"] {
	transform: translate3d(300px, 0, -90px) rotateY(-15deg);
	z-index: 3;
}
#t-2:checked ~ .testimonials label[for="t-1"],
#t-3:checked ~ .testimonials label[for="t-2"],
#t-4:checked ~ .testimonials label[for="t-3"],
#t-5:checked ~ .testimonials label[for="t-4"],
#t-1:checked ~ .testimonials label[for="t-5"] {
	transform: translate3d(-300px, 0, -90px) rotateY(15deg);
	z-index: 3;
}
#t-3:checked ~ .testimonials label[for="t-1"],
#t-4:checked ~ .testimonials label[for="t-2"],
#t-5:checked ~ .testimonials label[for="t-3"],
#t-2:checked ~ .testimonials label[for="t-5"],
#t-1:checked ~ .testimonials label[for="t-4"] {
	transform: translate3d(-600px, 0, -180px) rotateY(25deg);
}
#t-1:checked ~ .testimonials label[for="t-1"],
#t-2:checked ~ .testimonials label[for="t-2"],
#t-3:checked ~ .testimonials label[for="t-3"],
#t-4:checked ~ .testimonials label[for="t-4"],
#t-5:checked ~ .testimonials label[for="t-4"],
#t-5:checked ~ .testimonials label[for="t-5"] {
	z-index: 4;
}

    </style>
</head>
<body>
    



<!-- <div class="slider">
        <input type="radio" name="testimonial" id="t-1">
        <input type="radio" name="testimonial" id="t-2">
        <input type="radio" name="testimonial" id="t-3" checked>
        <input type="radio" name="testimonial" id="t-4">
        <input type="radio" name="testimonial" id="t-5">
        <div class="testimonials">
            <label class="item" for="t-1">
                <img src="../Webshop/img/alaplap.jpg" alt="picture">
                
                <h2 style="font-size:10px">- asdasdas, Web Developer</h2>
				<a href="asd.php"><button type="button" class="btn">Részletek</button></a>
            </label>
            <label class="item" for="t-2">
                <img src="../Webshop/img/termekekuj/1_Ryzen 5 5600_1679839489.jpg" alt="picture">
                
                <h2>- Princy, Web Developer</h2>
				<button type="button" class="btn">Részletek</button>
            </label>
            <label class="item" for="t-3">
                <img src="../Webshop/img/termekekuj/2_1679490039.jpg" alt="picture">
                
                <h2>- Princy, Web Developer</h2>
				<button type="button" class="btn">Részletek</button>
            </label>
            <label class="item" for="t-4">
                <img src="../Webshop/img/termekekuj/3_PRIME B450M-K II_1679911022.jpg" alt="picture">
                
                <h2>- Princy, Web Developer</h2>
				<button type="button" class="btn">Részletek</button>
            </label>
            <label class="item" for="t-5">
                <img src="../Webshop/img/termekekuj/4_Wave V2_1679933663.jpg" alt="picture">
                
                <h2>- Princy, Web Developer</h2>
				<button type="button" class="btn">Részletek</button>
            </label>
        </div>
        <div class="dots">
            <label for="t-1"></label>
            <label for="t-2"></label>
            <label for="t-3"></label>
            <label for="t-4"></label>
            <label for="t-5"></label>
        </div>
    </div> -->


	<!-- <!DOCTYPE html>
<html>
<body>

<h1>The Window Object</h1>
<h2>The setInterval() Method</h2>

<p id="demo"></p>

<script>
const element = document.getElementById("demo");
setInterval(function() {element.innerHTML = Math.random()}, 3000);
</script>

</body>
</html> -->


    <?php  print($ki)?>



	
<!-- require("kapcsolat.php");
$delete = "UPDATE `termek` SET akcio= 0, akcioIdo = 00000-00-00";
$deleteQuery = mysqli_query($dbconnect, $delete);


$update = "UPDATE `termek` SET akcio= 1, akcioIdo = NOW() WHERE akcio = 0 ORDER BY rand() LIMIT 5";
$updateQuery = mysqli_query($dbconnect, $update);
$newTime = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +5minutes"));
$asd = "SELECT DATEDIFF(`akcioIdo`, {$newTime}) AS `daysUntil` FROM termek";
$e = mysqli_query($dbconnect, $asd);
$rows = mysqli_fetch_assoc($e);
// $stmt = $dbconnect->prepare("SELECT DATEDIFF(`akcioIdo`, NOW()) AS `daysUntil` FROM termek");
// $stmt->execute();

// $row = $stmt->fetch();
if($rows['daysUntil'] >= 0) {
	echo 'Greater'; // banned
	$sql = "SELECT * FROM termek WHERE akcio = 1";
$eredmenyek = mysqli_query($dbconnect, $sql);

$ki = '<div class="slider">
<input type="radio" name="testimonial" id="t-1">
<input type="radio" name="testimonial" id="t-2">
<input type="radio" name="testimonial" id="t-3" checked>
<input type="radio" name="testimonial" id="t-4">
<input type="radio" name="testimonial" id="t-5">
<div class="testimonials">
';

$i = 1;
$_SESSION["deal"] = array();

while($sor = mysqli_fetch_assoc($eredmenyek)){   
    $_SESSION["deal"][] = $sor["id"];
    $termekNev = $sor['termekNev'];
    $foto = $sor['foto'];
    
    $ki .= "
        <label class='item' for='t-{$i}'>
        <img src='../Webshop/img/termekekuj/{$foto}' alt='picture'>
        
        <h2 style='font-size:10px'>{$termekNev}</h2>
        <a href='adat.php?id={$sor['id']}&deal=1'><button type='button' class='btn'>Részletek</button></a>
        </label>
        echo $i;
    ";
    $i++;
}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";	
$ki .= '</div>
<div class="dots">
    <label for="t-1"></label>
    <label for="t-2"></label>
    <label for="t-3"></label>
    <label for="t-4"></label>
    <label for="t-5"></label>
</div>
</div>';

}else{
	echo 'not'; // not banned
} -->


<script src="js/index.js"></script>
</body>
</html>