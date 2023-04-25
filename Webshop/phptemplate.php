<?php
// $eredmeny = mysqli_query($dbconnect, $sql);
if ((mysqli_num_rows($eredmeny)) < 1) {
    $kimenet = "<article>
    <h2>Nincs találat a rendszerben</h2>
    </article>";
} else {
    $kimenet = "";
    while ($sor = mysqli_fetch_assoc($eredmeny)) {
      $heartIcon = ((isset($_SESSION['user_type']))) ? "<i class='fa fa-heart' style='font-size:36px;' data-id='{$sor["id"]}'></i>" : "";
        $akcio = number_format($sor['ar'] * 0.8, '0', '.', '');
        $ArFormazas = intval($sor['ar']);
        $akciosAr = (in_array($sor['id'], $_SESSION['deal'])) ? "  <span style='font-size:1.4rem; margin-right:40px;'> {$akcio} Ft</span>  <span style='text-decoration:line-through; font-size:1.0rem'> $ArFormazas Ft</span> " :  " <span>$ArFormazas </span> Ft";
        $akciosKeret = (in_array($sor['id'], $_SESSION['deal'])) ? "border: 3px solid red" : "";
        $akciosSzoveg = (in_array($sor['id'], $_SESSION['deal'])) ? "<h2 style='color:red; text-align:center'>AKCIÓS</h2>" : "";
        $akciosLink = (in_array($sor['id'], $_SESSION['deal'])) ?  "<a href='adat.php?id={$sor['id']}&deal=1'>" : "<a href=adat.php?id={$sor['id']}>"; 
        if($sor['darab'] > 0){
        
        $kimenet .=
    <<<URLAP
        <article style='$akciosKeret'>
        <div class="border" >
        $akciosLink
        <img src="img/termekekuj/{$sor['foto']}" alt="{$sor['foto']} "></a>
        </div>
        <span style='display:none'>{$sor['id']}</span>
        $heartIcon
        $akciosSzoveg
        <div class="itemInfo">
            <h2>{$sor['termekNev']}</h2>
            <hr>
            $akciosAr
            <div class='appear' id='show'>
            <input type="number" name="quantity" id="quantity" min="1" max="{$sor["darab"]}" value="1">
            
            <button type="button" class="kosarhoz"><img src="img/cartICON.png" alt="Logo" class='cartImage'>Kosárba</button>
            </div>
        </div>
    
    </article>
   

URLAP;
// echo "<pre>";
// print_r($_SESSION);
// echo "<br> asdasdas";
// print_r($sor['id']);
echo "</pre>";

        } else {
            $kimenet .=
                <<<URLAP
    <article>
    <div class="border">
    <a href=adat.php?id={$sor['id']}">
    <img src="img/termekekuj/{$sor['foto']}" alt="{$sor['foto']} "></a>
    </div>
    <div class="itemInfo">
        <h2>{$sor['termekNev']}</h2>
        <hr>
        <p style='color:red; padding:5px; font-family:900'>ELFOGYOTT TERMÉK</p>
        <div class='appear' id='show'>
        <input type="number" name="quantity" id="quantity" min="1" max="{$sor['darab']}" value="0" disabled>
        
        <button type="button"  class="kosarhozElfogyott" disabled><img src="img/cartICON.png" alt="Logo" class='cartImage' >Kosárba</button>
        </div>
    </div>

</article>

URLAP;
        }
    }
}
?>