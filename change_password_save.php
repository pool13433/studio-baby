<?php

session_start();
include './db/connect_db.php';
if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $person = $_SESSION['person'];
    $sql = " UPDATE person SET pers_password = $password WHERE pers_id = " . $person->pers_id;
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
