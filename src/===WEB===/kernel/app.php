<?php

function run(){
    if (file_exists('kernel/kernel.php')){
        include 'kernel/config.php';
        if(!isset($_SESSION['loggedin'])){
            $_SESSION['loggedin'] = false;
        }
        if(!isset($_SESSION['p'])){
            $_SESSION['p'] = "";
        }
        if(isset($_GET['end-view'])){
            $_SESSION['p'] = "";
            header('location: .');
        }
        if($_SESSION['loggedin'] != true || $_SESSION['customer'] != true || $_SESSION['p'] == true){
            if(isset($_GET['clanky'])){
                if($_GET['clanky'] != ""){
                    include 'www/a.php';
                }
                else{
                    include 'www/index.php';
                }
            }
            else{
                require 'www/index.php';
            }
        }
        else{
            require 'app/dashboard.php';
        }
    }
    else{
        echo 'FATÁLNÍ CHYBA: Jádro systému nebylo nalezeno. Pro více informací kontaktujte správce systému.';
    }
}