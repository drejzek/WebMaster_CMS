</div>
</div>
<script src="js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="../js/bootstrap.js"></script>
<!--<script src="../js/js.js"></script>-->
<script src="../js/tinymce/tinymce.min.js"></script>
<script>
<?php if($page['subweb_id'] == 4){include '../js/tinymce/sj.tinymce.define.min.js';}else{include '../js/tinymce/tinymce.define.min.js';}?>
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
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
</script>
</body>
</html>
