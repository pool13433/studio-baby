<?php

session_start();
include './db/connect_db.php';
if (!empty($_POST)) {
    $id = $_POST['id'];
    $prefix = $_POST['prefix'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $idcard = $_POST['idcard'];
    $birthdate = $_POST['birthdate'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    
    $sql = "
                UPDATE person SET
                pref_id = $prefix, pers_fname = '$fname',pers_lname = '$lname',
                pers_idcard = '$idcard',pers_birthday = STR_TO_DATE('$birthdate','%Y-%m-%d'),
                pers_email = '$email',pers_phone = '$mobile',
                pers_address = '$address'
                WHERE pers_id = $id    
                ";

    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn).' sql :=='.$sql);
    mysqli_close($conn);
    if ($execute) {
        echo 'แก้ไขข้อมูล ผู้ใช้งาน สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'index.php\'" />';
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'index.php\'" />';
        exit();
    }
}
