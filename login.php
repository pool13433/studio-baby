<?php

session_start();
include './db/connect_db.php';
if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT 
             `pers_id`, `pref_id`, `pers_status`, `pers_username`, `pers_password`, `pers_fname`, 
             `pers_lname`, `pers_idcard`, DATE_FORMAT(pers_birthday,'%d-%m-%Y') pers_birthday, `pers_address`, `pers_phone`, `pers_email`,
             `pers_active`, `pers_createdate` FROM person
             WHERE pers_username = '$username' AND pers_password = '$password' ";
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $person = mysqli_fetch_object($result);
        $_SESSION['person'] = $person;
        echo 'ลงชื่อเข้าใช้งานระบบสำเร็จ';
        echo '<meta http-equiv="refresh" content="2; URL=\'index.php\'" />';
        exit();
    } else {
        echo 'ไม่พบข้อมูลผู่ใช้งานในระบบ';
        echo '<meta http-equiv="refresh" content="3; URL=\'index.php\'" />';
        exit();
    }
}