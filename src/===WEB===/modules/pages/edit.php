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
    $style_subpages_allowed = "";
    $style_subpages_denied = "";

    if(isset($_GET['id'])){  
        $id = $_GET['id'];  
        $sql = "SELECT * FROM pages WHERE id='$id'";
        $sql1 = "SELECT * FROM subwebs";
        $page_result = mysqli_query($con,$sql);
        $subwebs_result = mysqli_query($con,$sql1); 
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
            if($page['toppage'] == ""){
                $style_subpages_allowed = "block";
                $style_subpages_denied = "none";
            }
            else{
                $style_subpages_allowed = "none";
                $style_subpages_denied = "block";
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
                $sql = "UPDATE `pages` SET `public_from`='$ublic_from' WHERE id='$id'";
                $page_result = mysqli_query($con,$sql);
            }
            if(isset($_POST['public_to'])){
                $ublic_to = $_POST['public_to'];
                $sql = "UPDATE `pages` SET `public_to`='$ublic_to' WHERE id='$id'";
                $page_result = mysqli_query($con,$sql);
            }
            $name = $_POST['page_name'];
            $identifier = $_POST['page_identifier'];
            $desc = $_POST['desc'];
            $keywords = $_POST['keywords'];
            $date = $_POST['page_date'];
            $page_move = $_POST['page_move'];
            $subw = $page['subweb_id'];
                    
            if($page_move != 0)
                $subw = $page_move;
                    
            for($i=0;$i<4;$i++)
                $field[$i] = isset($_POST['field'][$i]) ? 1 : 0;

            $visible = $field[0];
            $is_public_from = $field[1];
            $is_public_to = $field[2];
            $locked = $field[3];
                    
            $sql = "UPDATE `pages` SET `name`='$name',`identifier`='$identifier',`descr`='$desc',`keywords`='$keywords',`date`='$date',`visible`=$visible, `locked`=$locked, `is_public_from`=$is_public_from,`is_public_to`=$is_public_to,`subweb_id`=$subw WHERE id='$id'";
            $page_result = mysqli_query($con,$sql);

            $msg = "<strong>ÚSPĚCH:</strong> Základni informace byly uloženy.";
            $msg_visible = "display: block;";
            $msg_class = "success";
        }
        if(isset($_POST['public_from_del'])){
            $sql = "UPDATE `pages` SET `public_from`=NULL WHERE id='$id'";
            $page_later_date_result = mysqli_query($con,$sql);
        }
        if(isset($_POST['public_to_del'])){
            $sql = "UPDATE `pages` SET `public_to`=NULL WHERE id='$id'";
            $page_later_date_result = mysqli_query($con,$sql);
        }
        if(isset($_POST['Content'])){
            $content = $_POST['texta'];
            $sql = "UPDATE `pages` SET `content`='$content'WHERE id='$id'";
            $page_result = mysqli_query($con,$sql);
            
            $msg = "<strong>ÚSPĚCH:</strong> Obsah stránky byl upraven.";
            $msg_visible = "display: block;";
            $msg_class = "success";
        }
        if(isset($_POST['Subpages'])){
            $sql = "SELECT * FROM pages";
            $pages_numb = mysqli_query($con,$sql);
            $pg_numb = $pages_numb->num_rows;
            for($i = 1; $i <= $pg_numb; $i++){
                if(isset($_POST[$i])){
                    $id = $_POST[$i];
                    $sql = "UPDATE `pages` SET `toppage`='" . $page['identifier'] . "' WHERE id='$i'";
                    $result = mysqli_query($con, $sql);
                    if($result){
                        //header('location: .?success=edit');
                    }
                }
            }
            
            $msg = "<strong>ÚSPĚCH:</strong> Podstránky byly nastaveny.";
            $msg_visible = "display: block;";
            $msg_class = "success";
        }
        if(isset($_POST['Delsubpage'])){
            $id = $_POST['subpageid'];
            $sql = "UPDATE `pages` SET `toppage`= NULL WHERE id='$id'";
            $subpage_result = mysqli_query($con,$sql);
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
    <body  class="hm-gradien" style="padding:0px;margin:0px;background-color:#F6F9FF">
<?php
    include '../header/navbar.php';
?>
<div class="row">
<?php
    include '../header/sidebar.php';
?>

<div class="col-md-9 pr-2" style="padding-left:0">
        <section class="container">
            <!--<div class="alert alert-<?php echo $msg_class;?>" style="display:<?php echo $msg_visible;?>; width: 50%"><?php echo $msg;?></div>			-->
            <h3>Upravit stránku</h3>
            <a href=".?fold=<?php echo $page['subweb_id']?>"><i class="fas fa-chevron-left"></i> Seznam stránek</a>
            <hr class="mb-2">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#one">Základní informace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#two">Obsah stránky</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#three">Informace</a>
                </li>
            </ul>
            <div class="container border-right border-bottom border-left" style="background:#fff">
                <br>
                <div class="tab-content">
                    <!--<p><?php //echo $datetime;?></p>-->
                    <div class="bg-white tab-pane active" id="one">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-8">
                                    <h4>Obecné</h4>
                                    <!--<hr style="width:100%">-->
                                    <label for="page_name">Titulek stránky:</label>
                                    <br>
                                    <input type="text" id="page_name"  name="page_name" style="width: 100%" value="<?php echo $page['name']?>" onkeyup="PageURL()" required>
                                    <br>
                                    <label for="page_name">URL identifikátor:</label>
                                    <br>
                                    <input type="text" id="page_identifier"  name="page_identifier" style="width: 100%" value="<?php echo $page['identifier']?>" required>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="d-flex w-25">
                                        <div class="mr-auto">
                                            <h4>Metadata</h4>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-basic btn-sm" data-bs-toggle="popover" title="Co jsou metadata" data-bs-content="Jedná se o data, která mají informační hodnotu o webové stránce, ale nejsou na první pohled vidět. Tato data se nacházejí v kódu HTML webové stránky, většinou mezi tagy <head> a </head> a slouží především jako informace pro roboty vyhledávačů. Mezi metadata patří například popis stránky nebo seznam klíčových slov."><i class="far fa-question-circle"></i></button>
                                        </div>
                                    </div>
                                    <!--<hr style="width:100%">-->
                                    <label for="keywords">Klíčová slova:</label>
                                    <br>
                                    <input type="text" id="keywords"  name="keywords" style="width: 100%" value="<?php echo $page['keywords']?>" onkeyup="" required>
                                    <br>
                                    <label for="">Popis stránky</label>
                                    <br>
                                    <textarea style="width: 100%" name="desc" id="desc" cols="30" rows="3" required><?php echo $page['descr']?></textarea>
                                    <br>
                                    <br>
                                    <br>
                                    <h4>Publikace</h4>
                                    <!--<hr style="width:100%">-->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="date">Datum publikace:</label>
                                            <br>
                                            <input type="date" id="date"  name="page_date" style="width: 100%" value="<?php echo $page['date']?>" required>  
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="date">Datum poslední úpravy:</label>
                                            <br>
                                            <input type="date" id="date"  name="last_modified" style="width: 100%" value="<?php echo date('Y-m-d')?>">
                                        </div>
                                    </div>
                                    <br>
                                    <h4>Zveřejnění</h4>
                                    <!--<hr style="width:100%">-->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="checkbox" id="public_from"  name="field[1]" <?php echo $published_form?>>
                                            <label for="public_from">Zveřejnit od:</label>
                                            <br>
                                            <input type="date" id="date"  name="public_from" value="<?php echo $page['public_from']?>">
                                            <input class="btn btn-link btn-sm" type="submit" name="public_from_del" value="Vymazat">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="checkbox" id="public_to"  name="field[2]" <?php echo $published_to?>>
                                            <label for="public_to">Zveřejnit do:</label>
                                            <br>
                                            <input type="date" id="date"  name="public_to" style="width: 100%" value="<?php echo $page['public_to']?>">
                                            <input class="btn btn-link btn-sm" type="submit" name="public_to_del" value="Vymazat">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <!--<button onclick="identifierGenerate" role="button">Vygenerovat</button>-->
                                    <br>
                                    <br>
                                    <br>   
                                </div>
                                <div class="col-sm-4">
                                    <div class="container border" style="padding:20px;">
                                        <div class="content" style="display:<?php echo $add_image_style?>">
                                            <span class="text text-center" style="text-align:center">Přidat úvodní obrázek</span>
                                            <br>
                                            <br>     
                                            <a href="add_header_pic.php?id=<?php echo $page['id']?>&m=page" class="btn btn-outline-primary btn-block">Přidat</a>
                                        </div>
                                        <div class="content" style="display:<?php echo $select_image_style?>">
                                            <span class="text text-center" style="text-align:center">Úvodní obrázek</span>
                                            <br>
                                            <center>
                                                <img class="my-3 img-thumbnail" src="../../files/obr%C3%A1zky/<?php echo $page['header_img_path']?>" alt="" width="100%">
                                            </center>
                                            <a href="add_header_pic.php?id=<?php echo $page['id']?>&m=page" class="btn btn-outline-primary btn-block">Upravit</a>
                                            <a href="delete_header_pic.php?id=<?php echo $page['id']?>&m=page" class="btn btn-outline-danger btn-block"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                    <br>
                                    <label for="page-move">Přesunout stránku na web:</label>
                                    <br>
                                    <select class="form-select lg-3" style="width:100%; padding:5px;" name="page_move">
                                        <option value="0"> - Vyberte - </option>
                                        <?php   
                                            while($sw = mysqli_fetch_array($subwebs_result)){
                                                echo '<option value="' . $sw['web_id'] . '">' . $sw['web_name'] . '</option>';
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
                                <hr style="width:100%">
                                <div class="container">
                                    <input type="submit" name="General" class="btn btn-primary" value="Uložit"> 
                                    <input type="submit" name="Cancel" class="btn btn-danger" value="Zrušit">     
                                </div>
                            </div>
                        </form>  
                    </div>
                    <div class="bg-white tab-pane fade" style="padding:0px" id="two">
                        <form action="" method="post">
                            <textarea name="texta" id="texta" cols="30" rows="10"><?php echo $page['content']?></textarea>
                            <br>
                            <br>
                            <hr style="width:100%">
                            <div class="container">
                                <input type="submit" name="Content" class="btn btn-primary" value="Uložit">
                                <input type="submit" name="Cancel" class="btn btn-danger" value="Zrušit">     
                            </div>
                        </form>
                    </div>                  
                    <div class="bg-white tab-pane fade" id="three">
                        <h3>Informace o stránce</h3>
                        <table class="table table-responzive table-sm table-striped">
                            <tbody>
                                <tr>      
                                    <td >Název stránky: </td>
                                    <td> <?php echo $page['name']?></td>
                                </tr>
                                <tr>
                                    <td>URL identifikátor: </td>
                                    <td> <?php echo $page['identifier']?></td>
                                </tr>
                                <tr>
                                    <td>Datum zveřejnění: </td>
                                    <td>  <?php echo $page['date']?></td>
                                </tr>
                                <tr>
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
                                    <td> <?php echo $page['subweb_id']?></td>
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
        </section>
        <br>
	</main>
</div>
<?php include '../header/footer.php'?>