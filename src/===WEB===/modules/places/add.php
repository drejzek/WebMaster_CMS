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
        $sql = "INSERT INTO `places`(`name`, `identifier`,`a_sec`, `visible`) VALUES ('$name','$identifier','$wid',1)";
        $result = mysqli_query($con, $sql);
    
    if($result){
      $sql_id = "SELECT * FROM places WHERE identifier='$identifier'";
      $r_id = mysqli_query($con, $sql_id);
      $pg = mysqli_fetch_array($r_id);
      $id = $pg['id'];
      header('location: edit.php?success=pg_created&id=' . $id);

    } 
    else{
                echo "<b>Chyba</b>: článek nebyl vytvořen!";
                $msg_visible = "block";
                $msg_class = "danger";
    }
}
?>