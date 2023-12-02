<?php

include '..//kernel/kernel.php';


if(isset($_POST['submit'])){
  $content = $_POST['src'];
  $id = $_POST['id'];
  echo $content . " " . $id;
  $sql = "UPDATE `articles` SET `header_img_path`='$content' WHERE id='$id'";
  $page_result = mysqli_query($ccon,$sql);
  if($page_result){
    header('location: edit.php?id=' . $id . '#success=add_image');
  }
}
?>