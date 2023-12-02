<?php

include '../kernel/kernel.php';

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";
$al_a = '';

$result_users = mysqli_query($con,"SELECT * FROM cms_users");
$result_settings = mysqli_query($con,"SELECT * FROM settings");
$result_news = mysqli_query($con,"SELECT * FROM cms_news WHERE id='1'");
$news = mysqli_fetch_array($result_news);
$settings = mysqli_fetch_array($result_settings);

if($settings['autologout_allowed']){
    $al_a = 'checked';
}


if(isset($_POST['lock-submit'])){
        $pwd = md5($_POST['pwd']);
        $pwd_repeat = md5($_POST['pwd-repeat']);
    if($pwd != $pwd_repeat){
        $msg = "<strong>CHYBA:</strong> Hesla se neshodují.";
        $msg_visible = "display: block;";
        $msg_class = "danger";
    }
    else{
     $sql = "UPDATE `settings` SET `page_password`='$pwd' WHERE id='1'";
        $page_result = mysqli_query($con,$sql);   
        $msg = "<strong>Úspěch:</strong> Heslo bylo nastaveno.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
}
if(isset($_POST['lock-reset'])){
 
    $sql = "UPDATE `settings` SET `page_password`=NULL WHERE id=1";
    $page_result = mysqli_query($con,$sql);   
    $msg = "<strong>Úspěch:</strong> Heslo bylo resetováno.";
    $msg_visible = "display: block;";
    $msg_class = "success";
}
    
if(isset($_POST['Content'])){
$content = $_POST['texta'];
$sql = "UPDATE `pages` SET `content`='$content'WHERE id='$id'";
$page_result = mysqli_query($con,$sql);

}

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

<div class="col-md-9" style="padding:0">
	<main role="main" class="container loadable w-100 h-100"  style="width: 100%">
	<section class="container">
    <div class="border-bottom mb-3">
      <h2 class="mb-2 mt-2">Nastavení</h1>
    </div>
        
			<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#one">Obecné nastavení</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#two">Nastavení stránek</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#three">Nastavení webu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#four">Nastavení na úrovni modulů</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#five">O systému</a>
    </li>
  </ul>
  
  
  <div class="container border-right border-bottom border-left bg-white">
  <br>
  <div class="tab-content bg-white">
  
<!--           <p><?php //echo $datetime;?></p>-->
            
               <!--               GENERAL-->
                <div class="bg-white tab-pane active" id="one">
                    <h5>Automatické odhlášení</h5>
                    <form action="" class="mb-3">
                        <label for="autologoutallowed" class="mr-2"><input type="checkbox" name="autologoutallowed" id="autologoutallowed" <?php echo $al_a?>> Povolit</label><span class="text-muted">(doporučeno)</span>
                        <div class="form-group">
                            <label for="logouttime">Po dobu nečinnosti:</label>
                            <div class="d-flex w-50">
                                <input class="mr-auto form-control text-end" type="number" name="logouttime" id="logouttime" value="<?php echo ($settings['autologout_time']) / 60?>"> <span class="ml-3">minut</span>
                            </div>
                        </div>
                        <input type="submit" name="autologout" value="Uložit" class="btn btn-primary">
                    </form>

                    <h5>Vzhled systému</h5>
                    <form action="">
                        <div class="form-group">
                            <label for="logouttime">Vzhled:</label>
                            <div class="d-flex w-50">
                                <select class="form-select" name="style" id="style">
                                    <option value="0">Original (BS5 + modifikace)</option>
                                    <option value="0">Starší (BS3 + BS5 + modifikace)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="logouttime">Tmavý režim:</label>
                            <div class="d-flex w-50">
                            <label for="darkmode" class="mr-2"><input type="checkbox" name="darkmode" id="darkmode" <?php echo $al_a?>> Povolit</label>
                            </div>
                        </div>
                        <input type="submit" name="style-save" value="Uložit" class="btn btn-primary">
                    </form>
                </div>
                                   
             <!--               PAGE SETTINGS-->
			     <div class="bg-white tab-pane fadee" id="two">
                     <h4>Známek stránek</h4>
                    <hr style="width:100%">
                    <div class="row">
                        <div class="col-lg-6">
	<?php //if($page != ""){include "$w/edit_page.php";}?>
                  <h5>Heslo:</h5>
                   <form action="" method="post">
                    <label for="pwd">Heslo:</label>
                    <br>
                    <input class="form-control" type="password" size="width:50%" name="pwd" id="pwd">
                    <br>
                    <label for="pwd-repeat">Heslo znovu:</label>
                    <br>
                    <input class="form-control" type="password" size="width:50%" name="pwd-repeat" id="pwd">
                    <br>
                    <br>
                    <input type="submit" value="Potvrdit" name="lock-submit">
                    <input type="submit" value="Resetovat zámek stránky" name="lock-reset">
                   </form>                             
                        </div>
                        <div class="col-sm-5">
                            <h5>Možnosti</h5>
                            <form action="" method="post">
                                <input id="web-lock-activation" type="checkbox">
                                <label for="web-lock-activation">Aktivovat zámek stránek</label>
                            </form>
                        </div>
                    </div>
			         </div>

               <!--               SITE SETTINGS-->
                <div class="bg-white tab-pane fade" id="three">
                    <div class="container mb-3">
                <h4>Obecné nastavení</h4>
                <form action="" method="post">
                        <label for="web-name">Jméno webu:</label>
                        <br>
                        <input class="form-control" type="text" id="web-name" value="" style="width:50%">
                        <br>
                        <label for="comp-name">Název společnosti:</label>
                        <br>
                        <input class="form-control" type="text" id="comp-name" value="" style="width:50%"> 
                        <br>
                        <label for="comp-name-short">Zkrécený název společnosti:</label>
                        <br>
                        <input class="form-control" type="text" id="comp-name-short" value="" style="width:50%">
                        <br>
                        <br>
                        <input type="submit" class="btn btn-primary" name="save-general" value="Uložit">
                    </form>
                    <hr class="w-100">
                    <div class="container mb-3">
                <h4>Google Analytics a Google Tag Manager</h4>
                <form action="" method="post">
                        <label for="mid">Google Analytics - ID měření:</label>
                        <br>
                        <input class="form-control" type="text" id="mid" value="" style="width:50%">
                        <br>
                        <label for="tid">Google Tag Manager- ID měření:</label>
                        <br>
                        <input class="form-control" type="text" id="tid" value="" style="width:50%"> 
                        <br>
                        <br>
                        <input type="submit" class="btn btn-primary" name="save-gagtm" value="Uložit">
                    </form>
                    <hr class="w-100">
                    </div>
                    <h4>Známek webu</h4>
                    <div class="row container mb-3">
                        <div class="col-lg-6">
                    <h5>Heslo</h5>
                    <form action="" method="post">
                        <label for="pwd">Heslo:</label>
                        <br>
                        <input class="form-control" type="password" size="width:50%" name="pwd" id="pwd">
                        <br>
                        <label for="pwd-repeat">Heslo znovu:</label>
                        <br>
                        <input class="form-control" type="password" size="width:50%" name="pwd-repeat" id="pwd">
                        <br>
                        <br>
                        <input class="btn btn-primary" type="submit" value="Uložit" name="lock-submit">
                        <input class="btn btn-warning" type="submit" value="Resetovat zámek stránky" name="lock-reset">
                    </form>                             
                        </div>
                        <div class="col-sm-5">
                            <h5>Možnosti</h5>
                            <form action="" method="post">
                                <input id="web-lock-activation" type="checkbox">
                                <label for="web-lock-activation">Aktivovat zámek webu</label>
                            </form>
                        </div>
                    </div>
            
                
              </div>
              </div>

              <div class="bg-white tab-pane fade" id="four">
                   
                  </div>
   
                 <!--               ABOUT -->

                   <div class="bg-white tab-pane fade" id="five">
                   <h3>WebMaster CMS - Systém pro správu obsahu webu</h3>
                   <hr style="width:100%">
                    <span><strong>Licencováno pro: </strong><?php echo $settings['company_name']?></span>
           <br>
            <span><strong>Verze: </strong><?php echo $settings['ver']?></span>
            <br>
            <span><strong>Autor: </strong>David Rejzek</span>
            <br>
            <span><strong>Copyright: </strong>David Rejzek &copy; 2023 | Všechna práva vyhrazena.</span>
                  </div>
                </div>
                 <br>
                  </div>
		</section>
		<br>
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