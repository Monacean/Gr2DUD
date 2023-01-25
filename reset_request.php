<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
ini_set('display_errors', 1);
if (isset($_POST["reset-request-submit"])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "localhost/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    //link til vår nettside

    $expires = date("U") + 1800;
    //hvor lenge token skal vare, satt til en time.

    require 'database-connect.php';

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, 
    ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;

    require_once "vendor/autoload.php";
    $mail = new PHPMailer(true);

    
    $mail->isSMTP();
    $mail ->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML(true);
    $mail->Username = 'datasikkerhet.gruppe2@gmail.com';
    $mail->Password = '';
    $mail->SetFrom('datasikkerhet.gruppe2@gmail.com');
    $mail->Subject = 'Reset your password for datasikkerhet gruppe 2';
    $mail->Body = $message .= '<p>We recieved a password reset request. The link to reset your password is provided below.</p>
    <p>If you did not make this request, you can ignore this e-mail.</p>
    <p>Here is your password reset link:<br><a href="' . $url . '">' . $url . '</a></p>';

    
    
    $mail->AddAddress($to);

    $mail->Send();

    //kode brukt i tutorial nedenfor.
/*
    $to = $userEmail;

    $subject = 'Reset your password for datasikkerhet gruppe 2';

    $message = '<p>We recieved a password reset request. The link to reset your password is provided below. If 
    you did not make this request, you can ignore this e-mail.</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: DatasikkerhetGr2 <datasikkerhet.gruppe2@gmail.com>\r\n";
    $headers .= "Reply-To: datasikkerhet.gruppe2@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);
*/
    header("Location: /reset_password.php?reset=success");



} else {
    header("Location: /login.php");
}