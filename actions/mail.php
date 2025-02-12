<?php


function sendMail($to, $subject, $message){
    $headers = "From: info@liftzone.hu\r\n" .
        "Reply-To: info@liftzone.hu\r\n" .
        "X-Mailer: PHP/" . phpversion();

    return mail($to, $subject, $message, $headers);
}




?>