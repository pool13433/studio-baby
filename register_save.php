<?php

session_start();
include './db/connect_db.php';
if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $prefix = $_POST['prefix'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $idcard = $_POST['idcard'];
    $birthdate = $_POST['birthdate'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    if (strlen($password) < 8) {
        echo 'รหัสผ่านใหม่ต้องมีความยาว 8 ตัวอักษรขึ้นไปเท่านั้น กรุณาตรวจสอบ';
        echo '<meta http-equiv="refresh" content="1.5; URL=\'register.php\'" />';
        exit();
    }

    $sql = "INSERT INTO person (pers_username,pers_password,pref_id,pers_fname,
            pers_lname,pers_birthday,pers_idcard,pers_email,pers_phone,pers_address,
            pers_status)
            values ('$username','$password',$prefix,'$fname',
                '$lname',STR_TO_DATE('$birthdate','%Y-%m-%d'),'$idcard','$email','$mobile','$address',
                 'CUSTOMER') ";

    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
    $last_id = mysqli_insert_id($conn);

    if ($execute) {
        $sql = " SELECT * FROM person WHERE   pers_id = $last_id  ";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
        $data = mysqli_fetch_object($result);
        $_SESSION['person'] = $data;

        /*
         * send mail to
         */
        $datas = array(
            'username' => '',
            'password' => '',
            'from_email' => '',
            'from_user' => '',
            'to_email' => '',
            'to_user' => '',
            'message' =>' อนุมัติการสมัครสมาชิก สำเร็จ เข้าใช้งาน จาก http://localhost/studio/ <br/> username :: '.$username.' ,password :: '.$password 
        );
        $isSendMail = sendEmail($datas);
        if ($isSendMail) {
            echo 'ลงทะเบียน ผู็ใช้งาน สำเร็จ';
            echo '<meta http-equiv="refresh" content="1; URL=\'index.php\'" />';
            exit();
        } else {
            echo "เกิดข้อผิดพลาด ในขั้นตอนการส่งเมลล์: " . var_dump($datas);
            echo '<meta http-equiv="refresh" content="3; URL=\'person_manage.php\'" />';
            exit();
        }
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'person_manage.php\'" />';
        exit();
    }
    mysqli_close($conn);
}

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
