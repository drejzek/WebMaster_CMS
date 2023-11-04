<?php

$min_perm_requied = 2;

include '../config.php';
include '../sess.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";
    
$sql = "SELECT * FROM cms_news";

$page_result = mysqli_query($con,$sql);
if($page_result->num_rows == 0){
$msg = "<strong>Varování: </strong>nebyl nalezen žádný projekt!";
$msg_visible = "display: block;";
$msg_class = "warning";
}


if(isset($_POST['edit'])){
    header('location: edit_update.php?id=' . $_POST['id']);
}
if(isset($_POST['delete'])){
    header('location: delete_update.php?id=' . $_POST['id']);
}
if(isset($_GET['success'])){
    if($_GET['success'] == 'delete'){
        $msg = "Stránka byla úspěšně smazána.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
    if($_GET['success'] == 'edit'){
        $msg = "Stránka byla úspěšně upravena.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
    if($_GET['success'] == 'create'){
        $msg = "Stránka byla úspěšně vytvořena.";
        $msg_visible = "display: block;";
        $msg_class = "success";
}
if(isset($_GET['err'])){
    if($_GET['err'] == 'noid'){
        $msg = "Nebyla vybrána žádný stránka.";
        $msg_visible = "display: block;";
        $msg_class = "danger";
    }
}
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
			<h2 id="contact" class="card-header">Správa aktualizací</h2>
			<div class="card-body">
			    <div class="alert alert-<?php echo $msg_class?>" role="alert" style="<?php echo $msg_visible;?>">
              <?php echo $msg; ?>
            </div>
			    <a class="btn btn-primary" href="add_update.php">Přidat aktualizaci</a>
            <br>
            <br>
            <?php 
                
                echo ' <table>
                        <tr>
                        <th>ID</th>
                        <th>Název</th>
                        <th>Obsah</th>
                        <th>Akce</th>
                        </tr>
                        ';
                
                    while($page = mysqli_fetch_array($page_result)){
                        echo '
                        <tr>
                            <td style="width:25%;">' . $page['id'] . '</td>
                            <td style="width:50%;">' . $page['name'] . '</td>
                            <td style="width:50%;">' . $page['content'] . '</td>
                            <td><form action="" method="post"><input name="edit" type="submit" value="Upravit"><input name="id" type="hidden" value="' . $page['id'] . '"></form><form action="" method="post"><input name="delete" type="submit" value="Smazat"><input name="id" type="hidden" value="' . $page['id'] . '"></form></td>
                            </tr>
                        ';
                    }     
                echo '
                    </table>';
                ?>
                <br>
            <hr>
            <br>
            <a href="add_update.php">Přidat aktualizaci</a>

			    
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