<?php

include 'config.php';
include 'sess.php';

$result_users = mysqli_query($con,"SELECT * FROM cms_users");
$result_news = mysqli_query($con,"SELECT * FROM cms_news WHERE id='1'");
$news = mysqli_fetch_array($result_news);

?>

	<?php
    include 'header/head.php';
    ?>
    <body>
    <?php
    include 'header/sidebar.php';
    include 'header/navbar.php';
    ?>

	<main role="main" class="container" style="margin-left:240px">
	<section>
					<div class="card">
					    <div class="card-header"><h2>Navigace</h2></div>
					    <div class="card-body">
					        
					    </div>
					</div>
        </section>
	</main>
    
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
	<script>
	$('.navbar-nav>li>a').on('click', function(){
		$('.navbar-collapse').collapse('hide');
	});
	//window.addEventListener("hashchange", function() { scrollBy(0, -50) })

	var shiftWindow = function() { scrollBy(0, -60) };
	if (location.hash) shiftWindow();
	window.addEventListener("hashchange", shiftWindow);
	</script>
</body>
</html>