<?php

$min_perm_requied = 1;

session_start();

include '../config.php';
include '../sess.php';
include '../logsmaker/logmgr.php';

date_default_timezone_set('Europe/Prague');

$folder = "";
$swid = "";
$p = "";
$p_exists = true;
$script = "";
$msg = "";
$msg_visible = "display: none;";
$msg_class = "";

$sql_m = "SELECT MAX(id) AS id FROM forms";
$result_m = mysqli_query($ccon,$sql_m);

if ($result_m->num_rows > 0) {
    $row = $result_m->fetch_assoc();
    $maxId = $row["id"];
}

//$sql = "SELECT * FROM forms WHERE subweb_id = '" . $_SESSION['web_id'] . "'";

  $sql_p = "SELECT * FROM forms";
  $page_result = mysqli_query($ccon,$sql_p);
  if($page_result->num_rows == 0){
    $p_exists = false;
    $msg = "<strong>Varování: </strong>seznam formulářu je prázdný.";
    $msg_visible = "display: block;";
    $msg_class = "warning";
  }



if(isset($_POST['edit'])){
    header('location: edit.php?id=' . $_POST['id']);
}
if(isset($_POST['delete'])){
    header('location: delete.php?id=' . $_POST['id']);
}

if(isset($_POST['submit-add'])){
  $title = $_POST['form-title'];
  $title = str_replace(" ", "-", $title);
  $form_method = $_POST['form-method'];

  header("location: add.php?params=$title+$form_method");
}

if(isset($_POST['sel_move'])){
  for($i=0;$i<($maxId + 1);$i++){
    if(isset($_POST['page'][$i])){
      $id = $i;
      $swid = $_POST['page_webid'];
      $sql_sm = "UPDATE `forms` SET `subweb_id`=$swid WHERE id='$id'";
      $r_sm = mysqli_query($ccon, $sql_sm);
    }
  }
}

if(isset($_POST['sel_del'])){
  for($i=0;$i<($maxId + 1);$i++){
    if(isset($_POST['page'][$i])){
      $id = $i;
      $sql_sd = "DELETE FROM `forms` WHERE `id`='$id'";
      $r_sd = mysqli_query($ccon, $sql_sd);
    }
  }
}


if(isset($_GET['success'])){
    if($_GET['success'] == 'delete'){
        $msg = "Stránka byla úspěšně smazána.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
    if($_GET['success'] == 'edit'){
        $msg = "Stránka byla úspěšně upravena.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
    if($_GET['success'] == 'pg_created'){
      if(isset($_GET['id'])){
        $sql_sections = "SELECT * FROM forms WHERE id = '" . $_GET['id'] . "'";
        $r_sec = mysqli_query($ccon, $sql_sections);
        $p = mysqli_fetch_array($r_sec);
      }
        $script = "$('#mpgCreated').modal('show');";
        $msg = "Stránka byla úspěšně vytvořena.";
        $msg_visible = "display: block;";
        $msg_class = "success";
}
if(isset($_GET['err'])){
    if($_GET['err'] == 'noid'){
        $msg = "Nebyla vybrána žádný stránka.";
        $msg_visible = "display: block;";
        $msg_class = "danger";
    }
}
}

function Geta_secName($domain, $tpid){  
  $ccon = mysqli_connect("localhost","root","",$domain);
  $sql1 = "SELECT * FROM forms WHERE id='$tpid'";
  $result = mysqli_query($ccon,$sql1);
  $nav = mysqli_fetch_array($result);
  $web = $nav['a_sec'];
  $sql = "SELECT * FROM a_sections WHERE sec_id='$web'";
  $result1 = mysqli_query($ccon, $sql);
  if($result1->num_rows > 0){
      $article = mysqli_fetch_array($result1);
      return $article['sec_name'];
          }
  else{
      return '';
  }
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
  <div class="border-bottom d-flex">
      <h2 class="mb-2 mt-2 me-auto">Formuláře</h1>
      <div class="mt-2">
        <div class="dropdown">
        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-ellipsis-v"></i>
        </button>
        <ul class="dropdown-menu">
          <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mSecAdmin">Nastavení</button></li>
        </ul>
      </div>
      </div>
    </div>
			<div class="mt-2 alert alert-<?php echo $msg_class?> alert-dismissible fade show" role="alert" style="<?php echo $msg_visible;?>">
          <?php echo $msg; ?>
          <button type="button" class="btn-close" data-dismiss="alert"></button>
      </div>
            <br>
            <div class="d-flex">
                <input class="form-control" id="search-bar" type="text" class="w-50 mr-auto" placeholder="Hledat stránku...">
                <span class="text-secondary mx-3">Vybrané: </span>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#mpgAskMove" data-toggle="tooltip" title="Přesunout do sekce"><i class="fas fa-arrow-right"></i></button>
                <button class="btn btn-outline-primary mr-3" data-toggle="modal" data-target="#mpgAskDelete" data-toggle="tooltip" title="Odstranit"><i class="far fa-trash-alt"></i></button>
                <button onclick="seraditTabulku()" class="btn btn-outline-primary" data-toggle="tooltip" title="Seřadit vzestupně"><i class="fas fa-sort-numeric-down"></i></button>
                <button onclick="seraditTabulku()" class="btn btn-outline-primary" data-toggle="tooltip" title="Seředit sestupně"><i class="fas fa-sort-numeric-up"></i></button>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#mfilter" data-toggle="tooltip" title="Filtr"><i class="fas fa-filter"></i></button>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#mAddPage" data-toggle="tooltip" title="Přidat stránku"><i class="fas fa-plus"></i></button>
            </div>
            <br>
                <form method="post">
                <?php 
                                echo ' <table id="forms" class="table table-hover">
                                      <thead>
                                      <tr>
                                      <th><input type="checkbox" name="check_all" onclick="checkAll(this);"></th>
                                      <th>ID</th>
                                      <th>Název</th>
                                      <th></th>
                                      <th></th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      ';
                                  while($page = mysqli_fetch_array($page_result)){
                                    echo '
                                    <tr style="max-height:50px">
                                    <td style="width:5%;"><input type="checkbox" name="page[' . $page['id'] . ']" id="check' . $page['id'] . '"></td>
                                    <td style="width:3%;">' . $page['id'] . '</td>
                                    <td style="width:20%;"><form action="" method="post"><button class="btn btn-link action-link" name="edit" type="submit">' . $page['name'] . '</button><input name="id" type="hidden" value="' . $page['id'] . '"></form></td>
                                    <td style="width:1%;"><form action="" method="post"><button class="text-primary action-link" name="edit" type="submit"><i class="text-primary	fas fa-pen"></i></button><input name="id" type="hidden" value="' . $page['id'] . '"></form></td>
                                    <td style="width:1%;"><form action="" method="post"><button class="text-primary action-link" name="delete" type="submit"><i class="text-primary far fa-trash-alt"></i></button><input name="id" type="hidden" value="' . $page['id'] . '"></form></td>
                                    </tr>
                                    ';
                                  }
                                echo '
                                  </tbody>
                                  </table>';
                          ?>

                  <div class="modal fade" id="mpgAskDelete">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title" id="test">Smazat formuláře</h4>
                          <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                          <label for="">Opravdu si přejete smazat vybrané formuláře?</label>
                          <br>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" class="btn btn-primary" name="sel_del" value="Smazat">
                          <button type="submit" class="btn btn-danger" data-dismiss="modal">Zrušit</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
            </section>
    <div class="modal fade" id="mfilter">
      <div class="modal-dialog">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Filtr formulářů</h4>
            <button type="button" class="btn-close" data-dismiss="modal"></button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
            <span>Podle sekce:</span>
            <br>
            <?php
            
            $sql_sections = "SELECT * FROM a_sectionss";
            $r_sec = mysqli_query($ccon, $sql_sections);
            while($web = mysqli_fetch_array($r_sec)){
              echo '<button style="width:50%" class="btn btn-secondary" onclick="filter(this)" value="' . $web['web_name'] . '">' . $web['web_name'] . '</button><br>';
            }
            
            ?>
              <button style="width:50%" class="btn btn-danger" onclick="filter(this)" value="">Zrušit filtr</button>;
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Zavřít</button>
          </div>
          
        </div>
      </div>
    </div>

    <div class="modal fade" id="mAddPage">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form method="post">
              <div class="modal-body px-3">
                <div class="d-flex mb-3">
                  <h4 class="modal-title me-auto">Přidat formulář</h4>
                  <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>
                <div class="form-group mb-3">
                  <label for="page_name">Titulek formuláře:</label>
                  <br>
                  <input type="text" id="page_name"  name="form-title" onkeyup="PageURL()" required>
                </div>
                <div class="form-group mb-3">
                  <label for="page_name">Metoda odeslání:</label>
                  <br>
                  <select class="form-select lg-3" name="form-method" required>
                    <option value="0"></option>
                    <option value="1">GET</option>
                    <option value="2">POST</option>
                    </select>
                </div>
                  </div>
                  <div class="modal-footer d-flex">
                      <input type="submit" name="submit-add" class="btn btn-primary" value="Pokračovat">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Zavřít</button>
                  </div>
            </form>
          </div>
      </div>
    </div>

    <?php
    
    if(isset($_GET['success']))
      if($_GET['success'] == 'pg_created')
      {
        echo '<div class="modal fade" id="mpgCreated">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Stránka' . $p['name'] . ' byla úspěšně vytvořena</h4>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <a href="edit.php?id=' . $p['id'] . '" class="btn btn-primary">Pokračovat k úpravě</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Zavřít</button>
  
            </div>
          </div>
        </div>
      </div>';
      }
    ?> 
	</main>                    
</div>
</div>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
<script>
//	$('.navbar-nav>li>a').on('click', function(){
//		$('.navbar-collapse').collapse('hide');
//	});
//	//window.addEventListener("hashchange", function() { scrollBy(0, -50) })
//
//	var shiftWindow = function() { scrollBy(0, -60) };
//	if (location.hash) shiftWindow();
//	window.addEventListener("hashchange", shiftWindow);
        
        
   
        // Funkce pro seřazení řádků tabulky podle čísel v prvním sloupci
function seraditTabulku() {
  var table = document.getElementById("forms"); // Nahraďte "mojeTabulka" ID svou vlastní hodnotou
  
  var rows = Array.from(table.rows);
  
  rows.sort(function(a, b) {
    var cellA = parseInt(a.cells[0].innerHTML);
    var cellB = parseInt(b.cells[0].innerHTML);
    
    if (cellA < cellB) {
      return -1;
    } else if (cellA > cellB) {
      return 1;
    } else {
      return 0;
    }
  });
  
  // Přesunutí seřazených řádků do tabulky
  for (var i = 0; i < rows.length; i++) {
    table.appendChild(rows[i]);
  }
}

// Volání funkce pro seřazení tabulky po načtení Články
window.onload = function() {
  //seraditTabulku();
};
        
    $(document).ready(function(){
  $("#search-bar").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#forms tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
	</script>
  <script>

function filter(input) {
  // Declare variables
  var table, tr, td, i, txtValue;
  table = document.getElementById("forms");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(input.value.toUpperCase()) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

  </script>
  <script>
     function checkAll(source) {
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
      }
    }
  </script>
  <script>
    function PageURL() {
      if(document.querySelector("#pgURLEnable").checked){
        var vstupniElement = document.getElementById("page_name");
        var vystupniElement = document.getElementById("page_identifier");
        
        var vstupniText = vstupniElement.value;
        
        // Přepis mezer na pomlčky
        var textSPomlckami = vstupniText.repage(/\s/g, "-");
        
        // Převod velkých písmen na malá písmena
        var textMalymiPismeny = textSPomlckami.toLowerCase();
        
        // Odstranění diakritiky
        var textBezDiakritiky = textMalymiPismeny.normalize("NFD").repage(/[\u0300-\u036f]/g, "");
        
        vystupniElement.value = textBezDiakritiky;
      }
    }
  </script>
  <script>
    window.onload = function() {
      <?php echo $script ?>
};
  </script>
</body>
</html>