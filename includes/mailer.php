<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

function sendMail($to, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';

        $mail->SMTPAuth = true;

        $mail->Username = 'ameramun2002@gmail.com';

        $mail->Password = 'jlym deae taip xkhf';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = 587;

        $mail->setFrom(
            'ameramun2002@gmail.com',
            'Lensora Studio'
        );

        $mail->addAddress($to);

        $mail->isHTML(true);

        $mail->Subject = $subject;

        $mail->Body = $body;

        return $mail->send();

    } catch (Exception $e) {

        return false;
    }
}
?>