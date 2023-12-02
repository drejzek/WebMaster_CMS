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
        <h1>Detail lokace</h1>
        <hr>
        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8">
            <div class="portfolio-description">
              <h2>Bývalá jatka</h2>
                  <p>
                    Bývalá Jatka sloužila k porážce dobykta a následného spracování masa.
                    Maso bylo následně exportováno, nebo doneseno na prodejnu, která je součástí lokace.
                    Jedná se o areál budov s dovrem, kde hlavní budovu tvoří chladírna, vývěšovna, 
                    expediční část, administrativní budova,
                    chlív, a prodejna. administrativní budova je podsklepená, a má půdu.
                    Na dvoře se nachází čistírna odpadních vod od živočišných zbytků, a samostatnou budovu veterinární stanice.
                  </p>
              <p>
                Přístup do budovy je možný malými dveřmi od hlavní silnice, nebo přes vrata vedoucí do dvora. 
                Všechny budovy jsou přístupné z dvora,
                ale administrativní buda je přístupná pouze otevřeným oknem. Hlavní dveře jsou uzamčeny zámkem.
                 V areálu býval zabezpečovací systém DSC PC2550.
                Nyní je však budova nechráněna. Přístup do areálu je možný i ve dne, a však s menším rizikem dopadení. 
                Vedle areálu se nachází funkční restaurace.
                Areál bývá přes noc obýván bezdomovci, nacházejíc se v administrativní budově.
              </p>

            </div>
          </div>

          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>Informace o lokaci</h3>
              <ul>
                <li><strong>Název lokce</strong> <span>Jatka</span></li>
                <li><strong>Druh lokace</strong> <span>Potravinářská budova</span></li>
                <li><strong>Typ lokace</strong> <span>Prázdný</span></li>
                <li><strong>Stav</strong> <span>Špatný</span></li>
                <li><strong>Stav statiky</strong> <span>Dobrý</span></li>
                <li><strong>Přístupnost</strong>Skvělá</li>
                <li><strong>Datum přidání</strong> <span>01 March, 2022</span></li>
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
                <li><strong>Ulice a ČP</strong> <span>U oharky 915</span></li>
                <li><strong>Město</strong> <span>Žatec</span></li>
                <li><strong>Země</strong> <span>CZE</span></li>
                <li><strong>Souřadnice</strong> <span>50.335027, 13.542076</span></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 mb-5">
            <div id="map" style="height:400px"></div>
            <script>
              var map = L.map('map').setView([50.335027, 13.542076], 15);

              L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
              }).addTo(map);

              var marker = L.marker([50.335027, 13.542076]).addTo(map) .bindPopup('U oharky 915\n43401, Žatec\n50.335027, 13.542076');
            </script>
          </div>
        </div>

        <h3>Galerie</h3>
        <hr>
        <div class="gallery">
          <div class="row">
            <?php
              if ($handle = opendir('img/jatka')) {
                while (false !== ($entry = readdir($handle))) {
                  if ($entry != "." && $entry != "..") {

                    echo 
                    '
                    <div class="col-4">
                      <div class="thumbnail">
                        <img src="img/jatka/' . $entry . '" alt="" width="100%" height="100%">
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
