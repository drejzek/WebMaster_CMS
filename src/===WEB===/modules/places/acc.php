<?php

$min_perm_requied = 1;

include '../kernel/kernel.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";

$page = "";
$select_image_style = "";
$add_image_style = "";
$style_subarticles_allowed = "";
$style_subarticles_denied = "";

$species_1 = '';
$species_2 = '';
$species_3 = '';
$species_4 = '';
$species_5 = '';
$species_6 = '';
$species_7 = '';
$species_8 = '';
$species_9 = '';

$type_1 = '';
$type_2 = '';
$type_3 = '';
$type_4 = '';
$type_5 = '';
$type_6 = '';

$status_1 = '';
$status_2 = '';
$status_3 = '';
$status_4 = '';

$statistics_1 = '';
$statistics_2 = '';
$statistics_3 = '';

$accessibility_1 = '';
$accessibility_2 = '';
$accessibility_3 = '';
$accessibility_4 = '';
$accessibility_5 = '';

if(isset($_GET['id'])){
    
$id = $_GET['id'];
    
$sql = "SELECT * FROM places WHERE id='$id'";
$sql1 = "SELECT * FROM p_sections";

$place_result = mysqli_query($ccon,$sql);
$p_sections_result = mysqli_query($ccon,$sql1);
    
if($place_result->num_rows == 1){
    $page =  mysqli_fetch_array($place_result);
    if($page['header_img_path'] != ""){
        $select_image_style = "block";
        $add_image_style = "none";
    }
    else{
        $select_image_style = "none";
        $add_image_style = "block";
    }
    switch($page['species']){
        case '0':
            
        break;
        case '1':
            $species_1 = 'selected';
        break;
        case '2':
            $species_2 = 'selected';
        break;       
        case '3':
            $species_3 = 'selected';
        break;
        case '4':
            $species_4 = 'selected';
        break;
        case '5':
            $species_5 = 'selected';   
        break;
        case '6':
            $species_6 = 'selected';   
        break;       
        case '7':
            $species_7 = 'selected';   
        break;
        case '8':
            $species_8 = 'selected';
        break;
        case '9':
            $species_9 = 'selected'; 
        break;
    }
    switch($page['type']){
        case '0':

        break;
        case '1':
            $type_1 = 'selected';
        break;
        case '2':
            $type_2 = 'selected';
        break;       
        case '3':
            $type_3 = 'selected';
        break;
        case '4':
            $type_4 = 'selected';
        break;
        case '5':
            $type_5 = 'selected';
        break;
        case '6':
            $type_6 = 'selected';
        break;       
        case '7':
            $type_7 = 'selected';
        break;       
        case '8':
            $type_8 = 'selected';
        break;
        case '9':
            $type_9 = 'selected';
        break;
        case '10':
            $type_10 = 'selected';
        break;       
        case '11':
            $type_11 = 'selected';
        break;
        case '12':
            $type_12 = 'selected';
        break;
        case '13':
            $type_13 = 'selected';
        break;
        case '14':
            $type_14 = 'selected';
        break;       
        case '15':
            $type_15 = 'selected';
        break;       
        case '16':
            $type_16 = 'selected';
        break;
        case '17':
            $type_17 = 'selected';
        break;
        case '18':
            $type_18 = 'selected';
        break;       
        case '19':
            $type_19 = 'selected';
        break;
        case '20':
            $type_20 = 'selected';
        break;       
        case '21':
            $type_21 = 'selected';
        break;
        case '22':
            $type_22 = 'selected';
        break;       
        case '23':
            $type_23 = 'selected';
        break;
        case '24':
            $type_24 = 'selected';
        break;
        case '25':
            $type_25 = 'selected';
        break;
        case '26':
            $type_26 = 'selected';
        break;       
        case '27':
            $type_27 = 'selected';
        break;       
        case '28':
            $type_28 = 'selected';
        break;
        case '29':
            $type_29 = 'selected';
        break;
        case '30':
            $type_30 = 'selected';
        break;       
        case '31':
            $type_31 = 'selected';
        break;
        case '32':
            $type_ = 'selected';
        break;
        case '33':
            $type_5 = 'selected';
        break;
        case '34':
            $type_6 = 'selected';
        break;       
        case '35':
            $type_ = 'selected';
        break;       
        case '36':
            $type_ = 'selected';
        break;
        case '37':
            $type_1 = 'selected';
        break;
        case '38':
            $type_2 = 'selected';
        break;       
        case '39':
            $type_3 = 'selected';
        break;
        case '40':
            $type4 = 'selected';
        break;
        case '41':
            $type4 = 'selected';
        break;
        case '42':
            $type4 = 'selected';
        break;
        case '43':
            $type4 = 'selected';
        break;  
        case '44':
            $type4 = 'selected';
        break;  
        case '45':
            $type4 = 'selected';
        break;   
    }

    switch($page['status']){
        case '0':
        break;
        case '1':
            $status_1 = 'selected';
        break;
        case '2':
            $status_2 = 'selected';
        break;       
        case '3':
            $status_3 = 'selected';
        break;
        case '4':
            $status_4 = 'selected';
        break;
    }
    switch($page['statistics']){
        case '0':

        break;
        case '1':
            $statistics_1 = 'selected';
        break;
        case '2':
            $statistics_2 = 'selected';
        break;        
        case '3':
            $statistics_3 = 'selected';

        break;
    }
    switch($page['accessibility']){
        case '0':

        break;
        case '1':
            $accessibility_1 = 'selected';
        break;
        case '2':
            $accessibility_2 = 'selected';
        break;       
        case '3':
            $accessibility_3 = 'selected';
        break;
        case '4':
            $accessibility_4 = 'selected';
        break;
        case '5':
            $accessibility_5 = 'selected';
        break;
    }
    
}
else{
    $msg = "<strong>CHYBA:</strong> Lokace nebyla nalezena.";
    $msg_visible = "display: block;";
    $msg_class = "danger";
    }
if(isset($_POST['General'])){
    if(isset($_POST['public_from'])){
        $ublic_from = $_POST['public_from'];
        $sql = "UPDATE `articles` SET `public_from`='$ublic_from' WHERE id='$id'";
        $place_result = mysqli_query($ccon,$sql);
    }
    if(isset($_POST['public_to'])){
        $ublic_to = $_POST['public_to'];
        $sql = "UPDATE `articles` SET `public_to`='$ublic_to' WHERE id='$id'";
        $place_result = mysqli_query($ccon,$sql);
    }

    $name = $_POST['place_name'];
    $coordinates = $_POST['coordinates'];
    $identifier = $_POST['place_identifier'];
    $keywords = $_POST['keywords'];
    $desc = $_POST['desc'];
    $species = $_POST['species'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $statistics = $_POST['statistics'];
    $accessibility = $_POST['accessibility'];
    $img_dir = $_POST['img_dir'];
    $keywords = $_POST['keywords'];
    $date = date('Y-m-d');
    $place_move = $_POST['place_move'];
    $subw = $page['a_sec'];
            
    if($place_move != 0)
        $subw = $place_move;
            
    for($i=0;$i<4;$i++)
        $field[$i] = isset($_POST['field'][$i]) ? 1 : 0;

    $visible = $field[0];
    $is_public_from = $field[1];
    $is_public_to = $field[2];
    $locked = $field[3];
            
    $sql = "UPDATE `places` SET `name`='$name',`coordinates`='$coordinates',`identifier`='$identifier',`descr`='$desc',`keywords`='$keywords',`species`='$species',`type`='$type',`status`='$status',`statistics`='$statistics',`accessibility`='$accessibility',`img_dir`='$img_dir',`visible`='$visible',`locked`='$locked', a_sec='$place_move' WHERE id='$id'";
    $place_result = mysqli_query($ccon,$sql);

    header('location: .?success=edit');

    $msg = "<strong>ÚSPĚCH:</strong> Provedené změny byly uloženy.";
    $msg_visible = "display: block;";
    $msg_class = "success";
}
if(isset($_POST['public_from_del'])){
    $sql = "UPDATE `articles` SET `public_from`=NULL WHERE id='$id'";
    $place_later_date_result = mysqli_query($ccon,$sql);
}
if(isset($_POST['public_to_del'])){
    $sql = "UPDATE `articles` SET `public_to`=NULL WHERE id='$id'";
    $place_later_date_result = mysqli_query($ccon,$sql);
}
if(isset($_POST['Content'])){
    $ccontent = $_POST['texta'];
    $sql = "UPDATE `articles` SET `content`='$ccontent'WHERE id='$id'";
    $place_result = mysqli_query($ccon,$sql);
    
    $msg = "<strong>ÚSPĚCH:</strong> Obsah stránky byl upraven.";
    $msg_visible = "display: block;";
    $msg_class = "success";
}
if(isset($_POST['Subarticles'])){
    $sql = "SELECT * FROM articles";
    $articles_numb = mysqli_query($ccon,$sql);
    $pg_numb = $articles_numb->num_rows;
    
    for($i = 1; $i <= $pg_numb; $i++){
        if(isset($_POST[$i])){
            $id = $_POST[$i];
            $sql = "UPDATE `articles` SET `toppage`='" . $page['identifier'] . "' WHERE id='$i'";
            $result = mysqli_query($ccon, $sql);
            if($result){
    //        header('location: .?success=edit');
                }
            }
    }
    
    $msg = "<strong>ÚSPĚCH:</strong> Podstránky byly nastaveny.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    
}
if(isset($_POST['Delsubpage'])){
    $id = $_POST['subpageid'];
    $sql = "UPDATE `articles` SET `toppage`= NULL WHERE id='$id'";
    $subplace_result = mysqli_query($ccon,$sql);
    $msg = "<strong>ÚSPĚCH:</strong> Podstránka byla smazána.";
        $msg_visible = "display: block;";
        $msg_class = "success";
}
}
else{
    header('location: .?err=noid');
}
if(isset($_GET['editor'])){
    $w = $_GET['editor'];
}
else{
   header("location: ?id=$id&editor=wg"); 
}
if(isset($_POST['back-to-wysiwyg'])){
                    header("location: edit_article.php?id=" . $_GET['id'] . "&editor=wg");
                }
?>
<?php
                
                $visibled = "";
                $lockeded = "";
                $published_form = "";
                $published_to = "";
                   
                if($page['visible'] == 1){
                    $visibled = "checked";
                }
                if($page['locked'] == 1){
                    $lockeded = "checked";
                }
                
            ?>
<?php
    include '../header/head.php';
    ?>
    <body  class="hm-gradien" style="padding:0px;background-color:#F6F9FF">
<?php
    include '../header/navbar.php';
?>
<div class="row">
<?php
    include '../header/sidebar.php';
?>

<div class="col-md-10" style="padding:0">
	<main role="main" class="container loadable w-100 h-100"  style="width: 100%">
	<section class="container">

                <div class="card w-50">
                    <div class="card-header">
                        <h4>Přihlášení</h4>
                    </div>
                    <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Uživatel</label>
                            <div class="col-sm-10">
                            <input type="text" style="box-shadow:none" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Heslo</label>
                            <div class="col-sm-10">
                            <input type="password" style="box-shadow:none" class="form-control" id="inputPassword3">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2 d-flex">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Zapamatovat si mě</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2 d-flex">
                                <button type="submit" class="btn btn-success">Přihlásit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

		</section>
		<br>
	</main>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
<!--    <script src="../js/js.js"></script>-->
    <script src="../js/tinymce/tinymce.min.js"></script>
    <script>
    <?php include '../js/tinymce/tinymce.define.min.js';?>
    </script>
    <script>
        
    function PageURL() {
  var vstupniElement = document.getElementById("place_name");
  var vystupniElement = document.getElementById("place_identifier");
  
  var vstupniText = vstupniElement.value;
  
  // Přepis mezer na pomlčky
  var textSPomlckami = vstupniText.replace(/\s/g, "-");
  
  // Převod velkých písmen na malá písmena
  var textMalymiPismeny = textSPomlckami.toLowerCase();
  
  // Odstranění diakritiky
  var textBezDiakritiky = textMalymiPismeny.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  
  vystupniElement.value = textBezDiakritiky;
}

        
    </script>
</body>
</html>
