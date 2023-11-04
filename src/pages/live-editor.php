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
    $style_subpages_allowed = "";
    $style_subpages_denied = "";

    if(isset($_GET['id'])){  
        $id = $_GET['id'];  
        $sql = "SELECT * FROM pages WHERE id='$id'";
        $sql1 = "SELECT * FROM subwebs";
        $sqlb = "SELECT * FROM page_blocks WHERE page_id = $id";
        $page_result = mysqli_query($con,$sql);
        $subwebs_result = mysqli_query($con,$sql1); 
        $blocks_result = mysqli_query($con,$sqlb); 
        if($page_result->num_rows > 0){

        }
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

        if(isset($_POST['SaveBlock'])){
            $i = $_POST['BlockID'];
            if(isset($_POST['editor-' . $i])){
                $text = $_POST['editor-' . $i];
                $sql_u = "UPDATE page_blocks SET page_id='$id', content='$text' WHERE block_id='$i'";
                $r_u = mysqli_query($con, $sql_u);
            }
        }

        if(isset($_POST['InsertBlock'])){
            $i = $_POST['BlockID'];
            if(isset($_POST['editor-' . $i])){
                $text = $_POST['editor-' . $i];
                $sql_u = "INSERT INTO `page_blocks`(`page_id`, `block_id`, `content`, `block_type`) VALUES ('$id', '$i', '$text', 'text')";
                $r_u = mysqli_query($con, $sql_u);
            }
        }

        if(isset($_POST['SaveImage'])){
            $i = $_POST['imageBlockID'];
            if(isset($_POST['editor-' . $i])){
                $text = $_POST['editor-' . $i];
                $sql_u = "UPDATE page_blocks SET page_id='$id', content='$text' WHERE block_id='$i'";
                $r_u = mysqli_query($con, $sql_u);
            }
        }

        if(isset($_POST['InsertImage'])){
            $i = $_POST['imageBlockID'];
            if(isset($_POST['editor-' . $i])){
                $text = $_POST['editor-' . $i];
                $sql_u = "INSERT INTO `page_blocks`(`page_id`, `block_id`, `content`, `block_type`) VALUES ('$id', '$i', '$text', 'img')";
                $r_u = mysqli_query($con, $sql_u);
            }
        }

        if(isset($_POST['deleteBlock'])){
            $i = $_POST['BlockID'];
            if(isset($_POST['editor-' . $i])){
                $text = $_POST['editor-' . $i];
                $sql_u = "DELETE FROM page_blocks WHERE block_id='$i'";
                $r_u = mysqli_query($con, $sql_u);
            }
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
    include '../header/le-navbar.php';
?>
<style>
    .tab-pane{
        padding:0px;
    }

    /*tinymce styles*/
    .editor {
        border: none;
        background-color:none;
        outline:none;
}

div.card,
.tox div.card {
  width: 240px;
  background: white;
  border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: 0 4px 8px 0 rgba(34, 47, 62, .1);
  padding: 8px;
  font-size: 14px;
  font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
}

div.card::after,
.tox div.card::after {
  content: "";
  clear: both;
  display: table;
}

div.card h1,
.tox div.card h1 {
  font-size: 14px;
  font-weight: bold;
  margin: 0 0 8px;
  padding: 0;
  line-height: normal;
  font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
}

div.card p,
.tox div.card p {
  font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
}

div.card img.avatar,
.tox div.card img.avatar {
  width: 48px;
  height: 48px;
  margin-right: 8px;
  float: left;
}
.edit-btn{
position: absolute;
right: 0px;
}
.edit-button{
    right: 40px;
}
.save-button{
    right: 80px;
}
</style>

<?php //include '../../assets/header.php'?>
<div class="editable mx-3">
    <h1><?php echo $page['name']?></h1>
    <div id="content">
        <?php
            //foreach ($blocks as $index => $content) {
            $index = 1;
            while ($blocks = mysqli_fetch_array($blocks_result)) {
                if($blocks['block_type'] == 'text'){

                    echo '<style>.tools{display:block}.block:hover .tools{display: block}</style>';
                    echo '<div id="block-' . $index . '" class="block mb-3">';
                    echo '<form method="post">';
                    echo '<div class="tools">';
                    echo '<button type="button" class="btn edit-btn edit-button edit-' . $index . '" data-index="' . $index . '" style="display:block"><i class="fas fa-pen"></i></button>';
                    echo '<button type="button" class="btn edit-btn delete-button delete-' . $index . '" data-index="' . $index . '" style="display:block" data-bs-toggle="modal" data-bs-target="#mDeleteBlock-' . $index . '"><i class="far fa-trash-alt"></i></button>';
                    echo '<button type="submit" name="SaveBlock" class="save-btn-' . $index . ' edit-btn save-button btn" style="display:none"><i class="fas fa-save"></i></button>';
                    echo '<input type="hidden" name="BlockID" value="' . $index . '" data-index="' . $index . '">';
                    echo '<span class="text-muted">Blok ' . $index . ': </span>';
                    echo '
                        <div class="modal fade" id="mDeleteBlock-' . $index . '">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Opravdu si přejete smazat blok ' . $index . '?
                                    </div>
                                    <div class="modal-body">
                                        <div class="container text-center">     
                                            <button type="submit" name="deleteBlock" class="btn btn-danger mx-2 shadow-sm">ANO</button>
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-success mx-2 shadow-sm" id="addBlock-image" data-bs-dismiss="modal">Ne</button>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <span class="text-muted">Tuto akci nelze odvolat!</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    echo '<hr>';
                    echo '</div>';
                    echo '<div class="editor" id="div-' . $index . '" style="block">' . $blocks['content'] . '</div>';
                    echo '<textarea style="visibility:hidden;border:none;outline:none;background-color:none;height:auto" class="editor" id="editor-' . $index . '" name="editor' . $index . '">' . $blocks['content'] . '</textarea>';
                    echo '</div>';
                    echo '<script>const editB' . $index . ' = document.querySelector(".edit-' . $index . '");editB' . $index . '.addEventListener("click", function() {document.querySelector(".save-btn-' . $index . '").style.display="block";document.querySelector("#div-' . $index . '").style.display="none";document.querySelector("#editor-' . $index . '").style.visibility="visible";const index = this.dataset.index;tinymce.init({selector: "#editor-" + index,language: "cs",plugins: "preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons",menubar: "file edit view insert format tools table help",toolbar: "undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl",toolbar_sticky: true,autosave_ask_before_unload: true,autosave_interval: "30s",autosave_prefix: "{path}{query}-{id}-",autosave_restore_when_empty: false,autosave_retention: "2m",image_advtab: true,});const editorContent = tinymce.get("editor-" + index).getContent();tinymce.get("editor-" + index).setContent(editorContent);});const deleteB' . $index . ' = document.querySelector(".delete-' . $index . '");deleteB' . $index . '.addEventListener("click",function(){const index = this.dataset.index;/*document.querySelector("#block-" + index).remove();*/});</script>';
                    echo '</form>';
                    $index++;
                }
                else if($blocks['block_type'] == 'img'){

                    echo '<style>.tools{display:block}.block:hover .tools{display: block}</style>';
                    echo '<div id="block-' . $index . '" class="block mb-3">';
                    echo '<form method="post">';
                    echo '<div class="tools">';
                    echo '<button type="button" class="btn edit-btn edit-button edit-' . $index . '" data-index="' . $index . '" style="display:block"><i class="fas fa-pen"></i></button>';
                    echo '<button type="button" class="btn edit-btn delete-button delete-' . $index . '" data-index="' . $index . '" style="display:block" data-bs-toggle="modal" data-bs-target="#mDeleteBlock-' . $index . '"><i class="far fa-trash-alt"></i></button>';
                    echo '<button type="submit" name="SaveBlock" class="save-btn-' . $index . ' edit-btn save-button btn" style="display:none"><i class="fas fa-save"></i></button>';
                    echo '<input type="hidden" name="BlockID" value="' . $index . '" data-index="' . $index . '">';
                    echo '<span class="text-muted">Blok ' . $index . ': </span>';
                    echo '
                        <div class="modal fade" id="mDeleteBlock-' . $index . '">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Opravdu si přejete smazat blok ' . $index . '?
                                    </div>
                                    <div class="modal-body">
                                        <div class="container text-center">     
                                            <button type="submit" name="deleteBlock" class="btn btn-danger mx-2 shadow-sm">ANO</button>
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-success mx-2 shadow-sm" id="addBlock-image" data-bs-dismiss="modal">Ne</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <span class="text-muted">Tuto akci nelze odvolat!</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    echo '<hr>';
                    echo '</div>';
                    echo '<img src="' . $blocks['content'] . '">';
                    echo '</div>';
                    echo '<script>const editB' . $index . ' = document.querySelector(".edit-' . $index . '");editB' . $index . '.addEventListener("click", function() {document.querySelector(".save-btn-' . $index . '").style.display="block";document.querySelector("#div-' . $index . '").style.display="none";document.querySelector("#editor-' . $index . '").style.visibility="visible";const index = this.dataset.index;tinymce.init({selector: "#editor-" + index,language: "cs",plugins: "preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons",menubar: "file edit view insert format tools table help",toolbar: "undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl",toolbar_sticky: true,autosave_ask_before_unload: true,autosave_interval: "30s",autosave_prefix: "{path}{query}-{id}-",autosave_restore_when_empty: false,autosave_retention: "2m",image_advtab: true,});const editorContent = tinymce.get("editor-" + index).getContent();tinymce.get("editor-" + index).setContent(editorContent);});const deleteB' . $index . ' = document.querySelector(".delete-' . $index . '");deleteB' . $index . '.addEventListener("click",function(){const index = this.dataset.index;/*document.querySelector("#block-" + index).remove();*/});</script>';
                    echo '</form>';
                    $index++;
                }
            }

        
        ?>
    </div>
    <button class="btn w-100 bg-light py-5" type="button" data-bs-toggle="modal" data-bs-target="#mAddBlock">Přidat blok</button>
    <div class="modal fade" id="mAddBlock">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Přidat blok
                </div>
                <div class="modal-body">
                    <div class="container text-center">     
                        <button class="btn btn-light border rounded p-3 mx-2 shadow-sm" id="addBlock-text" data-bs-dismiss="modal"><i style="font-size:20px" class="fas fa-font"></i></button>
                        <button class="btn btn-light border rounded p-3 mx-2 shadow-sm" id="addBlock-image" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#mAddImage"><i style="font-size:20px" class="fas fa-image"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mAddImage">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Přidat obrázek
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon1">Vybrat obrázek</button>
                        <input name="" id="imageAdress" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                    </div>
                        <div class="form-group">
                            <label for="imgAlign">Zvolte zarovnání</label>
                            <select name="imgAlign" id="imgAlign" class="form-select">
                                <option value="0">Vlevo</option>
                                <option value="1">Na střed</option>
                                <option value="2">Vpravo</option>
                            </select>
                            <input type="hidden" value="" name="imageBlockID" id="imageBlockID">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="addBlock-img" name="InsertImage">Uložit</button>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Zrušit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../../assets/footer.php'?>

</form>

<?php
if (isset($_POST['submit'])) {
    echo "<h2>Odeslané obsahové bloky:</h2>";
    foreach ($_POST['content'] as $index => $text) {
        echo "Blok " . ($index + 1) . ": " . $text . "<br>";
    }
}
?>

<script>

let blockCounter = <?php echo $blocks_result->num_rows + 1; ?>;

document.getElementById("addBlock-text").addEventListener("click", function() {

    const form =  document.createElement('form');
    form.method = 'post';

    const block = document.createElement("div");
    block.className = "block";

    const tools = document.createElement("div");
    tools.className = "tools";
    
    const deleteButton = document.createElement("button");
    deleteButton.className = 'btn edit-btn delete-button edit-' + blockCounter; 
    deleteButton.type = 'buttom'; 
    deleteButton.dataset.index = blockCounter - 1;

    const deleteButtonIco = document.createElement("i");
    deleteButtonIco.className = 'far fa-trash-alt';

    const saveButton = document.createElement("button");
    saveButton.name = 'InsertBlock';
    saveButton.type = 'submit';
    saveButton.className = 'btn edit-btn save-button edit-' + blockCounter; 

    const saveButtonIco = document.createElement("i");
    saveButtonIco.className = 'fas fa-save';
    
    const blockNumber = document.createElement("span");
    blockNumber.className = 'text-muted';
    blockNumber.textContent = "Blok " + blockCounter + ": ";

    const hr = document.createElement('hr');
    
    const editorDiv = document.createElement("div");
    editorDiv.className = "editor";
    editorDiv.id = "editor-" + blockCounter;

    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'BlockID';
    hidden.value = blockCounter;

    const script = document.createElement('script');
    script.textContent = 'const editB' + blockCounter + ' = document.querySelector(".edit-' + blockCounter + '");editB' + blockCounter + '.addEventListener("click", function() {document.querySelector(".save-btn-' + blockCounter + '").style.display="block";document.querySelector("#div-' + blockCounter + '").style.display="none";document.querySelector("#editor-' + blockCounter + '").style.visibility="visible";const index = this.dataset.index;tinymce.init({selector: "#editor-" + index,language: "cs",plugins: "preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons",menubar: "file edit view insert format tools table help",toolbar: "undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl",toolbar_sticky: true,autosave_ask_before_unload: true,autosave_interval: "30s",autosave_prefix: "{path}{query}-{id}-",autosave_restore_when_empty: false,autosave_retention: "2m",image_advtab: true,});const editorContent = tinymce.get("editor-" + index).getContent();tinymce.get("editor-" + index).setContent(editorContent);});const deleteB' + blockCounter + ' = document.querySelector(".delete-' + blockCounter + '");deleteB' + blockCounter + '.addEventListener("click",function(){const index = this.dataset.index;document.querySelector("#block-" + index).remove();});'
    
    tools.appendChild(blockNumber);
    tools.appendChild(saveButton);
    saveButton.appendChild(saveButtonIco);
    tools.appendChild(deleteButton);
    deleteButton.appendChild(deleteButtonIco);
    tools.appendChild(hr);
    form.appendChild(tools);
    form.appendChild(hidden);
    form.appendChild(editorDiv);
    form.appendChild(script);
    block.appendChild(form);
    
    document.getElementById("content").appendChild(block);
    
    // Inicializace TinyMCE editoru pro tento blok
    tinymce.init({
        selector: "#editor-" + blockCounter,
        language: 'cs',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
    });

    
    blockCounter++;
});

document.getElementById("addBlock-image").addEventListener("click", function() {
    
    document.querySelector("#imageBlockID").value = blockCounter;
    document.querySelector("#imageAdress").name = 'editor-' + blockCounter;
    
    blockCounter++;
});
</script>

<div class="modal fade" id="mPageInfo" style="padding:0">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                Nastavení stránky
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-2">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-general-tab" data-bs-toggle="pill" data-bs-target="#pills-general" type="button" role="tab" aria-controls="pills-general" aria-selected="true">Obecné</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-publish-tab" data-bs-toggle="pill" data-bs-target="#pills-publish" type="button" role="tab" aria-controls="pills-piblish" aria-selected="false">Publikace</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-later-tab" data-bs-toggle="pill" data-bs-target="#pills-later" type="button" role="tab" aria-controls="pills-later" aria-selected="false">Zveřejnění</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-pagepicture-tab" data-bs-toggle="pill" data-bs-target="#pills-pagepicture" type="button" role="tab" aria-controls="pills-page-picture" aria-selected="false">Úvodní obrázek</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-other-tab" data-bs-toggle="pill" data-bs-target="#pills-other" type="button" role="tab" aria-controls="pills-other" aria-selected="false">Ostatní</button>
                                </li>
                            </ul>
                            <div class="footer">
                                <input type="submit" name="General" class="btn btn-primary" value="Uložit"> 
                                <input type="button" data-bs-dismiss="modal" name="Cancel" class="btn btn-danger" value="Zrušit">
                            </div>

                        </div>
                        <div class="col-8">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab" tabindex="0" style="background:#fff">
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
                                <!--<hr style="width:100%">-->
                                <label for="keywords">Klíčová slova:</label>
                                <button type="button" class="btn btn-basic btn-sm" data-bs-toggle="popover" title="Co jsou metadata" data-bs-content="Jedná se o data, která mají informační hodnotu o webové stránce, ale nejsou na první pohled vidět. Tato data se nacházejí v kódu HTML webové stránky, většinou mezi tagy <head> a </head> a slouží především jako informace pro roboty vyhledávačů. Mezi metadata patří například popis stránky nebo seznam klíčových slov."><i class="far fa-question-circle"></i></button>
                                <br>
                                <input type="text" id="keywords"  name="keywords" style="width: 100%" value="<?php echo $page['keywords']?>" onkeyup="" required>
                                <br>
                                <label for="">Popis stránky</label>
                                <br>
                                <textarea style="width: 100%" name="desc" id="desc" cols="30" rows="3" required><?php echo $page['descr']?></textarea>
                                </div>
                                <div class="tab-pane fade" id="pills-publish" role="tabpanel" aria-labelledby="pills-publish-tab" tabindex="0" style="background:#fff">
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
                            </div>
                            <div class="tab-pane fade" id="pills-later" role="tabpanel" aria-labelledby="pills-later-tab" tabindex="0" style="background:#fff">
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
                            </div>
                            <div class="tab-pane fade" id="pills-pagepicture" role="tabpanel" aria-labelledby="pills-pagepicture-tab" tabindex="0" style="background:#fff">
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
                            </div>
                            <div class="tab-pane fade" id="pills-other" role="tabpanel" aria-labelledby="pills-other-tab" tabindex="0" style="background:#fff">
                                <label for="page-move">Přesunout stránku na web:</label>
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
                    </div>
                    </div>
                    </div>
                </form>  
            </div>
        </div>
    </div>
</div>

<?php include '../header/footer.php'?>