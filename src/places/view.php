<?php

$min_perm_requied = 1;

session_start();

$msg = "";
$msg_visible = "";
$msg_class = "";

$name = "";
$text = "";
$author = "";
$timestamp = "";
if(isset($_GET['id'])){
    
    include '../config.php';
    include '../sess.php';
    
    $id = $_GET['id'];

    $sql = "";
    
    $result = mysqli_query($con,"SELECT * FROM `articles` WHERE id='$id'");
    
    if($result->num_rows > 0){
        $article = mysqli_fetch_array($result);
        
        $name = $article['name'];
        $text = $article['text'];
        $author = $article['author'];
        $timestamp = $article['timestamp'];
    }
    else{
        $msg = "Požadovaný článek nebyl nalezen!";
        $msg_visible = "display: block;";
        $msg_class = "danger";
    }
}
else{
    $msg = "Stránce nebyly předány potřřebná data pro zobrazení článku!";
        $msg_visible = "display: block;";
        $msg_class = "danger";
}

?>
<?php
    include '../header/head.php';
    ?>
    <body>
    <?php
    include '../header/sidebar.php';
    include '../header/navbar.php';
    ?>
	<main role="main" class="container" style="margin-left: 240px;">
	<section>
			<div class="card">
			<h2 id="contact" class="card-header">Náhled článku</h2>
			<div class="card-body">
			
			<div class="alert alert-<?php echo $msg_class?>" role="alert" style="<?php echo $msg_visible;?>">
              <?php echo $msg; ?>
            </div>

            <h1><?php echo $name;?></h1>
					    <p> <?php echo $author .  " • " . $timestamp?></p>
						<p style="text-align:justify"><?php echo $text;?></p>
            
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