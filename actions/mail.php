<?php

function sendMail($to, $tipus, $extra = ''): bool{
    $mailPresets = [
        "regisztracio" => ["Sikeres regisztáció!", "Köszönjük hogy csatlakoztál a LiftZonehoz!"],
        "bejelentkezesUj" => ["Új bejelentkezési kísérlet!", "Új IP címről jelentkeztek be. Ha ön volt, kattintson ide: $extra"],
        "bejelentkezes" => ["Sikeres bejelentkezés!", "Ön bejelentkezett az oldalra!"],
        "sikeresToken" => ["Sikeres IP cím megerősítés!", "Az IP címét megerősítettük!"],
        "sikertelenToken" => ["Sikertelen IP cím megerősítés!", "Az IP címét nem sikerült megerősíteni!"],
        "jelszoValtoztatas" => ["Jelszó változtatás!", "Sikeresen megváltoztatta a jelszavát!"],
        "fiokAdatValtoztatas" => ["Fiók adat változtatás!", "Sikeresen megváltoztatta a fiókadatait!"],
        "edzoAdatValtoztatas" => ["Edző adat változtatás!", "Sikeresen megváltoztatta az edzőadatait!"],
        "vasarlas" => ["Vásárlás megerősítése!", "Sikeresen vásárolt!"],
        "edzoPromotalas" => ["Edzővé válás megerősítése!", "Sikeresen edzővé vált!"],
        "2fa" => ["Kétlépcsős azonosítás", "Az Ön 2FA kódja: $extra"],
        "ertesites" => ["Értesítés", "Sikeresen értesítettük!"]
    ];

    

    $headers = "From: info@liftzone.hu\r\n" .
        "Reply-To: info@liftzone.hu\r\n" .
        "X-Mailer: PHP/" . phpversion();

    $valasztott_email = $mailPresets[$tipus];

    return mail($to, $valasztott_email[0], $valasztott_email[1], $headers);
}




?>