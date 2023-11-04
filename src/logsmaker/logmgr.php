<?php

function AddLog($event, $user)
{
    $date = date('Y-m-d h:m:s');  
    $sql = "INSERT INTO logs (event, date, user) VALUES ('$event','$date','$user')";
    $r = mysql_result($con, $sql);
}
?>