<?php

// $domain = $_SESSION['domain'];
$domain = "exploreblog";

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,'webmastercms');
$ccon = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,$domain);

?>
