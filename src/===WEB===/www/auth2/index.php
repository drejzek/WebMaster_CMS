<?php

$min_perm_requied = 1;

session_start();

include 'config.php';

date_default_timezone_set('Europe/Prague');

$invalid_msg = "";
$invalid_msg_style = "none;";
$invalid_msg_class = "danger";

if(isset($_POST['submit'])){

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
                header('location: ../cms');
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
<?php
    include 'assets/head.php';
    ?>
    <body  class="hm-gradien" style="padding:0px;background-color:#F6F9FF">
<?php
    // include 'assets/navbar.php';
?>
<div class="row">
<?php
    // include 'assets/sidebar.php';
?>

<div class="col-md-10" style="padding:0">
	<main role="main" class="container w-100 h-100"  style="width: 100%">
	<section class="container">

                <div class="card w-50 position-absolute" style="top:40%; left:50%; transform:translate(-50%, -50%)">
                    <div class="card-header">
                        <h4>Přihlášení</h4>
                    </div>
                    <div class="card-body">
                    <form method="post" id="form" class="loadable">
                        <div class="alert alert-danger alert-dismissible fade show" id="danger" role="alert" style="display:<?php echo $invalid_msg_style?>">
                            <?php echo $invalid_msg?>
                            <button type="button" class="btn-close" onclick="close()"></button>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Uživatel</label>
                            <div class="col-sm-10">
                            <input type="text" name="username" style="box-shadow:none" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Heslo</label>
                            <div class="col-sm-10">
                            <input type="password" name="pass" style="box-shadow:none" class="form-control" id="inputPassword3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2 d-flex">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Zapamatovat si mě</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2 d-flex">
                                <button type="submit" name="submit" class="btn btn-success">Přihlásit</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center loader invisible">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    </div>
                </div>
		</section>
		<br>
	</main>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script>
        function close(){
            document.querySelector("#danger").style.display = "none";
        }
    </script>
    <script>
        // window.onload = function (){
		// 	document.querySelector(".loadable").style.display = "none";
		// }

        // setTimeout(function() {
		// 	document.querySelector(".loadable").style.display = "block";
		// 	document.querySelector(".loader").style.display = "none";
		// }, 3000);
    </script>
</body>
</html>
