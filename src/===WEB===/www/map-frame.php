<?php

$scr = '';
$title = '';
if(isset($_GET['args']) && isset($_GET['view'])){
    $view = explode('-', $_GET['view']);
    $args = explode('-', $_GET['args']);
    if(isset($_GET['title']))
        $title = $_GET['title'];
    $scr = '';
}
else{
    $view = explode('-', '50.335027-13.542076');
    $scr = "
    
    var marker = L.marker([50.335027, 13.542076]).addTo(map) .bindPopup('H+B Jatky Žatec: U oharky 915\n43801, Žatec\n');
        var marker = L.marker([50.318649, 13.59767]).addTo(map) .bindPopup('Bytový dům: Trnovany 28\n43801, Žatec\n');
        var marker = L.marker([50.318292, 13.597786]).addTo(map) .bindPopup('Depo: Trnovany 28\n43801, Žatec\n');
        var marker = L.marker([50.325389, 13.542642]).addTo(map) .bindPopup('Hotel Nachtigal Praha: Masarykova 349\n43801, Žatec\n'); 
        var marker = L.marker([50.329925, 13.548956]).addTo(map) .bindPopup('Hrázděnka: U plynárny 581\n43801, Žatec\n');
        var marker = L.marker([50.338643, 13.541132]).addTo(map) .bindPopup('Depo, Žatec západ');
        var marker = L.marker([50.350052, 13.571624]).addTo(map) .bindPopup('Závodní jídelna: Postoloprtská 11,\n43949 Staňkovice');
        var marker = L.marker([50.340528, 13.597067]).addTo(map) .bindPopup('Železniční stanice Tvršice:\n43801 Staňkovice');

    ";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div id="map" style="height:100vh;width:100%"></div>
    <script>
        // Žatec: var map = L.map('map').setView([50.335027, 13.542076], 13);
        var map = L.map('map').setView([<?php echo $view[0]?>, <?php echo $view[1]?>], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var marker = L.marker([<?php echo $args[0]?>, <?php echo $args[1]?>]).addTo(map) .bindPopup('<?php echo $title?>');

        <?php echo $src?>
    </script>
</body>
</html>



<!-- <iframe src="https://www.davidrejzek.cz/map-frame.php?view=50.335027-13.542076&amp;args=50.335027-13.542076&amp;title=H%2BB%20Jatky%20%C5%BDatec%3A%20U%20oharky%20915%2C%2043801%20%C5%BDatec" width="600px" height="400px"></iframe> -->
