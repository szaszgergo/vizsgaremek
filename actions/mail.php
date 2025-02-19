<?php

function sendMail($to, $tipus, $extra = ''): bool{
    $mailPresets = [
        "regisztracio" => ["Sikeres regisztáció!", "Köszönjük hogy csatlakoztál a LiftZonehoz!"],
        "bejelentkezesUj" => ["Új bejelentkezési kísérlet!", "Új IP címről jelentkeztek be. Ha ön volt, kattintson ide: $extra"],
        "bejelentkezes" => ["Sikeres bejelentkezés!", "Ön bejelentkezett az oldalra!"],
        "sikeresToken" => ["Sikeres IP cím megerősítés!", "Az IP címét megerősítettük!"],
        "sikertelenToken" => ["Sikertelen IP cím megerősítés!", "Az IP címét nem sikerült megerősíteni!"],
    ];

    

    $headers = "From: info@liftzone.hu\r\n" .
        "Reply-To: info@liftzone.hu\r\n" .
        "X-Mailer: PHP/" . phpversion();

    $valasztott_email = $mailPresets[$tipus];

    return mail($to, $valasztott_email[0], $valasztott_email[1], $headers);
}




?>