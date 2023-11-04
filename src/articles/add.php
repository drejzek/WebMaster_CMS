<?php

$min_perm_requied = 1;

session_start();

include '../config.php';
include '../sess.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";

if(isset($_POST['submit'])){
        $name = $_POST['page_name'];
        $author = $_SESSION['name'];
        $wid = $_POST['wid'];
        $sql = "INSERT INTO `articles`(`name`, `identifier`, `descr`, `keywords`, `content`, `date`, `public_from`, `public_to`, `author`, `a_sec`,`header_img_path`, `visible`, `is_public_from`, `is_public_to`, `locked`) VALUES ('$name','',NULL,NULL,NULL,'" . date('Y-m-d') . "',NULL,NULL,'$author','$wid',NULL,1,0,0,0)";
        $result = mysqli_query($con, $sql);
    
    if($result){
      $sql_id = "SELECT * FROM articles WHERE identifier='$identifier'";
      $r_id = mysqli_query($con, $sql_id);
      $pg = mysqli_fetch_array($r_id);
      $id = $pg['id'];
      header('location: edit.php?id=' . $id);

    } 
    else{
                echo "<b>Chyba</b>: článek nebyl vytvořen!";
                $msg_visible = "block";
                $msg_class = "danger";
    }
}
?>