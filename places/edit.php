<?php

$min_perm_requied = 1;

session_start();

include '../config.php';
include '../sess.php';

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

<div class="col-md-9" style="padding:0">
	<main role="main" class="container loadable w-100 h-100"  style="width: 100%">
	<section class="container">

			<!-- <div class="alert alert-<?php echo $msg_class;?>" style="display:<?php echo $msg_visible;?>; width: 50%"><?php echo $msg;?></div>			 -->
<form action="" method="post">
<div class="d-flex">
    <div class="mr-auto">
        <h3>Upravit lokaci</h3>
        <a href=".?fold=<?php echo $page['a_sec']?>"><i class="fas fa-chevron-left"></i> Seznam lokací</a>
    </div>
    <div class="mt-3">
        <input type="submit" name="General" class="btn btn-success" value="Uložit">
        <input type="submit" name="Cancel" class="btn btn-danger" value="Zrušit">   
    </div>
</div>
<hr class="mb-2">
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#one">Základní informace</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#two">Podrobné informace</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#three">Informace</a>
    </li>
  </ul>
  
  <div class="container border-right border-bottom border-left bg-white">
    <br>
  <div class="tab-content bg-white" style="background:#fff">
<!--           <p><?php //echo $datetime;?></p>-->
            
                <div class="bg-white tab-pane active" id="one">
                
                <div class="row">
      <div class="col-8">
                       <h4>Obecné</h4>
<!--                       <hr style="width:100%">-->
                        <label for="place_name">Název lokace:</label>
            <br>
			    <input class="form-control" type="text" id="place_name"  name="place_name" style="width: 100%" value="<?php echo $page['name']?>" onkeyup="PageURL()" required>
			    <br>
                <label for="place_name">URL identifikátor:</label>
                <br>
			    <input class="form-control" type="text" id="place_identifier"  name="place_identifier" style="width: 100%" value="<?php echo $page['identifier']?>" required>
			     <br>
			     <br>
			     <br>
			     <div class="row">
             <div class="col-2">
          <h4>Metadata</h4>
                    </div>
             <div class="col-4">
                 <div class="dropdown w-50">
  <button type="button" class="btn btn-basic btn-sm dropdown-toggle" data-toggle="dropdown"><i class="far fa-question-circle"></i></button>
  <div class="dropdown-menu p-3">
    <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum voluptatem aliquam odio fuga sequi iure, corporis? Earum pariatur nesciunt, accusamus. Iste sint temporibus iusto, enim incidunt ad at quisquam dignissimos!</span>
  </div>
</div>
             </div>
         </div>
<!--            <hr style="width:100%">-->
                <label for="keywords">Klíčová slova:</label>
                <br>
			    <input class="form-control" type="text" id="keywords"  name="keywords" style="width: 100%" value="<?php echo $page['keywords']?>" onkeyup="" required>
			    <br>
			    <label for="">Popis lokace</label>
			    <br>
			    <textarea class="form-control" style="width:100%" name="desc" id="desc" cols="30" rows="3" required><?php echo $page['descr']?></textarea>
			    <br>
			    <br>
			    <br>
			    <h4>Souřadnice lokace</h4>
                
                <div class="input-group mb-3">
                    <input class="form-control" type="text" id="coordinates"  name="coordinates" style="width: 93%" value="<?php echo $page['coordinates']?>" onkeyup="" required>
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-bs-toggle="collapse" data-bs-target="#collapseExample"><i class="fas fa-map-marker-alt"></i></button>
                </div>
                        <div id="map"style="height:400px;width:100%"></div>


                <script>
                    <?php
                    $c = '';
                    $z = '';
                    if($page['coordinates'] != ''){
                        $c = $page['coordinates'];
                        $z = '15';
                    }
                    else{
                        $c = '49.760273, 15.333252';
                        $z = '6';
                    }
                    
                    ?>
                    const map = L.map('map').setView([<?php echo $c?>], <?php echo $z?>);

                    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);

                    const popup = L.popup()
                        .setLatLng([<?php echo $c?>])
                        .setContent('<?php echo $c?>')
                        .openOn(map);

                    function onMapClick(e) {
                        popup
                            .setLatLng(e.latlng)
                            .setContent('Souřadnice: ' + e.latlng.toString().replace('LatLng(', '').replace(')', ''))
                            .openOn(map);

                            document.querySelector('#coordinates').value = e.latlng.toString().replace('LatLng(', '').replace(')', '');
                    }

                    map.on('click', onMapClick);
                </script>
      </div>
      <div class="col-sm-4">
          <div class="container border" style="padding:20px;">
              <div class="content" style="display:<?php echo $add_image_style?>">
                  <span class="text text-center" style="text-align:center">Přidat úvodní obrázek</span>
              <br>
              <br>     
              <a href="add_image.php?id=<?php echo $page['id']?>&m=page" class="btn btn-outline-primary btn-block">Přidat</a>
              </div>
              <div class="content" style="display:<?php echo $select_image_style?>">
                  <span class="text text-center" style="text-align:center">Úvodní obrázek</span>
              <br>
              <hr style="width:100%;">
              <center>
              <img src="../../img/<?php echo $page['img_dir']?>/<?php echo $page['header_img_path']?>" alt="" width="50%">
              </center>
                <hr style="width:100%;">
              <a href="add_image.php?id=<?php echo $page['id']?>&m=page" class="btn btn-outline-primary btn-block">Upravit</a>
              <a href="delete_image.php?id=<?php echo $page['id']?>&m=page" class="btn btn-outline-danger btn-block"><i class="far fa-trash-alt"></i></a>
              </div>
          </div>
                <br>
                <label for="img_dir">Adresář obrázků</label>
                <input class="form-control" type="text" id="img_dir" name="img_dir" value="<?php echo $page['img_dir']?>">
               <br>
                <label for="page-move">Přesunout do rubriky:</label>
			    <br>
			    <select class="form-select lg-3" style="width:100%; padding:5px;" name="place_move">
               <option value="0"> - Vyberte - </option>
                <?php
                    
                while($sw = mysqli_fetch_array($p_sections_result)){
                    echo '<option value="' . $sw['sec_id'] . '">' . $sw['sec_name'] . '</option>';
                }
                    
                ?>
                </select>
                <br>
                <br>
                <input type="checkbox" name="field[0]" id="visible" <?php echo $visibled?> value="1">
                <label for="visible">Zobrazit stránku</label>
                <br>
                <input type="checkbox" name="field[3]" id="lock" <?php echo $lockeded?> value="1">
                <label for="lock">Uzamknout stránku</label>
                <br>
                <br>
                <button class="btn btn-outline-primary" style="width:100%"><i class="fas fa-share-alt"></i> Sdílet</button>
                <br>
                <br>
                <button class="btn btn-outline-danger" style="width:100%"><i class="far fa-trash-alt"></i> Smazat</button>
      </div>
                </div>
                </div>
                
			     <div class="bg-white tab-pane fadee px-5" id="two">
                    <label class="mt-2" for="species">Druh lokace</label>
                    <select class="form-select" name="species" id="loc-type1">
                        <option value="0"></option>
                        <option value="1" <?php echo $species_1?>>Obytné</option>
                        <option value="2" <?php echo $species_2?>>Reprezentativvní</option>
                        <option value="3" <?php echo $species_3?>>Průmyslové</option>
                        <option value="4" <?php echo $species_4?>>Veřejné</option>
                        <option value="5" <?php echo $species_5?>>Komerční</option>
                        <option value="6" <?php echo $species_6?>>Vojenské</option>
                        <option value="7" <?php echo $species_7?>>Dopravní</option>
                        <option value="8" <?php echo $species_8?>>Infrastrukturní</option>
                        <option value="9" <?php echo $species_9?>>Technické</option>
                    </select>
                    <label class="mt-2" for="type">Typ lokace</label>
                    <select class="form-select" name="type" id="loc-type2">
                        <option value="0"></option>
                        <optgroup label="Obytné">
                            <option value="2">Městský dům</option>
                            <option value="4">Bytový dům</option>
                            <option value="6">Rodinný dům</option>
                            <option value="3">Vila</option>
                            <option value="5">Venkovský dům</option>
                            <option value="51">- Roubenka</option>
                            <option value="54">- Podstávkový dům</option>
                            <option value="52">- Fara</option>
                            <option value="53">- Vechtrovna</option>
                            <option value="48">Zemědělská usedlost</option>
                        </optgroup>
                        <optgroup label="Reprezentativní">
                            <option value="13">Palác</option>
                            <option value="11">Zámek</option>
                            <option value="10">Hrad</option>
                            <option value="12">Tvrz</option>
                        </optgroup>
                        <optgroup label="Průmyslové">
                            <option value="15">Hutnický</option>
                            <option value="16">Strojírenský</option>
                            <option value="17">Elektrotechnický</option>
                            <option value="18">Chemický</option>
                            <option value="19">Energetický</option>
                            <option value="20">Spotřební</option>
                            <option value="21">Potravinářský</option>
                            <option value="57">- Hospodářský dvůr</option>
                            <option value="55">- Pivovar</option>
                            <option value="56">- Mlýn</option>
                            <option value="22">Stavební</option>
                            <option value="23">Zbrojní</option>
                            <option value="24">Sklářský</option>
                        </optgroup>
                        <optgroup label="Veřejné">
                            <option value="26">Církev</option>
                            <option value="27">Zdravotnictví</option>
                            <option value="28">Školství</option>
                            <option value="58">- Malotřídní škola</option>
                            <option value="59">- Školička</option>
                            <option value="29">Kultura</option>
                            <option value="30">Sport</option>
                            <option value="31">Státní správa</option>
                        </optgroup>
                        <optgroup label="Komerční">
                            <option value="33">Ubytování</option>
                            <option value="34">Restaurace</option>
                            <option value="35">Kino</option>
                            <option value="36">Koupaliště</option>
                            <option value="37">Obchodní dům</option>
                            <option value="38">Rekreační areál</option>
                            <option value="47">Administrativa</option>
                            <option value="50">Ostatní</option>
                        </optgroup>
                        <optgroup label="Vojenské">
                            <option value="40">Rota</option>
                            <option value="41">Kasárna</option>
                            <option value="49">Ostatní</option>
                        </optgroup>
                        <optgroup label="Dopravní">
                            <option value="43">Kolejová doprava</option>
                            <option value="44">Letecká doprava</option>
                            <option value="45">Vodní doprava</option>
                        </optgroup>
                    </select>
                    <label class="mt-2" for="status">Stav lokace</label>
                    <select class="form-select" name="status" id="status">
                        <option value="0"></option>
                        <option value="1" <?php echo $status_1?>>Používaný</option>
                        <option value="2" <?php echo $status_2?>>Částečne používaný</option>
                        <option value="3" <?php echo $status_3?>>Prázdný</option>
                        <option value="4" <?php echo $status_4?>>Zaniklý</option>
                    </select>
                    <label class="mt-2" for="statistics">Stav statiky</label>
                    <select class="form-select" name="statistics" id="statistics">
                        <option value="0"></option>
                        <option value="1" <?php echo $statistics_1?>>Špatný</option>
                        <option value="2" <?php echo $statistics_2?>>Dobrý</option>
                        <option value="3" <?php echo $statistics_3?>>Výborný</option>
                    </select>
                    <label class="mt-2" for="accessibility">Přístupnost</label>
                    <select class="form-select" name="accessibility" id="accessibility">
                        <option value="0"></option>
                        <option value="1" <?php echo $accessibility_1?>>Nepřístupné</option>
                        <option value="2" <?php echo $accessibility_2?>>Špatně přístupné</option>
                        <option value="3" <?php echo $accessibility_3?>>Hůř přístupné</option>
                        <option value="4" <?php echo $accessibility_4?>>Lépe přístupné</option>
                        <option value="5" <?php echo $accessibility_5?>>Zcela přístupné</option>
                    </select>
			    </div>
                              
                   <div class="bg-white tab-pane fade" id="three">
                    <h3>Informace o stránce</h3>
                    <table class="table table-responzive table-sm table-striped">
                        <tbody>
                        <tr> 
                            
                        <td >Název stránky: </td>
                        <td> <?php echo $page['name']?></td>
                    </tr>
                        <tr >
                        <td>URL identifikátor: </td>
                        <td> <?php echo $page['identifier']?></td>
                    </tr>
                        <tr >
                        <td>Datum zveřejnění: </td>
                        <td>  <?php echo $page['date']?></td>
                    </tr>
                        <tr >
                        <td>Datum posledních úprav:</td>
                        <td>  <?php echo date('d. m. Y')?></td>
                    </tr>
                        <tr >
                        <td>Zveřejnit od: </td>
                        <td>  <?php echo $page['public_from']?></td>
                    </tr>
                        <tr >
                        <td>Zveřejnit do: </td>
                        <td> <?php echo $page['public_to']?></td>
                    </tr>
                        <tr >
                        <td>ID webu: </td>
                        <td> <?php echo $page['a_sec']?></td>
                    </tr>
                        <tr >
                        <td>Klíčová slova (META): </td>
                        <td> <?php echo $page['keywords']?></td>
                    </tr>
                        <tr >
                        <td>Popis stránky (META):</td> 
                        <td>  <?php echo $page['descr']?></td>
                    </tr>
                        <tr >
                        <td>Obrázek: </td>
                        <td>  <?php echo $page['header_img_path']?></td>
                    </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                 <br>
                </div>
            </form>
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
