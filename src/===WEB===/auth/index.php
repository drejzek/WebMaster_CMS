<?php

if(isset($_GET['m'])){
  if($_GET['m'] == 'user'){
    header('location: ../www/auth');
  }
}

$invalid_msg = "";
$invalid_msg_style = "none";

$msg = "";
$msg_visible = "display: none;width:0%";
$msg_class = "";

session_start();
if (file_exists('../kernel/kernel.php')){
	include '../kernel/config.php';
}
else{
	echo 'FATÁLNÍ CHYBA: Jádro systému nebylo nalezeno. Pro více informací kontaktujte správce systému.';
  die();
}

if(isset($_POST['submit'])){

    $alias = trim($_POST['alias']);
    $alias = "exploreblog";
    $sql = "SELECT * FROM webs WHERE web_alias='$alias'";
    $r = mysqli_query($con, $sql);
    if($r->num_rows > 0){
        $u = mysqli_fetch_array($r);
        $_SESSION['domain'] = $alias;
        $_SESSION['customer_id'] = $u['customer_id'];
        $customer = $u['customer_id'];
        $username = trim($_POST['username']);
        $pass = md5(trim($_POST['pass']));
        
        $query = "SELECT * FROM `users` WHERE username='$username' AND password='$pass' AND customer_id='$customer'";
        $result = mysqli_query($con,$query);
        if($result->num_rows > 0){
            $user = mysqli_fetch_array($result);
            if($user['active'] == '1'){
                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $user['name'];
                $_SESSION['user'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['customer'] = $user['customer_id'];
                header('location: ../');
            }
        }
        else{
            $invalid_msg= "Zadané údaje jsou neplatné!";
            $invalid_msg_style= "block";
        }
    }
    else{
        $invalid_msg= "Web nebyl v databázi nalezen.";
        $invalid_msg_style= "block";
    }
}
?>


<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webmaster CMS - přihlášení</title>
    <link href="assets/css.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-default" style="background: #2362A2">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" style="color:#fff" href="#">WebMaster CMS</a>
    </div>
  </div>
</nav>

<div class="container d-flex align-items-center justiy-content-center">
    <div class="bg-body-tertiary px-5 border w-50 mx-auto shadow">
      <h3 class="border-bottom p-3 mb-5">Přihlášení do systému</h3>
      <form class="form-horizontal mb-5" method="post">
        <div class="alert alert-danger" style="display:<?php echo $invalid_msg_style?>">
          <span class="text-danger">
              <?php echo $invalid_msg?>
          </span>
        </div>
        <!-- <div class="form-group">
          <label class="control-label col-sm-2" for="alias">Alias/web:</label>
          <div class="col-sm-10">
            <input name="alias" type="text" class="form-control" id="alias" placeholder="Zadejte alias webu">
          </div>
        </div> -->
        <div class="form-group">
          <label class="control-label col-sm-2" for="username">Uživatel:</label>
          <div class="col-sm-10">
            <input name="username" type="text" class="form-control" id="username" placeholder="Zadejte uživatelské jméno">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Heslo:</label>
          <div class="col-sm-10">
            <input name="pass" type="password" class="form-control" id="pwd" placeholder="Zadejte heslo">
          </div>
        </div>
        <div class="form-group">
        </div>
        <div class="form-group d-flex">
          <div class="col-sm-offset-2 col-sm-10 me-auto">
            <button name="submit" type="submit" class="btn btn-default">Přihlásit</button>
          </div>
          <a href="forgot-password.php" class="btn btn-link">Zapomentué heslo</a>
        </div>
      </form>
    </div>
</div>
</body>
</html>