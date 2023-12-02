<?php

require __DIR__ . '/config.php';

if(isset($_GET['m'])){
    if($_GET['m'] == 'public'){
        $_SESSION['p'] = true;
    }
}