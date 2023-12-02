<!DOCTYPE html>
<html lang="cs">
<head>
<!--   <base href="loalhost/cms/">-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<title>WebMaster CMS</title>
<!--
	<link rel="stylesheet" media="all" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/sidebar.css">
	<link rel="stylesheet" href="css/wg.css">
	<link rel="icon" href="files/img/favicon.png">
-->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    
    <?php
    
        $style = '0';
        if(isset($_GET['style'])){
            $style = $_GET['style'];
        }

    ?>

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/b<?php echo $style?>/bootstrap.css">
	<link rel="stylesheet" href="css/sidebar.php">
	
    <link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/b<?php echo $style?>/bootstrap.css">
	<link rel="stylesheet" href="../css/sidebar.php">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
	
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	<script>
    </script>
    <style>
    
        body{
            overflow-x: hidden;
        }
        .card{
            width: 90%;
        }
        input[type=text],input[type=password],input[type=email], input[type=date], textarea[id]:not([id="texta"]),select{
      width: 100%;
      outline: none;
      border-radius: none;
      border: 1px solid #aaa;
      padding: 5px;
    }
    input[type=text]:focus,input[type=password]:focus,input[type=email]:focus, input[type=date]:focus, textarea[id]:not([id="texta"]):focus, select:focus{
      border: 1px solid #2362A2;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      transition: 0.1s;
    }
    .table{
        background-color: none;
    }
    .list-groupp {
  width: 100%;
  max-width: 460px;
  margin-inline: 1.5rem;
}

.form-check-input:checked + .form-checked-content {
  opacity: .5;
}

.form-check-input-placeholder {
  border-style: dashed;
}
[contenteditable]:focus {
  outline: 0;
}

.list-group-checkable .list-group-item {
  cursor: pointer;
}
.list-group-item-check {
  position: absolute;
  clip: rect(0, 0, 0, 0);
}
.list-group-item-check:hover + .list-grop-item {
  background-color: var(--bs-secondary-bg);
}
.list-group-item-check:checked + .list-group-item {
  color: #fff;
  background-color: var(--bs-primary);
  border-color: var(--bs-primary);
}
.list-group-item-check[disabled] + .list-group-item,
.list-group-item-check:disabled + .list-group-item {
  pointer-events: none;
  filter: none;
  opacity: .5;
}

.list-group-radio .list-group-item {
  cursor: pointer;
  border-radius: .5rem;
}
.list-group-radio .form-check-input {
  z-index: 2;
  margin-top: -.5em;
}
.list-gropp-radio .list-group-item:hover,
.list-group-radio .list-group-item:focus {
  background-color: var(--bs-secondary-bg);
}

.list-group-radio .form-check-input:checked + .list-group-item {
  background-color: var(--bs-body);
  border-color: var(--bs-primary);
  box-shadow: 0 0 0 2px var(--bs-primary);
}
.list-group-radio .form-check-input[disabled] + .list-gropp-item,
.list-group-radio .form-check-input:disabled + .list-group-item {
  pointer-events: none;
  filter: none;
  opacity: .5;
}
        /*
        @media (min-width: 991.98px){
            main{
                margin-left: 240px;
            }
        }
        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
          }
        }*/
/*         .sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 58px 0 0;  Height of navbar 
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  width: 240px;
  z-index: 600;
}


.sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto; Scrollable contents if viewport is shorter than content. 
} */
    .btn{
        border-radius: 0px;
    }
    </style>
</head>