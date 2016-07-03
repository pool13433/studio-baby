<?php
session_start();
include './db/connect_db.php';
if (!empty($_POST)) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desciption = $_POST['desciption'];
    
    if (empty($_POST['id'])) {
        $sql = "INSERT INTO prefix (pref_name,pref_desc)
            values ('$name','$desciption') ";
    } else {
        $sql = "
                UPDATE prefix SET
                pref_name = '$name',pref_desc = '$desciption'
                WHERE pref_id = $id    
                ";
    }

    $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn).' sql :=='.$sql);
    mysqli_close($conn);
    if ($execute) {
        echo 'บันทึก ข้อมูล สำเร็จ';
        echo '<meta http-equiv="refresh" content="1; URL=\'prefix_manage.php\'" />';
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        echo '<meta http-equiv="refresh" content="3; URL=\'prefix_manage.php\'" />';
        exit();
    }
}
