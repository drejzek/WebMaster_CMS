<?php

include 'config.php';
include 'sess.php';

$article_resutl = "";
$page_resutl = "";
$user_resutl = "";
$query = "";

if(isset($_GET['search_query'])){
    $query = $_GET['search_query'];
    $script = "myFunction()";

$article_sql = 'SELECT * FROM articles';
$article_result = mysqli_query($con, $article_sql);

$page_sql = 'SELECT * FROM pages';
$page_result= mysqli_query($con, $page_sql);

$user_sql = 'SELECT * FROM cms_users';
$user_result = mysqli_query($con, $user_sql);
}
?>


<?php
    include 'header/head.php';
    ?>
    <body>
    <?php
    include 'header/sidebar.php';
    include 'header/navbar.php';
    ?>
    
    <div class="modal" id="myModal">
    <!-- Modal content -->
<div class="modal-content">
  <div class="modal-header">
    <h2 class="text-left">Filtr hledání</h2>
    <span class="close">&times;</span>
  </div>
  <div class="modal-body">
<div id="myBtnContainer">
    <button class="btn active" onclick="filterSelection('all')"> Zobrazit vše</button>
  <button class="btn" onclick="filterSelection('page')"> Stránky</button>
  <button class="btn" onclick="filterSelection('article')"> Články</button>
  <button class="btn" onclick="filterSelection('user')"> Uživatelé</button>
</div>
  </div>
</div>
</div>
    
   <main class="container" style="margin-left: 250px;">
       <div class="card">
               <h2 class="card-header">Výsledky hledání pro "<span id=""><?php echo  $query?></span>"</h2>
           <div class="card-body">
                       <button type="button" class="btn btn-info" id="myBtn">Filtr hledání</button>
                       <br>
                       <br>
                       <br>
                      <div class="search-bar" style="display:block">
                            <div class="container">
                                           <ul id="myUL">
               <?php
               if(isset($_GET['search_query'])){
                   while($article = mysqli_fetch_array($article_result)){
                echo '<li class="filterDiv article">Článek: <a href="edit_article.php?id=' . $article['id'] . '">' . $article['name'] . '</a></li>';
               }
               while($page = mysqli_fetch_array($page_result)){
                echo '<li class="filterDiv page">Stránka: <a href="edit_project.php?id=' . $page['id'] . '">' . $page['name'] . '</a></li>';
               }
               while($user = mysqli_fetch_array($user_result)){
                echo '<li class="filterDiv user">Uživatel: <a href="edit_user.php?id=' . $user['id'] . '">' . $user['name'] . '</a></li>';
               }
               }
                   ?>
           </ul>
                            </div>
       </div>
           </div>
       </div>
          </main>
   <script>
       
       // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

//---------------------------------------------------------

       
//function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
//}

//---------------------------------------------------------
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current control button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
        </script>
        
<!--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>-->
<!--        <script src="js/bootstrap.bundle.js"></script>-->
</body>
</html>