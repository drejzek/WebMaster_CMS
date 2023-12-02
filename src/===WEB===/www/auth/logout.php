<?php 
if(isset($_GET['url']))
    $url = $_GET['url'];
if(isset($_GET['id']))
    $id = $_GET['id'];
    
else
    $url = '';
if(isset($_GET['long-inactive'])){
    session_start();
    $_SESSION['loggedin'] = false;
    $domain = $_SESSION['domain'];
    session_unset();
    session_destroy();
    $_SESSION['domain'] = $domain;
    header('location: lgn-inactive.php?domain=' . $domain . '&url=' . $url . '&id=' . $id);
}
else{
    session_start();
    $_SESSION['loggedin'] = false;
    session_unset();
    session_destroy();
    if(isset($_COOKIE['_userid'])){
        $token = $_COOKIE['_userid'];
        $sql = "DELETE FROM `user_tokens` WHERE token = '$token'";
        mysqli_query($con,$sql);
    }
    header('location: logedout.php');
}
?>