<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$json = [
    "error" => false,
    "message" => ""
];

if ( empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) ) {

    $json["error"] = true;
    $json["message"] = "Por favor, todos os campos devem ser preenchidos.";
    echo json_encode($json);
    exit;

}

$mail = new PHPMailer(true);
// $mail->SMTPDebug  = 2;

try {

    $mail->isSMTP();
    $mail->isHTML(true);
    $mail->setLanguage('br');

    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "tls";
    $mail->CharSet    = "utf-8";

    $mail->Host       = "smtp.live.com";
    $mail->Port       = 587;
    $mail->Username   = "atendimentoskymodel@hotmail.com";
    $mail->Password   = "Bucetaloka159@";

    $body_message = "<strong>Nome:</strong> {$_POST['name']}<br>";
    $body_message .= "<strong>E-mail:</strong> {$_POST['email']}<br>";
    $body_message .= "<strong>Mensagem:</strong> {$_POST['message']}";

    $mail->setFrom($mail->Username, $_POST['name']);
    $mail->addAddress($mail->Username);
    $mail->addBCC("dionathanbraga79@gmail.com");
    
    $mail->isHTML(true);
    $mail->Subject = "Contato pelo site Sky Model";
    $mail->Body    = $body_message;

    $mail->send();

    $json["message"] =  "Mensagem enviada!";

} catch (Exception $e) {

    $json["error"] = true;
    $json["message"] = "Falha ao enviar e-mail. Por favor, entre em contato com um de nossos scouters.";

}

echo json_encode($json);
exit;