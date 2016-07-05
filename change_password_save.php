<?php

session_start();
include './db/connect_db.php';
if (!empty($_POST)) {
    $username = $_POST['username'];
    $password_old = $_POST['password_old'];
    $password_new = $_POST['password_new'];
    $password_renew = $_POST['password_renew'];
    $person = $_SESSION['person'];

    $sql = "SELECT * FROM person WHERE pers_username = '$username' AND pers_password = '$password_old' ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
    $check_oldpassword = mysqli_num_rows($result);
    if ($check_oldpassword == 0) {
        echo 'รหัสผ่านเก่า ไม่ถูกต้อง กรุณาตรวจสอบ';
        echo '<meta http-equiv="refresh" content="1; URL=\'change_password.php\'" />';
        exit();
    } else {
        if (strlen($password_new) < 8 || strlen($password_renew) < 8) {
            echo 'รหัสผ่านใหม่ต้องมีความยาว 8 ตัวอักษรขึ้นไปเท่านั้น กรุณาตรวจสอบ';
            echo '<meta http-equiv="refresh" content="1.5; URL=\'change_password.php\'" />';
            exit();
        } else {
            if ($password_new != $password_renew) {
                echo 'รหัสผ่านใหม่ไม่ตรงกัน กรุณาตรวจสอบ';
                echo '<meta http-equiv="refresh" content="1; URL=\'change_password.php\'" />';
                exit();
            } else {
                $sql = " UPDATE person SET pers_password = '$password_new' WHERE pers_id = " . $person->pers_id;
                $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn) . ' sql :==' . $sql);
                mysqli_close($conn);
                if ($execute) {
                    echo 'บันทึก ข้อมูล สำเร็จ';
                    echo '<meta http-equiv="refresh" content="1; URL=\'index.php\'" />';
                    exit();
                } else {
                    echo "เกิดข้อผิดพลาด deleting record: " . mysqli_error($conn);
                    echo '<meta http-equiv="refresh" content="3; URL=\'index.php\'" />';
                    exit();
                }
            }
        }
    }
}

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
