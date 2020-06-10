<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

function sendEmail($paraUsuario, $subject, $message_body){

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'cesargustavos2020@gmail.com';                 // SMTP username
    $mail->Password = '987654321cesar';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('cesargustavos2020@gmail.com', 'Bienvenido');
    $mail->addAddress($paraUsuario);

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message_body;

    $mail->send();
    echo 'Mensaje fue enviado';
    } catch (Exception $e) {
       echo 'Mensaje no puedo ser enviado. Mailer Error: ', $mail->ErrorInfo;
    }
}

?>