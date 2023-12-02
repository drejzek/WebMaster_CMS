<?php

    if($_GET['c']){
        $c = $_GET['c'];
    }

    $email_content;
    // Načítá pole z formuláře - name, email a message; odstraňuje bílé znaky; odstraňuje HTML
    $name = 'Coordinates';
    $email = 'support@max-online.cz';
    $subject = 'Coordinates';
    $message = $c;

    // Kontroluje data popř. přesměruje na chybovou adresu
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location:.?success=0#contact");
        exit;
    }

    // Nastavte si email, nakterý chcete, aby se vyplněný formulář odeslal - jakýkoli váš email
    $recipient = "dejvrejzek@seznam.cz";

    // Nastavte předmět odeslaného emailu
    $subject = "Máte nový kontakt od: $name - $subject";

    // Obsah emailu, který se vám odešle
    $email_content = "Jméno: $name\n";
    $email_content .= "Email: $email\n\n";
	$email_content .= "Předmět: $subject\n\n";
    $email_content .= "Zpráva:\n$message\n";

    // Emailová hlavička
    $email_headers = "From: $name <$email>";

    // Odeslání emailu - dáme vše dohromady
    mail($recipient, $subject, $email_content, $email_headers);
    
    // Přesměrování na stránku, pokud vše proběhlo v pořádku
    header("Location:.?success=1#contact");

?>
