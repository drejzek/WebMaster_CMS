<?php

$min_perm_requied = 1;

session_start();

include '../config.php';
include '../sess.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";
        
$username = $_SESSION['user'];
    
$sql = "SELECT * FROM cms_users WHERE username='$username'";

$user_result = mysqli_query($con,$sql);

$user =  mysqli_fetch_array($user_result);


if(isset($_POST['submit'])){
$name = $_POST['name'];
$user = $_POST['user'];
$email = $_POST['mail'];
$pass = md5($_POST['pass']);
$pass_repeat = md5($_POST['pass_repeat']);
    
if($pass == $pass_repeat){
    $sql = "UPDATE `cms_users` SET `name`='$name',`username`='$user',`email`='$email', `password`='$pass' WHERE `username`=$username";
    
    $users_result = mysqli_query($con,$sql);
    if($users_result){
            header('location: .?success_user=edit');

    }
}
    
}
if(isset($_POST['back'])){
    header('location: users.php');
}
?>
<?php
    include '../header/head.php';
    ?>
    <body class="hm-gradient">
    <?php
    include '../header/sidebar.php';
    include '../header/navbar.php';
    ?>

	<div class="main">
	<main role="main" class="container" style="margin-left: 270px;background: #fff">
	<div class="alert alert-<?php echo $msg_class;?>" style="display:<?php echo $msg_visible;?>; width: 50%"><?php echo $msg;?></div>
	<?php //if($page != ""){include "$w/edit_page.php";}?>
	<section class="container">
			
			<form action="" method="post">
			<div class="row">
			    <div class="col-sm-3">
                <h4>Osobní údaje</h4>
			        <label for="name">Jméno:</label>
            <br>
			    <input type="text" id="name"  name="name" value="<?php echo $user['name']?>">
			    <br>
			    <label for="user">Uživatelské jméno:</label>
			    <br>
			    <input type="text" id="user" name="user" value="<?php echo $user['username']?>">
			    <br>
			    <label for="mail">Email:</label>
			    <br>
			    <input type="email" id="mail"  name="mail" value="<?php echo $user['email']?>">
			    <br>
			    </div>
			    <div class="col-sm-3">
                <h4>Změna hesla</h4>
			        <label for="pass">Helo:</label>
			    <br>
			    <input type="password" id="pass"  name="pass" value="">
			    <br>
			    <label for="pass_repeat">Heslo znovu:</label>
			    <br>
			    <input type="password" id="pass_repeat"  name="pass_repeat">
			    </div>
			    <div class="col-sm-3">
			        
			    </div>
			</div>
            <hr style="width:100%">
			    <input type="hidden" name="id" value="0">
			    <input type="submit" name="submit">
			    <input type="submit" name="back" value="Zpět">
			</form>
			<br>

		</section>
	</main>
</div>
    
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