<?php
include 'config.php';
if(isset($_GET['article'])){
$target_dir = "../files/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $galery = $_POST['galery'];
    $alt = $_POST['file_alt'];
    $filename = $_FILES["file"]["name"];
    $id = $_POST['galery_id'];
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

//// Check file size
//if ($_FILES["file"]["size"] > 500000) {
//  echo "Sorry, your file is too large.";
//  $uploadOk = 0;
//}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    $galery_add = "INSERT INTO `files`(`name`, `type`, `path`, `alt`,`for_module`, `superior_section`) VALUES ('$filename','$imageFileType','files/" . $filename . "','$alt','article', '$galery')";
    $result_ga = mysqli_query($con, $galery_add);
    header('location: edit_galery.php?id=' . $id);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
else if(isset($_GET['galery'])){
$target_dir = "../files/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $galery = $_POST['galery'];
    $alt = $_POST['file_alt'];
    $filename = $_FILES["file"]["name"];
    $id = $_POST['galery_id'];
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

//// Check file size
//if ($_FILES["file"]["size"] > 500000) {
//  echo "Sorry, your file is too large.";
//  $uploadOk = 0;
//}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    $galery_add = "INSERT INTO `files`(`name`, `type`, `path`, `alt`,`for_module`, `superior_section`) VALUES ('$filename','$imageFileType','files/" . $filename . "','$alt','galery', '$galery')";
    $result_ga = mysqli_query($con, $galery_add);
    header('location: edit_galery.php?id=' . $id);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
?>