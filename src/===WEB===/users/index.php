<?php

$min_perm_requied = 2;

include '../kernel/kernel.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";
    
$sql = "SELECT * FROM users WHERE customer_id = '$c_id'";

$users_result = mysqli_query($con,$sql);


if(isset($_POST['edit'])){
    header('location: edit.php?id=' . $_POST['id']);
}
if(isset($_POST['delete'])){
    header('location: delete.php?id=' . $_POST['id']);
}
if(isset($_GET['success'])){
    if($_GET['success'] == 'delete'){
        $msg = "Účet byl úspěšně smazán.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
    if($_GET['success'] == 'edit'){
        $msg = "Účet byl úspěšně upraven.";
        $msg_visible = "display: block;";
        $msg_class = "success";
    }
    if($_GET['success'] == 'create'){
        $msg = "Účet byl byl úspěšně vytvořen.";
        $msg_visible = "display: block;";
        $msg_class = "success";
}
if(isset($_GET['err'])){
    if($_GET['err'] == 'noid'){
        $msg = "Nebyl vybrán žádný článek.";
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

<div class="col-md-10" style="padding:0">
	<main role="main" class="container loadable w-100 h-100"  style="width: 100%">
	<section class="container">
            <br>
            <h1>Přehled uživatelů</h1>
            <hr style="width:100%">
            <div class="d-flex">
                <input onkeyup="filter(this)" id="search-bar" type="text" class="form-control w-50 me-auto" placeholder="Hledat uživatele...">
                <span class="text-secondary mx-3">Vybrané: </span>
                <button class="btn btn-outline-primary mr-3" data-toggle="modal" data-target="#mpgAskDelete" data-toggle="tooltip" title="Odstranit"><i class="far fa-trash-alt"></i></button>
                <button onclick="seraditTabulku()" class="btn btn-outline-primary" data-toggle="tooltip" title="Seřadit vzestupně"><i class="fas fa-sort-numeric-down"></i></button>
                <button onclick="seraditTabulku()" class="btn btn-outline-primary" data-toggle="tooltip" title="Seředit sestupně"><i class="fas fa-sort-numeric-up"></i></button>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#mfilter" data-toggle="tooltip" title="Filtr"><i class="fas fa-filter"></i></button>
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#mAddPage" data-toggle="tooltip" title="Vytvořit článek"><i class="fas fa-plus"></i></button>
            </div>
            <br>
			<div class="alert alert-<?php echo $msg_class?>" role="alert" style="<?php echo $msg_visible;?>">
              <?php echo $msg; ?>
            </div>
            
            <?php 
                
                echo ' <table id="users" class="table table-hover shadow w-100">
                <thead>
                        <tr>
                        <th><input type="checkbox" name="check_all" onclick="checkAll(this);"></th>
                        <th>ID</th>
                        <th>Jméno</th>
                        <th>Uživatelskéjméno</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        ';
                
                    while($user = mysqli_fetch_array($users_result)){
                        
                        echo '
                        <tr>
                            <td style="width:5%;"><input type="checkbox" name="page[' . $user['id'] . ']" id="check' . $user['id'] . '"></td>
                            <td style="width:5%;">' . $user['id'] . '</td>
                            <td style="width:25%;">' . $user['name'] . '</td>
                            <td style="width:25%;">' . $user['username'] . '</td>
                            <td style="width:30%;">' . $user['email'] . '</td>
                            <td style="width:5%;"><form action="" method="post"><button class="text-primary action-link" name="edit" type="submit"><i class="text-primary	fas fa-pen"></i></button><input name="id" type="hidden" value="' . $user['id'] . '"></form></td>
                            <td style="width:5%;"><form action="" method="post"><button class="text-primary action-link" name="delete" type="submit"><i class="text-primary far fa-trash-alt"></i></button><input name="id" type="hidden" value="' . $user['id'] . '"></form></td>
                        </tr>
                        ';
                    }     
                echo '
                </tbody>
                    </table>';
                ?>
                <div class="modal fade" id="mpgAskDelete">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title" id="test">Smazat vybrané uživaele</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">
                            Opravdu si přejete smazat vybrané uživatele?
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="sel_del" value="Smazat">
                            <button type="submit" class="btn btn-danger" data-dismiss="modal">Zrušit</button>
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
                <h4 class="modal-title">Vytvořit článek</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <label for="page_name">Titulek článku:</label>
                <br>
                <input type="text" id="page_name"  name="page_name" style="width: 75%" onkeyup="PageURL()" required>
                <br>
                <label for="page_name">Identifikátor:</label>
                <br>
                <input type="text" id="page_identifier"  name="page_identifier" style="width: 75%" required>
                <br>
                <label for="page_author">Autor:</label>
                <br>
                <input type="text" id="page_author"  name="page_author" style="width: 75%" required>
                <br>
                <label for="page-move">Rubrika:</label>
                <br>
                <select class="form-select lg-3" style="width:75%; padding:5px;" name="page_webid" required>
                  <option value="0"> - Vyberte - </option>
                  <?php
                    $sql1 = "SELECT * FROM a_sections";
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
                <br>
            <hr>

		</section>
	</main>   
    </div>

    
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
	<script>
	$('.navbar-nav>li>a').on('click', function(){
		$('.navbar-collapse').collapse('hide');
	});
	//window.addEventListener("hashchange", function() { scrollBy(0, -50) })

	var shiftWindow = function() { scrollBy(0, -60) };
	if (location.hash) shiftWindow();
	window.addEventListener("hashchange", shiftWindow);
	</script>

<script>

function filter(input) {
  // Declare variables
  var table, tr, td, i, txtValue;
  table = document.getElementById("users");
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
</body>
</html>