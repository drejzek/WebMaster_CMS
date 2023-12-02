
<?php include 'www/assets/header.php'?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade" data-aos-delay="1500">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <h2>Jsem David Rejzek.<br>Urban explorer</h2>
          <p>Vítejte na mém blogu, kde najdete plno zajímavých lokací, zajímmavostí o urbxu, a ochod s lokacemi.</p>
          <a href="#gallery" class="btn-get-started">Prohlédnout mé lokace</a>
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main" data-aos="fade" data-aos-delay="500">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container-fluid">
        <h3 class="text-center">Navštívené lokace</h3>

        <div class="row gy-4 justify-content-center">
        <?php
          
          $sql = "SELECT * FROM articles WHERE a_sec='1'";
          $r = mysqli_query($ccon, $sql);
          while($l = mysqli_fetch_array($r)){
            echo '
              <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="gallery-item h-100">
                    <img src="www/img/' . $l['img_dir'] . '/' . $l['header_img_path'] . '" class="img-fluid" alt="">
                    <div class="gallery-links d-flex align-items-center justify-content-center">
                      <span>' . $l['name'] . '</span>
                      <br>
                      <a href="www/img/' . $l['img_dir'] . '/' . $l['header_img_path'] . '" title="' . $l['name'] . '" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                      <a href="clanky/' . $l['identifier'] . '" class="details-link"><i class="bi bi-link-45deg"></i></a>
                    </div>
                  </div>
                </div><!-- End Gallery Item -->
              ';
            }
          
          ?>  
        </div>

      </div>
    </section><!-- End Gallery Section -->

  </main><!-- End #main -->

<?php include 'www/assets/footer.php'?>