<?php

function sendMail($to, $tipus, $extra = '', $extra2 = ''): bool{
    $mailPresets = [
        "regisztracio" => ["Sikeres regisztáció!", "Köszönjük hogy csatlakoztál a LiftZonehoz!"],
        "bejelentkezesUj" => ["Új bejelentkezési kísérlet!", "Új IP címről jelentkeztek be. Ha ön volt, kattintson ide: $extra\n
        Ha nem ön volt kattintson ide: $extra2"],
        "sikeresToken" => ["Sikeres IP cím megerősítés!", "Az IP címét megerősítettük!"],
        "sikertelenToken" => ["Sikertelen IP cím megerősítés!", "Az IP címét nem sikerült megerősíteni!"],
        "jelszoValtoztatas" => ["Jelszó változtatás!", "Sikeresen megváltoztatta a jelszavát!"],
        "fiokAdatValtoztatas" => ["Fiók adat változtatás!", "Sikeresen megváltoztatta a fiókadatait!"],
        "edzoAdatValtoztatas" => ["Edző adat változtatás!", "Sikeresen megváltoztatta az edzőadatait!"],
        "vasarlas" => ["Vásárlás megerősítése!", "Sikeresen vásárolt!"],
        "edzoPromotalas" => ["Edzővé válás megerősítése!", "Sikeresen edzővé vált!"],
        "2fa" => ["Kétlépcsős azonosítás", "Az Ön 2FA kódja: $extra"],
        "ertesitesma" => ["Értesítés", "A jegye ma lejár!!"],
        "ertesitesholnap" => ["Értesítés", "A jegye holnap lejár!"],
        "ertesitesxnap" => ["Értesítés", "A jegye " . $extra . " nap múlva lejár!"],
        "2fa_enable" => ["Kétlépcsős azonosítás", "Sikeresen beállította a kétlépcsős azonosítást!"],
        "2fa_disable" => ["Kétlépcsős azonosítás", "Sikeresen kikapcsolta a kétlépcsős azonosítást!"],
        "ban" => ["Sikeresen letiltás", "Sikeresen letiltottuk az IP címet!"],
        
    ];

    

    $headers = "From: info@liftzone.hu\r\n" .
        "Reply-To: info@liftzone.hu\r\n" .
        "X-Mailer: PHP/" . phpversion();

    $valasztott_email = $mailPresets[$tipus];

    return mail($to, $valasztott_email[0], $valasztott_email[1], $headers);
}




?>