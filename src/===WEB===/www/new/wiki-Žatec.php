<?php include 'services.php';?>
<button id="myBtn">Přihlsit se</button>
<div id="myModal" class="modal" style="background: #fff">

  <!-- Modal content -->
  <div class="modal-contents">
<div class="content">
       <span class="close">&times;</span>
        <?php include 'text.txt'; ?>
    </div>
  </div>
</div>
<script>// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
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
}</script>