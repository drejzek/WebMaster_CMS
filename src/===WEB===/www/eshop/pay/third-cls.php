<?php

if(isset($_GET['id']) && isset($_GET['title'])){
    $id = $_GET['id'];
    $title = $_GET['title'];
}

?>

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

    <div class="m-3 row">
        <div class="col-3">

        </div>
        <div class="col-6">
        <h4>Souhrn objednávky</h4>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="">
            <input type="hidden" name="cmd" value="_s-xclick" />
            <input type="hidden" name="hosted_button_id" value="4SPCNU9SY72NL" />
            <div class="form-group my-3">
            <label for="email">E-mail:</label>
            <input type="hidden" name="on0" value="Email"/>
            <input class="form-control" placeholder="Zadejte váš e-mail..." type="email" name="os0" maxLength="200" />
            </div>
            <div class="form-group my-3">
                <label for="email">ID Lokace:</label>
                <input type="hidden" name="on0" value="ID Lokace" require/>
                <input value="<?php echo $id?>" placeholder="ID Lokace" class="form-control" id="id" type="text" name="os0" maxLength="200" /> 
            </div>
            <div class="form-group my-3 w-100">
                <table class="table table-xl border">
                    <tr>
                        <th>Položka</th>
                        <th>Cena</th>
                    </tr>
                    <tr>
                        <td><?php echo $title?></td>
                        <td>100 Kč</td>
                    </tr>
                </table>
            </div>
            <div class="form-group mt-3 text-center">
                <input type="hidden" name="currency_code" value="CZK" />
                <button name="submit" type="submit" class="btn btn-primary btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-paypal" viewBox="0 0 16 16">
  <path d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.351.351 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91.379-.27.712-.603.993-1.005a4.942 4.942 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.687 2.687 0 0 0-.76-.59l-.094-.061ZM6.543 8.82a.695.695 0 0 1 .321-.079H8.3c2.82 0 5.027-1.144 5.672-4.456l.003-.016c.217.124.4.27.548.438.546.623.679 1.535.45 2.71-.272 1.397-.866 2.307-1.663 2.874-.802.57-1.842.815-3.043.815h-.38a.873.873 0 0 0-.863.734l-.03.164-.48 3.043-.024.13-.001.004a.352.352 0 0 1-.348.296H5.595a.106.106 0 0 1-.105-.123l.208-1.32.845-5.214Z"/>
</svg> Zaplatit přes PayPal</button>
            </div>
            <!-- <input type="image" src="https://www.paypalobjects.com/en_CZ/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" /> -->
        </form>
        </div>
        <div class="col-3">

        </div>
    </div>
</body>
</html>