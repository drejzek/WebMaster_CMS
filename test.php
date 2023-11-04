<?php

if(isset($_POST['submit'])){
    echo $_POST['chk'];

}
?>


<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="">
</head>

<body>
<form action="" method="post" enctype="multipart/form-data">
<input type="checkbox" name="chk" id="file"> 
<br />
<input type="submit" name="submit" value="Submit" />
</form></body>
</html>
