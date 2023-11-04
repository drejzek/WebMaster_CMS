<?php

if($_SESSION['loggedin'] != true || $_SESSION['domain'] != true || $_SESSION['customer'] != true){
    if(strpos($_SERVER['PHP_SELF'], 'pages') || strpos($_SERVER['PHP_SELF'], 'articles') || strpos($_SERVER['PHP_SELF'], 'users') || strpos($_SERVER['PHP_SELF'], 'updates') || strpos($_SERVER['PHP_SELF'], 'banners') || strpos($_SERVER['PHP_SELF'], 'sections') || strpos($_SERVER['PHP_SELF'], 'galeries'))
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            header('location: ../../auth/?url=' . $_SERVER['PHP_SELF'] . '&id=' . $id . '&web=' . $_SESSION['web_id']);
        }
        else{
            header('location: ../../auth/?url=' . $_SERVER['PHP_SELF'] . '&web=' . $_SESSION['web_id']);
        
        }
    }
    else{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            header('location: ../auth/?url=' . $_SERVER['PHP_SELF'] . '&id=' . $id . '&web=' . $_SESSION['web_id']);
        }
        else{
            header('location: ../auth/?url=' . $_SERVER['PHP_SELF'] . '&web=' . $_SESSION['web_id']);
        
        }
    }
}

$domain = $_SESSION['domain'];

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,'webmastercms');
$ccon = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,$domain);

?>
