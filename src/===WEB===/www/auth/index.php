<?php include '../assets/header.php'?>

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= End Page Header ======= -->
    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>Přihlášení</h2>
            <p>Přihlašte se ke svému účtu a získejte přístup k souřadnicím všech lokací.</p>

          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-9">
            <form action="forms/contact.php" method="post" class="form" role="form">
              <div class="row">
              <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Uživatelské jméno:</label>
                      <input type="text" name="username" class="form-control" id="name" placeholder="Uživatelské jméno" required>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Heslo:</label>
                      <input type="password" class="form-control" name="passsword" id="pwd" placeholder="Heslo" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember"><label class="form-check-label" for="remember"> Zapamatovat si mě</label>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                                <button type="submit">Přihlásit</button></div>
                        </div>
                    </div>
              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <?php include '../assets/footer.php'?>