<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://www.davidrejzek.cz/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://www.davidrejzek.cz/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="https://www.davidrejzek.cz/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="text-center" id="load">
        <div class="spinner-border"></div>
        <br>
        <span>Načítám produkty...</span>
    </div>
<ul class="list-group" style="display:none" id="list">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Bývalá jatka</div>
      100 Kč
      <span class="badge bg-primary rounded-pill">Dostupné</span>
    </div>
    <a href="third-cls.php?id=335027&title=B%C3%BDval%C3%A9%20jatky" class="btn btn-outline-primary">Zakoupit</a>

  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Hotel Nachtigal Praha</div>
      100 Kč
      <span class="badge bg-secondary rounded-pill">Nedostupné</span>
    </div>
    <a href="third-cls.php?id=325389&title=Hotel%20Nachtigal%20Praha" class="btn btn-outline-primary disabled">Zakoupit</a>

  </li>
  <!--<li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Subheading</div>
      Content for list item
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li> -->
</ul>
<script>
    setTimeout(() => {
        document.querySelector('#list').style.display="block";
        document.querySelector('#load').style.display="none";
    }, 1000);
</script>
</body>
</html>