<?php

$min_perm_requied = 1;

include 'kernel/sess.php';

$new = "";
$webstats = 0;
$user_card = "";

$result_users = mysqli_query($con,"SELECT * FROM users WHERE customer_id = $c_id");
$result_usersess = mysqli_query($con,"SELECT * FROM users WHERE username = '" . $_SESSION['user'] . "'");
$result_news = mysqli_query($con,"SELECT * FROM cms_news");
$result_pages = mysqli_query($con,"SELECT * FROM pages");
$result_articles = mysqli_query($con,"SELECT * FROM articles");

$news = $result_news->num_rows;
$cmsusers = $result_users->num_rows;
$pages = $result_pages->num_rows;
$articles = $result_articles->num_rows;

$_news = mysqli_query($con,"SELECT * FROM cms_news WHERE id=$news");
if($_news->num_rows > 0){
    $new = mysqli_fetch_array($_news);
}

$usersess = mysqli_fetch_array($result_usersess);

?>
	<?php
    include 'header/head.php';
    ?>
    <body  class="hm-gradien" style="padding:0px;background-color:#F6F9FF">
	<?php
	include 'header/navbar.php';
	?>
	<div class="row">
	<?php
    include 'header/sidebar.php';
    ?>

<div class="col-md-10
" style="padding:0">
<div class="main">
	<style>
		
		@media (min-width: 991.98px){
			.main-c,.loader{
            /* margin-left: 270px; */
        }
    }
    @media (max-width: 991.98px){
        .main-c,.loader{
        width: 100%;
        margin: 0px;
        }
    }
	.loadable{
		display: none;
	}
    
	/* class="main-c container w-100 mb-5 loadable" */
</style>
	<main role="main" class="container loadable w-100 h-100"  style="width: 100%">
	<br>
	<section class="container">
	<div class="">
		<h4>Vítejte zpět, <?php echo $_SESSION['name']?></h4>
		<hr>
	<div class="row h-50">
						<div class="col-12 col-lg-6">

							<div class="card" id="box">
								<div class="card-header py-1">
									<h4>Novinky</h4>
								</div>
								<div class="card-body">
								<h5><?php echo $new['name']?></h5>
								<p><?php echo $new['content']?></p>
								</div>
							</div>
							<div class="card" id="box">
							<div class="card-header py-1">
									<h4>Články</h4>
								</div>
								<div class="card-body">
									<p>Počet článků: <?php echo $i;?></p>
                                       <a href="articles.php">Přehled článků</a>

                                       <br>
                                        <a href="add_article.php">Přidat článek</a>
                  						</div>
							</div>
						</div>
						<div class="col-12 col-lg-6">
                                                      <?php 
                            
                            if($usersess['perm'] != 2){
    echo '
    
                            <div class="card" id="box">
							<div class="card-header py-1">
									<h4>Uživatel</h4>
								</div>
								<div class="card-body users">
							<p>' . $usersess['name'] . '</p>		
							<a href="user.php">Nastavení uživatele</a>
                                       <br>
                                        <a href="login/logout.php">Odhlásit se</a>
								</div>
							</div>
    
    ';
}
else{
     echo '
     
     						<div class="card" id="box">
							 <div class="card-header py-1">
							 	<h4>Uživatelé</h4>
						 	</div>
								<div class="card-body users">
							<p>';
							
							while($users = mysqli_fetch_array($result_users)){
                                echo $users['name'];
                                echo '<br>';
                            }
							
							echo '</p>		
							<a href="users.php">Přehled uživatelů</a>
                                       <br>
                                        <a href="add_user.php">Přidat uživatele</a>
								</div>
							</div>
     
     ';
}
                            
                            ?> 
                            <div class="card" id="box">
							<div class="card-header py-1">
									<h4>Přehledy</h4>
								</div>
								<div class="card-body">

							<p><?php 
                                
                                
							
                                echo "
                                
                                <table class='stats'>
				                <tr>
				                    <td>Články: </td>
				                    <td>$articles</td>
				                </tr>
				                <tr>
				                    <td>Uživatelé: </td>
				                    <td>$cmsusers</td>
				                </tr>
				                <tr>
				                    <td>Stránky: </td>
				                    <td>$pages</td>
				                </tr>
				                <tr>
				                    <td>Počet návštěv webu: </td>
				                    <td>$webstats</td>
				                </tr>
				            </table>
                                
                                ";
							
							?></p>
							
							<style>
                            
                                .stats{
                                    width: 75%;
                                }
                                .stats tr td{
                                    padding-left: 15px;
                                }
                                .stats tr{
                                    border-bottom: 1px solid #ddd;
                                }
                                .stats tr:hover{
                                    background-color: #fff;
                                }
                                    
                            </style>
				    
								</div>
						</div>
						</div>
					</div>
	</div>
</section>
</main>
<style>
	.center{
		position: absolute;
		left: 50%;
		transform: translate(0, -50%);
	}
</style>
<div class="loader container py-5" style="width: 100%;background: #fff">
	<div class="center">
		<center>
			<div class="spinner-border"></div>
			<br>
			<span>Načítám...</span>
		</center>
	</div>
</div>
</div>
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
	<script>
		window.onload = function (){
			document.querySelector(".loadable").style.display = "none";
		}
		setTimeout(function() {
			document.querySelector(".loadable").style.display = "block";
			document.querySelector(".loader").style.display = "none";
		}, 3000);
	</script>
</body>
</html>