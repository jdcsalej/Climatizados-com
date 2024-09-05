<?php
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Reemplaza con tu dirección de correo electrónico y configuración de SMTP
$receiving_email_address = 'gerencia@climatizadosdelacosta.com';
$smtp_host = 'mail.climatizadosdelacosta.com';
$smtp_username = 'gerencia@climatizadosdelacosta.com';
$smtp_password = 'rrNHjbz66KAUESde';
$smtp_port = 465; // Puerto SMTP seguro

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recoge los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $body = $_POST['message'];

    // Crea una instancia de PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // Configura el uso de SMTP
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = $smtp_port;

    // Concatena todos los detalles en el mensaje con saltos de línea
    $message = "Asunto: $subject\n";
    $message .= "Nombre: $name\n";
    $message .= "Correo: $email\n";
    $message .= "Teléfono: $phone\n";
    $message .= "Mensaje:\n$body";

    // Configura el correo
    $mail->setFrom($email, $name, $phone);
    $mail->addAddress($receiving_email_address);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Envía el correo
    if ($mail->send()) {
        echo "¡Correo enviado con éxito!";
    } else {
        echo "Error al enviar el correo: " . $mail->ErrorInfo;
    }
} else {
    echo "Acceso prohibido";
}
?>
