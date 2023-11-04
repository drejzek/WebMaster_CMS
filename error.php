<?php

$min_perm_requied = 0;
$msg = "";
$msg_c = "";

include 'config.php';
include 'sess.php';

if(isset($_GET['c'])){
    switch($_GET['c']){
        case "400":
            $msg = "Požadavek nemůže být vyřízen, poněvadž byl syntakticky nesprávně zapsán.";
            $msg_c = "400";
            break;
        case "401":
            $msg = "Je vyžadována autorizace!";
            $msg_c = "401";
            break;
        case "403":
            $msg = "Přístup byl zamítnut!";
            $msg_c = "403";
            break;
        case "404":
            $msg = "Požadovaná stránka nebyla nalezena!";
            $msg_c = "404";
            break;
        case "500":
            $msg = "Vyskytla se vnitřní chyba serveru!";
            $msg_c = "500";
            break;
    }
}

?>

	<?php
    include 'header/head.php';
    ?>
    <body  class="hm-gradient">
    <?php
    include 'header/sidebar.php';
    include 'header/navbar.php';
    ?>

    <div class="main">
	    <main role="main" class="container mb-5 p-3" style="padding-left:0px;margin-left:270px;background: #fff">   
            <h2><i class="fas fa-exclamation-triangle text-danger"></i> Vyskytla se chyba</h2>
            <span class="text-muted">Kód chyby: <?php echo $msg_c?></span>
            <div class="container border my-3 p-3">
                <span class=""><?php echo $msg?></span>
            </div>
        </main>
    </div>
    
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
	<script>
//	$('.navbar-nav>li>a').on('click', function(){
//		$('.navbar-collapse').collapse('hide');
//	});
	//window.addEventListener("hashchange", function() { scrollBy(0, -50) })

	var shiftWindow = function() { scrollBy(0, -60) };
	if (location.hash) shiftWindow();
	window.addEventListener("hashchange", shiftWindow);
	</script>
</body>
</html>