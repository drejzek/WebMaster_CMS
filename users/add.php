<?php

$min_perm_requied = 2;

session_start();

include '../config.php';
include '../sess.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";

if(isset($_POST['submit'])){
$name = $_POST['name'];
$user = $_POST['user'];
$email = $_POST['mail'];
$up = $_POST['perm'];
$pass = md5($_POST['pass']);
$pass_repeat = md5($_POST['pass_repeat']);   
    
if($pass == $pass_repeat){
    $sql = "INSERT INTO `cms_users`(`name`, `email`, `username`, `password`,`perm`,`timestamp`) VALUES ('$name', '$email', '$user', '$pass', '$up', '" . date("d-m-y h:m:s") . "')";
         $result = mysqli_query($con,$sql);
    if($result){
                // Redirect to login page
                $msg = "Účet byl úspěšně vytvořen";
                $msg_visible = "display: block;";
                $msg_class = "success";
                header('location: users.php?success=create');

            } else{
                $msg = "Chyba: účet nebyl vytvořen!";
                $msg_visible = "display: block;";
                $msg_class = "danger";
            }
        }
    else{
        $msg = "Chyba: hesla se neshodují!";
                $msg_visible = "display: block;";
                $msg_class = "danger";
        
    }
}
if(isset($_POST['back'])){
        header('location: users.php');
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
	<main role="main" class="container" style="margin-left:240px">
	<section>
			<div class="card">
			<h2 id="contact" class="card-header">Přidat uživatele</h2>
			<div class="card-body">
			
			<div class="alert alert-<?php echo $msg_class?>" role="alert" style="<?php echo $msg_visible;?>">
              <?php echo $msg; ?>
            </div>
			
			<form action="" method="post">
<!--           <p><?php //echo $datetime;?></p>-->
            <label for="name">Jméno:</label>
            <br>
			    <input type="text" id="name"  name="name">
			    <br>
			    <label for="user">Uživatelské jméno:</label>
			    <br>
			    <input type="text" id="user" name="user">
			    <br>
			    <label for="mail">Email:</label>
			    <br>
			    <input type="email" id="mail"  name="mail">
			    <br>
			    <label for="perm">Práva:</label>
			    <select class="form-select mt-3" name="perm">
                 <option value="0">Bez práv</option>
                 <option value="1">Redaktor</option>
                 <option value="2">Správce</option>
                </select>
                <br>
			    <label for="pass">Helo:</label>
			    <br>
			    <input type="password" id="pass"  name="pass">
			    <br>
			    <label for="pass_repeat">Heslo znovu:</label>
			    <br>
			    <input type="password" id="pass_repeat"  name="pass_repeat">
			    <br>
			    <br>
			    <input type="submit" name="submit">
			    <input type="submit" name="back" value="Zpět">
			</form>
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