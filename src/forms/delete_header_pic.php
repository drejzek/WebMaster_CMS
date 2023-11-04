<?php

$min_perm_requied = 1;

include '../config.php';
include '../sess.php';

if(isset($_GET['id'])){
    
$id = $_GET['id'];
    
$sql = "SELECT * FROM `pages` WHERE id='$id'";

$page_result = mysqli_query($con,$sql);

$page =  mysqli_fetch_array($page_result);
            
        $sql = "UPDATE `pages` SET `header_img_path`=NULL WHERE id='$id'";
        mysqli_query($con,$sql);
        header('location: edit.php?id=' . $id . '#success=delete_image');
    
}
?>