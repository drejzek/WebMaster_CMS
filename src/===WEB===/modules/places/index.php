<?php

$min_perm_requied = 1;

include '../kernel/kernel.php';

date_default_timezone_set('Europe/Prague');

$folder = "";
$swid = "";
$p = "";
$p_exists = true;
$script = "";
$msg = "";
$msg_visible = "display: none;";
$msg_class = "";

$sql_m = "SELECT MAX(id) AS id FROM places";
$result_m = mysqli_query($ccon,$sql_m);

if ($result_m->num_rows > 0) {
    $row = $result_m->fetch_assoc();
    $maxId = $row["id"];
} 


$ccon = mysqli_connect("localhost","root","",$_SESSION['domain']);
$sql1 = "SELECT * FROM places";
$place_result = mysqli_query($ccon,$sql1);
//$sql = "SELECT * FROM places WHERE subweb_id = '" . $_SESSION['web_id'] . "'";

if(isset($_POST['edit'])){
    header('location: edit.php?id=' . $_POST['id']);
}
if(isset($_POST['delete'])){
    header('location: delete.php?id=' . $_POST['id']);
}


if(isset($_POST['sel_move'])){
  for($i=0;$i<($maxId + 1);$i++){
    if(isset($_POST['page'][$i])){
      $id = $i;
      $swid = $_POST['page_webid'];
      $sql_sm = "UPDATE `places` SET `a_sec`=$swid WHERE id='$id'";
      $r_sm = mysqli_query($ccon, $sql_sm);
    }
  }
}

if(isset($_POST['sel_del'])){
  for($i=0;$i<($maxId + 1);$i++){
    if(isset($_POST['page'][$i])){
      $id = $i;
      $sql_sd = "DELETE FROM `places` WHERE `id`='$id'";
      $r_sd = mysqli_query($ccon, $sql_sd);
    }
  }
}

if(isset($_POST['AddSec'])){
  $name = $_POST['sec_name'];
  $s_s = "SELECT * FROM p_sections";
  $r_s = mysqli_query($ccon, $s_s);
  $sec_id = ($r_s->num_rows) + 1;
  $sql = "INSERT INTO `p_sections`( `sec_name`, `sec_id`, `visible`, `locked`, `password`) VALUES ('$name','$sec_id','1','0','')";
  $result = mysqli_query($ccon, $sql);
}

if(isset($_GET['success'])){
    if($_GET['success'] == 'delete'){
        $msg = "Lokace byla úspěšně smazána.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
    if($_GET['success'] == 'edit'){
        $msg = "Lokace byla úspěšně upravena.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
    if($_GET['success'] == 'pg_created'){
      if(isset($_GET['id'])){
        $sql_sections = "SELECT * FROM places WHERE id = '" . $_GET['id'] . "'";
        $r_sec = mysqli_query($ccon, $sql_sections);
        $p = mysqli_fetch_array($r_sec);
      }
        $script = "$('#mpgCreated').modal('show');";
        $msg = "Článek byl úspěšně vytvořen.";
        $msg_visible = "display: block;";
        $msg_class = "success";
}
if(isset($_GET['err'])){
    if($_GET['err'] == 'noid'){
        $msg = "Nebyl vybrán žádný Článek.";
        $msg_visible = "display: block;";
        $msg_class = "danger";
    }
}
}
function GetTopPageName($domain, $tpid){  
  $ccon = mysqli_connect("localhost","root","",$domain);
  $sql1 = "SELECT * FROM places WHERE id='$tpid'";
  $result = mysqli_query($ccon,$sql1);
  $nav = mysqli_fetch_array($result);
  $web = $nav['a_sec'];
  $sql = "SELECT * FROM p_sections WHERE sec_id='$web'";
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
      <h2 class="mb-2 mt-2 me-auto">Lokace</h1>
      <div class="mt-2">
        <div class="dropdown">
        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-ellipsis-v"></i>
        </button>
        <ul class="dropdown-menu">
          <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mSecAdmin">Správa rubrik</button></li>
          <li><a href="map.php" class="dropdown-item">Zobrazit lokace na mapě</a></a></li>
        </ul>
      </div>
      </div>
    </div>
    <div class="modal fade" id="mSecAdmin">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="mSecAdmin">Správa rubrik</h4>
            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">&times;</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-3">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><button class="btn" data-bs-toggle="modal" data-bs-target="#mSecAdd">Přidat rubriku</button></li>
              </ul>
              </div>
              <div class="col-sm-9">
                <?php
              
              $sql_sec = "SELECT * FROM p_sections";
              $sec_result = mysqli_query($ccon, $sql_sec);
              echo ' <table id="p_sections" class="table table-hover shadow">
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
                      while($sec = mysqli_fetch_array($sec_result)){
                    echo '
                    <tr style="max-height:50px">
                    <td style="width:5%;"><input type="checkbox" name="page[' . $sec['id'] . ']" id="check' . $sec['id'] . '"></td>
                    <td style="width:3%;">' . $sec['id'] . '</td>
                    <td style="width:20%;"><button data-bs-whatever="' . $sec['id'] . '-' .  $sec['sec_name'] . '" data-bs-toggle="modal" data-bs-target="#mSecEdit" class="btn btn-link action-link" name="edit" type="button" data-bs-whatever="' . $sec['id'] . '">' . $sec['sec_name'] . '</button></td>
                    <td style="width:1%;"><button data-bs-toggle="modal" data-bs-target="#mSecEdit" class="btn btn-link action-link" name="edit" type="button" data-bs-whatever="' . $sec['id'] . '"><i class="fas fa-pen"></i></button></td>
                    <td style="width:1%;"><form action="" method="post"><button class="text-primary action-link" name="delete" type="submit"><i class="text-primary far fa-trash-alt"></i></button><input name="id" type="hidden" value="' . $sec['id'] . '"></form></td>
                    </tr>
                    ';
                  }     
                echo '
                  </tbody>
                  </table>';
            
              ?>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="mSecAdd">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <form action="" method="post">
            <div class="modal-header">
              <h4 class="modal-title" id="mSecAdmin">Správa rubrik - přidat rubriku</h4>
              <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-3">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><button class="btn" data-bs-toggle="modal" data-bs-target="#mSecAdmin">Zpět</button></li>
                  </ul>
                </div>
                <div class="col-sm-9">
                  <dov class="form-group">
                    <label for="#secName">Název rubriky</label>
                    <input type="text" id="secName" name="sec_name" class="form-control" name="secName">
                  </dov>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="AddSec" class="btn btn-success">Vytvořit</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="mSecEdit">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="mSecAdmin">Správa rubrik - upravit rubriku</h4>
            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-3">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><button class="btn" data-bs-toggle="modal" data-bs-target="#mSecAdmin">Zpět</button></li>
              </ul>
              </div>
              <div class="col-sm-9">
                  <dov class="form-group">
                    <label for="#secName">Název rubriky</label>
                    <input type="text" id="secName" class="form-control" name="secName">
                    <input type="hidden" id="secID" class="form-control" name="secID">
                  </dov>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
			<div class="mt-2 alert alert-<?php echo $msg_class?> alert-dismissible fade show" role="alert" style="<?php echo $msg_visible;?>">
          <?php echo $msg; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
            <br>
            <div class="d-flex">
                <input class="form-control" id="search-bar" type="text" class="pl-2 w-50 mr-auto" placeholder="Hledat lokaci...">
                <span class="text-secondary mx-3">Vybrané: </span>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#mpgAskMove" data-toggle="tooltip" title="Přesunout do rubriky"><i class="fas fa-arrow-right"></i></button>
                <button class="btn btn-outline-primary mr-3" data-toggle="modal" data-target="#mpgAskDelete" data-toggle="tooltip" title="Odstranit"><i class="far fa-trash-alt"></i></button>
                <button onclick="seraditTabulku()" class="btn btn-outline-primary" data-toggle="tooltip" title="Seřadit vzestupně"><i class="fas fa-sort-numeric-down"></i></button>
                <button onclick="seraditTabulku()" class="btn btn-outline-primary" data-toggle="tooltip" title="Seředit sestupně"><i class="fas fa-sort-numeric-up"></i></button>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#mfilter" data-toggle="tooltip" title="Filtr"><i class="fas fa-filter"></i></button>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#mAddPage" data-toggle="tooltip" title="Vytvořit článek"><i class="fas fa-plus"></i></button>
            </div>
            <br>
            <form method="post">
            <div id="table">
            <?php 
                                echo ' <table id="places" class="table table-hover shadow">
                                      <thead>
                                      <tr>
                                      <th><input type="checkbox" name="check_all" onclick="checkAll(this);"></th>
                                      <th>ID</th>
                                      <th>Název</th>
                                      <th>Rubrika</th>
                                      <th></th>
                                      <th></th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      ';
                                  while($place = mysqli_fetch_array($place_result)){
                                    echo '
                                    <tr style="max-height:50px">
                                    <td style="width:5%;"><input type="checkbox" name="page[' . $place['id'] . ']" id="check' . $place['id'] . '"></td>
                                    <td style="width:3%;">' . $place['id'] . '</td>
                                    <td style="width:20%;"><form action="" method="post"><button class="btn btn-link action-link" name="edit" type="submit">' . $place['name'] . '</button><input name="id" type="hidden" value="' . $place['id'] . '"></form></td>
                                    <td style="width:20%;">' . GetTopPageName($_SESSION['domain'], $place['id']) . '</td>
                                    <td style="width:1%;"><form action="" method="post"><button class="text-primary action-link" name="edit" type="submit"><i class="text-primary	fas fa-pen"></i></button><input name="id" type="hidden" value="' . $place['id'] . '"></form></td>
                                    <td style="width:1%;"><form action="" method="post"><button class="text-primary action-link" name="delete" type="submit"><i class="text-primary far fa-trash-alt"></i></button><input name="id" type="hidden" value="' . $place['id'] . '"></form></td>
                                    </tr>
                                    ';
                                  }
                                echo '
                                  </tbody>
                                  </table>';
                          ?>
            </div>
            <div style="display:none" id="maps">
            </div>
                          
                  <div class="modal fade" id="mpgAskDelete">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title" id="test">Smazat vybrané lokace</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body text-center">
                          <h4>Opravdu si přejete smazat vybrané lokace?</h4>
                        </div>
                        <div class="modal-footer d-flex">
                          <span class="text-muted">Tuto akci nelze odvolat!</span>
                          <input type="submit" class="ml-auto btn btn-primary" name="sel_del" value="Smazat">
                          <button type="submit" class="btn btn-danger" data-dismiss="modal">Zrušit</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="mpgAskMove">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Kam si přejete vybrané lokace přesunout?</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <label for="page-move">lokace budou v rubrice:</label>
                              <br>
                              <select class="form-select lg-3" style="width:75%; padding:5px;" name="page_webid" required>
                                <option value="0"> - Vyberte - </option>
                                <?php
                                  $sql1 = "SELECT * FROM p_sections";
                                    $sec_result = mysqli_query($ccon,$sql1);
                                    while($a_s = mysqli_fetch_array($sec_result)){
                                      echo '<option value="' . $a_s['sec_id'] . '">' . $a_s['sec_name'] . '</option>';
                                    }
                                                
                                ?>
                                </select>
                              </div>
                                <div class="modal-footer">
                                    <input type="submit" name="sel_move" class="btn btn-primary" value="Pokračovat">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Zavřít</button>
                                </div>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            </section>
    <div class="modal fade" id="mfilter">
      <div class="modal-dialog">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Filtr lokací</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
            <span>Podle rubriky:</span>
            <br>
            <?php
            
            $sql_sections = "SELECT * FROM p_sections";
            $r_sec = mysqli_query($ccon, $sql_sections);
            while($web = mysqli_fetch_array($r_sec)){
              echo '<button style="width:50%" class="btn btn-secondary" onclick="filter(this)" value="' . $web['sec_name'] . '">' . $web['sec_name'] . '</button><br>';
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
            <form action="add.php" method="post">
              <div class="modal-header">
                <h4 class="modal-title">Přidat lokaci</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="page_name">Název:</label>
                  <input class="form-control" type="text" id="page_name"  name="page_name" style="width: 75%" onkeyup="PageURL()" required>
                </div>
                <div class="form-group">
                  <label for="page_name">Identifikátor:</label>
                <input class="form-control" type="text" id="page_identifier"  name="page_identifier" style="width: 75%" required>
                </div>
                <div class="form-group">
                  <select class="form-select lg-3" style="width:75%; padding:5px;" name="page_webid" required>
                  <option value="0"> Vyberte rubriku </option>
                  <?php
                    $sql1 = "SELECT * FROM p_sections";
                      $subwebs_result = mysqli_query($ccon,$sql1);
                      while($sw = mysqli_fetch_array($subwebs_result)){
                        echo '<option value="' . $sw['sec_id'] . '">' . $sw['sec_name'] . '</option>';
                      }
                                  
                  ?>
                  </select>
                </div> 
                </div>
                  <div class="modal-footer">
                      <input type="submit" name="submit" class="btn btn-primary" value="Pokračovat">
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
              <h4 class="modal-title">Článek' . $p['name'] . ' byl úspěšně vytvořen</h4>
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
  var table = document.getElementById("places"); // Nahraďte "mojeTabulka" ID svou vlastní hodnotou
  
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

// Volání funkce pro seřazení tabulky po načtení stránky
window.onload = function() {
  //seraditTabulku();
};
        
    $(document).ready(function(){
  $("#search-bar").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#places tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
	</script>
  <script>

function filter(input) {
  // Declare variables
  var table, tr, td, i, txtValue;
  table = document.getElementById("places");
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
  <script>
    window.onload = function() {
      <?php echo $script ?>
};
  </script>
  <script>
  const exampleModal = document.getElementById('mSecEdit')
    if (exampleModal) {
      exampleModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const input = button.getAttribute('data-bs-whatever')

        const splitted = input.split('-') 
        // If necessary, you could initiate an Ajax request here
        // and then do the updating in a callback.

        // Update the modal's content.
        const modalTitle = exampleModal.querySelector('.modal-title')
        const modalBodyInput = exampleModal.querySelector('.modal-body #secID')
        const modalBodyInput2 = exampleModal.querySelector('.modal-body #secName')

        modalBodyInput.value = splitted['0']
        modalBodyInput2.value = splitted['1']
      })
    }
</script>
</body>
</html>