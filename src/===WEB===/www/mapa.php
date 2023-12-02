<?php include 'assets/header.php'?>
  <main class="pt-5 mt-5" id="main" data-aos="fade" data-aos-delay="1500">
    <!-- ======= Gallery Single Section ======= -->
    <section id="gallery-single" class="gallery-single">
      <div class="container">
            <div id="map" style="height:400px"></div>
            <script>
              var map = L.map('map').setView([50.335027, 13.542076], 13);

              L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
              }).addTo(map);

              var marker = L.marker([50.335027, 13.542076]).addTo(map) .bindPopup('H+B Jatky Žatec: U oharky 915\n43801, Žatec\n');
              var marker = L.marker([50.318649, 13.59767]).addTo(map) .bindPopup('Bytový dům: Trnovany 28\n43801, Žatec\n');
              var marker = L.marker([50.318292, 13.597786]).addTo(map) .bindPopup('Depo: Trnovany 28\n43801, Žatec\n');
              var marker = L.marker([50.325389, 13.542642]).addTo(map) .bindPopup('Hotel Nachtigal Praha: Masarykova 349\n43801, Žatec\n'); 
              var marker = L.marker([50.329925, 13.548956]).addTo(map) .bindPopup('Hrázděnka: U plynárny 581\n43801, Žatec\n');
              var marker = L.marker([50.338643, 13.541132]).addTo(map) .bindPopup('Depo, Žatec západ');
              var marker = L.marker([50.350052, 13.571624]).addTo(map) .bindPopup('Závodní jídelna: Postoloprtská 11,\n43949 Staňkovice');
              var marker = L.marker([50.340528, 13.597067]).addTo(map) .bindPopup('Železniční stanice Tvršice:\n43801 Staňkovice');
              var marker = L.marker([50.503953, 13.700471]).addTo(map) .bindPopup('Železniční stanice Obrnice:\n43401 Most');
            </script>
      </div>
    </section><!-- End Gallery Single Section -->

  </main><!-- End #main -->
  <?php include 'assets/footer.php'?>
