<?php

$min_perm_requied = 1;

session_start();

include '../config.php';
include '../sess.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";

$page = "";

if(isset($_GET['id'])){
    
$id = $_GET['id'];
    
$sql = "SELECT * FROM articles WHERE id='$id'";

$page_result = mysqli_query($con,$sql);
    

if($page_result->num_rows == 1){
    $page =  mysqli_fetch_array($page_result);
}
}
    else{
        $msg = "<strong>CHYBA:</strong> Stránka nebyla nalezena.";
        $msg_visible = "display: block;";
        $msg_class = "danger";
    }

if(isset($_POST['submit'])){
$content = $_POST['src'];
$sql = "UPDATE `articles` SET `header_img_path`='$content'WHERE id='$id'";
$page_result = mysqli_query($con,$sql);
    
header('location: edit.php?id=' . $id . '#success=add_image');

    $msg = "<strong>ÚSPĚCH:</strong> Obrázek stránky byl upraven.";
        $msg_visible = "display: block;";
        $msg_class = "success";

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
      <section class="container">
        <h4>Vyberte úvodní obrázek</h4>
        <span class="text text-muted">Pro stránku: <?php echo $page['name']?></span>
        <hr style="width:100%">
        <?php
          echo '<div class="row">';
          if ($handle = opendir('../../img/' . $page['img_dir'])) { 
            while (false !== ($entry = readdir($handle))) {
              if ($entry != "." && $entry != "..") {
                echo '
                  <div class="col-lg-2">
                  <form action="" method="post" class="col-thumbnail">
                    <button type="submit" name="submit" class="btn btn-sm border"><img width="100px" height="100px" src="../../img/' . $page['img_dir'] . '/' . $entry . '" alt=""></button>
                    <input name="src" type="hidden" value="' . $entry . '">
                  </form>
                  </div>
                ';
              }
            }
            closedir($handle);
          }
          echo '</div>';
        ?>   
      </section>
    </main>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
<script src="js/js.js"></script>
<script src="js/tinymce/tinymce.min.js"></script>
<script>
$('.navbar-nav>li>a').on('click', function(){
$('.navbar-collapse').collapse('hide');
});
</script>
</body>
</html>
