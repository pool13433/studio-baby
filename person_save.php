<?php

session_start();
include './db/connect_db.php';
if (!empty($_POST)) {
    $id = $_POST['id'];
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
    if (empty($_POST['id'])) {
        $sql = "INSERT INTO person (pers_username,pers_password,pref_id,pers_fname,
            pers_lname,pers_birthday,pers_idcard,pers_email,pers_phone,pers_address,
            pers_status)
            values ('$username','$password',$prefix,'$fname',
                '$lname',STR_TO_DATE('$birthdate','%Y-%m-%d'),'$idcard','$email','$mobile','$address',
                 'CUSTOMER') ";
    } else {
        $sql = "
                UPDATE person SET
                pers_username = '$username',pers_password = '$password',
                pref_id = $prefix, pers_fname = '$fname',pers_lname = '$lname',
                pers_idcard = '$idcard',pers_birthday = STR_TO_DATE('$birthdate','%Y-%m-%d'),
                pers_email = '$email',pers_phone = '$mobile',
                pers_address = '$address',persta_id = 'CUSTOMER'
                WHERE pers_id = $id    
                ";
    }

    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn).' sql :=='.$sql);
    mysqli_close($conn);
    if ($execute) {
        echo 'บันทึก ผู็ใช้งาน สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'person_manage.php\'" />';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'person_manage.php\'" />';
        exit();
    }
}
