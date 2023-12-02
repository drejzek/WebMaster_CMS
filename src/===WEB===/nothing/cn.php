<?php

include 'config.php';
$sql = "UPDATE `settings` SET `company_name`='Základní a mateřská škola Staňkovice, Postoloprtská 100, 439 49 Staňkovice' WHERE id='1'";
            $result = mysqli_query($con, $sql);

?>