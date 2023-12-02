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
      <a href="." class="me-auto"><i class="fas fa-chevron-left"></i> Zpět</a>
      <!-- <h2 class="mb-2 mt-2">Lokace</h1> -->
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
    <div id="map" class="mt-3" style="height:500px;width:100%"></div>
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