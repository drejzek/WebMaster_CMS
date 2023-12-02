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

if(isset($_GET['id'])){
    
$id = $_GET['id'];
    
$sql = "SELECT * FROM articles WHERE id='$id'";
$sql1 = "SELECT * FROM a_sections";

$page_result = mysqli_query($ccon,$sql);
$a_sections_result = mysqli_query($ccon,$sql1);
    
if($page_result->num_rows == 1){
    $page =  mysqli_fetch_array($page_result);
    if($page['header_img_path'] != ""){
        $select_image_style = "block";
        $add_image_style = "none";
    }
    else{
        $select_image_style = "none";
        $add_image_style = "block";
    }
}
    else{
        $msg = "<strong>CHYBA:</strong> Stránka nebyla nalezena.";
        $msg_visible = "display: block;";
        $msg_class = "danger";
    }
if(isset($_POST['General'])){
    if(isset($_POST['public_from'])){
        $ublic_from = $_POST['public_from'];
        $sql = "UPDATE `articles` SET `public_from`='$ublic_from' WHERE id='$id'";
        $page_result = mysqli_query($ccon,$sql);
    }
    if(isset($_POST['public_to'])){
        $ublic_to = $_POST['public_to'];
        $sql = "UPDATE `articles` SET `public_to`='$ublic_to' WHERE id='$id'";
        $page_result = mysqli_query($ccon,$sql);
    }

    $name = $_POST['page_name'];
    $identifier = $_POST['page_identifier'];
    $ccontent = $_POST['page_content'];
    $desc = $_POST['desc'];
    $img_dir = $_POST['img_dir'];
    $keywords = $_POST['keywords'];
    $date = $_POST['page_date'];
    $page_move = $_POST['page_move'];
    $subw = $page['a_sec'];
            
    if($page_move > 0)
        $subw = $page_move;
            
    for($i=0;$i<4;$i++)
        $field[$i] = isset($_POST['field'][$i]) ? 1 : 0;

    $visible = $field[0];
    $is_public_from = $field[1];
    $is_public_to = $field[2];
    $locked = $field[3];
            
    $sql = "UPDATE `articles` SET `name`='$name',`identifier`='$identifier', `content`='$ccontent',`descr`='$desc',`img_dir`='$img_dir',`keywords`='$keywords',`date`='$date',`visible`=$visible, `locked`=$locked, `is_public_from`=$is_public_from,`is_public_to`=$is_public_to,`a_sec`=$subw WHERE id='$id'";
    $page_result = mysqli_query($ccon,$sql);

    $msg = "<strong>ÚSPĚCH:</strong> Základni informace byly uloženy.";
    $msg_visible = "display: block;";
    $msg_class = "success";
}
if(isset($_POST['public_from_del'])){
    $sql = "UPDATE `articles` SET `public_from`=NULL WHERE id='$id'";
    $page_later_date_result = mysqli_query($ccon,$sql);
}
if(isset($_POST['public_to_del'])){
    $sql = "UPDATE `articles` SET `public_to`=NULL WHERE id='$id'";
    $page_later_date_result = mysqli_query($ccon,$sql);
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
    $subpage_result = mysqli_query($ccon,$sql);
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
                if($page['public_from'] == 1){
                    $published_from = "checked";
                }
                if($page['public_to'] == 1){
                    $published_to = "checked";
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
    <form action="" method="post">
    <div class="d-flex">
    <div class="me-auto">
        <h3>Upravit článek</h3>
        <a href=".?fold=<?php echo $page['a_sec']?>"><i class="fas fa-chevron-left"></i> Seznam článků</a>
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
      <a class="nav-link" data-toggle="tab" href="#three">Informace</a>
    </li>
  </ul>
  
  <div class="container border-right border-bottom border-left bg-white">
  <div class="tab-content bg-white p-3" style="background:#fff">
<!--           <p><?php //echo $datetime;?></p>-->
            
                <div class="bg-white tab-pane active" id="one">
                <div class="row">
      <div class="col-8">
                       <h4>Obecné</h4>
<!--                       <hr style="width:100%">-->
        <div class="form-group mb-3">
            <label for="page_name">Titulek stránky:</label>
            <input class="form-control" type="text" id="page_name"  name="page_name" value="<?php echo $page['name']?>" onkeyup="PageURL()" required>
        </div>
        <div class="bg-white tab-pane fadee" id="two">
			        <textarea name="page_content" id="texta" cols="30" rows="10"><?php echo $page['content']?></textarea>
			    </div>
      </div>
      <div class="col-sm-4">
      <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#h-img" aria-expanded="false" aria-controls="flush-collapseOne">
        Úvodní obrázek
      </button>
    </h2>
    <div id="h-img" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      <div class="container border" style="padding:20px;">
              <div class="content" style="display:<?php echo $add_image_style?>">
                  <span class="text text-center" style="text-align:center">Přidat úvodní obrázek</span>
              <br>
              <br>     
              <a href="add_article_pic.php?id=<?php echo $page['id']?>&m=page" class="btn btn-outline-primary btn-block">Přidat</a>
              </div>
              <div class="content" style="display:<?php echo $select_image_style?>">
                  <span class="text text-center" style="text-align:center">Úvodní obrázek</span>
              <br>
              <hr style="width:100%;">
              <center>
              <img src="../../img/<?php echo $page['img_dir']?>/<?php echo $page['header_img_path']?>" alt="" width="50%">
              </center>
                <hr style="width:100%;">
              <a href="add_article_pic.php?id=<?php echo $page['id']?>&m=page" class="btn btn-outline-primary btn-block">Upravit</a>
              <a href="add_article_pic.php?id=<?php echo $page['id']?>&m=page" class="btn btn-outline-danger btn-block"><i class="far fa-trash-alt"></i></a>
              </div>
          </div>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#img-dir" aria-expanded="false" aria-controls="flush-collapseTwo">
        Adresář obrázků
      </button>
    </h2>
    <div id="img-dir" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <label for="img_dir">Adresář obrázků</label>
        <input class="form-control" type="text" id="img_dir" name="img_dir" value="<?php echo $page['img_dir']?>">
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#meta" aria-expanded="false" aria-controls="flush-collapseThree">
        Metadata
      </button>
    </h2>
    <div id="meta" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      <label for="keywords">Klíčová slova:</label>
                <br>
			    <input class="form-control" type="text" id="keywords"  name="keywords" style="width: 84%" value="<?php echo $page['keywords']?>" onkeyup="" required>
			    <br>
			    <label for="">Popis stránky</label>
			    <br>
			    <textarea class="form-control" style="width:84%" name="desc" id="desc" cols="30" rows="3" required><?php echo $page['descr']?></textarea>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#url" aria-expanded="false" aria-controls="flush-collapseThree">
        URL identifikátor
      </button>
    </h2>
    <div id="url" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      <div class="form-group">
            <label for="page_name">URL identifikátor:</label>
            <input class="form-control" type="text" id="page_identifier"  name="page_identifier" style="width: 84%" value="<?php echo $page['identifier']?>" required>
        </div>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sec" aria-expanded="false" aria-controls="flush-collapseThree">
        Rubrika
      </button>
    </h2>
    <div id="sec" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      <label for="page-move">Přesunout do rubriky:</label>
			    <br>
			    <select class="form-select lg-3" style="width:100%; padding:5px;" name="page_move">
                    <option> - Vyberte - </option>
                    <?php
                        
                        while($sw = mysqli_fetch_array($a_sections_result)){
                            echo '<option value="' . $sw['sec_id'] . '">' . $sw['sec_name'] . '</option>';
                        }
                        
                    ?>
                </select>
      </div>
    </div>
  </div>
 
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#public" aria-expanded="false" aria-controls="flush-collapseThree">
        Publikace
      </button>
    </h2>
    <div id="public" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <div class="form-group mb-3">
            <label for="date">Datum publikace:</label>
            <br>
		    <input class="form-control" type="date" id="date"  name="page_date" style="width: 100%" value="<?php echo $page['date']?>" required>
        </div>
        <div class="form-group">
            <label for="date">Datum poslední úpravy:</label>
            <br>
			<input class="form-control" type="date" id="date"  name="last_modified" style="width: 100%" value="<?php echo date('Y-m-d')?>">
        </div>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fpublic" aria-expanded="false" aria-controls="flush-collapseThree">
        Plánované zveřejnění
      </button>
    </h2>
    <div id="fpublic" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">                    <input type="checkbox" id="public_from"  name="field[1]" <?php echo $published_form?>>
                     <label for="public_from">Zveřejnit od:</label>
                <br>
			    <input class="form-control" type="date" id="date"  name="public_from" value="<?php echo $page['public_from']?>">
			    <input class="btn btn-link btn-sm" type="submit" name="public_from_del" value="Vymazat">
                <br>
                <br>
                <input type="checkbox" id="public_to"  name="field[2]" <?php echo $published_to?>>
                <label for="public_to">Zveřejnit do:</label>
                <br>
			    <input class="form-control" type="date" id="date"  name="public_to" style="width: 100%" value="<?php echo $page['public_to']?>">
			    <input class="btn btn-link btn-sm" type="submit" name="public_to_del" value="Vymazat"></div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#options" aria-expanded="false" aria-controls="flush-collapseThree">
        Možnosti
      </button>
    </h2>
    <div id="options" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
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
</div>
                
      </div>
  </div>
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
  var vstupniElement = document.getElementById("page_name");
  var vystupniElement = document.getElementById("page_identifier");
  
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
