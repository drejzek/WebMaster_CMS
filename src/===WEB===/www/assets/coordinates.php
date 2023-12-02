<?php include 'header.php'?>
  <main class="pt-5 mt-5" id="main" data-aos="fade" data-aos-delay="1500">
    <!-- ======= Gallery Single Section ======= -->
    <section id="gallery-single" class="gallery-single">
      <div class="container">

      <input type="text" class="form-control" id="output" readonly>
        
      <div id="map" style="height:400px"></div>
            <script>
              var map = L.map('map').setView([50.335027, 13.542076], 13);

              L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
              }).addTo(map);

            function onMapClick(e) {
                document.querySelector('#output').value = e.latlng.toString().replace('LatLng(', '').replace(')', '');
            }

            map.on('click', onMapClick);
            </script>

      </div>
    </section><!-- End Gallery Single Section -->

  </main><!-- End #main -->
  <?php include 'footer.php'?>
