<?php

$min_perm_requied = 1;

include '../kernel/kernel.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";

if(isset($_POST['submit'])){
        $wid = $_POST['page_webid'];
        $name = $_POST['page_name'];
        $identifier = $_POST['page_identifier'];
        $sql = "INSERT INTO `pages`(`name`, `identifier`, `descr`, `keywords`, `content`, `date`, `public_from`, `public_to`, `last_modified`, `toppage`, `subweb_id`, `header_img_path`, `visible`, `locked`, `is_public_from`, `is_public_to`)
        VALUES ('$name','$identifier',NULL,NULL,NULL,'" . date('Y-m-d') . "',NULL,NULL,'" . date('Y-m-d') . "',NULL,'$wid',NULL,1,0,0,0)";
        $result = mysqli_query($con, $sql);
    
    if($result){
      $sql_id = "SELECT * FROM pages WHERE identifier='$identifier'";
      $r_id = mysqli_query($con, $sql_id);
      $pg = mysqli_fetch_array($r_id);
      $id = $pg['id'];
      header('location: edit.php?success=pg_created&id=' . $id);

    } 
    else{
                echo "<b>Chyba</b>: stránka nebyla vytvořena!";
                $msg_visible = "block";
                $msg_class = "danger";
    }
}
?>