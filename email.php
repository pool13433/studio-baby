<?php

sendEmail();

function sendEmail($datas) {
    require("./PHPMailer_v5.0.2/class.phpmailer.php");
    /**
     * This example shows making an SMTP connection with authentication.
     */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('Asia/Bangkok');

//Create a new PHPMailer instance
    $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
    $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
    $mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
//Set the hostname of the mail server
    $mail->Host = "smtp.gmail.com";
//Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
    $mail->SMTPAuth = true;
//Username to use for SMTP authentication
    $mail->Username = $datas['username']; //"poolsawatapin@gmail.com";
//Password to use for SMTP authentication
    $mail->Password = $datas['password']; //"Inno@Pum001";
//Set who the message is to be sent from
    $mail->setFrom($datas['from_email'], $datas['from_user']);
//Set who the message is to be sent to
    $mail->addAddress($datas['to_email'], $datas['to_user']);
//Set the subject line
    $mail->Subject = 'itOffside.com test email';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('content.html'), dirname(__FILE__));
    $mail->msgHTML($datas['message']);

//send the message, check for errors
//    if (!$mail->send()) {
//        echo "Mailer Error: " . $mail->ErrorInfo;
//    } else {
//        echo "Message sent!";
//    }
    return $mail->send();
}
