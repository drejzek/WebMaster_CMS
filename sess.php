<?php


//------------------------------------------------------------------------------

$c_id = $_SESSION['customer'];

$sql_stngs = "SELECT * FROM settings WHERE customer_id = '$c_id'";
$stngs_r = mysqli_query($con, $sql_stngs);
$stngs = mysqli_fetch_array($stngs_r);

//------------------------------------------------------------------------------

if(strpos($_SERVER['PHP_SELF'], "sess")){
    header('location: error.php?c=403');
}

//------------------------------------------------------------------------------

// Nastavíme čas nečinnosti na 1440 sekund (24 minut)
$inactive = $stngs['autologout_time'];
$inactive_on = $stngs['autologout_allowed'] == 1 ? true : false;

if($inactive_on){
    // Zkontrolujeme, jestli byl poslední časový záznam v session
if (isset($_SESSION['last_activity'])) {
    // Spočítáme, jak dlouho uplynulo od poslední aktivity
    $secondsInactive = time() - $_SESSION['last_activity'];

    // Pokud je čas nečinnosti delší než limit, přesměrujeme uživatele na přihlašovací stránku
    if ($secondsInactive >= $inactive) {
        if(strpos($_SERVER['PHP_SELF'], 'pages') || strpos($_SERVER['PHP_SELF'], 'places') || strpos($_SERVER['PHP_SELF'], 'articles') || strpos($_SERVER['PHP_SELF'], 'users') || strpos($_SERVER['PHP_SELF'], 'updates') || strpos($_SERVER['PHP_SELF'], 'banners') || strpos($_SERVER['PHP_SELF'], 'sections')  || strpos($_SERVER['PHP_SELF'], 'forms') || strpos($_SERVER['PHP_SELF'], 'galeries'))
        {
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                header('location: ../../auth/logout.php?long-inactive&url=' . $_SERVER['PHP_SELF'] . '&id=' . $id);
            }
            else{
                header('location: ../../auth/logout.php?long-inactive&url=' . $_SERVER['PHP_SELF']);
            
            }
        }
    else{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            header('location: ../auth/logout.php?long-inactive&url=' . $_SERVER['PHP_SELF'] . '&id=' . $id);
        }
        else{
            header('location: ../auth/logout.php?long-inactive&url=' . $_SERVER['PHP_SELF']);
        
        }
    }
        exit;
    }
}
}

// Aktualizujeme poslední časový záznam v session na aktuální čas
$_SESSION['last_activity'] = time();

// Pokračujeme s běžným prováděním skriptu
// ...


//------------------------------------------------------------------------------



if($_SESSION['loggedin'] != true || $_SESSION['domain'] != true || $_SESSION['customer'] != true){
    if(strpos($_SERVER['PHP_SELF'], 'pages') || strpos($_SERVER['PHP_SELF'], 'articles') || strpos($_SERVER['PHP_SELF'], 'users') || strpos($_SERVER['PHP_SELF'], 'updates') || strpos($_SERVER['PHP_SELF'], 'banners') || strpos($_SERVER['PHP_SELF'], 'sections') || strpos($_SERVER['PHP_SELF'], 'galeries'))
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            header('location: ../auth/?url=' . $_SERVER['PHP_SELF'] . '&id=' . $id . '&web=' . $_SESSION['web_id']);
        }
        else{
            header('location: ../auth/?url=' . $_SERVER['PHP_SELF'] . '&web=' . $_SESSION['web_id']);
        
        }
    }
    else{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            header('location: auth/?url=' . $_SERVER['PHP_SELF'] . '&id=' . $id . '&web=' . $_SESSION['web_id']);
        }
        else{
            header('location: auth/?url=' . $_SERVER['PHP_SELF'] . '&web=' . $_SESSION['web_id']);
        
        }
    }
}
else{
//    
//if(!strpos($_SERVER['PHP_SELF'], "web-selection") && !isset($_SESSION['web_id']) && !isset($_SESSION['web_name'])){
//                if(strpos($_SERVER['PHP_SELF'], 'pages') || strpos($_SERVER['PHP_SELF'], 'articles') || strpos($_SERVER['PHP_SELF'], 'users') || strpos($_SERVER['PHP_SELF'], 'updates') || strpos($_SERVER['PHP_SELF'], 'banners') || strpos($_SERVER['PHP_SELF'], 'sections') || strpos($_SERVER['PHP_SELF'], 'galeries')){
//                    header('location: ../auth/web-selection.php');
//                }
//    else{
//                    header('location: ../auth/web-selection.php');
//        
//    }
//
//}

}


//------------------------------------------------------------------------------



$sess_user = $_SESSION['user'];

$result_perm = mysqli_query($con, "SELECT * FROM `users` WHERE `username`='$sess_user'");

$user_perm = mysqli_fetch_array($result_perm);

if($user_perm['perm'] == "2"){
    $perm = "admin";
}
else if($user_perm['perm'] == "1"){
    $perm = "redactor";
}

if(isset($min_perm_requied)){
    if($min_perm_requied > $user_perm['perm']){
        header('location: index.php');
    }
}


//------------------------------------------------------------------------------



$result_i = mysqli_query($con,"SELECT * FROM articles");

$i = 0;

while($row = mysqli_fetch_array($result_i)){
$i++;
}

//------------------------------------------------------------------------------

$result_settings = mysqli_query($con,"SELECT * FROM settings");

$settings = mysqli_fetch_array($result_settings);


?>