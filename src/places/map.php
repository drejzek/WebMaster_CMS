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

$sql_m = "SELECT MAX(id) AS id FROM places";
$result_m = mysqli_query($con,$sql_m);

if ($result_m->num_rows > 0) {
    $row = $result_m->fetch_assoc();
    $maxId = $row["id"];
} 


$con = mysqli_connect("localhost","root","",$_SESSION['domain']);
$sql1 = "SELECT * FROM places";
$place_result = mysqli_query($con,$sql1);
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
      $r_sm = mysqli_query($con, $sql_sm);
    }
  }
}

if(isset($_POST['sel_del'])){
  for($i=0;$i<($maxId + 1);$i++){
    if(isset($_POST['page'][$i])){
      $id = $i;
      $sql_sd = "DELETE FROM `places` WHERE `id`='$id'";
      $r_sd = mysqli_query($con, $sql_sd);
    }
  }
}


if(isset($_GET['success'])){
    if($_GET['success'] == 'delete'){
        $msg = "Článek byl úspěšně smazán.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
    if($_GET['success'] == 'edit'){
        $msg = "Článek byl úspěšně upraven.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
    if($_GET['success'] == 'pg_created'){
      if(isset($_GET['id'])){
        $sql_sections = "SELECT * FROM places WHERE id = '" . $_GET['id'] . "'";
        $r_sec = mysqli_query($con, $sql_sections);
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
    <div class="border-bottom d-flex">
      <h2 class="mb-2 mt-2 mr-auto">Lokace</h1>
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

    <div id="map" style="height:500px;width:100%"></div>
                  <script>
                    var map = L.map('map').setView([49.760273, 15.333252], 6);

                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                      maxZoom: 19,
                      attribution: '© OpenStreetMap'
                    }).addTo(map);

                    <?php
                    $conn = mysqli_connect("localhost","root","",$_SESSION['domain']);
                    $sqlmap = "SELECT * FROM places";
                    $mplace_result = mysqli_query($conn,$sqlmap);
                      while($msec = mysqli_fetch_array($mplace_result)){
                        echo 'var marker = L.marker([' . $msec['coordinates'] . ']).addTo(map) .bindPopup(\'' . $msec['name'] . '\');';
                      }
                    ?>
                  </script>

    
</section>
    <div class="modal fade" id="mfilter">
      <div class="modal-dialog">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Filtr stránek</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
            <span>Podle sekce:</span>
            <br>
            <?php
            
            $sql_sections = "SELECT * FROM subwebs";
            $r_sec = mysqli_query($con, $sql_sections);
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
            <form action="add.php" method="post">
              <div class="modal-header">
                <h4 class="modal-title">Přidat lokaci</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <label for="page_name">Název:</label>
                <br>
                <input type="text" id="page_name"  name="page_name" style="width: 75%" onkeyup="PageURL()" required>
                <br>
                <label for="page_name">Identifikátor:</label>
                <br>
                <input type="text" id="page_identifier"  name="page_identifier" style="width: 75%" required>
                <br>
                <label for="page-move">Rubrika:</label>
                <br>
                <select class="form-select lg-3" style="width:75%; padding:5px;" name="page_webid" required>
                  <option value="0"> - Vyberte - </option>
                  <?php
                    $sql1 = "SELECT * FROM p_sections";
                      $subwebs_result = mysqli_query($con,$sql1);
                      while($sw = mysqli_fetch_array($subwebs_result)){
                        echo '<option value="' . $sw['sec_id'] . '">' . $sw['sec_name'] . '</option>';
                      }
                                  
                  ?>
                  </select>
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
<script>
  const btn = document.querySelector('#view_map');
  const tables = document.querySelector('#table');
  const maps = document.querySelector('#maps');

    var i = false;
    btn.addEventListener("click", function() {

      if(i){
        maps.style.visibility = 'none';
        tables.style.display = 'block';
        i = false;
      }
      else{
        maps.style.display = 'inline-block';
        tables.style.display = 'none';
        i = true;
      }
    });

</script>
</body>
</html>