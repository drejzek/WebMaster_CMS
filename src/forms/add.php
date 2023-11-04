<?php

$min_perm_requied = 1;

session_start();

include '../config.php';
include '../sess.php';

date_default_timezone_set('Europe/Prague');

$msg = "";
$msg_visible = "display: none;";
$msg_class = "";
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
        <h3>Přidat formulář</h3>
        <a href="."><i class="fas fa-chevron-left"></i> Zpět</a>
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
      <a class="nav-link" data-toggle="tab" href="#two">Struktura formuláře</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#three">Akce po odeslání</a>
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
            <label for="page_name">Titulek formuláře:</label>
            <input class="form-control" type="text" id="page_name"  name="page_name" value="" onkeyup="PageURL()" required>
      </div>
      <div class="form-group mb-3">
            <label for="page_name">Metoda odeslání dat:</label>
            <select name="form-method" id="">
              <option value="0"></option>
              <option value="1">POST</option>
              <option value="2">GET</option>
            </select>
      </div>
      </div>
      <div class="col-sm-4">
      <div class="accordion" id="accordionFlushExample">
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
            <input class="form-control" type="text" id="page_identifier"  name="page_identifier" style="width: 84%" value="" required>
        </div>
      </div>
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
      <input type="checkbox" name="field[0]" id="visible" value="1">
                <label for="visible">Zobrazit formulář</label>
                <br>
                <input type="checkbox" name="field[3]" id="lock"value="1">
                <label for="lock">Uzamknout formulář</label>
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
                   <div class="bg-white tab-pane fade" id="two">
                    <div class="d-flex justify-content-center align-items-center">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>
                                  Titulek pole
                                </th>
                                <th>
                                  Typ pole
                                </th>
                                <th>
                                  Název
                                </th>
                                <th>
                                  Placeholder
                                </th>
                                <th>
                                  Povinné pole
                                </th>
                              </tr>
                            </thead>
                            <tbody id="fields">

                            </tbody>
                          </table>
                          <br>
                        </div>
                        <button class="btn btn-primary" onclick="AddRow()" id="add-field">Přidat pole</button>
                    </div>
                    <div class="bg-white tab-pane fade" id="three">
                    <h3>Akce po odeslání</h3>
                    
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
    <script src="AddRow.js"></script>
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
