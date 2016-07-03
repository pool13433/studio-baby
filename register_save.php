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
        echo 'ลงทะเบียน ผู็ใช้งาน สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'index.php\'" />';
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'person_manage.php\'" />';
        exit();
    }
    mysqli_close($conn);
}
