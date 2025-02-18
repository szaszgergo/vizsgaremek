<?php

function sendMail($to, $tipus): bool{
    $mailPresets = [
        "regisztracio" => ["Sikeres regisztáció!", "Köszönjük hogy csatlakoztál a LiftZonehoz!"],
        "bejelentkezesUj" => ["Sikeres bejelentkezés!", "Új IP címről jelentkeztek be, ellenőrizze ön volt e!"],
        "bejelentkezes" => ["Sikeres bejelentkezés!", "Ön bejelentkezett az oldalra!"]
    ];

    

    $headers = "From: info@liftzone.hu\r\n" .
        "Reply-To: info@liftzone.hu\r\n" .
        "X-Mailer: PHP/" . phpversion();

    $valasztott_email = $mailPresets[$tipus];

    return mail($to, $valasztott_email[0], $valasztott_email[1], $headers);
}




?>