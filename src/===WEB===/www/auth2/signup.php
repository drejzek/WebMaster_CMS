<?php

/* $min_perm_requied = 1;

session_start();

include 'config.php';
include 'sess.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = ""; */

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
	<main role="main" class="container loadable w-100 h-100"  style="width: 100%">
	<section class="container">

    <div class="card position-absolute" style="top:40%; left:50%; transform:translate(-50%, -50%)">
                    <div class="card-header">
                        <h4>Registrace</h4>
                    </div>
                    <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Jméno</label>
                            <div class="col-sm-9">
                            <input type="text" style="box-shadow:none" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mail" class="col-sm-3 col-form-label">E-mail</label>
                            <div class="col-sm-9">
                            <input type="email" style="box-shadow:none" class="form-control" id="mail">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tel" class="col-sm-3 col-form-label">Telefon</label>
                            <div class="col-sm-9">
                            <input type="tel" style="box-shadow:none" class="form-control" id="tel">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="user" class="col-sm-3 col-form-label">Uživatelské jméno</label>
                            <div class="col-sm-9">
                            <input type="text" style="box-shadow:none" class="form-control" id="user">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pass" class="col-sm-3 col-form-label">Heslo</label>
                            <div class="col-sm-9">
                            <input type="password" style="box-shadow:none" class="form-control" id="pass">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="passRepeat" class="col-sm-3 col-form-label">Heslo znovu:</label>
                            <div class="col-sm-9">
                            <input type="password" style="box-shadow:none" class="form-control" id="passRepeat">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-9 offset-sm-2 d-flex">
                                <button type="submit" class="btn btn-success">Přihlásit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
		</section>
		<br>
	</main>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
<!--    <script src="../js/js.js"></script>-->
    <script src="../js/tinymce/tinymce.min.js"></script>
    <script>
    <?php include '../js/tinymce/tinymce.define.min.js';?>
    </script>
    <script>
        
    function PageURL() {
  var vstupniElement = document.getElementById("place_name");
  var vystupniElement = document.getElementById("place_identifier");
  
  var vstupniText = vstupniElement.value;
  
  // Přepis mezer na pomlčky
  var textSPomlckami = vstupniText.replace(/\s/g, "-");
  
  // Převod velkých písmen na malá písmena
  var textMalymiPismeny = textSPomlckami.toLowerCase();
  
  // Odstranění diakritiky
  var textBezDiakritiky = textMalymiPismeny.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  
  vystupniElement.value = textBezDiakritiky;
}

        
    </script>
</body>
</html>
