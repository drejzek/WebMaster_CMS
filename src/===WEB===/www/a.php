<?php

  $id = $_GET['clanky'];

  $name = explode("/", $id);
  if(!isset($name[1])){
    echo 'ahooooj';
  }else{

  }
  $l = "";
  $loc = "";

  $sql = "SELECT * FROM articles WHERE a_sec='1' AND identifier = '" . $name[1] . "'";
  $r = mysqli_query($ccon, $sql);
  $l = mysqli_fetch_array($r);

  $sql1 = "SELECT * FROM places WHERE identifier = '" . $name[1] . "'";
  $r1 = mysqli_query($ccon, $sql1);
  $loc = mysqli_fetch_array($r1);
// else{
//     header('location: .');
// }


switch($loc['species']){
    case '0':
        
    break;
    case '1':
        $species = 'Obytné';
    break;
    case '2':
        $species = 'Reprezentativvní';
    break;       
    case '3':
        $species = 'Průmyslové';
    break;
    case '4':
        $species = 'Veřejné';
    break;
    case '5':
        $species = 'Komerční';   
    break;
    case '6':
        $species = 'Vojenské';   
    break;       
    case '7':
        $species = 'Dopravní';   
    break;
    case '8':
        $species = 'Infrastrukturní';
    break;
    case '9':
        $species = 'Technické'; 
    break;
}
switch($loc['type']){
    case '0':

    break;
    case '1':
        $type = 'Budova';
    break;
    case '2':
        $type = 'Podzemní objekt';
    break;       
    case '3':
        $type = 'unel/kanalizace';
    break;
    case '4':
        $type = 'Ruiny';
    break;
    case '5':
        $type = 'Staveniště';
    break;
    case '6':
        $type = 'Doly';
    break;       
}

switch($loc['status']){
    case '0':
    break;
    case '1':
        $status = 'Používaný';
    break;
    case '2':
        $status = 'Částečne používaný';
    break;       
    case '3':
        $status = 'Prázdný';
    break;
    case '4':
        $status = 'Zaniklý';
    break;
}
switch($loc['statistics']){
    case '0':

    break;
    case '1':
        $statistics = 'Špatný';
    break;
    case '2':
        $statistics = 'Dobrý';
    break;        
    case '3':
        $statistics = 'Výborný';

    break;
}
switch($loc['accessibility']){
    case '0':

    break;
    case '1':
        $accessibility = 'Nepřístupné';
    break;
    case '2':
        $accessibility = 'Špatně přístupné';
    break;       
    case '3':
        $accessibility = 'Hůř přístupné';
    break;
    case '4':
        $accessibility = 'Lépe přístupné';
    break;
    case '5':
        $accessibility = 'Zcela přístupné';
    break;
}

?>
<?php include 'assets/header.php'?>
  <style>
    p
    {
      text-align: justify;
    }
  </style>
  <main class="pt-5 mt-5" id="main" data-aos="fade" data-aos-delay="1500">
    <!-- ======= Gallery Single Section ======= -->
    <section id="gallery-single" class="gallery-single">
      <div class="container">
<!--         <h1>Detail lokace</h1>
        <hr> -->
        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8">
            <div class="portfolio-description">
              <h2><?php echo $l['name']?></h2>
              <?php echo $l['content']?>

            </div>
          </div>

          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>Informace o lokaci</h3>
              <ul>
                <li><strong>Druh lokce</strong> <span><?php echo  $species?></span></li>
                <li><strong>Typ lokace</strong> <span><?php echo  $type?></span></li>
                <li><strong>Stav lokace</strong> <span><?php echo  $status?></span></li>
                <li><strong>Stav statiky</strong> <span><?php echo  $statistics?></span></li>
                <li><strong>Přístupnost</strong><?php echo  $accessibility?></li>
              </ul>
            </div>
          </div>

        </div>


        <h1>Adresa a umístění</h1>
        <hr>
        <div class="row justify-content-between gy-4 mt-4">
        <div class="col-lg-6">
            <div class="portfolio-info">
              <h3>Umístění lokace</h3>
              <ul>
                <li><strong>Ulice a ČP</strong> <span>(Již brzy)</span></li>
                <li><strong>Město</strong> <span>(Již brzy)</span></li>
                <li><strong>Země</strong> <span>(Již brzy)</span></li>
                <li><strong>Souřadnice</strong> <span><?php echo $loc['coordinates']?></span></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 mb-5">
            <div id="locmap" style="height:400px"></div>
            <script>
              var locmap = L.map('locmap').setView([<?php echo $loc['coordinates']?>], 15);

              L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
              }).addTo(locmap);

              var marker = L.marker([<?php echo $loc['coordinates']?>]).addTo(locmap) .bindPopup('<?php echo $l['name']?>, <?php echo $loc['coordinates']?>');
            </script>
          </div>
        </div>

        <h3>Galerie</h3>
        <hr>
        <div class="gallery">
          <div class="row">
            <?php
              if ($handle = opendir('www/img/' . $l['img_dir'])) {
                while (false !== ($entry = readdir($handle))) {
                  if ($entry != "." && $entry != "..") {

                    echo 
                    '
                    <div class="col-4">
                      <div class="thumbnail">
                        <img src="www/img/' . $l['img_dir'] . '/' . $entry . '" alt="" width="100%" height="100%">
                      </div>
                    </div>
                    ';
                  }
                }
                closedir($handle);
              }
            ?>
          </div>
        </div>

      </div>
    </section><!-- End Gallery Single Section -->

  </main><!-- End #main -->
  <?php include 'assets/footer.php'?>
