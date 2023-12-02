<?php

$min_perm_requied = 1;

include '../kernel/kernel.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";

if(isset($_GET['id'])){
    
$id = $_GET['id'];
    
$sql = "SELECT * FROM users WHERE id='$id'";

$user_result = mysqli_query($con,$sql);

$user =  mysqli_fetch_array($user_result);
    
switch ($user['perm']){
    case '0':
        $p0 = 'selected';
        $p1 = '';
        $p2 = '';
        $p3 = '';
        break;
    case '1':
        $p0 = '';
        $p1 = 'selected';
        $p2 = '';
        $p3 = '';
        break;
    case '2':
        $p0 = '';
        $p1 = '';
        $p2 = 'selected';
        $p3 = '';
        break;
    case '3':
        $p0 = '';
        $p1 = '';
        $p2 = '';
        $p3 = 'selected';
        break;
}


if(isset($_POST['submit'])){
$name = $_POST['name'];
$user = $_POST['user'];
$email = $_POST['mail'];
$up = $_POST['perm'];
$pass = md5($_POST['pass']);
$pass_repeat = md5($_POST['pass_repeat']);
$active = "0";
    
if(isset($_POST['active'])){
    $active = "1";
}
    
if($pass != "" && $pass == $pass_repeat){
    $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`username`='$user',`password`='$pass',`perm`='$up',`active`='$active' WHERE id = $id";
    
    $users_result = mysqli_query($con,$sql);
    header('location: users.php?success=edit');

    if($users_result){
        //header('location: users.php?success=edit');
    }
}
else if($pass_repeat == ""){
$sql = "UPDATE `users` SET `name`='$name',`email`='$email',`username`='$user',`perm`='$up', `active`='$active' WHERE id = $id";
    
$users_result = mysqli_query($con,$sql);
header('location: users.php?success=edit');

if($users_result){
    //header('location: users.php?success=edit');
}
}
    else{
        $msg = "<strong>Chyba: </strong>Hesla se neshdoují";
        $msg_visible = "display: block;";
        $msg_class = "danger";
    }
    
}
}
else{
    header('location: articles.php?err=noid');
}
if(isset($_POST['back'])){
    header('location: .');
}
?>
<?php
    include '../header/head.php';
    ?>
    <body  class="hm-gradien" style="padding:0px;background-color:#F6F9FF">
<?php
    include '../header/navbar.php';
?>
<div class="row">
<?php
    include '../header/sidebar.php';
?>

<div class="col-md-9" style="padding:0">
	<main role="main" class="container loadable w-100 h-100"  style="width: 100%">
	<section class="container bg-white mt-3 p-3">		
			<form action="" method="post">
            <h1>Úprava uživatele</h1>
            <hr style="width:100%">
			<div class="row">
			<div class="col-8">

                
                <h4>Osobní údaje</h4>
<div class="row mb-4">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Jméno</label>
  <div class="col-sm-9">
      <input class="form-control" type="text" id="name"  name="name" value="<?php echo $user['name']?>">
  </div>
</div>
<div class="row mb-4">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Uživatel</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" id="user" name="user" value="<?php echo $user['username']?>">
  </div>
</div>
<div class="row mb-4">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
  <div class="col-sm-9">
    <input class="form-control" type="email" id="mail"  name="mail" value="<?php echo $user['email']?>">
  </div>
</div>
                <h4>Změna hesla</h4>


<div class="row mb-4">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Heslo</label>
  <div class="col-sm-9">
    <input class="form-control" type="password" id="pass"  name="pass" value="">
  </div>
</div>
<div class="row mb-4">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Heslo</label>
  <div class="col-sm-9">
    <input class="form-control" type="password" id="pass_repeat"  name="pass_repeat">
  </div>
</div>

<h4>Možnosti</h4>
<div class="row mb-4">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Práva</label>
  <div class="col-sm-9">
    <select class="form-select" name="perm">
        <option value="0" <?php echo $p0 ?>>Žádná</option>
        <option value="1" <?php echo $p1 ?>>Redaktor</option>
        <option value="2" <?php echo $p2 ?>>Správce</option>
        <option value="2" <?php echo $p3 ?>>Root</option>
    </select>
  </div>
</div>
<input id="activate" type="checkbox" name="activate" <?php if($user['active'] == "1"){echo 'checked';}?>>
<label for="activate">Aktivovat účet</label>
			</div>
			</div>
			    <br>
			    <br>
                <hr style="width:100%">
			    <input type="hidden" name="id" value="0">
			    <input value="Uložit" class="btn btn-success" type="submit" name="submit">
			    <input value="Zrušit" class="btn btn-danger" type="submit" name="back" value="Zpět">
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